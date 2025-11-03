<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'profile_picture',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $fullName = $user->first_name . ' ' . $user->last_name;
            $user->slug = static::generateUniqueSlug($fullName);
        });

        static::updating(function ($user) {
            if ($user->isDirty('first_name') || $user->isDirty('last_name')) {
                $fullName = $user->first_name . ' ' . $user->last_name;
                $user->slug = static::generateUniqueSlug($fullName);
            }
        });
    }

    protected static function generateUniqueSlug($fullName)
    {
        $slug = Str::slug($fullName);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function workSummaries(){
        return $this->hasMany(WorkSummary::class);
    }
}
