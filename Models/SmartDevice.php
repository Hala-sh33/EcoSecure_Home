<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartDevice extends Model
{
    use HasFactory;

    protected $table = 'SmartDevice';
    protected $primaryKey = 'deviceID';
    public $timestamps = false;

    protected $fillable = [
        'deviceStatus',
        'deviceType',
        'deviceWarranty',
        'quantityOnHand',
        'Description',
        'year',
        'modelNo',
        'modelin',
        'specification',
        'pic'
    ];

    public function getImagePathAttribute()
    {
        return $this->pic ? asset($this->pic) : asset('def.webp');
    }
}
