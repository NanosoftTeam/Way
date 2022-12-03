<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function to()
    {
        return $this->belongsTo(User::class, 'user_to');
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'user_from');
    }

    protected $fillable = [
        'title',
        'content',
        'user_from',
        'user_to',
        'isread',
        'archived',
        'parent_message_id',
        'file_path',
        'file_name'
    ];
}
