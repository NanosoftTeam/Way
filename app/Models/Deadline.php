<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Deadline
 *
 * @property $id
 * @property $name
 * @property $date
 * @property $type
 * @property $description
 * @property $created_at
 * @property $updated_at
 * @property $priority
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Deadline extends Model
{
  use HasFactory;

  public function tasks()
  {
      return $this->hasMany(Task::class);
  }

  public function goals()
  {
      return $this->hasMany(Goal::class);
  }

  public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    static $rules = [
		'name' => 'required',
		'date' => 'required',
		'priority' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','date','type','description','priority','is_planned','user_id','team_id'];



}
