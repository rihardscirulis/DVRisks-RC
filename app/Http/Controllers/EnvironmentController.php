<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Environment;
use App\workLocation;
use App\Authority;
use DB;

class EnvironmentController extends Controller
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

    public function __construct(Environment $environmentModel)
    {
        $this->middleware('auth');
        $this->modelEnvironment = $environmentModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $environmentList = $this->modelEnvironment->getEnvironmentList();
        $authorityList = $this->modelEnvironment->getAuthorityList();
        $workLocationList = $this->modelEnvironment->getWorkLocationList();
        return view("environment.indexNew", compact('authorityList', 'environmentList', 'workLocationList'));
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
            $environmentName = $request->input("newAuthorityEnvironment");
            $authorityName = $request->input("authorityGroupList");
            $environment = new Environment;
            $environment->Nosaukums = $environmentName;
            $environment->Iestade_ID = $authorityName;
            $environment->save();

            $workLocationNameCount = $request->input('newAuthorityCabinet');
            for($i=0; $i<count($workLocationNameCount); $i++) {
                $workLocation = new workLocation;
                $workLocation->Nosaukums = $workLocationNameCount[$i];
                $workLocation->VideID = $environment->ID;
                $workLocation->save();
            }    

            return redirect('vide')->with('success', 'Dati veiksmīgi pievienoti');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $environment = Environment::find($id);
        $authority = Authority::find($environment->Iestade_ID);
        $authorityList = $this->modelEnvironment->getAuthorityList();
        $workLocationList = DB::table('darba_vieta')->select('ID', 'Nosaukums')->where('VideID', '=', $environment->ID)->get();
        $workLocationCount = 0;
        return view('environment.editNew', compact('environment', 'authority', 'authorityList', 'workLocationList', 'workLocationCount'));
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
        $environment->Iestade_ID = $request->input('authorityGroupList');
        $environment->Nosaukums = $request->input('newAuthorityEnvironment');
        $checkBoxSelected = $request->input('workLocationIDs');
        $workLocationInputName = $request->input('AuthorityCabinet');
        if($request->input('newAuthorityCabinet')) {
            $newWorkLocationInputName = $request->input('newAuthorityCabinet');
            for ($i=0; $i < count($newWorkLocationInputName) ; $i++) { 
                $workLocation = new workLocation;
                $workLocation->Nosaukums = $newWorkLocationInputName[$i];
                $workLocation->VideID = $environment->ID;
                $workLocation->save();
            }
        }
        if($checkBoxSelected){
            for ($i=0; $i < count($checkBoxSelected); $i++) { 
                $workLocationByID = workLocation::find($checkBoxSelected[$i]);
                $workLocationByID->delete();
            } 
        }
        $environment->save();
        return redirect('/vide')->with('success', 'Dati veiksmīgi tika laboti!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $environment = Environment::find($id);
        $workLocation = DB::table('darba_vieta')
            ->select('ID', 'Nosaukums', 'VideID')
            ->where('VideID', '=', $environment->ID)
            ->delete();
        $environment->delete();
        return redirect('/vide')->with('success', 'Dati veiksmīgi tika dzēsti!');
    }
}
