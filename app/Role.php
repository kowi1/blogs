<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as User;


class Role extends User
{

  protected $fillable=['role_id','role_name']; 

  public function role()
   {
        return $this->hasOne('App\User', 'user_id', 'id');
   }

}


