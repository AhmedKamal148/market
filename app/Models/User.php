<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;


    protected $appends = ['fullName', 'image_url'];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'image',
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
    private $path = "images\user\\";
    private $fullPath;

    /********************** Accessories ********************** */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    } // end FullName-> Accessor

    /********************************************************** */

    public function getImageUrlAttribute()
    {
        return 'images/user/' . $this->image;
    }
    // end getImageUrl-> Accessor
    /********************************************************** */


}
