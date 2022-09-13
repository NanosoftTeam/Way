<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public function wordlist()
    {
        return $this->belongsTo(Wordlist::class);
    }

    static $rules = [
		'name' => 'required',
        'translation' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'translation', 'wordlist_id', 'name_info', 'translation_info', 'mw', 'iw', 'mt'];
}
