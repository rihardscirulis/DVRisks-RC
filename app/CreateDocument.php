<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class CreateDocument extends Model
{
    protected $table = 'dokuments';

    //Primary Key
    public $primaryKey = 'ID';

    public function getFactorList() {
        $sql = DB::table('faktors')
            ->select(
                'faktors.id as factorID',
                'faktors.nosaukums as factorTitle',
                'faktors.faktorsgrupa_id as factorGroup_ID',
            )
            ->get();

        return $sql;
    }

    public function getFactorGroupList() {
        $sql = DB::table('faktorsgrupa')
            ->select(
                'faktorsgrupa.id as factorGroupID',
                'faktorsgrupa.nosaukums as factorGroupTitle'
            )
            ->get();

        return $sql;
    }

    public function getRiskLevelList(){
        $sql = DB::table('riskslimenis')
            ->select(
                'riskslimenis.id as riskLevelID',
                'riskslimenis.nosaukums as riskLevelTitle'
            )
            ->get();
        
        return $sql;
    }

    public function getAuthorityList(){
        $sql = DB::table('iestade')
            ->select(
                'iestade.id as authorityID',
                'iestade.nosaukums as authorityTitle',
                'iestade.registracijas_numurs as registrationNumber',
                'iestade.talrunis as authorityTelephone',
                'iestade.epasts as authorityEmail',
                'iestade.adrese as authorityAddress'
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

    public function getPersonList() {
        $sql = DB::table('persona')
            ->select(
                'persona.id as personID',
                'persona.vards as personName',
                'persona.uzvards as personSurname'
            )
            ->get();

        return $sql;
    }

    public function getPersonAuthorityList() {
        $sql = DB::table('persona_iestade')
            ->select(
                'persona_iestade.id as ID',
                'persona_iestade.persona_id as personID',
                'persona_iestade.iestade_id as personAuthorityID'
            )
            ->get();

        return $sql;
    }

    public function getRiskCauseList() {
        $sql = DB::table('riska_celonis')
            ->select(
                'riska_celonis.id as riskCauseID',
                'riska_celonis.nosaukums as riskCauseName',
                'riska_celonis.faktora_id as riskCauseFactorID'
            )
            ->get();

        return $sql;
    }
}
