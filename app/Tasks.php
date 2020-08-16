<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];
    protected $primaryKey = 'task_id';
    protected $table = 'tasks';
}
