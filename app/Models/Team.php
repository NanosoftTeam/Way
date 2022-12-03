<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Team
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Team extends Model
{
  use HasFactory;
  

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function deadlines()
    {
        return $this->hasMany(Deadline::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
    
    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];



}
