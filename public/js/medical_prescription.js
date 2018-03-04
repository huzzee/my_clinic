
$('#select_pres_record').change(function () {
    var type = $(this).val();

    if(type == 0)
    {
        $('#vital_sign_hidden').css('display','block');
        $('#medical_note_hidden').css('display','none');
        $('#medical_template_hidden').css('display','none');
        $('#drawing_template_hidden').css('display','none');
        $('#prescription_hidden').css('display','none');
        $('#medical_certificate_hidden').css('display','none');
        $('#files_hidden').css('display','none');
    }
    else if(type == 1)
    {
        $('#vital_sign_hidden').css('display','none');
        $('#medical_note_hidden').css('display','block');
        $('#medical_template_hidden').css('display','none');
        $('#drawing_template_hidden').css('display','none');
        $('#prescription_hidden').css('display','none');
        $('#medical_certificate_hidden').css('display','none');
        $('#files_hidden').css('display','none');
    }
    else if(type == 2)
    {
        $('#vital_sign_hidden').css('display','none');
        $('#medical_note_hidden').css('display','none');
        $('#medical_template_hidden').css('display','block');
        $('#drawing_template_hidden').css('display','none');
        $('#prescription_hidden').css('display','none');
        $('#medical_certificate_hidden').css('display','none');
        $('#files_hidden').css('display','none');
    }
    else if(type == 3)
    {
        $('.bootstrap-filestyle').css('display','block');

        $('#vital_sign_hidden').css('display','none');
        $('#medical_note_hidden').css('display','none');
        $('#medical_template_hidden').css('display','none');
        $('#drawing_template_hidden').css('display','block');
        $('#prescription_hidden').css('display','none');
        $('#medical_certificate_hidden').css('display','none');
        $('#files_hidden').css('display','none');
    }
    else if(type == 4)
    {
        $('#vital_sign_hidden').css('display','none');
        $('#medical_note_hidden').css('display','none');
        $('#medical_template_hidden').css('display','none');
        $('#drawing_template_hidden').css('display','none');
        $('#prescription_hidden').css('display','block');
        $('#medical_certificate_hidden').css('display','none');
        $('#files_hidden').css('display','none');
    }
    else if(type == 5)
    {
        $('#vital_sign_hidden').css('display','none');
        $('#medical_note_hidden').css('display','none');
        $('#medical_template_hidden').css('display','none');
        $('#drawing_template_hidden').css('display','none');
        $('#prescription_hidden').css('display','none');
        $('#medical_certificate_hidden').css('display','block');
        $('#files_hidden').css('display','none');
    }
    else if(type == 6)
    {
        $('.bootstrap-filestyle').css('display','none');

        $('#vital_sign_hidden').css('display','none');
        $('#medical_note_hidden').css('display','none');
        $('#medical_template_hidden').css('display','none');
        $('#drawing_template_hidden').css('display','none');
        $('#prescription_hidden').css('display','none');
        $('#medical_certificate_hidden').css('display','none');
        $('#files_hidden').css('display','block');
    }

});

