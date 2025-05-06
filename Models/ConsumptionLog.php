<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumptionLog extends Model
{
    use HasFactory;

    protected $table = 'ConsumptionLog';
    protected $primaryKey = 'readingNo';
    public $timestamps = false;

    protected $fillable = [
        'inventoryDeviceID',
        'startStamp',
        'endStamp',
        'consumption'
    ];

    public function inventoryDevice()
    {
        return $this->belongsTo(InventoryDevice::class, 'inventory_device_id');
    }
}
