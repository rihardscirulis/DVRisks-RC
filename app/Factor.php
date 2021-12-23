<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Factor extends Model
{
    //Table name
    protected $table = 'faktors';

    //Primary Ke
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

    public function getRiskProcedureList() {
        $sql = DB::table('riska_kartiba')
            ->select(
                'riska_kartiba.id as riskProcedureID',
                'riska_kartiba.nosaukums as riskProcedureName',
                'riska_kartiba.faktora_id as riskProcedureFactorID'
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
