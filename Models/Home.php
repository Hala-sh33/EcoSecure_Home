<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $table = 'Home';
    protected $primaryKey = 'homeID';
    public $timestamps = false;

    protected $fillable = [
        'accountID',
        'streetName',
        'homeNumber',
        'homeType',
        'Country',
        'City',
        'numberOfRooms'
    ];

    // Relations
    public function account()
    {
        return $this->belongsTo(Account::class, 'accountID');
    }

    public function inventoryDevices()
    {
        return $this->hasMany(InventoryDevice::class, 'homeID');
    }
}
