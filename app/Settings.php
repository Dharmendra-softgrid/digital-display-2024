<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    

   
    protected $fillable = [
        'skey', 'svalue', 'type'
    ];

    
    protected $hidden = [
        
    ];


    protected $table = 'settings';

    
    

}
