@extends('application.app')

@section('content')
    <div class="container">
        <h1>Faktora grupas "{{$factorGroup->Nosaukums}}" labošana</h1>
        <hr>
        <div id="formField">
            <div class="form-group container">
                {!! Form::open(['action' => ['FactorController@update', $factor->ID], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    <label for="noteFactorLabel"><span id="noteForFactorFields">Piezīme: Apzīmejums ar šadu simbolu <span id="requiredText">* </span> nozīmē, ka ir jāaizpilda</span></label><br><br>
                    <div class="row">
                        <div class="col">
                            <label for="selectFactorGroupLabel"><span id="requiredText">* </span>Faktora grupa:</label>
                            <input type="text" name="factorGroupTitle" id="factorGroupTitle" class="form-control" value="{{$factorGroup->Nosaukums}}" autocomplete="off" required>
                            <div class="invalid-feedback">
                                Lūdzu, izvēlies darba riska faktora grupu!
                            </div>
                            <div class="valid-feedback">
                                Izskatās labi!
                            </div>        
                        </div>
                        <div class="col">
                            <label for="writeFactorLabel"><span id="requiredText">* </span>Riska faktors:</label><br>
                            <div id="inputFactorRow">
                                <div class="input-group">
                                    <input type="text" name="factorTitle" id="factorTitle" class="form-control" value="{{$factor->Nosaukums}}" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Lūdzu, aizpildi darba riska faktora lauku!
                                    </div>
                                    <div class="valid-feedback">
                                        Izskatās labi!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="writeFactorLabel">Riski:</label><br>
                            <div class="position-relative">
                                @foreach ($riskCauseList as $riskCause)
                                    <div id="inputRiskCauseRow">
                                        <div class="input-group is-invalid">
                                            <input type="text" name="riskCause[]" id="riskCause[]" class="form-control" value="{{$riskCause->Nosaukums}}" autocomplete="off">
                                            <div class="btn-group-append">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-danger">
                                                        <input type="checkbox" type="checkbox" name="checkedriskCauseIDs[]" value="{{$riskCause->ID}}" autocomplete="off"><i class="bi bi-trash-fill"></i>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Lūdzu, aizpildiiet laukus, kas rāda risku!
                                            </div>
                                            <div class="valid-feedback">
                                                Izskatās labi!
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="newRiskCauseRow"></div>
                            <button id="addRiskCauseRow" type="button" class="btn btn-info" >Pievienot rindu</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="writeFactorLabel">Riska kārtība:</label><br>
                            @foreach ($riskProcedureList as $riskProcedure)
                                <input type="text" name="riskProcedure" id="riskProcedure" class="form-control" value="{{$riskProcedure->Nosaukums}}" autocomplete="off">
                                <div class="invalid-feedback">
                                    Lūdzu, aizpildiiet lauku par pastāvoši risku, kas jānovērtē!
                                </div>
                                <div class="valid-feedback">
                                    Izskatās labi!
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Apstiprināt', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('scripts.factorEditJavascript')
@endsection  