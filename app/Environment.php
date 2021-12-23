<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Environment extends Model
{
    //Table name
    protected $table = 'Vide';

    //Primary Ke
    public $primaryKey = 'ID';

    public function getAuthorityList() {
        $sql = DB::table('iestade')
            ->select(
                'iestade.id as authorityID',
                'iestade.nosaukums as authorityName',
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

    public function getWorkLocationList() {
        $sql = DB::table('darba_vieta')
            ->select(
                'darba_vieta.id as workLocationID',
                'darba_vieta.nosaukums as workLocationName',
                'darba_vieta.videid as workLocationEnvironmentID'
            )
            ->get();

        return $sql;
    }
}
