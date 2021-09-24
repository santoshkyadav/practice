<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'studio';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'studio_name', 'name', 'email', 'password', 'mobile_no','distributor', 'address', 'status', 'city', 'state', 'Hdd_sno', 'MAC_no', 'model_no', 'ExpiredStudio', 'DomainName',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
     'remember_token',
    ];
}
