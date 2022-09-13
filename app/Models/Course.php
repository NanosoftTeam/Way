<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function films()
    {
        return $this->hasMany(Film::class)->orderBy('end', 'asc')->orderBy('status', 'asc');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'channel',
        'category',
        'p_episodes',
        'yt',
        'scenario',
        'description',
        'status',
        'description',
        'goal',
        'longstatus'
    ];
}
