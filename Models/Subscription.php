<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'Subscription';
    protected $primaryKey = 'subscriptionID';
    public $timestamps = false;

    protected $fillable = [
        'accountID',
        'PaymentMethod',
        'paymentAmount',
        'startDate',
        'endDate',
        'subscriptionStatus'
    ];

    // Relations
    public function account()
    {
        return $this->belongsTo(Account::class, 'accountID');
    }
}
