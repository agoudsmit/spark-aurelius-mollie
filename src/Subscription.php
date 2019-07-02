<?php

namespace Laravel\Spark;

use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['provider_plan'];

    /**
     * Get the "provider_plan" attribute from the model.
     *
     * @return string
     */
    public function getProviderPlanAttribute()
    {
        if(Spark::billsUsingStripe()) {
            return $this->stripe_plan;
        }

        if(Spark::billsUsingMollie()) {
            return $this->plan;
        }

        return $this->braintree_plan;
    }
}
