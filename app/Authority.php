<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Authority extends Model
{
    protected $table = 'iestade';

    //Primary Key
    public $primaryKey = 'ID';
    
    public function getAuthorityList() {
        $sql = DB::table('iestade')
            ->select(
                'iestade.id as authorityID',
                'iestade.nosaukums as authorityName',
                'iestade.registracijas_numurs as authorityRegistrationNumber',
                'iestade.talrunis as authorityPhoneNumber',
                'iestade.epasts as authorityEmail',
                'iestade.adrese as authorityAddress'
            )
            ->get();

        return $sql;
    }

}
