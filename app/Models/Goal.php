<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Goal
 *
 * @property $id
 * @property $name
 * @property $description
 * @property $deadline_id
 * @property $type
 * @property $priority
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Goal extends Model
{
  use HasFactory;

  public function tasks()
  {
      return $this->hasMany(Task::class);
  }

  public function deadline()
    {
        return $this->belongsTo(Deadline::class);
    }
    
    static $rules = [
		'name' => 'required',
		'priority' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','deadline_id','type','priority'];



}
