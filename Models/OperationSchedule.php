<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationSchedule extends Model
{
    use HasFactory;

    protected $table = 'OperationSchedule';
    protected $primaryKey = 'scheduleID';
    public $timestamps = false;

    protected $fillable = [
        'scheduleName',
        'inventoryDeviceID',
        'days',
        'onTime',
        'offTime',
        'startDate',
        'endDate'
    ];
    protected $casts = [
        'days' => 'array',
    ];
    public function inventoryDevice()
    {
        return $this->belongsTo(InventoryDevice::class, 'inventoryDeviceID');
    }
}
