<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'Message';
    protected $primaryKey = 'messageNumber';

    protected $fillable = [
        'accountID',
        'previousMessageNo',
        'reply',
        'recipientID',
        'text'
    ];

    // Relations
    public function sender()
    {
        return $this->belongsTo(Account::class, 'accountID');
    }

    public function recipient()
    {
        return $this->belongsTo(Account::class, 'recipientID');
    }

    public function previousMessage()
    {
        return $this->belongsTo(Message::class, 'previousMessageNo');
    }
}
