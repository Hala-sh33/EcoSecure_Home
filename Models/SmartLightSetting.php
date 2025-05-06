<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartLightSetting extends Model
{
    use HasFactory;

    protected $table = 'SmartLightSetting';
    protected $primaryKey = 'lightSettingID';
    public $timestamps = false;

    protected $fillable = [
        'inventoryDeviceID',
        'lightBrightness',
        'lightColor'
    ];

    // العلاقة مع الأجهزة الذكية المثبتة في المنازل
    public function inventoryDevice()
    {
        return $this->belongsTo(InventoryDevice::class, 'inventoryDeviceID');
    }
}
