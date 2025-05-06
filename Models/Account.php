<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use Notifiable;

    protected $table = 'Account';
    protected $primaryKey = 'accountID';

    protected $fillable = [
        'accountName',
        'password',
        'email',
        'phoneNumber',
        'accountType'
    ];

    // Relations
    public function members()
    {
        return $this->hasMany(Member::class, 'accountID');
    }

    public function homes()
    {
        return $this->hasMany(Home::class, 'accountID');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'accountID');
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'accountID');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'recipientID');
    }
}
