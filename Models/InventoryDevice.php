<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDevice extends Model
{
    use HasFactory;

    protected $table = 'InventoryDevice';
    protected $primaryKey = 'inventoryDeviceID';
    public $timestamps = false;

    protected $fillable = [
        'homeID',
        'deviceID',
        'deviceLocation',
        'is_on',
        'color',
        'size'
    ];

    // Relations
    public function home()
    {
        return $this->belongsTo(Home::class, 'homeID');
    }

    public function smartDevice()
    {
        return $this->belongsTo(SmartDevice::class, 'deviceID');
    }

    public function consumptionLogs()
    {
        return $this->hasMany(ConsumptionLog::class, 'inventoryDeviceID');
    }
    public function operationSchedule()
    {
        return $this->hasOne(OperationSchedule::class, 'inventoryDeviceID');
    }
    public function lightSetting()
    {
        return $this->hasOne(SmartLightSetting::class, 'inventoryDeviceID');
    }
    public function acSetting()
    {
        return $this->hasOne(SmartAcSetting::class, 'inventoryDeviceID');
    }


}
