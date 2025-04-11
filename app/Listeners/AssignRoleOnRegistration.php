<?php

namespace App\Listeners;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Events\Registered;

class AssignRoleOnRegistration
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->assignRole('customer');
    }
}
