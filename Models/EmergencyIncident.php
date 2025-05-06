<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyIncident extends Model
{
    use HasFactory;

    protected $table = 'EmergencyIncident';
    protected $primaryKey = 'containsNo';
    public $timestamps = false;

    protected $fillable = [
        'inventoryDeviceID',
        'emergencyID',
        'date',
        'startTime',
        'endTime',
        'emergencyStatus',
        'action'
    ];

    public function inventoryDevice()
    {
        return $this->belongsTo(InventoryDevice::class, 'inventoryDeviceID');
    }

    public function emergencyEntity()
    {
        return $this->belongsTo(EmergencyEntity::class, 'emergencyID');
    }
}
