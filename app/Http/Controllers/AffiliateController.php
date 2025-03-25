<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\User;
use App\Modules\AffiliateClassses\AffiliateClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AffiliateController extends Controller
{
    /**
     * Display a listing of affiliates.
     */
    public function index(Request $request): \Inertia\Response
    {
        $affiliates = User::affiliates()
            ->with('affiliate')
            ->latest()
            ->paginate(15)
            ->through(function ($user) {

                $referees = Affiliate::where('referred_by', $user->id)->pluck('user_id');

                if ($referees->isNotEmpty()) {
                    $total = DB::table('transactions')
                        ->whereIn('user_id', $referees)
                        ->sum('amount');

                    $earned = (int) $total * 0.1;
                } else {
                    $earned = 0;
                }


                $user['earned'] = $earned;
                $user['referred'] = $earned;

                return $user;

            });

        return Inertia::render("Administrator/Affiliate/Index", [
            'affiliates' => $affiliates,
        ]);
    }

    /**
     * Store a newly created affiliate in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:affiliates,user_id',
        ]);

        $referralCode = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));

        $affiliate = Affiliate::create([
            'user_id' => $validated['user_id'],
            'referral_code' => $referralCode,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Affiliate created successfully',
            'affiliate' => $affiliate
        ], 201);
    }

    /**
     * Display the specified affiliate.
     */
    public function show(Affiliate $affiliate): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'affiliate' => $affiliate->load('user', 'referrer')
        ]);
    }

    /**
     * Update the specified affiliate in storage.
     */
    public function update(Request $request, Affiliate $affiliate): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'referred_by' => 'sometimes|nullable|exists:users,id',
            'referral_code' => 'sometimes|required|string|unique:affiliates,referral_code,' . $affiliate->id,
        ]);

        $affiliate->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Affiliate updated successfully',
            'affiliate' => $affiliate
        ]);
    }

    /**
     * Soft delete the specified affiliate.
     */
    public function destroy(Affiliate $affiliate): \Illuminate\Http\JsonResponse
    {
        $affiliate->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Affiliate deleted successfully'
        ]);
    }

    /**
     * Restore a soft-deleted affiliate.
     */
    public function restore($id): \Illuminate\Http\JsonResponse
    {
        $affiliate = Affiliate::onlyTrashed()->findOrFail($id);
        $affiliate->restore();

        return response()->json([
            'status' => 'success',
            'message' => 'Affiliate restored successfully',
            'affiliate' => $affiliate
        ]);
    }

    /**
     * Permanently delete the specified affiliate.
     */
    public function forceDelete($id): \Illuminate\Http\JsonResponse
    {
        $affiliate = Affiliate::onlyTrashed()->findOrFail($id);
        $affiliate->forceDelete();

        return response()->json([
            'status' => 'success',
            'message' => 'Affiliate permanently deleted'
        ]);
    }

    public function add_user(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate request data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'referral_code' => 'required|string|exists:affiliates,referral_code',
        ]);

        // Find the affiliate using the referral code
        $affiliate = Affiliate::where('referral_code', $validated['referral_code'])->firstOrFail();

        // Increase total referrals
        $affiliate->increment('total_referrals');

        // Add 10% of the amount to total earnings
        $commission = $validated['amount'] * 0.10;
        $affiliate->increment('total_earnings', $commission);

        return response()->json([
            'status' => 'success',
            'message' => 'Referral updated successfully',
            'affiliate' => $affiliate->refresh()
        ]);
    }

    public function add_purchase(Request $request): ?\Illuminate\Http\JsonResponse
    {
        // Validate request data
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'referral_code' => 'required|string|exists:affiliates,referral_code',
        ]);

        $affiliate = new AffiliateClass($validated['referral_code']);
        $is_CommissionAdded = $affiliate->addPurchase($validated['amount']);

        if ($is_CommissionAdded) {
            return response()->json([
                'status' => 'success',
                'message' => 'Referral updated successfully',
                'affiliate' => $affiliate->getAffiliate()->refresh()
            ]);
        } else {
            Log::error('There was a problem adding commision');
            return null;
        }

    }

}
