<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //Table name
    protected $table = 'dokuments';

    //Primary Key
    public $primaryKey = 'ID';
}
