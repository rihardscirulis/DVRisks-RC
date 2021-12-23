<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Factor;
use App\FactorGroup;
use Session;
use App\riskCause;
use App\riskProcedures;
use App\riskCause_ProceduresIDs;

class FactorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }*/

    public function __construct(Factor $factorModel)
    {
        $this->middleware('auth');
        $this->modelFactor = $factorModel;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factorGroupList = $this->modelFactor->getFactorGroupList();
        $factorList = $this->modelFactor->getFactorList();
        $factorRiskCauseList = $this->modelFactor->getRiskCauseList();
        $factorRiskProcedureList = $this->modelFactor->getRiskProcedureList();
        return view('factor.index', compact('factorGroupList', 'factorList', 'factorRiskCauseList', 'factorRiskProcedureList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        if($request->isMethod('post')) {
            $factorGroupID = $request->input('factorGroupListItem');
            $factorName = $request->input('newFactorTitle');
            $factor = new Factor;
            $factor->Nosaukums = $factorName;
            $factor->FaktorsGrupa_ID = $factorGroupID;
            $factor->save();
            if ($request->input('newRiskCauseTitle') && $request->input('newRiskProcedure') == null) {
                return redirect('faktors')->with('success', 'Dati veiksmīgi pievienoti');
            }
            else {
                $riskProcedureName = $request->input('newRiskProcedure');
                $riskProcedure = new riskProcedures;
                $riskProcedure->Nosaukums = $riskProcedureName;
                $riskProcedure->Faktora_ID = $factor->ID;
                $riskProcedure->save();

                $riskCauseCount = $request->input('newRiskCauseTitle');
                for($i=0; $i<count($riskCauseCount); $i++) {
                    $riskCause = new riskCause;
                    $riskCause->Nosaukums = $riskCauseCount[$i];
                    $riskCause->Faktora_ID = $factor->ID;
                    $riskCause->save();

                    $riskCause_ProcedureIDs = new riskCause_ProceduresIDs;
                    $riskCause_ProcedureIDs->RiskaCelonisID = $riskCause->ID;
                    $riskCause_ProcedureIDs->RiskaKartibaID = $riskProcedure->ID;
                    $riskCause_ProcedureIDs->FaktoraGrupaID = $factorGroupID;
                    $riskCause_ProcedureIDs->save();   
                }    
            
                return redirect('faktors')->with('success', 'Dati veiksmīgi pievienoti');
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $factor = Factor::find($id);
        $factorGroup = factorGroup::find($factor->FaktorsGrupa_ID);
        $riskCauseList = DB::table('riska_celonis')
            ->select('ID', 'Nosaukums')->where('Faktora_ID', '=', $factor->ID)->get();
        $riskProcedureList = DB::table('riska_kartiba')
            ->select('ID', 'Nosaukums')->where('Faktora_ID', '=', $factor->ID)->get();
        return view('factor.edit', compact(
            'factor', 
            'factorGroup',
            'riskCauseList', 
            'riskProcedureList'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $factorGroupName = $request->input('factorGroupTitle');
        $factorName = $request->input('factorTitle');
        $riskCauseList = $request->input('riskCause');
        $riskProcedureName = $request->input('riskProcedure');
        $factorID = Factor::find($id);
        $factorGroup = factorGroup::find($factorID->FaktorsGrupa_ID);
        $factorGroup->Nosaukums = $factorGroupName;
        $factorGroup->save();
        //$searchFactorID = DB::table('faktors')->select('ID')->where('Nosaukums', '=', $factorName)->get();
        $factor = Factor::find($id);
        $factor->Nosaukums = $factorName;
        $factor->save();
        if($request->input('checkedriskCauseIDs')) {
            $checkedRiskCauseID = $request->input('checkedriskCauseIDs');
            for ($i=0; $i < count($checkedRiskCauseID); $i++) { 
                $riskCauseDelete = riskCause::find($checkedRiskCauseID[$i]);
                $riskCauseDelete->delete();
            }
        }
        $factorListByFactorGroup = DB::table('riska_celonis')
            ->select('ID', 'Nosaukums')
            ->where('Faktora_ID', '=', $factor->ID)
            ->get();
        for ($i=0; $i < count($factorListByFactorGroup); $i++) { 
            $riskCause = riskCause::find($factorListByFactorGroup[$i]->ID);
            $riskCause->Nosaukums = $riskCauseList[$i];
            $riskCause->save();
        }
        $searchRiskProcedureID = DB::table('riska_kartiba')->select('ID')->where('Faktora_ID', '=', $id)->get();
        $riskProcedure = riskProcedures::find($searchRiskProcedureID[0]->ID);
        $riskProcedure->Nosaukums = $riskProcedureName;
        $riskProcedure->save();
        if($request->input('newRiskCause')) {
            $newRiskCauseList = $request->input('newRiskCause');
            for ($i=0; $i < count($newRiskCauseList); $i++) { 
                $newRiskCause = new riskCause;
                $newRiskCause->Nosaukums = $newRiskCauseList[$i];
                $newRiskCause->Faktora_ID = $id;
                $newRiskCause->save();
            }
        }
        return redirect('/faktors')->with('success', 'Dati veiksmīgi tika mainīti!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factor = Factor::find($id);
        $riskProcedureID = DB::table('riska_kartiba')->select('ID')->where('Faktora_ID', '=', $factor->ID)->get();
        DB::table('riska_celonis')
            ->where('Faktora_ID', '=', $factor->ID)
            ->delete();
        DB::table('riska_kartiba')
            ->where('Faktora_ID', '=', $factor->ID)
            ->delete();
        DB::table('riskacelonis_kartiba')
            ->where('riskacelonis_kartiba.RiskaKartibaID', '=', $riskProcedureID[0]->ID)
            ->delete();
        $factor->delete();
        return redirect('/faktors')->with('success', 'Dati veiksmīgi tika dzēsti!');
    }
}
