<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(Note::class, "parent_id")->orderBy('name');
    }

    public function parent()
    {
        return $this->belongsTo(Note::class, "parent_id");
    }

    protected $fillable = [
        'name',
        'content',
        'parent_id',
        'count_children',
        'file_path',
        'file_name'
    ];
}
