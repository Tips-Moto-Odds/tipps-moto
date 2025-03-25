<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Affiliate;
use App\Models\Matches;
use App\Models\Packages;
use App\Models\Selection;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function subscriptions(Request $request): \Inertia\Response
    {
        $user = Auth::user();
        $now = now();
        $activeSubscriptions = [];
        $userSubscriptions = $user->subscriptions ?? [];

        if ($userSubscriptions) {
            foreach ($userSubscriptions as $subscription) {
                $endDate = \Carbon\Carbon::parse($subscription->end_date)->startOfDay(); // Expiry date at 00:00:00
                $updatedTime = \Carbon\Carbon::parse($subscription->updated_at)->format('H:i:s'); // Time part only


                // If its expired, update it
                if ($endDate->lt($now->startOfDay()) && $updatedTime > $now->format('H:i:s')) {
                    $subscription->status = 'expired';
                    $subscription->save();
                }
            }

            $activeSubscriptions = Selection::whereIn('package_id', $user->subscriptions()->where('status', 'active')->pluck('package_id'))
                ->where('date_for', $now->toDateString())
                ->get();


            $activeSubscriptions = $activeSubscriptions->map(function ($subscription) use ($user){
                $sub = $user->subscriptions()
                    ->where('package_id',$subscription->package_id)
                    ->where('status','active')->first();

                $subscription->end_date = $sub->end_date;

                return $subscription;
            });
        }

        return Inertia::render('UserPanel/Subscriptions', ['subscriptions' => $activeSubscriptions]);
    }

    public function subscriptions_tip(Request $request, Selection $selection): \Inertia\Response
    {
        // Decode the tips JSON
        $tipsData = json_decode($selection->tips, true, 512, JSON_THROW_ON_ERROR) ?? [];

        // Fetch match details for each tip and format them properly
        $formattedTips = collect($tipsData)->map(function ($tip) {

            $match = Matches::find($tip['match_id']);

            return [
                'tip_id' => $tip['tip_id'] ?? null,
                'match_id' => $tip['match_id'],
                'match_start_time' => $match->match_start_time ?? null,
                'home_teams' => $match->home_teams ?? null,
                'away_teams' => $match->away_teams ?? null,
                'league' => $match->league ?? null,
                'mark_as_free' => $tip['mark_as_free'] ?? "0",
                'prediction_type' => $tip['prediction_type'],
                'predictions' => $tip['prediction'],
            ];
        });

        return Inertia::render('UserPanel/PackageTips', [
            'tips' => $formattedTips,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function subscribe(SubscribeRequest $request): RedirectResponse
    {
        $package_id = $request->input('id');

        $transaction_code = $this->generateRandomCode();
        $request['transaction_code'] = $transaction_code;
        $package = Packages::where('name', $request->input('package'))->first();

        //create a new transaction
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'currency' => 'KSH',
            'amount' => number_format($package->price + $package->tax, 2),
            'payment_method' => 'M-Pesa',
            'package_id' => $package_id,
            'transaction_reference' => $transaction_code,
            'transaction_type' => 'subscription',
        ]);

        $onitController = new OnitController();
        $push_stk_result = $onitController->deposit($request, $transaction);

        return redirect()->back()->with('success', 'Subscription request sent. Awaiting confirmation.');
    }


    public function patchUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'sometimes|string|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');

        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');

    }

    public function patchPassword(Request $request, User $user): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'current_password' => 'required|string',
        ]);

        // Check if the provided current password matches the stored password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->back()->with('message', 'Password updated successfully.');
    }

    public function generateRandomCode($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function validateRequest($transaction): bool
    {
        return (new TransactionController())->validatePayment($transaction);
    }


    //TODO:No action
    public function unsubscribe(Request $request): RedirectResponse
    {
        //get password from request
        $request->validate([
            'password' => 'required',
        ]);

        //get validated passwords from request
        $password = $request->input('password');

        //check if password is correct use hash check
        if (!Hash::check($password, auth()->user()->password)) {
            return redirect()->back()->with('error', 'Incorrect password');
        }

        //check if user has an active subscription
        $subscription = Subscription::where('user_id', auth()->user()->id)
            ->where('status', 'active')
            ->first();

        if (!$subscription) {
            return redirect()->back()->with('error', 'You do not have an active subscription');
        }

        $subscription->status = 'cancelled';
        $subscription->save();

        return redirect()->back()->with('success', 'Subscription cancelled successfully');
    }

    public function joinAffiliate(): RedirectResponse
    {
        try {
            if (auth()->user()->affiliate){
                throw new \RuntimeException('User already has an account');
            }

            $referralCode = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));

            $affiliate = Affiliate::updateOrCreate(
                ['user_id' => auth()->id()], // Find by user_id
                ['referral_code' => $referralCode] // Set/update referral_code
            );


            return redirect()->back();

        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