$('#chk_temp').change(function () {
    $('#templating div:last-child').remove();

    var temp_id = $(this).val();

    $.ajax({
        url: "../../record_ajax",
        type: "GET",
        data: {temp_id: temp_id},
        dataType: "json",
        success: function (response) {
            //console.log(response);
            var html = ``;
            var cnts = 1;
            var abcd = 0;
            response.forEach(function (data,i) {
                if(data.type == 0)
                {
                    html+= `
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">`+cnts++ +`-`+data.question+` ?</label>
                                    <input type="hidden" name="questions[]" value="`+data.question+`">
                                    
                                    <input type="text" class="form-control"
                                           name="answers[`+abcd+`]" placeholder="Answer" required>
                                </div>
                            </div>
                        </div>
                    `;

                }
                else if(data.type == 1)
                {
                    html+= `
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">`+cnts++ +`-`+data.question+` ?</label>
                                    <input type="hidden" name="questions[]" value="`+data.question+`">
                                    
                                    <textarea name="answers[`+abcd+`]" id="textarea" 
                                    class="form-control" maxlength="500" rows="4" placeholder="Answer" required></textarea>
                                    
                                </div>
                            </div>
                        </div>
                    `;
                }
                else if(data.type == 2)
                {
                    var radio = '';
                    data.answers.forEach(function (ans,j) {
                        radio+=`
                            <div class="radio radio-inverse radio-inline">
                                <input type="radio" id="inlineRadio`+ans+`" name="answers[`+abcd+`]" value="`+ans+`">
                                <label for="inlineRadio`+ans+`"> `+ans+` </label>
                            </div></br>
                        `;
                    });
                    html+= `
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">`+cnts++ +`-`+data.question+` ?</label>
                                    <input type="hidden" name="questions[]" value="`+data.question+`"><br>
                                       `+radio+`
                                </div>
                            </div>
                        </div>
                    `;


                }
                else if(data.type == 3)
                {
                    var chk = '';
                    data.answers.forEach(function (ans,j) {
                        chk+=`
                            <div class="checkbox checkbox-success checkbox">
                                <input id="checkbox-`+j+`" value="`+ans+`" type="checkbox" name="answers[`+abcd+`][]">
                                <label for="checkbox-`+j+`" style="font-weight: bold">
                                    `+ans+`
                                </label>
                            </div>
                        `;
                    });
                    html+= `
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="hidden" name="questions[]" value="`+data.question+`">
                                    <label for="field-3" class="control-label">`+cnts++ +`-`+data.question+` ? (Multiple choice)</label>
                                       `+chk+`
                                </div>
                            </div>
                        </div>
                    `;


                }
                else if(data.type == 4)
                {
                    var select = '';
                    data.answers.forEach(function (ans,j) {
                        select+=`
                            <option value="`+ans+`">`+ans+`</option>
                        `;
                    });
                    html+= `
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="hidden" name="questions[]" value="`+data.question+`">
                                    <label for="field-3" class="control-label">`+cnts++ +`-`+data.question+` ?</label>
                                    <select class="form-control" 
                                    name="answers[`+abcd+`]">
                                        <option selected disabled>Select Answer</option>
                                        `+select+`
                                    </select>
                                       
                                </div>
                            </div>
                        </div>
                    `;


                }
                abcd++;
                //console.log(abcd);
            });

            $('#templating').html(html);

        }
    });

});

$('.weight').keyup(function () {

    var weight = $(this).val();
    var height = $('.height').val();



    total = Math.round(Math.sqrt((weight*height)/3600)*100)/100 ;

    var bsa = $('.bsa').val(total);
});
$('.height').keyup(function () {

    var height = $(this).val();
    var weight = $('.weight').val();



    total = Math.round(Math.sqrt((weight*height)/3600)*100)/100 ;

    var bsa = $('.bsa').val(total);
});


$(window).load(function () {
    var medicines = [];
    $.ajax({
        url: "../../drugs_autocomplete",
        type: "GET",
        data: {temp_id: "ok"},
        dataType: "json",
        success: function (response) {
            //console.log(response[0].medicine_info.drug_name);

            response.forEach(function (data) {
                medicines.push(data.medicine_info.drug_name);
            });
        }
    });

    //console.log(medicines);

    $('#drug_name_pres').autoComplete({

        minChars: 1,
        source: function(term, suggest){
            term = term.toLowerCase();
            var choices = medicines;
            var suggestions = [];
            for (i=0;i<choices.length;i++)
                if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
            suggest(suggestions);
        }

    });
});
function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;

/*------------------------------------------------------------
* -----------------------------------------------------------
* ------------------------------------------------------------*/

