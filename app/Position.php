<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Position extends Model
{
    //Table name
    protected $table = 'amats';

    //Primary Key
    public $primaryKey = 'ID';

    public function getPositionList() {
        $sql = DB::table('amats')
            ->select(
                'amats.id as positionID',
                'amats.nosaukums as positionName',
                'amats.vide_id as environmentID'
            )
            ->get();

        return $sql;
    }

    public function getEnvironmentList() {
        $sql = DB::table('vide')
            ->select(
                'vide.id as environmentID',
                'vide.nosaukums as environmentName',
                'vide.iestade_id as authorityID'
            )
            ->get();

        return $sql;
    }

    public function getAuthorityList() {
        $sql = DB::table('iestade')
            ->select(
                'iestade.id as authorityID',
                'iestade.nosaukums as authorityName'
            )
            ->get();

        return $sql;
    }
}
