<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('end', 'desc')->orderBy('status', 'asc');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'scenario',
        'yt',
        'start',
        'end',
        'status',
        'channel',
        'type',
        'course_id',
        'longstatus',
        'person'
    ];
}
