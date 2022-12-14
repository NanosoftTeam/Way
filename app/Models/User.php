<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function messages()
    {
        return $this->hasMany(Message::class, "user_to");
    }

    public function sent_messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class, "user_from");
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

    public function changes()
    {
        return $this->hasMany(Change::class)->orderBy('date', 'desc');
    }

    public function importants()
    {
        return $this->hasMany(Importants::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function wordlists()
    {
        return $this->hasMany(Wordlist::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'unread_messages',
        'team_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
