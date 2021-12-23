@extends('application.index')

@section('content')
    <section class="form cid-sQfz7iVz2U" id="formbuilder-x">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    {!! Form::open(['action' => ['PositionController@update', $environment->ID], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'mbr-form form-with-styler', 'data-form-title' => 'Form name']) !!}
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5">Amatu saraksta "{{$environment->Nosaukums}}" rediģēšana</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div data-for="name" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="name-formbuilder-x" class="form-control-label mbr-fonts-style display-7">* Rediģēt vidi:</label>
                                <input type="text" name="environmentGroupList" placeholder="-- Ievadiet vidi --" data-form-field="name" class="form-control display-7" required="required" value="{{$environment->Nosaukums}}" id="name-formbuilder-x">
                            </div>
                            <div data-for="positions[]" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="positions[]-formbuilder-x" class="form-control-label mbr-fonts-style display-7">* Rediģēt amatu(-us) vai pievienot jaunus:</label>
                                @foreach ($positionList as $position)
                                    <div class="form-row">
                                        <div class="form-group col-md-11">
                                            <input type="text" name="positions[]" placeholder="- Ievadiet amatu -" data-form-field="positions[]" class="form-control display-7" required="required" value="{{$position->positionName}}" id="positions[]-formbuilder-x">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <div class="btn-group-append">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-danger">
                                                        <input type="checkbox" name="checkedPsositionIDs[]" value="{{$position->positionID}}" autocomplete="off">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                        </svg>                                    
                                                    </label>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <span id="newPositionRow"></span>
                                <button id="addPositionRow" type="button" class="btn btn-secondary display-7">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>                                    
                                </button>
                            </div>
                        </div>
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Apstiprināt', ['class' => 'btn btn-primary display-7'])}}            
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection