<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Staff extends Model
{
    //Table name
    protected $table = 'persona';

    //Primary Key
    public $primaryKey = 'ID';
    
    public function getStaffList() {
        $sql = DB::table('persona')
            ->select(
                'persona.id as staffID',
                'persona.vards as staffName',
                'persona.uzvards as staffSurname',
                'persona.personas_kods as staffPersonCode',
                'persona.telefons as staffTelephoneNumber',
                'persona.epasts as staffEmail',
                'persona.amatsid as staffPositionID'
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

    public function getPositionList() {
        $sql = DB::table('amats')
            ->select(
                'amats.id as positionID',
                'amats.nosaukums as positionName',
                'amats.vide_id as environmentID',
                'amats.darbavietaid as positionWorkLocationID'
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

    public function getWorkLocationStaffList() {
        $sql = DB::table('darbavieta_persona')
            ->select(
                'darbavieta_persona.id as workLocationPositionID',
                'darbavieta_persona.darbavietaid as workLocationID',
                'darbavieta_persona.personaid as staffID',
                'darbavieta_persona.videid as environmentID'
            )
            ->get();

        return $sql;
    }
}
