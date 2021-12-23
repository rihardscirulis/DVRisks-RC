@extends('application.index')

@section('content')
<section class="form cid-sMmZvwYTTt" id="formbuilder-e">
    <!-- Messages bar -->
    @include('inc.messages')
    <!-- //////////// -->    
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <form action="/amats" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name"><input type="hidden" name="email" data-form-email="true" value="OblfQhWrDMz7FQVkJrhnBetQm6BlnbdW+QvptuB1xAV8NOaSn9/jOScg3EnFM0U6XmBejlauOwCxm3OH3EX0dNS0Byipb0NK+nMI+u87GtYpq2VIsav00w3aAfWXueJN">
                    @csrf
                    <div class="dragArea form-row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h4 class="mbr-fonts-style display-5">Amatu pievienošana/saraksts</h4>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                        </div>
                        <div data-for="amatsNew" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="name-formbuilder-5" class="form-control-label mbr-fonts-style display-7">* - obligātie aizpildāmie lauki</label><br><br>
                            <label for="amatsNew-formbuilder-e" class="form-control-label mbr-fonts-style display-7">* Ievadiet amatu:</label>
                            <input type="text" name="newAuthorityPosition" placeholder="- Ievadiet darba amatu -" data-form-field="amatsNew" class="form-control display-7" required="required" value="" id="amatsNew-formbuilder-e">
                        </div>
                        <div data-for="select" class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <label for="select-formbuilder-e" class="form-control-label mbr-fonts-style display-7">* Izvēlieties vidi:</label>
                            <select name="environmentGroupList" data-form-field="select" required="required" class="form-control display-7" id="select-formbuilder-e">
                                <option selected disabled hidden value="" >--- Izvēlieties darba vidi ---</option>
                                @foreach ($authorityList as $authority)
                                    <optgroup label="{{$authority->authorityName}}">
                                        @foreach ($environmentList as $environment)
                                            @if ($environment->authorityID == $authority->authorityID)
                                                <option value="{{$environment->environmentID}}">{{$environment->environmentName}}</option>
                                            @endif
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

<section class="content17 cid-sMmZvZIvCg" id="content17-f">
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
                                    <h6 class="mbr-fonts-style display-7">{{$authority->authorityName}}</h6>
                                </a>
                            </div>
                            <div id="collapse{{$authority->authorityID}}" class="panel-collapse noScroll collapse" role="tabpanel" aria-labelledby="heading{{$authority->authorityID}}">
                                <div class="panel-body p-3">
                                    <div class="row">
                                        <div class="col">
                                            <strong>Darba vide:</strong>
                                        </div>
                                        <div class="col">
                                            <strong>Amats:</strong>
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
                                                    @foreach ($positionList as $position)
                                                        @if ($environment->environmentID == $position->environmentID)
                                                            <i class="bi bi-tools"></i> {{$position->positionName}}<br>
                                                        @endif
                                                    @endforeach        
                                                </div>
                                                <div class="col">
                                                    <div class="row">
                                                        {!!Form::open(['action' => ['PositionController@destroy', $environment->environmentID], 'method' => 'DELETE', 'class' => 'pull-right']) !!}
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
                                                        <a href="/amats/{{$environment->environmentID}}/edit" class="btn btn-outline-dark btn">
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