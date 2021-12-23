<script type="text/javascript">
    //Pievieno jaunu tabulas rindu anketai
    var index = 0;
    $("#addNewTableRow").click(function () {
        index = index + 1;
        var html = '';
        html += '<tbody id="removeNewTableRow">';
        html += '<tr>';
        html += '<th>';
        html += '<select class="form-control form-control-sm" name="riskFactorSelectMenu['+index+']" id="riskFactorSelectMenu['+index+']" required>';
        html += '<option selected disabled hidden value="" >-- Riska faktors --</option>';
        html += '@foreach ($factorGroupList as $factorGroup)';
        html += '<optgroup label="{{$factorGroup->factorGroupTitle}}">';
        html += '@foreach ($factorList as $factor)';
        html += '@if ($factorGroup->factorGroupID == $factor->factorGroup_ID)';
        html += '@foreach ($riskCauseList as $riskCause)';
        html += '@if ($riskCause->riskCauseFactorID == $factor->factorID)';
        html += '<option value="{{$factorGroup->factorGroupID}}-{{$factor->factorID}}/{{$riskCause->riskCauseID}}">{{$factorGroup->factorGroupTitle}} - {{$factor->factorTitle}} - {{$riskCause->riskCauseName}}</option>';
        html += '@endif';
        html += '@endforeach';
        html += '@endif';
        html += '@endforeach';
        html += '</optgroup>';
        html += '@endforeach';
        html += '</select>';
        html += '</th>';
        html += '<th>';
        html += '<select class="form-control form-control-sm" name="riskLevelSelectMenu['+index+']" id="riskLevelSelectMenu['+index+']" required>';
        html += '<option selected disabled hidden value="" >-- Riska līmenis --</option>';
        html += '@foreach ($riskLevel as $level)';
        html += '<option value="{{$level->riskLevelID}}">{{$level->riskLevelTitle}}</option>';
        html += '@endforeach';
        html += '</select>';
        html += '</th>';
        html += '<th>';
        html += '<textarea class="form-control form-control-sm" name="riskEventTextArea['+index+']" id="riskEventTextArea['+index+']" cols="0" rows="0" required></textarea>';
        html += '</th>';
        html += '<th>';
        html += '<button type="button" class="btn btn-outline-danger" id="removeTableRow">-</button>';
        html += '</th>';
        html += '</tr>';
        html += '</tbody'

        $('#createDocumentTable').append(html);

        $(document).ready(function () {
            $('select').selectize({
                sortField: 'text'
            });
        });
    });

    $(document).on('click', '#removeTableRow', function () {
        if(index>=0) {
            $(this).closest('#removeNewTableRow').remove();
            //index = index - 1;
        }
    });

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()

    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
    });
</script>
