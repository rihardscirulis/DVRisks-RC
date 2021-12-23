<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Authority;
use App\Staff;
use App\StaffWithAuthority;
use App\Environment;

class AuthorityController extends Controller
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

    public function __construct(Authority $authorityModel)
    {
        $this->middleware('auth');
        $this->modelAuthority = $authorityModel;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorityList = $this->modelAuthority->getAuthorityList();
        return view("authority.indexNew", compact('authorityList'));
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
            $authorityName = $request->input("newAuthorityName");
            if($request->input("newAuthorityName") == null){
                return redirect('iestade')->with('error', 'Iestādes nosaukuma aizpildes lauks nedrīkst būt tukšs!');
            }
            $authorityEmail = $request->input("newEmail");
            if($request->input("newEmail") == null){
                return redirect('iestade')->with('error', 'E-pasta aizpildes lauks nedrīkst būt tukšs!');
            }
            $authorityTelephoneNumber = $request->input("newTelephoneNumber");
            if($request->input("newTelephoneNumber") == null){
                return redirect('iestade')->with('error', 'Telefona numura aizpildes lauks nedrīkst būt tukšs!');
            }
            $authorityAddress = $request->input("newAddress");
            if($request->input("newAddress") == null){
                return redirect('iestade')->with('error', 'Adreses aizpildes lauks nedrīkst būt tukšs!');
            }
            $authorityRegistrationNumber = $request->input("newRegistrationNumber");
            if($request->input("newRegistrationNumber") == null){
                return redirect('iestade')->with('error', 'Reģistrācijas numura aizpildes lauks nedrīkst būt tukšs!');
            }
            $authority = new Authority;
            $authority->Nosaukums = $authorityName;
            $authority->Epasts = $authorityEmail;
            $authority->Talrunis = $authorityTelephoneNumber;
            $authority->Adrese = $authorityAddress;
            $authority->Registracijas_numurs = $authorityRegistrationNumber;
            $authority->save();

            return redirect('iestade')->with('success', 'Dati veiksmīgi pievienoti');
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
        $authority = Authority::find($id);
        return view('authority.editNew', compact('authority'));
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
        $authority = Authority::find($id);
        $authority->Nosaukums = $request->input('newAuthorityName');
        $authority->Epasts = $request->input('newEmail');
        $authority->Talrunis = $request->input('newTelephoneNumber');
        $authority->Adrese = $request->input('newAddress');
        $authority->Registracijas_numurs = $request->input('newRegistrationNumber');
        $authority->save();
        return redirect('/iestade')->with('success', 'Dati tika veiksmīgi laboti!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $authority = Authority::find($id);
        //get a list of persons who are in this authority
        $personAuthorityListToDelete = DB::table('persona_iestade')
            ->select('ID', 'persona_ID', 'iestade_ID')
            ->where('iestade_ID', '=', $authority->ID)
            ->get();
        for ($i=0; $i < count($personAuthorityListToDelete); $i++) { 
            //delete persons who are in this authority
            $personIDToDelete = $personAuthorityListToDelete[$i]->persona_ID;
            $staff = Staff::findOrFail($personIDToDelete);
            $staff->delete();
            //deletes staff who assigned to authority ID (persona-iestade)
            DB::table('persona_iestade')
                ->select('ID', 'persona_ID', 'iestade_ID')
                ->where('iestade_ID', '=', $personAuthorityListToDelete[$i]->iestade_ID)
                ->delete();
        }
        //get a list of environments who are in this authority
        $environmentListToDelete = DB::table('vide')
            ->select('ID', 'Nosaukums', 'Iestade_ID')
            ->where('Iestade_ID', '=', $authority->ID)
            ->get();
        for ($i=0; $i < count($environmentListToDelete); $i++) { 
            //deletes work location by environment ID
            DB::table('darba_vieta')
                ->select('ID', 'Nosaukums', 'VideID')
                ->where('VideID', '=', $environmentListToDelete[$i]->ID)
                ->delete();
            //deletes position by environment ID
            DB::table('amats')
                ->select('ID', 'Nosaukums', 'Vide_ID')
                ->where('Vide_ID', '=', $environmentListToDelete[$i]->ID)
                ->delete();
            //deletes work location-person by environmentID
            DB::table('darbavieta_persona')
                ->select('ID', 'DarbaVietaID', 'PersonaID', 'VideID')
                ->where('VideID', '=', $environmentListToDelete[$i]->ID)
                ->delete();
            //then deletes environment itself
            $environment = Environment::findOrFail($environmentListToDelete[$i]->ID);
            $environment->delete();
        }        
        //deletes authority itself
        $authority->delete();
        return redirect('/iestade')->with('success', 'Dati veiksmīgi tika dzēsti!');
    }
}
