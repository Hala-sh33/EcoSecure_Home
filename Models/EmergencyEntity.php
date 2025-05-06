<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyEntity extends Model
{
    use HasFactory;

    protected $table = 'EmergencyEntity';
    protected $primaryKey = 'emergencyID';
    public $timestamps = false;

    protected $fillable = [
        'inventoryDeviceID',
        'emergencyName',
        'emergencyDescription',
        'emergencyContact'
    ];

    public function inventoryDevice()
    {
        return $this->belongsTo(InventoryDevice::class, 'inventoryDeviceID');
    }
}
