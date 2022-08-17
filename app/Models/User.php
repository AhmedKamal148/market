<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use function PHPUnit\Framework\fileExists;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;


    protected  $appends = ['fullName','image_url'];
    private  $path = "images\user\\";
    private $fullPath ;

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

    /********************************************************** */
    /********************** Accessories ********************** */
    public function getFullNameAttribute()
    {
        return $this->first_name  . ' ' .  $this->last_name;
    } // end FullName-> Accessor
    public  function  getImageUrlAttribute()
    {
        // fullpath = The Image Path From Dir To Image;
        $this->fullPath = $this->path . $this->image;

        if(file_exists($this->fullPath))
        {
            if(str_contains($this->fullPath,'jpg')||
                str_contains($this->fullPath,'png')||
                str_contains($this->fullPath,'jpeg')) {
                return $this->fullPath;
            }
            else{
                // return default image;
                return 'images/user/avatar.png';
            }

        }
        else{
            // return default image;
            return 'images/user/avatar.png';
        }

    }
    // end getImageUrl-> Accessor
    /********************************************************** */



}
