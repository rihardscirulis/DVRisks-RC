<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Risk extends Model
{
    //Table name
    protected $table = 'Risks';

    //Primary Ke
    public $primaryKey = 'ID';

    public function getFactorList() {
        $sql = DB::table('faktors')
            ->join('faktorsgrupa', 'faktorsgrupa.id', '=', 'faktors.faktorsgrupa_id')
            ->select(
                'faktors.id as factorID',
                'faktors.nosaukums as factorTitle',
                'faktorsgrupa.nosaukums as factorGroupTitle',
                'faktors.faktorsgrupa_id as factorTableGroupID',
                'faktorsgrupa.id as factorGroupID'
            )
            ->get();

        return $sql;
    }

    public function getFactorGroupList() {
        $sql = DB::table('faktorsgrupa')
            ->select(
                'faktorsgrupa.id as id',
                'faktorsgrupa.nosaukums as title'
            )
            ->get();

        return $sql;
    }
}
