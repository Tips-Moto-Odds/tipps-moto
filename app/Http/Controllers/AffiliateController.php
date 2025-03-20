<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Affiliate;
use Inertia\Inertia;

class AffiliateController extends Controller
{
    /**
     * Display a listing of affiliates.
     */
    public function index(Request $request): \Inertia\Response
    {
        $affiliates = User::affiliates()->with('affiliate')->latest()->paginate(15);

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
            'user_id' => 'required|exists:users,id',
            'referred_by' => 'nullable|exists:users,id',
            'referral_code' => 'required|string|unique:affiliates,referral_code',
        ]);

        $affiliate = Affiliate::create($validated);

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

    public function add_purchase(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate request data
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'referral_code' => 'required|string|exists:affiliates,referral_code',
        ]);

        // Find the affiliate using the referral code
        $affiliate = Affiliate::where('referral_code', $validated['referral_code'])->firstOrFail();

        // Add 10% of the amount to total earnings
        $commission = $validated['amount'] * 0.10;
        $affiliate->increment('total_earnings', $commission);

        return response()->json([
            'status' => 'success',
            'message' => 'Referral updated successfully',
            'affiliate' => $affiliate->refresh()
        ]);
    }

}
