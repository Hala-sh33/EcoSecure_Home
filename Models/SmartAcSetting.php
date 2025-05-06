<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartAcSetting extends Model
{
    use HasFactory;

    protected $table = 'SmartAcSetting';
    protected $primaryKey = 'acSettingID';
    public $timestamps = false;

    protected $fillable = [
        'inventoryDeviceID',
        'acFan',
        'acTemperature',
        'acMode'
    ];

    public function inventoryDevice()
    {
        return $this->belongsTo(InventoryDevice::class, 'inventoryDeviceID');
    }
}
