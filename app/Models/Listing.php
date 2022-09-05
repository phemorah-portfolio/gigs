<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewGig;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName() {
        #this key return corresponds with the column in the database that is being referenced for the model route binding
        return 'slug';
    }

    public function user() {
        return $this->belongsTo(related: User::class);
    }

    public function tags() {
        return $this->belongsToMany(related: Tag::class);
    }

    public function sendNewGigNotificationEmail() {
        //  Email Notification Queued before sending
         Mail::to(config('mail.notification_recipient'))
         ->queue(new NewGig($this));

         return redirect()->route('dashboard');
    }
}
