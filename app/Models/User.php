<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\Role;



class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;
    use HasRoles;
    use HasApiTokens;

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
        'gender',
        'birth_date',
        'phone',
        'profilePictureURL',
        'experience',
        'personalQualities',
        'skills',
        'ACACED',
        'status'
    ];
    public function setPasswordAttribute($mdp)
    {
        $this->attributes['password'] = bcrypt($mdp);
    }
    
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

    

    
    function isAdmin()
    {
        return $this->hasRole('Admin');
    }
    function isSuperAdmin()
    {
        return $this->hasRole('SuperAdmin');
    }
    function isUser()
    {
        return $this->hasRole('User');
    }
    function isDeleted()
    {
        return $this->status == 'deleted';
    }
    function isActive()
    {
        return $this->status == 'active';
    }
    function isBlocked()
    {
        return $this->status == 'blocked';
    }
    function isBanned()
    {
        return $this->status == 'banned';
    }
    function isSuspended()
    {
        return $this->status == 'suspended';
    }
    function isPending()
    {
        return $this->status == 'pending';
    }
    function isInProgress()
    {
        return $this->status == 'in progress';
    }

}