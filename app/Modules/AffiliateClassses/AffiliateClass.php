<?php

namespace App\Modules\AffiliateClassses;

use App\Models\Affiliate;

class AffiliateClass
{
    protected Affiliate $affiliate;

    public function __construct($affiliateCode)
    {
        $this->affiliate = Affiliate::where('referral_code',$affiliateCode)->first();
    }

    public function addPurchase($ammount): bool
    {
        $request = request();

        $commission = $ammount * 0.10;
        $this->affiliate->increment('total_earnings', $commission);
        return $this->affiliate->save();
    }

    public function getAffiliate(): Affiliate
    {
        return $this->affiliate;
    }
}
