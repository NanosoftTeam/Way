<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function children()
    {
        return $this->hasMany(Task::class, "parent_id")->orderBy('end', 'asc')->orderBy('status', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo(Task::class, "parent_id");
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
    
    public function deadline()
    {
        return $this->belongsTo(Deadline::class);
    }

    protected $fillable = [
        'name',
        'status',
        'user_id',
        'description',
        'longstatus',
        'start',
        'end',
        'film_id',
        'parent_id',
        'count_children',
        'goal_id',
        'deadline_id',
        'duration'
    ];
}
