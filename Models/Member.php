<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'Member';
    protected $primaryKey = 'memberID';
    public $timestamps = false;

    protected $fillable = [
        'accountID',
        'userName'
    ];

    // Relations
    public function account()
    {
        return $this->belongsTo(Account::class, 'accountID');
    }
}
