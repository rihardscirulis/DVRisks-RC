@extends('application.index')

@section('content')
    <section class="form cid-sQkANrOFza" id="formbuilder-z" style="padding-bottom: 200px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    {!! Form::open(['action' => ['StaffController@update', $environment->ID], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'mbr-form form-with-styler', 'data-form-title' => 'Form Name']) !!}
                        @csrf    
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5">Personāla saraksta labošanas forma</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div data-for="environment" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="environment-formbuilder-z" class="form-control-label mbr-fonts-style display-7">* Rediģēt darba vidi:</label>
                                <select name="environmentItem" data-form-field="selectEnvironment" class="form-control display-7" id="selectEnvironment-formbuilder-m">
                                    <option selected hidden value="{{$environment->ID}}">{{$environment->Nosaukums}}</option>
                                    @foreach ($environmentList as $environment)
                                        <option value="{{$environment->environmentID}}">{{$environment->environmentName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                                $i = 1;
                                $authorityID = $authority->ID;
                                $authorityName = $authority->Nosaukums;
                            @endphp
                            @foreach ($personList as $person)
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <hr>
                                </div>
                                <label class="form-control-label mbr-fonts-style display-7"># {{$i++}}. persona - {{$person->Vards}} {{$person->Uzvards}}:</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label class="form-control-label mbr-fonts-style display-7">* Rediģēt personas vārdu, uzvārdu:</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" name="staffName[]" placeholder="- Ievadiet personas vārdu -" data-form-field="staffName" required="required" class="form-control text-multiple" value="{{$person->Vards}}" id="staffName-formbuilder-z">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="staffSurname[]" placeholder="- Ievadiet personas uzvārdu -" data-form-field="staffSurname" required="required" class="form-control text-multiple" value="{{$person->Uzvards}}" id="staffSurname-formbuilder-z">
                                        </div>
                                    </div>
                                </div>
                                <div data-for="staffPersonCode" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="staffPersonCode-formbuilder-z" class="form-control-label mbr-fonts-style display-7">* Rediģēt personas kodu:</label>
                                    <input type="text" name="staffPersonCode[]" placeholder="- Ievadiet personas kodu -" data-form-field="staffPersonCode" class="form-control display-7" required="required" value="{{$person->Personas_kods}}" id="staffPersonCode-formbuilder-z">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label class="form-control-label mbr-fonts-style display-7">* Rediģēt personas telefona numuru, e-pastu</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" name="staffTelephoneNumber[]" placeholder="- Ievadiet telefona numuru -" data-form-field="staffTelephoneNumber" required="required" class="form-control text-multiple" value="{{$person->Telefons}}" id="staffTelephoneNumber-formbuilder-z">
                                        </div>
                                        <div class="col">
                                            <input type="text" name="staffEmail[]" placeholder="- Ievadiet personas e-pastu -" data-form-field="staffEmail" required="required" class="form-control text-multiple" value="{{$person->Epasts}}" id="staffEmail-formbuilder-z">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="staffAuthority">
                                    <label for="staffAuthority-formbuilder-z" class="form-control-label mbr-fonts-style display-7">* Rediģēt piešķirto iestādi un amatu:</label>
                                    <div class="form-row">
                                        <div class="col">
                                            <select name="authorityItem[]" data-form-field="staffAuthority" class="form-control display-7" id="staffAuthority-formbuilder-z">
                                                <option selected disabled value="{{$authorityID}}">{{$authorityName}}</option>
                                                <optgroup label="Iestādes">
                                                    @foreach ($authorityList as $authority)
                                                        <option value="{{$authority->authorityID}}">{{$authority->authorityName}}</option>
                                                    @endforeach
                                                </optgroup>
                                            </select>        
                                        </div>
                                        <div class="col">
                                            <select name="positionItem[]" data-form-field="staffPosition" class="form-control display-7" id="staffPosition-formbuilder-z">
                                                @foreach ($positionListForPerson as $positionPerson)
                                                    @if ($person->AmatsID == $positionPerson->ID)
                                                        <option selected hidden value="{{$positionPerson->ID}}">{{$positionPerson->Nosaukums}}</option>
                                                    @endif
                                                @endforeach
                                                @foreach ($authorityList as $authority)
                                                    <optgroup label="{{$authority->authorityName}}">
                                                        @foreach ($environmentList as $environment)
                                                            @if ($authority->authorityID == $environment->authorityID)
                                                                <optgroup label="{{$environment->environmentName}}"> 
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
                                    </div>
                                </div>
                                <div data-for="staffEnvironment" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="staffEnvironment-formbuilder-z" class="form-control-label mbr-fonts-style display-7">* Rediģēt piešķirto darba vidi:</label>
                                    <select name="workLocationItem[]" data-form-field="staffEnvironment" class="form-control display-7" id="staffEnvironment-formbuilder-z">
                                        @foreach ($workLocationDBList as $workLocationDB)
                                            @if ($person->ID == $workLocationDB->personID)
                                                <option selected hidden value="{{$workLocationDB->workLocationID}}">{{$workLocationDB->workLocationName}}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($authorityList as $authority)
                                            <optgroup label="{{$authority->authorityName}}">
                                                @foreach ($environmentList as $environment)
                                                    @if ($authority->authorityID == $environment->authorityID)
                                                        <optgroup label="{{$environment->environmentName}}"> 
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
                            @endforeach
                            <div class="col-auto">
                                {{Form::hidden('_method', 'PUT')}}
                                {{Form::submit('Apstiprināt', ['class' => 'btn btn-primary display-7'])}}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection