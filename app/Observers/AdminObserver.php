<?php

namespace App\Observers;

use App\Admin;

class AdminObserver
{
    /**
     * Listen to the Admin creating event.
     *
     * @param  \App\Admin  $Admin
     * @return void
     */
    public function creating(Admin $admin)
    {
        $admin->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }

}