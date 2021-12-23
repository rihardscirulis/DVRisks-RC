@extends('application.index')

@section('content')
    <section class="form cid-sQvZ5x5v4V" id="formbuilder-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                    <form action="/izveidotdokumentu" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name">
                        @csrf
                        <div class="dragArea form-row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h4 class="mbr-fonts-style display-5">Riska novērtēšanas anketa</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div data-for="selectAuthority" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="selectAuthority-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Izvēlieties iestādi:</label>
                                <select onchange="getValue(this.value);" name="authorityListItem" data-form-field="selectAuthority" class="form-control display-7" id="selectAuthority-formbuilder-12">
                                    <option selected disabled hidden value="" >--- Izvēlieties iestādi ---</option>
                                    @foreach ($authorityList as $authority)
                                       <option value="{{$authority->authorityID}}" data-value="{{$authority->authorityTitle}}">{{$authority->authorityTitle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div data-for="date" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="date-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Izvēlieties datumu:</label>
                                        <input type="date" name="date" data-form-field="date" required="required" class="form-control display-7" value="" id="date-formbuilder-12">
                                    </div>
                                    <div class="col">
                                        <label for="documentNumber-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Ievadiet dokumenta numuru:</label>
                                        <input type="text" name="documentNumber" placeholder="- Ievadiet dokumenta numuru -" data-form-field="documentNumber" class="form-control display-7" required="required" value="" id="documentNumber-formbuilder-12">        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="selectMember">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="selectMember-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Riska vērtējumā piedālās:</label>
                                        <select name="selectMember" data-form-field="selectMember" class="form-control display-7" id="selectMember-formbuilder-12">
                                            <option selected disabled hidden value="" >--- Izvēlieties personu ---</option>
                                            <option value="Darba vide#1">Darba vide#1</option>
                                            <option value="Darba vide#2">Darba vide#2</option>
                                            <option value="Darba vide#3">Darba vide#3</option>
                                            <span id="p1"></p>       
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="selectEnvironment-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Darba vieta, iekārta, darba vide:</label>
                                        <select name="selectEnvironment" data-form-field="selectEnvironment" class="form-control display-7" id="selectEnvironment-formbuilder-12">
                                            <option value="Darba vide#1">Darba vide#1</option>
                                            <option value="Darba vide#2">Darba vide#2</option>
                                            <option value="Darba vide#3">Darba vide#3</option>
                                        </select>        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="selectEnvironment" style="">
                            </div>
                            <div data-for="textarea" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="textarea-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Riska faktoru novērtēšanas apstākļi::</label>
                                <textarea name="textarea" placeholder="- Ievadiet riska faktoru novērtējuma apstākli -" data-form-field="textarea" required="required" class="form-control display-7" id="textarea-formbuilder-12"></textarea>
                            </div>
                            <div data-for="workProcess" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="workProcess-formbuilder-12" class="form-control-label mbr-fonts-style display-7">*Darba procesa apraksts:</label>
                                <textarea name="workProcess" placeholder="- Ievadiet ieteicamo riska pasākumu -" data-form-field="workProcess" required="required" class="form-control display-7" id="workProcess-formbuilder-12"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <hr>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="mbr-fonts-style display-7"># - Rinda</p>
                            </div>
                            <div data-for="selectRiskFactor" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <label for="selectRiskFactor-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Faktora grupa:</label>
                                        <select name="selectRiskFactor" data-form-field="selectRiskFactor" class="form-control display-7" id="selectRiskFactor-formbuilder-12">
                                            <option value="faktors #1">faktors #1</option>
                                            <option value="faktors #2">faktors #2</option>
                                            <option value="faktors #3">faktors #3</option>
                                        </select>        
                                    </div>
                                    <div class="col">
                                        <label for="selectRiskFactor-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Riska faktors:</label>
                                        <select name="selectRiskFactor" data-form-field="selectRiskFactor" class="form-control display-7" id="selectRiskFactor-formbuilder-12">
                                            <option value="faktors #1">faktors #1</option>
                                            <option value="faktors #2">faktors #2</option>
                                            <option value="faktors #3">faktors #3</option>
                                        </select>        
                                    </div>
                                </div>
                            </div>
                            <div data-for="selectRiskLevel" class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <label for="selectRiskLevel-formbuilder-12" class="form-control-label mbr-fonts-style display-7">* Riska līmenis (I - V):</label>
                                <select name="selectRiskLevel" data-form-field="selectRiskLevel" class="form-control display-7" id="selectRiskLevel-formbuilder-12">
                                    <option value="Riska līmenis #1">Riska līmenis #1</option>
                                    <option value="Riska līmenis #1">Riska līmenis #1</option>
                                    <option value="Riska līmenis #1">Riska līmenis #1</option>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group" data-for="riskEvent">
                                <label for="riskEvent-formbuilder-12" class="form-control-label mbr-fonts-style display-7">Ieteicamie riska novēršanas vai samazināšanas pasākumi:</label>
                                <textarea name="riskEvent" placeholder="- Ierakstiet nepieciešamos riska pasākumus -" data-form-field="riskEvent" required="required" class="form-control display-7" id="riskEvent-formbuilder-12"></textarea>
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

    <script type="text/javascript">
        function getValue(val) {
            $.ajax({
                type: 'post',
                url: 'php/fetch_data.php',
                data: {
                    get_option:val 
                },
                success: function (response) {
                    //console.log(response);
                    //document.getElementById("selectMember-formbuilder-12").innerHTML=response; 
                    document.getElementById("selectMember-formbuilder-12").innerHTML = response; 
                    //console.log(selectedID);
                }
            });
        }    
    </script>

@endsection