$('#add_service_in_press').click(function () {
    var category_id = $('#service_pres').val();
    var detail_service = $('.detail_service').val();

    if(category_id == 1)
    {
        var servic_id = $('#serve_press').val();
        var servic_name = $('#serve_press option:selected').text();
        var service_price = $('#service_price').val();
        var medicine_qnt = 1;


        if(service_price !== '')
        {
            var html = `<tr>
                        <td>`+servic_name+`<input type="hidden" name="drug_name[]" value="`+servic_name+`"></td>
                        <td>`+medicine_qnt+`<input type="hidden" class="medicine_qnt" name="drug_qnt[]" value="`+medicine_qnt+`"></td>
                        <td>---<input type="hidden" name="dosage_qnt[]" value="0"></td>
                        <td>---<input type="hidden" name="days[]" value="0"></td></td>
                        <td>`+detail_service+`<input type="hidden" name="instruction[]" value="`+detail_service+`">
                        <input type="hidden" name="pres_type[]" value="1"></td>
                        
                        <td>
                            <button type="button" class="btn btn-icon btn-danger m-b-5 remove_table_prescription">
                            <i class="fa fa-remove"></i>
			            </button></td>
                    </tr>`;
            $('#pres_test_here').append(html);

            $(this).attr('data-dismiss','modal');

        }
        else
        {
            $.alert('please choose Serivce Name','Required!');
        }


    }
    if(category_id == 2)
    {

        var service_name = $('#service_name').val();
        var detail_service2 = $('.detail_service2').val();
        var medicine_qnt = 1;
        var service_price = 0;


        if(service_name !== '')
        {
            var html = `<tr>
                        <td>`+service_name+`<input type="hidden" name="drug_name[]" value="`+service_name+`"></td>
                        
                        <td>`+medicine_qnt+`<input type="hidden" class="medicine_qnt" name="drug_qnt[]" value="`+medicine_qnt+`"></td>
                        <td>---<input type="hidden" name="dosage_qnt[]" value="0"></td>
                        <td>---<input type="hidden" name="days[]" value="0"></td></td>
                        <td>`+detail_service2+`<input type="hidden" name="instruction[]" value="`+detail_service2+`">
                        <input type="hidden" name="pres_type[]" value="1"></td>
                        <td><button type="button" class="btn btn-icon btn-danger m-b-5 remove_table_prescription">
			            <i class="fa fa-remove"></i>
			            </button></td>
                    </tr>`;
            $('#pres_test_here').append(html);


            $(this).attr('data-dismiss','modal');

        }
        else
        {
            $.alert('please choose Serivce Name','Required!');
        }

    }
});
$('body').on('click','.remove_table_prescription',function () {


    var item = $(this).parent().parent();
    item.remove();

});

