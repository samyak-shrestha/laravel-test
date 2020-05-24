<?php

namespace Modules\Crud\Entities;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    protected $fillable = ['first_name', 'last_name'];
}
