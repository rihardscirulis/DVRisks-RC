@extends('application.index')

@section('content')
    <section class="form cid-sQkANrOFza" id="formbuilder-z">
        <!-- Messages bar -->
        @include('inc.messages')
        <!-- //////////// -->            
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form action="/personals" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name">
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5">Personāla pievienošana/saraksts</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="name-formbuilder-5" class="form-control-label mbr-fonts-style display-7">* - obligātie aizpildāmie lauki</label><br><br>
                                <label class="form-control-label mbr-fonts-style display-7">* Personas vārds, uzvārds:</label>
                                <div class="form-row">
                                    <div class="col">
                                        <input type="text" name="staffName" placeholder="- Ievadiet personas vārdu -" data-form-field="staffName" required="required" class="form-control text-multiple" value="" id="staffName-formbuilder-z">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="staffSurname" placeholder="- Ievadiet personas uzvārdu -" data-form-field="staffSurname" required="required" class="form-control text-multiple" value="" id="staffSurname-formbuilder-z">
                                    </div>
                                </div>
                            </div>
                            <div data-for="staffPersonCode" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="staffPersonCode-formbuilder-z" class="form-control-label mbr-fonts-style display-7">* Personas kods:</label>
                                <input type="text" name="staffPersonCode" placeholder="- Ievadiet personas kodu -" data-form-field="staffPersonCode" class="form-control display-7" required="required" value="" id="staffPersonCode-formbuilder-z">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label class="form-control-label mbr-fonts-style display-7">Telefona numurs, e-pasts:</label>
                                <div class="form-row">
                                    <div class="col">
                                        <input type="text" name="staffTelephoneNumber" placeholder="- Ievadiet telefona numuru -" data-form-field="staffTelephoneNumber" required="required" class="form-control text-multiple" value="" id="staffTelephoneNumber-formbuilder-z">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="staffEmail" placeholder="- Ievadiet personas e-pastu -" data-form-field="staffEmail" required="required" class="form-control text-multiple" value="" id="staffEmail-formbuilder-z">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="selectAuthority">
                                <label for="selectAuthority-formbuilder-z" class="form-control-label mbr-fonts-style display-7">* Izvēlieties iestādi:</label>
                                <select name="authorityListItem" data-form-field="selectAuthority" class="form-control display-7" id="selectAuthority-formbuilder-z">
                                    <option selected disabled hidden value="">- Izvēlieties iestādi -</option>
                                    @foreach ($authorityList as $authority)
                                        <option value="{{$authority->authorityID}}">{{$authority->authorityName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="selectPosition">
                                <label for="selectPosition-formbuilder-z" class="form-control-label mbr-fonts-style display-7">* Izvēlieties amatu:</label>
                                <select name="positionListItem" data-form-field="selectPosition" class="form-control display-7" id="selectPosition-formbuilder-z">
                                    <option  selected disabled hidden value="">-- Izvēlieties amatu --</option>
                                    @foreach ($authorityList as $authority)
                                        <optgroup label="{{$authority->authorityName}}">
                                            @foreach ($environmentList as $environment)
                                                @if ($authority->authorityID == $environment->authorityID)
                                                    <optgroup label="&nbsp;&nbsp;{{$environment->environmentName}}"> 
                                                    @foreach ($positionList as $position)
                                                        @if ($environment->environmentID == $position->environmentID)
                                                            <option value="{{$position->positionID}}">{{$position->positionName}}</option>   
                                                        @endif
                                                    @endforeach
                                                @endif
                                                </optgroup>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="selectEnvironment">
                                <label for="selectEnvironment-formbuilder-z" class="form-control-label mbr-fonts-style display-7">* Izvēlieties darba vietu:</label>
                                <select name="workLocation" data-form-field="selectEnvironment" class="form-control display-7" id="selectEnvironment-formbuilder-z">
                                    <option selected disabled hidden value="">-- Izvēlieties darba vietu --</option>
                                    @foreach ($authorityList as $authority)
                                        <optgroup label="{{$authority->authorityName}}">
                                            @foreach ($environmentList as $environment)
                                                @if ($authority->authorityID == $environment->authorityID)
                                                    <optgroup label="&nbsp;&nbsp;{{$environment->environmentName}}"> 
                                                    @foreach ($workLocationList as $workLocation)
                                                        @if ($workLocation->workLocationEnvironmentID == $environment->environmentID)
                                                            <option value="{{$workLocation->workLocationID}}">{{$workLocation->workLocationName}}</option>   
                                                        @endif
                                                    @endforeach    
                                                @endif
                                                </optgroup>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary display-7">Apstiprināt</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content17 cid-sQkDimmEHi" id="content17-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="mbr-section-head align-center"></div>
                    <div id="bootstrap-toggle" class="toggle-panel accordionStyles tab-content mt-4">
                        @foreach ($authorityList as $authority)
                            <div class="card mb-3">
                                <div class="card-header" role="tab" id="heading{{$authority->authorityID}}">
                                    <a role="button" class="collapsed panel-title text-black" data-toggle="collapse" data-core="" href="#collapse{{$authority->authorityID}}" aria-expanded="false" aria-controls="collapse{{$authority->authorityID}}">
                                        <span class="sign mbr-iconfont mbri-arrow-down inactive"></span>
                                        <h6 class="mbr-fonts-style display-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                                                <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                                            </svg>
                                            {{$authority->authorityName}}  
                                        </h6>
                                    </a>
                                </div>
                                <div id="collapse{{$authority->authorityID}}" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading{{$authority->authorityID}}">
                                    <div class="panel-body p-3">
                                        <div class="row">
                                            <div class="col">
                                                <strong>Darba vide:</strong>
                                            </div>
                                            <div class="col">
                                                <strong>Darba vieta - Personāls:</strong>
                                            </div>
                                            <div class="col">
                                                <strong>Darbības</strong>
                                            </div>
                                        </div>
                                        <hr>
                                        @foreach ($environmentList as $environment)
                                            @if ($environment->authorityID == $authority->authorityID)
                                                <div class="row">
                                                    <div class="col">
                                                        {{$environment->environmentName}}
                                                    </div>
                                                    <div class="col">
                                                        @foreach ($workLocationList as $workLocation)
                                                            @if ($environment->environmentID == $workLocation->workLocationEnvironmentID)
                                                                <strong>{{$workLocation->workLocationName}}:</strong><br>
                                                                @foreach ($staffList as $staff)
                                                                    @foreach ($getWorkLocationStaffList as $workLocationStaff)
                                                                        @if ($staff->staffID == $workLocationStaff->staffID)
                                                                            @if ($workLocation->workLocationID == $workLocationStaff->workLocationID)
                                                                                <div class="row pl-4">
                                                                                    {{$staff->staffName}} {{$staff->staffSurname}}<br>
                                                                                </div>    
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                        @endforeach        
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            {!!Form::open(['action' => ['StaffController@destroy', $environment->environmentID], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
                                                                {{Form::hidden('method', 'DELETE')}}
                                                                {{Form::button('
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                    </svg>', 
                                                                ['type' => 'submit', 'class' => 'btn btn-outline-danger', 'onclick' => 'return confirm("Vai esat pārliecināts ka nepieciešams dzēst?")'])}}
                                                            {!!Form::close() !!}
                                                        </div>
                                                        <div class="row">
                                                            <a href="/personals/{{$environment->environmentID}}/edit" class="btn btn-outline-dark btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                </svg>    
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection