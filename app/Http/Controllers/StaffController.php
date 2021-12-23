<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use App\StaffWithAuthority;
use App\Position;
use App\workLocation;
use App\workLocation_Position;
use App\Environment;
use App\Authority;
use DB;

class StaffController extends Controller
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

    public function __construct(Staff $staffModel)
    {
        $this->middleware('auth');
        $this->modelStaff = $staffModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorityList = $this->modelStaff->getAuthorityList();
        $positionList = $this->modelStaff->getPositionList();
        $environmentList = $this->modelStaff->getEnvironmentList();
        $staffList = $this->modelStaff->getStaffList();
        $workLocationList = $this->modelStaff->getWorkLocationList();
        $getWorkLocationStaffList = $this->modelStaff->getWorkLocationStaffList();
        return view('staff.indexNew', compact(
            'authorityList', 
            'positionList', 
            'environmentList', 
            'staffList', 
            'workLocationList', 
            'getWorkLocationStaffList')
        );
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
        $staffName = $request->input('staffName');
        $staffSurname = $request->input('staffSurname');
        $staffPersonCode = $request->input('staffPersonCode');
        $staffTelephoneNumber = $request->input('staffTelephoneNumber');
        $staffEmail = $request->input('staffEmail');
        $staffAuthority = $request->input('authorityListItem');
        $staffPosition = $request->input('positionListItem');
        $staffWorkLocation = $request->input('workLocation');

        $staff = new Staff;
        $staff->Vards = $staffName;
        $staff->Uzvards = $staffSurname;
        $staff->Personas_kods = $staffPersonCode;
        $staff->Telefons = $staffTelephoneNumber;
        $staff->Epasts = $staffEmail;
        $staff->AmatsID = $staffPosition;
        $staff->save();

        $staffWithSelectedAuthority = new StaffWithAuthority;
        $staffWithSelectedAuthority->persona_ID = $staff->ID;
        $staffWithSelectedAuthority->iestade_ID = $staffAuthority;
        $staffWithSelectedAuthority->save();

        $staffPositionEnvironmentID = Position::findOrFail($staffPosition);
        $staffWithSelectedWorkLocation = new workLocation_Position;
        $staffWithSelectedWorkLocation->DarbaVietaID = $staffWorkLocation;
        $staffWithSelectedWorkLocation->PersonaID = $staff->ID;
        $staffWithSelectedWorkLocation->VideID = $staffPositionEnvironmentID->Vide_ID;
        $staffWithSelectedWorkLocation->save();

        return redirect('/personals')->with('success', 'Dati veiksmīgi pievienoti');
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
        $authorityList = $this->modelStaff->getAuthorityList();
        $positionList = $this->modelStaff->getPositionList();
        $environmentList = $this->modelStaff->getEnvironmentList();
        $workLocationList = $this->modelStaff->getWorkLocationList();

        $environment = Environment::find($id);
        $authority = Authority::find($environment->Iestade_ID);
        $workLocationDBList = DB::table('darba_vieta')
            ->join('darbavieta_persona', 'darbavieta_persona.DarbaVietaID', '=', 'darba_vieta.ID')
            ->select(
                'darba_vieta.ID as workLocationID', 
                'darba_vieta.Nosaukums as workLocationName',
                'darbavieta_persona.DarbaVietaID as workLocationID',
                'darbavieta_persona.PersonaID as personID')
            ->where('darbavieta_persona.VideID', '=', $id)
            ->get();
        for ($i=0; $i < count($workLocationDBList); $i++) { 
            $personList[] = Staff::find($workLocationDBList[$i]->personID);
        }
        for ($i=0; $i < count($personList); $i++) { 
            $positionListForPerson[] = Position::find($personList[$i]->AmatsID);
        }
        return view('staff.editNew', 
            compact(
                'authorityList', 
                'positionList', 
                'environmentList', 
                'workLocationList',
                'environment',
                'authority',
                'workLocationDBList',
                'personList',
                'positionListForPerson'
            )
        );
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
        $environmentInput = $request->input('environmentItem');
        $staffNameInput = $request->input('staffName');
        $staffSurnameInput = $request->input('staffSurname');
        $staffPersonCodeInput = $request->input('staffPersonCode');
        $staffTelephoneNumberInput = $request->input('staffTelephoneNumber');
        $staffEmailInput = $request->input('staffEmail');
        $staffAuthorityInput = $request->input('authorityItem');
        $staffPositionInput = $request->input('positionItem');
        $staffWorkLocationInput = $request->input('workLocationItem');

        $personListFromDB = DB::table('darbavieta_persona')
            ->select('ID', 'DarbaVietaID', 'PersonaID')
            ->where('VideID', '=', $id)
            ->get();
        for ($i=0; $i < count($personListFromDB); $i++) { 
            $staff[] = Staff::find($personListFromDB[$i]->ID);
        }

        for ($i=0; $i < count($staff); $i++) { 
            $staff[$i]->Vards = $staffNameInput[$i];
            $staff[$i]->Uzvards = $staffSurnameInput[$i];
            $staff[$i]->Personas_kods = $staffPersonCodeInput[$i];
            $staff[$i]->Telefons = $staffTelephoneNumberInput[$i];
            $staff[$i]->Epasts = $staffEmailInput[$i];
            $staff[$i]->AmatsID = $staffPositionInput[$i];
            //if db person id == person id
            if($staff[$i]->ID == $personListFromDB[$i]->PersonaID) {
                $workLocationPosition = workLocation_Position::find($personListFromDB[$i]->ID);
                $workLocationPosition->DarbaVietaID = $staffWorkLocationInput[$i];
                $workLocationPosition->VideID = $environmentInput;
                $workLocationPosition->PersonaID = $staff[$i]->ID;
                $workLocationPosition->save();
            }
            $staff[$i]->save();
        }
        return redirect('/personals')->with('success', 'Dati veiksmīgi tika mainīti!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $workLocationPerson = DB::table('darbavieta_persona')
            ->select('ID', 'DarbaVietaID', 'PersonaID')
            ->where('VideID', '=', $id)
            ->get();
        //dd($workLocationPerson);
        foreach ($workLocationPerson as $key => $person) {
            $staff = Staff::find($person->PersonaID);
            $staffAuthority = DB::table('persona_iestade')
                ->select('ID', 'iestade_ID')
                ->where('persona_ID', '=', $staff->ID)
                ->delete();
            $staff->delete();
        }
        $workLocationPersonDelete = DB::table('darbavieta_persona')
        ->select('ID', 'DarbaVietaID', 'PersonaID')
        ->where('VideID', '=', $id)
        ->delete();
        return redirect('/personals')->with('success', 'Dati veiksmīgi tika dzēsti!');
    }
}
