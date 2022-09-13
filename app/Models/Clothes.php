<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Clothes
 *
 * @property $id
 * @property $type
 * @property $subtype
 * @property $status
 * @property $place
 * @property $notes
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Clothes extends Model
{
    
    static $rules = [
		'type' => 'required',
		'subtype' => 'required',
		'status' => 'required',
		'place' => 'required',
		'notes' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type','subtype','status','place','notes','last_status_changed'];



}
