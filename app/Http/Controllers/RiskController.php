<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Risk;

class RiskController extends Controller
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

    public function __construct(Risk $riskModel)
    {
        $this->middleware('auth');
        $this->modelRisk = $riskModel;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factorList = $this->modelRisk->getFactorList();
        $factorGroupList = $this->modelRisk->getFactorGroupList();
        return view('risk.index', compact('factorList', 'factorGroupList'));
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
            $this->validate($request ,[
                'newFactorGroupTitle' => 'required'
            ]);

            $riskTitle = $request->input('newFactorGroupTitle');
            $risk = new Risk;
            $risk->Nosaukums = $riskTitle;
            $risk->save();

            return redirect('risks')->with('success', 'Dati veiksmīgi pievienoti');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}