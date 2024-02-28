<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Helpers\EncryptionDecryptionHelper;

class User extends Authenticatable
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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $table = 'mst_tbl_users';
    protected $primaryKey = 'tbl_user_id';
    public $timestamps = false;
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
        'password' => 'hashed',
    ];

    protected $attributes = [
        'update_by' => null,
        'update_date' => null,
        'update_time' => null
    ];
    

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function setPasswordAttribute($password)
    {
        // Your custom encryption logic goes here
        $encryptedPassword = EncryptionDecryptionHelper::encryptData($password);
        
        $this->attributes['password'] = $encryptedPassword;
    }
}
