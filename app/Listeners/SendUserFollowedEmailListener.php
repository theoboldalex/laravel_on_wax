<?php

namespace App\Listeners;

use App\Events\UserFollowed;
use App\Mail\UserFollowedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserFollowedEmailListener
{
    /**
     * Handle the event.
     *
     * @param  UserFollowed  $event
     * @return void
     */
    public function handle(UserFollowed $event)
    {
        Mail::to($event->user->email)
            ->send(new UserFollowedEmail($event->user));
    }
}
