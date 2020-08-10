<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keystore extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];
    protected $primaryKey = 'keystore_id';
    protected $table = 'keystore';


}
