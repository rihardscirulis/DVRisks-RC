<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\FactorGroup;
use App\Factor;

class FactorGroupController extends Controller
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

    public function __construct(FactorGroup $factorGroupModel)
    {
        $this->middleware('auth', ['except' => ['show']]);
        $this->modelFactorGroup = $factorGroupModel;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factorGroupList = $this->modelFactorGroup->getFactorGroupList();
        return view('factorgroup.indexNew', compact('factorGroupList'));
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
            /*$this->validate($request, [
                'newFactorGroupTitle' => 'required'
            ]);*/

            $factorTitle = $request->input('newFactorGroupTitle');
            $factorGroup = new FactorGroup;
            $factorGroup->Nosaukums = $factorTitle;
            $factorGroup->save();

            return redirect('faktoragrupa')->with('success', 'Dati veiksmīgi pievienoti');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
        $factorGroup = FactorGroup::find($id);
        return view('factorgroup.editNew', compact('factorGroup'));
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
        $factorGroup = FactorGroup::find($id);
        $factorGroup->Nosaukums = $factorGroupName;
        $factorGroup->save();
        return redirect('/faktoragrupa')->with('success', 'Dati veiksmīgi tika mainīti!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factorGroup = FactorGroup::find($id);
        $allFactorsByGroup = DB::table('faktors')
            ->select('ID', 'Nosaukums')
            ->where('FaktorsGrupa_ID', '=', $id)
            ->get();
        for ($i=0; $i < count($allFactorsByGroup); $i++) { 
            DB::table('riska_celonis')
                ->select('ID', 'Nosaukums')
                ->where('Faktora_ID', '=', $allFactorsByGroup[$i]->ID)
                ->delete();
            DB::table('riska_kartiba')
                ->select('ID', 'Nosaukums')
                ->where('Faktora_ID', '=', $allFactorsByGroup[$i]->ID)
                ->delete();
            $factor = Factor::find($allFactorsByGroup[$i]->ID);
            $factor->delete();
        }
        DB::table('riskacelonis_kartiba')
            ->select('ID', 'RiskaCelonisID', 'RiskaKartibaID')
            ->where('FaktoraGrupaID', '=', $id)
            ->delete();
        $factorGroup->delete();
        return redirect('/faktoragrupa')->with('success', 'Dati veiksmīgi tika dzēsti!');
    }
}
