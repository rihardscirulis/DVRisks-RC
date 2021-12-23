<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FactorGroup extends Model
{
    //Table name
    protected $table = 'faktorsgrupa';

    //Primary Key
    public $primaryKey = 'ID';
    
    public function getFactorGroupList() {
        $sql = DB::table('faktorsgrupa')
            ->select(
                'faktorsgrupa.id as factorGroupID',
                'faktorsgrupa.nosaukums as factorGroupTitle'
            )
            ->get();

        return $sql;
    }

    public function getFactorGroupListById($id) {
        $sql = DB::table('faktorsgrupa')
            ->join('faktors', 'faktors.FaktorsGrupa_ID', '=', 'faktorsgrupa.ID')
            ->select(
                'faktors.nosaukums as factorTitle'
            )
            ->where('FaktorsGrupa_ID', '=' ,$id)
            ->get();

        return $sql;
    }

}
