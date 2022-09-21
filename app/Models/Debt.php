<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Debt
 *
 * @property $id
 * @property $name
 * @property $contact_id
 * @property $amount
 * @property $date
 * @property $status
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Debt extends Model
{
  use HasFactory;

  public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    
    static $rules = [
		'name' => 'required',
		'contact_id' => 'required',
		'amount' => 'required',
		'date' => 'required',
		'status' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','contact_id','amount','date','status','description'];



}
