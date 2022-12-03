<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lesson
 *
 * @property $id
 * @property $name
 * @property $day
 * @property $lesson_number
 * @property $classroom_number
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Lesson extends Model
{
    
    static $rules = [
		'name' => 'required',
		'day' => 'required',
		'lesson_number' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','day','lesson_number','classroom_number','description','user_id'];



}
