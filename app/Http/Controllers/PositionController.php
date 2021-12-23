<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Position;
use App\Environment;

class PositionController extends Controller
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

    public function __construct(Position $positionModel)
    {
        $this->middleware('auth');
        $this->modelPosition = $positionModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $environmentList = $this->modelPosition->getEnvironmentList();
        $positionList = $this->modelPosition->getPositionList();
        $authorityList = $this->modelPosition->getAuthorityList();
        return view("position.indexNew", compact('positionList', 'environmentList', 'authorityList'));
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
        if($request->isMethod('post')){
            $positionName = $request->input("newAuthorityPosition");
            $positionEnvironment = $request->input("environmentGroupList");
            $position = new Position;
            $position->Nosaukums = $positionName;
            $position->Vide_ID = $positionEnvironment;
            $position->save();

            return redirect('amats')->with('success', 'Dati veiksmīgi pievienoti');
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
        $environmentList = $this->modelPosition->getEnvironmentList();
        $positionList = $this->modelPosition->getPositionList();
        $authorityList = $this->modelPosition->getAuthorityList();
        $environment = Environment::find($id);
        return view('position.editNew', compact('environmentList', 'positionList', 'authorityList', 'environment'));
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
        $environment = Environment::find($id);
        if($request->input('positions')){
            $positionNames = $request->input('positions');
            $positionListByEnvironmentID = DB::table('amats')
            ->select('ID', 'Nosaukums')
            ->where('Vide_ID', '=', $environment->ID)
            ->get();        
            for ($i=0; $i < count($positionNames) ; $i++) { 
                $position = Position::find($positionListByEnvironmentID[$i]->ID);
                $position->Nosaukums = $positionNames[$i];
                $position->save();
            }
        }
        //if request has new position inputs
        if($request->input('newPosition')) {
            $newPositions = $request->input('newPosition');
            for ($i=0; $i < count($newPositions); $i++) { 
                $newPosition = new Position;
                $newPosition->Nosaukums = $newPositions[$i];
                $newPosition->Vide_ID = $environment->ID; 
                $newPosition->save();   
            }
        }
        //if request has checked position ids
        if ($request->input('checkedPsositionIDs')) {
            $checkedPositionID = $request->input('checkedPsositionIDs');
            for ($i=0; $i < count($checkedPositionID); $i++) { 
                $positionID = Position::find($checkedPositionID[$i]);
                $positionID->delete();
            }
        }
        //if request has environment change
        $environmentName = $request->input('environmentGroupList');
        $environment->Nosaukums = $environmentName;
        $environment->save();
        return redirect('/amats')->with('success', 'Dati veiksmīgi tika mainīti!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = DB::table('amats')
            ->select('ID', 'Nosaukums', 'Vide_ID')
            ->where('Vide_ID', '=', $id)
            ->delete();
        return redirect('/amats')->with('success', 'Dati veiksmīgi tika dzēsti!');
    }
}
