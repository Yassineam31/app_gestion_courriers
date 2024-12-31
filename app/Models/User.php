<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomEmailVerification;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\CourrierEntrant;
use App\Models\ArchiveEntrant;
use App\Models\CourrierSortant;
use App\Models\ArchiveSortant;

class User extends Authenticatable implements MustVerifyEmail 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'division',
        'services',
        'poste'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomEmailVerification());
    }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
    
    public function courrierEntrants(){
        return $this->hasMany(CourrierEntrant::class);
    }

    public function archiveEntrants(){
        return $this->hasMany(ArchiveEntrant::class);
    }

    public function courrierSortants(){
        return $this->hasMany(CourrierSortant::class);
    }

    public function archiveSortants(){
        return $this->hasMany(ArchiveSortant::class);
    }
}