$('#enter_drug_add').click(function () {
    var  medicine_name = $('#drug_name_pres').val();
    var  medicine_type = $('#drug_type_pres').val();
    var  medicine_qnt = $('#drug_qnt_pres').val();
    var  medicine_dosage = $('#drug_dosage_pres').val();
    var  medicine_dosage_unit = $('#drug_dosage_unit_pres').val();
    var  medicine_days = $('#drug_days_pres').val();

    var  instructions = $('#drug_inst_pres').val();





    if(medicine_name !== '' && medicine_qnt !== '' && medicine_type !== '0' && medicine_dosage_unit !== '0' && medicine_dosage !== '' && medicine_days !== '') {

        $.ajax({
            url: "../../drug_qnt_check",
            type: "GET",
            data: {medicine_name: medicine_name,medicine_type:medicine_type,medicine_dosage:medicine_dosage},
            dataType: "json",
            success: function (response) {
                //console.log(response);
                if(response.ok == 1)
                {

                    if(response.medicines.medicine_info.current_qnt < response.medicines.medicine_info.min_qnt)
                    {
                        $.alert('Low In Stock', 'This medicine is Low in our stock!');
                        var html = `<tr>
                                <td>` + medicine_name + ` (`+medicine_type+`)<input type="hidden" name="drug_name[]" value="` + medicine_name + ` (`+medicine_type+`)"></td>
                                
                                <td>` + medicine_qnt + `<input type="hidden" class="medicine_qnt" name="drug_qnt[]" value="` + medicine_qnt + `"></td>
                                <td>` + medicine_dosage + `.`+medicine_dosage_unit+`<input type="hidden" name="dosage_qnt[]" value="` + medicine_dosage + `.`+medicine_dosage_unit+`"></td>
                                <td>` + medicine_days + `<input type="hidden" name="days[]" value="` + medicine_days + `"></td></td>
                                <td>` + instructions + `<input type="hidden" name="instruction[]" value="` + instructions + `">
                                <input type="hidden" name="pres_type[]" value="0"></td>
                                <td><button type="button" class="btn btn-icon btn-danger m-b-5 remove_table_prescription">
                                <i class="fa fa-remove"></i>
                                </button></td>
                            </tr>`;
                        $('#pres_test_here').append(html);

                        $('#drug_name_pres').val('');

                        $('#drug_qnt_pres').val('');
                        $('#drug_dosage_pres').val('');

                        $('#drug_days_pres').val('');

                        $('#drug_inst_pres').val('');

                    }
                    else{
                        var html = `<tr>
                                <td>` + medicine_name + ` (`+medicine_type+`)<input type="hidden" name="drug_name[]" value="` + medicine_name + ` (`+medicine_type+`)"></td>
                                
                                <td>` + medicine_qnt + `<input type="hidden" class="medicine_qnt" name="drug_qnt[]" value="` + medicine_qnt + `"></td>
                                <td>` + medicine_dosage + `.`+medicine_dosage_unit+`<input type="hidden" name="dosage_qnt[]" value="` + medicine_dosage + `.`+medicine_dosage_unit+`"></td>
                                <td>` + medicine_days + `<input type="hidden" name="days[]" value="` + medicine_days + `"></td></td>
                                <td>` + instructions + `<input type="hidden" name="instruction[]" value="` + instructions + `">
                                <input type="hidden" name="pres_type[]" value="0"></td>
                                <td><button type="button" class="btn btn-icon btn-danger m-b-5 remove_table_prescription">
                                <i class="fa fa-remove"></i>
                                </button></td>
                            </tr>`;
                        $('#pres_test_here').append(html);

                        $('#drug_name_pres').val('');

                        $('#drug_qnt_pres').val('');
                        $('#drug_dosage_pres').val('');

                        $('#drug_days_pres').val('');

                        $('#drug_inst_pres').val('');
                    }
                }
                else{
                    $.alert('Not In Stock', 'This medicine is not in our stock!');

                    var html = `<tr>
                                    <td>` + medicine_name + ` (`+medicine_type+`)<input type="hidden" name="drug_name[]" value="` + medicine_name + ` (`+medicine_type+`)"></td>
                                    
                                    <td>` + medicine_qnt + `<input type="hidden" class="medicine_qnt" name="drug_qnt[]" value="` + medicine_qnt + `"></td>
                                    <td>` + medicine_dosage + `.`+medicine_dosage_unit+`<input type="hidden" name="dosage_qnt[]" value="` + medicine_dosage + `.`+medicine_dosage_unit+`"></td>
                                    <td>` + medicine_days + `<input type="hidden" name="days[]" value="` + medicine_days + `"></td></td>
                                    <td>` + instructions + `<input type="hidden" name="instruction[]" value="` + instructions + `">
                                    <input type="hidden" name="pres_type[]" value="0"></td>
                                    <td><button type="button" class="btn btn-icon btn-danger m-b-5 remove_table_prescription">
                                    <i class="fa fa-remove"></i>
                                    </button></td>
                                </tr>`;
                    $('#pres_test_here').append(html);

                    $('#drug_name_pres').val('');

                    $('#drug_qnt_pres').val('');
                    $('#drug_dosage_pres').val('');

                    $('#drug_days_pres').val('');

                    $('#drug_inst_pres').val('');


                }
            }
        });

    }

    else {
        $.alert('please enter required fields To Add Medicine', 'Some Fields missing!');

    }
});

