<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffWithAuthority extends Model
{
    //Table name
    protected $table = 'persona_iestade';

    //Primary Key
    public $primaryKey = 'ID';
}
