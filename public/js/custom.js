
var base_uri = $('#baseUrl').val();
var g_day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];


$('#my_doc').change(function () {
   var doc_id = $(this).val();

    $.ajax({
        url: "../doc_schedule_chk",
        type: "GET",
        data: {doc_id:doc_id},
        dataType: "json",
        success: function(response) {
            var html = '';
            if(response == 1)
            {
                html = `<p>This Doctor schedule is already added.If
                        You want to update it go to schedule list</p>`;

                $('#display_schedule').css('display','none');
                $('#here_doc').html(html);
            }
            else
            {
                html = '';
                $('#here_doc').html(html);
                $('#display_schedule').css('display','block');
            }
        }

    });
});

/*for schedules */

$('.add_opd').click(function(){
    //alert('ok');
    var day = $('.opd_day').val();
    var start = $('.opd_start').val();
    var end = $('.opd_end').val();


    if(day !== null && start !== '' && end !== '')
    {

        var html = `
					<tr>
					    
			            <td>`+g_day[day]+`<input type="hidden" name="opd_day[]" value="`+day+`"></td>
			            <td>`+start+`<input type="hidden" name="opd_start_time[]" value="`+start+`"></td>
			            <td>`+end+`<input type="hidden" name="opd_end_time[]" value="`+end+`"></td>
			            <td>
			            <button type="button" class="btn btn-icon btn-danger m-b-5 remove_table1">
			            <i class="fa fa-remove"></i>
			            </button>
			            </td>
			        </tr>
		`;
        $('#table_row1').append(html);
        //$('.name_of_item').val().prop('selected',true);





        $('.opd_start').val('');
        $('.opd_end').val('');
    }
    else{
        alert('please Enter Required Information');
    }
});
$('body').on('click', '.remove_table1', function(){
    var itemData = $(this).parent().parent();
    itemData.remove();
});

$('.add_app').click(function(){
    //alert('ok');
    var day = $('.app_day').val();
    var start = $('.app_start').val();
    var end = $('.app_end').val();
    var app_token = $('.app_token').val();



    if(day !== null && start !== '' && end !== '' && app_token !== '')
    {

        var html = `
					<tr>
					    
			            <td>`+g_day[day]+`<input type="hidden" name="app_day[]" value="`+day+`"></td>
			            <td>`+start+`<input type="hidden" name="app_start_time[]" value="`+start+`"></td>
			            <td>`+end+`<input type="hidden" name="app_end_time[]" value="`+end+`"></td>
			            <td>`+app_token+`<input type="hidden" name="app_tokens[]" value="`+app_token+`"></td>
			            <td>
			            <button type="button" class="btn btn-icon btn-danger m-b-5 remove_table2">
			            <i class="fa fa-remove"></i>
			            </button>
			            </td>
			        </tr>
		`;
        $('#table_row2').append(html);
        //$('.name_of_item').val().prop('selected',true);





        $('.app_start').val('');
        $('.app_end').val('');
        $('.app_token').val('');
    }
    else{
        alert('please Enter Required Information');
    }
});
$('body').on('click', '.remove_table2', function(){
    var itemData = $(this).parent().parent();
    itemData.remove();
});

$('#my_type').change(function () {
   var type = $(this).val();

   var html = '';

  if(type == 0)
  {
      $('#full_leave').css('display','none');
      $('#many_leave').css('display','none');
      $('#half_leave').css('display','block');
  }
  else if(type == 1)
  {
      $('#full_leave').css('display','block');
      $('#many_leave').css('display','none');
      $('#half_leave').css('display','none');
  }
  else if(type == 2)
  {
      $('#full_leave').css('display','none');
      $('#many_leave').css('display','block');
      $('#half_leave').css('display','none');
  }
});


/*--------------------------------*/




/*-------------------------------*/


var cnt = 0;
var namcnt = 0;

$('#add_fields').click(function () {
    var itemData1 = $('#here_temp').children();
    itemData1.remove();
    cnt++;
    var type = $('#template_type').val();

    if(type == null)
    {
        alert('Choose Type');
    }


   if(type == 0)
   {
       var html = `
                <div class="row temp_clone" style="border: 1px solid lightgrey; background-color: whitesmoke;">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Questions<span class="text-danger">*</span></label>
                            <input type="text" class="form-control short_qst"
                                   name="questions[]" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Type</label>
                            <input type="text" class="form-control"
                                   placeholder="short Field" value="Short Field" readonly="true">
                            <input type="hidden" name="type[]" value="0">
                           
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Answer</label>
                            <input type="text" class="form-control short_ans"
                                   name="answers[`+namcnt+`]" readonly>
                        </div>
                    </div>
                    <div class="col-md-7">
                        
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-icon btn-primary m-b-5" id="add_temp">
                                Add To Template
                            </button>
                        </div>
                    </div>
    
                    
    
                </div>
       `;

       $('#here_temp').html(html);
   }
   else if(type == 1)
    {
        var html = `
                <div class="row temp_clone" style="border: 1px solid lightgrey; background-color: whitesmoke;">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Questions<span class="text-danger">*</span></label>
                            <input type="text" class="form-control short_qst"
                                   name="questions[]" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="field-4" class="control-label">Type</label>
                            <input type="text" class="form-control"
                                   placeholder="short Field" value="Text Field" readonly="true">
                            <input type="hidden" name="type[]" value="1">
                           
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Answer</label>
                            <textarea type="text" class="form-control short_ans"
                                   name="answers[`+namcnt+`]" readonly></textarea>
                        </div>
                    </div>
                    <div class="col-md-7">
                        
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-icon btn-primary m-b-5" id="add_temp">
                                Add To Template
                            </button>
                        </div>
                    </div>
    
                    
    
                </div>
       `;

        $('#here_temp').html(html);
    }
   else if(type == 2)
   {
       var html = `
                <div class="row temp_clone" style="border: 1px solid lightgrey; background-color: whitesmoke;">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Questions<span class="text-danger">*</span></label>
                            <input type="text" class="form-control short_qst"
                                   name="questions[]" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Type</label>
                            <input type="text" class="form-control"
                                   placeholder="short Field" value="Radio" readonly="true">
                            <input type="hidden" name="type[]" value="2">
                           
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12 field_here`+cnt+`">
                        <div class="form-group row">
                            
                                <label for="field-3" class="col-md-2">Answer</label>
                                <div class="col-md-8">
                                     <input type="text" class="form-control"
                                       name="answers[`+namcnt+`][]" required><br>
                                </div>
                                <div class="col-md-2">
                                     <button type="button" class="btn btn-icon btn-inverse m-b-5 remove_field">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                               
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <button type="button" class="btn btn-icon btn-warning m-b-5 add_field">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-icon btn-primary m-b-5" id="add_temp">
                                Add To Template
                            </button>
                        </div>
                    </div>
                    
                </div>
       `;

       $('#here_temp').html(html);

   }
   else if(type == 3)
   {
       var html = `
                <div class="row temp_clone" style="border: 1px solid lightgrey; background-color: whitesmoke;">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Questions<span class="text-danger">*</span></label>
                            <input type="text" class="form-control short_qst"
                                   name="questions[]" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Type</label>
                            <input type="text" class="form-control"
                                   placeholder="short Field" value="CheckBoxes" readonly="true">
                            <input type="hidden" name="type[]" value="3">
                           
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12 field_here`+cnt+`">
                        <div class="form-group row">
                            
                                <label for="field-3" class="col-md-2">Answer</label>
                                <div class="col-md-8">
                                     <input type="text" class="form-control"
                                       name="answers[`+namcnt+`][]" required><br>
                                </div>
                                <div class="col-md-2">
                                     <button type="button" class="btn btn-icon btn-inverse m-b-5 remove_field">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                               
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <button type="button" class="btn btn-icon btn-warning m-b-5 add_field">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-icon btn-primary m-b-5" id="add_temp">
                                Add To Template
                            </button>
                        </div>
                    </div>
                    
                </div>
       `;

       $('#here_temp').html(html);
   }
   else if(type == 4)
   {
       var html = `
                <div class="row temp_clone" style="border: 1px solid lightgrey; background-color: whitesmoke;">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Questions<span class="text-danger">*</span></label>
                            <input type="text" class="form-control short_qst"
                                   name="questions[]" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Type</label>
                            <input type="text" class="form-control"
                                   placeholder="short Field" value="Multiple Select" readonly="true">
                            <input type="hidden" name="type[]" value="3">
                           
                        </div>
                    </div>
                    
                    
                    <div class="col-md-12 field_here`+cnt+`">
                        <div class="form-group row">
                            
                                <label for="field-3" class="col-md-2">Answer</label>
                                <div class="col-md-8">
                                     <input type="text" class="form-control"
                                       name="answers[`+namcnt+`][]" required><br>
                                </div>
                                <div class="col-md-2">
                                     <button type="button" class="btn btn-icon btn-inverse   m-b-5 remove_field">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                               
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group">
                            <button type="button" class="btn btn-icon btn-warning m-b-5 add_field">
                                Add
                            </button>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <button type="button" class="btn btn-icon btn-primary m-b-5" id="add_temp">
                                Add To Template
                            </button>
                        </div>
                    </div>
                    
                </div>
       `;

       $('#here_temp').html(html);
   }
});

$('body').on('click', '.add_field', function(){
    /*var html = `
            <div class="form-group row">
                    <label for="field-3" class="col-md-2">Answer</label>
                    <div class="col-md-8">
                         <input type="text" class="form-control"
                           name="answers[`+cnt+`][]" required><br>
                    </div>
                    <div class="col-md-2">
                         <button type="button" class="btn btn-icon btn-inverse m-b-5 remove_field">
                            <i class="fa fa-trash"></i>
                         </button>
                    </div>
            </div>
    `;*/
    var itemData = $('.remove_field').parent().parent();
    $('.field_here'+cnt).append("<div class='form-group row'>"+itemData.html()+"</div>");
    $('.field_here'+cnt+' div:last-child').find('input').val('');

    //$('.field_here').append(html);

});

$('#remove_box').click(function(){
    var itemData = $('#temp_all').children('div div:last-child');
    itemData.remove();
    namcnt--;
});

$('body').on('click', '.remove_field', function(){
    var itemData = $(this).parent().parent();
    itemData.remove();
});

$('body').on('click', '#add_temp', function(){

    var temp = $('#here_temp').children().clone();
    $('#temp_all').append(temp);
    var itemData1 = $('#here_temp').children();
    itemData1.remove();
    cnt++;
    namcnt++;

    /*var itemData = $(this).parent().parent().parent();
    $('#temp_all').append("<div class='row' style='border: 1px solid lightgrey; background-color: whitesmoke;'>"+itemData.html()+"</div></br>");*/

});

$('.temp_submt').one('submit',function(e) {
    e.preventDefault();
    // do your things ...
    //alert('ok');
    var itemData = $('#here_temp').children();
    itemData.remove();
    // and when you done:
    $(this).submit();
});

/*----------------------------------------------------------------*/
/*----------------------------------------------------------------*/
/*----------------------------------------------------------------*/

$('#draw_pad').click(function () {
    $('.bootstrap-filestyle').css('display','block');
});

$('#uploads').click(function () {
    $('.bootstrap-filestyle').css('display','none');
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

$('#presc').change(function () {
    var pres = $(this).val();

    if(pres == 1)
    {
        $('#hide_press').css('display','none');
        $('#show_press').css('display','block');
        $('#pres_foot').css('display','block');
    }
});

$('#drug_pres').change(function () {
    var drug = $(this).val();

    if(drug == 0)
    {
        $('#stock_unit').val('');
        $('#dosage_unit').val('');
        $('#price_med').val('');
        $('#gst').val('');
    }
    else if (drug !== 0)
    {
        $.ajax({
            url: "../../drugs_press",
            type: "GET",
            data: {drug:drug},
            dataType: "json",
            success: function(response) {
                //console.log(response.medicine_info['drug_name']);dosage_unitprice_med
                $('#stock_unit').val(response.medicine_info['stock_unit']);
                $('#dosage_unit').val(response.medicine_info['dosage_unit']);
                $('#price_med').val(response.medicine_info['retail_price']);
                $('#gst').val(response.medicine_info['retail_gst']);
                $('#current_qnt').val(response.medicine_info['current_qnt']);

            }

        });
    }



});

var net_total = $('#net_total').val()*1;
var total_discont = $('#total_discount').val()*1;
var after_discount = $('#after_discount').val()*1;
var total_gst = $('#total_gst').val()*1;
var grand_total = $('#grand_total').val()*1;





$('#add_pres_here').click(function () {

    var stock_unit = $('#stock_unit').val();
    var dosage_unit = $('#dosage_unit').val();
    var price_med = $('#price_med').val();
    var gst = $('#gst').val();
    var drug_pres = $('#drug_pres').val();
    var medicine_qnt = $('#medicine_qnt').val();
    var dosage_qnt = $('#dosage_qnt').val();
    var discount = $('#discount').val();
    var remark = $('#remark').val();
    var instruction = $('.instruction').val();
    var days = $('#days').val();
    var drug_id = $('#drug_pres').val();
    var drug_name = $('#drug_pres option:selected').text();


    if(dosage_unit !== '' && price_med !== '' && stock_unit !== '' && gst !== '' && drug_pres !== '' &&
        medicine_qnt !== '' && dosage_qnt !== '' && instruction !== ''
        && days !== '')
    {
        var sub_total = Math.round((medicine_qnt*price_med)*1000)/1000;



        var dissc_total = Math.round((sub_total/100 *discount)*10000)/10000;

        var after_dis = Math.round((sub_total-dissc_total)*10000)/10000;

        var gst_total = Math.round((sub_total/100 *gst)*10000)/10000;

        var line_total = Math.round((gst_total+after_dis)*10000)/10000;
        var html = `<tr>
                        <td>`+drug_name+`<input type="hidden" name="drug_name[]" value="`+drug_name+`">
                        <input type="hidden" name="drug_id[]" value="`+drug_id+`"></td>
                        <td>`+medicine_qnt+`<input type="hidden" class="medicine_qnt" name="drug_qnt[]" value="`+medicine_qnt+`"></td>
                        <td>`+price_med+`<input type="hidden" class="price" name="price[]" value="`+price_med+`"></td>
                        <td>`+sub_total+`<input type="hidden" class="sub_total" name="sub_total[]" value="`+sub_total+`"></td>
                        <td>`+discount+`%<input type="hidden" class="discount" name="discount[]" value="`+discount+`"></td>
                        <td>`+remark+`<input type="hidden" name="remark[]" value="`+remark+`"></td>
                        <td>`+gst+`%<input type="hidden" class="gst" name="gst[]" value="`+gst+`"></td>
                        <td>`+line_total+`<input type="hidden" class="line_total" name="line_total[]" value="`+line_total+`">
                        <input type="hidden" name="pres_type[]" value="0"></td>
                        <input type="hidden" name="days[]" value="`+days+`"></td>
                        <input type="hidden" name="instruction[]" value="`+instruction+`"></td>
                        <input type="hidden" name="dosage_qnt[]" value="`+dosage_qnt+`">
                        <input type="hidden" name="dosage_unit[]" value="`+dosage_unit+`"></td>
                        <td>
                        <button type="button" class="btn btn-icon btn-danger m-b-5 remove_table_pres">
			            <i class="fa fa-remove"></i>
			            </button></td>
                    </tr>`;
        $('#insert_medicine').append(html);

        $('#stock_unit').val('');
        $('#dosage_unit').val('');
        $('#price_med').val('');
        $('#gst').val('');
        $('#drug_pres').val('');
        $('#medicine_qnt').val('');
        $('#dosage_qnt').val('');
        $('#discount').val(0);
        $('#remark').val('');
        $('.instruction').val('');
        $('#days').val('');


        net_total += sub_total;
        var t_total_discont = Math.round((sub_total/100 *discount)*10000)/10000;
        total_discont += t_total_discont;
        after_discount += Math.round((sub_total-t_total_discont)*10000)/10000;
        total_gst += Math.round((sub_total/100 *gst)*10000)/10000;
        grand_total = after_discount+total_gst;

        $('#net_total').val(net_total);
        $('#total_discount').val(total_discont);
        $('#after_discount').val(after_discount);
        $('#total_gst').val(total_gst);
        $('#grand_total').val(grand_total);



        $(this).attr('data-dismiss','modal');
    }
    else
    {
        alert('Fill All Fields');
    }


});

$('body').on('click','.remove_table_pres',function () {

    var price_med = $(this).parent().parent().find('.price').val();
    var gst = $(this).parent().parent().find('.gst').val();
    var medicine_qnt = $(this).parent().parent().find('.medicine_qnt').val();
    var discount = $(this).parent().parent().find('.discount').val();

    //alert(price_med);
    //console.log(price_med);

    var sub_total = Math.round((medicine_qnt*price_med)*1000)/1000;

    net_total -= sub_total;
    var t_total_discont = Math.round((sub_total/100 *discount)*10000)/10000;
    total_discont -= t_total_discont;
    var t_after_discount = Math.round((sub_total - t_total_discont)*10000)/10000;
    after_discount -= t_after_discount;
    var t_total_gst = Math.round((sub_total/100 *gst)*10000)/10000;
    total_gst -=t_total_gst;
    grand_total = after_discount+total_gst;

    $('#net_total').val(net_total);
    $('#total_discount').val(total_discont);
    $('#after_discount').val(after_discount);
    $('#total_gst').val(total_gst);
    $('#grand_total').val(grand_total);
   var item = $(this).parent().parent();
   item.remove();

});

$('#service_pres').change(function () {
    var service = $(this).val();


    if(service == 1)
    {
        $('#hide_our').css('display','block');
        $('#cat_foot').css('display','block');
        $('#hide_other').css('display','none');
    }
    else if(service == 2)
    {
        $('#hide_our').css('display','none');
        $('#cat_foot').css('display','block');
        $('#hide_other').css('display','block');
    }
    else {
        $('#hide_our').css('display','none');
        $('#cat_foot').css('display','none');
        $('#hide_other').css('display','none');
    }

});

$('#category_pres').change(function () {
    var category_id = $(this).val();

    $.ajax({
        url: "../../services_press",
        type: "GET",
        data: {category_id: category_id},
        dataType: "json",
        success: function (response) {
            //console.log(response.clinic_services);
            var html='<option selected="selected" value="0">Select Test/Service</option>';
            response.clinic_services.forEach(function (data,i) {
                html+=`
                    <option value="`+ data.id +`">`+ data.service_name +`</option>
                `;
            });

            $('#serve_press').html(html);
        }
    });


});

$('body').on('change','#serve_press',function () {

    var service_id = $(this).val();

    $.ajax({
        url: "../../services_price",
        type: "GET",
        data: {service_id: service_id},
        dataType: "json",
        success: function (response) {
            //console.log(response);
            if(service_id == 0)
            {
                $('#service_price').val('');
            }
            else {
                $('#service_price').val(response.rate);
            }

        }
    });
});

$('#add_service_here').click(function () {
    var category_id = $('#service_pres').val();




    if(category_id == 1)
    {
        var servic_id = $('#serve_press').val();
        var servic_name = $('#serve_press option:selected').text();
        var service_price = $('#service_price').val();
        var medicine_qnt = 1;

        var discount = 0;
        var gst = 0;

        var sub_total = Math.round((medicine_qnt*service_price)*1000)/1000;



        var dissc_total = Math.round((sub_total/100 *discount)*10000)/10000;

        var after_dis = Math.round((sub_total-dissc_total)*10000)/10000;

        var gst_total = Math.round((sub_total/100 *gst)*10000)/10000;

        var line_total = Math.round((gst_total+after_dis)*10000)/10000;

        if(service_price !== '')
        {
            var html = `<tr>
                        <td>`+servic_name+`<input type="hidden" name="drug_name[]" value="`+servic_name+`">
                        <input type="hidden" name="drug_id[]" value="`+servic_id+`"></td>
                        <td>`+medicine_qnt+`<input type="hidden" class="medicine_qnt" name="drug_qnt[]" value="`+medicine_qnt+`"></td>
                        <td>`+service_price+`<input type="hidden" class="price" name="price[]" value="`+service_price+`"></td>
                        <td>`+sub_total+`<input type="hidden" class="sub_total" name="sub_total[]" value="`+sub_total+`"></td>
                        <td>`+discount+`%<input type="hidden" class="discount" name="discount[]" value="`+discount+`"></td>
                        <td><input type="hidden" name="remark[]" value=""></td>
                        <td>`+gst+`%<input type="hidden" class="gst" name="gst[]" value="`+gst+`"></td>
                        <td>`+line_total+`<input type="hidden" class="line_total" name="line_total[]" value="`+line_total+`">
                        <input type="hidden" name="pres_type[]" value="1">
                        <input type="hidden" name="days[]" value="0"></td>
                        <input type="hidden" name="instruction[]" value=""></td>
                        <input type="hidden" name="dosage_qnt[]" value="0">
                        <input type="hidden" name="dosage_unit[]" value="0"></td>
                        </td>
                        
                        
                        <td>
                        <button type="button" class="btn btn-icon btn-danger m-b-5 remove_table_pres">
			            <i class="fa fa-remove"></i>
			            </button></td>
                    </tr>`;
            $('#insert_medicine').append(html);

            net_total += sub_total;
            var t_total_discont = Math.round((sub_total/100 *discount)*10000)/10000;
            total_discont += t_total_discont;
            after_discount += Math.round((sub_total-t_total_discont)*10000)/10000;
            total_gst += Math.round((sub_total/100 *gst)*10000)/10000;
            grand_total = after_discount+total_gst;

            $('#net_total').val(net_total);
            $('#total_discount').val(total_discont);
            $('#after_discount').val(after_discount);
            $('#total_gst').val(total_gst);
            $('#grand_total').val(grand_total);


            $(this).attr('data-dismiss','modal');

        }
        else
        {
            alert('please choose Serivce Name');
        }


    }
    if(category_id == 2)
    {

        var service_name = $('#service_name').val();
        var detail_service = $('.detail_service').val();
        var medicine_qnt = 1;
        var service_price = 0;

        var discount = 0;
        var gst = 0;

        var sub_total = Math.round((medicine_qnt*service_price)*1000)/1000;



        var dissc_total = Math.round((sub_total/100 *discount)*10000)/10000;

        var after_dis = Math.round((sub_total-dissc_total)*10000)/10000;

        var gst_total = Math.round((sub_total/100 *gst)*10000)/10000;

        var line_total = Math.round((gst_total+after_dis)*10000)/10000;
        if(service_name !== '')
        {
            var html = `<tr>
                        <td>`+service_name+`<input type="hidden" name="drug_name[]" value="`+service_name+`">
                        <input type="hidden" name="drug_id[]" value="0"></td>
                        </td>
                        <td>`+medicine_qnt+`<input type="hidden" class="medicine_qnt" name="drug_qnt[]" value="`+medicine_qnt+`"></td>
                        <td>`+service_price+`<input type="hidden" class="price" name="price[]" value="`+service_price+`"></td>
                        <td>`+sub_total+`<input type="hidden" class="sub_total" name="sub_total[]" value="`+sub_total+`"></td>
                        <td>`+discount+`%<input type="hidden" class="discount" name="discount[]" value="`+discount+`"></td>
                        <td><input type="hidden" name="remark[]" value=""></td>
                        <td>`+gst+`%<input type="hidden" class="gst" name="gst[]" value="`+gst+`"></td>
                        <td>`+line_total+`<input type="hidden" class="line_total" name="line_total[]" value="`+line_total+`">
                        <input type="hidden" name="pres_type[]" value="1">
                        <input type="hidden" name="days[]" value="0"></td>
                        <input type="hidden" name="instruction[]" value=""></td>
                        <input type="hidden" name="dosage_qnt[]" value="0">
                        <input type="hidden" name="dosage_unit[]" value="0"></td>
                        </td>
                        
                        
                        <td>
                        <button type="button" class="btn btn-icon btn-danger m-b-5 remove_table_pres">
			            <i class="fa fa-remove"></i>
			            </button></td>
                    </tr>`;
            $('#insert_medicine').append(html);

            net_total += sub_total;
            var t_total_discont = Math.round((sub_total/100 *discount)*10000)/10000;
            total_discont += t_total_discont;
            after_discount += Math.round((sub_total-t_total_discont)*10000)/10000;
            total_gst += Math.round((sub_total/100 *gst)*10000)/10000;
            grand_total = after_discount+total_gst;

            $('#net_total').val(net_total);
            $('#total_discount').val(total_discont);
            $('#after_discount').val(after_discount);
            $('#total_gst').val(total_gst);
            $('#grand_total').val(grand_total);


            $(this).attr('data-dismiss','modal');

        }
        else
        {
            alert('please choose Serivce Name');
        }

    }
});


/* Permissions Scripts */

$('#permit_role').change(function () {
    var role_id = $(this).val();
    $.ajax({
       url : 'role_chk',
       type : 'GET',
       data : {role_id:role_id},
       dataType : 'Json',
       success : function (response) {
           //console.log(response);
           var html = "";
           var checked = "";

           response.forEach(function(res){
               var checked2 = "";
               var html2 = "";
               response.forEach(function (sub_res) {
                   if(sub_res['active']==1) {checked2="checked";} else{checked2="";}
                   if (sub_res['menus']['parent_menu_id'] == res['menus']['id'])
                   {
                       html2 += `
                        <div class="checkbox checkbox-success checkbox-circle">
                            <input id="checkbox-` + sub_res['id'] + `" class="postmenu" data-id="` + sub_res['id'] + `" type="checkbox" ` + checked2 + `>
                        
                            <label for="checkbox-` + sub_res['id'] + `" style="font-weight: bold">
                            ` + sub_res['menus']['menu_name'] + `
                            </label>
                        </div>
                        `;
                   }
               });
               if(res['active']==1) {checked="checked";} else{checked="";}
               if(res['menus']['parent_menu_id'] == null) {
                   html += `
                    <div class="checkbox checkbox-success checkbox-circle">
                        <input id="checkbox-` + res['id'] + `" class="postmenu" data-id="` + res['id'] + `" type="checkbox" ` + checked + `>
                        <label for="checkbox-` + res['id'] + `" style="font-weight: bold">
                            ` + res['menus']['menu_name'] + `
                        </label>
                        `+html2+`
                    </div>
               `;
               }

           });

           $('#check_permission').html(html);
       }
    });
});

$('#check_permission').on('click', '.postmenu', function(){


    var pid = $(this).data('id');
    var chk = $(this).is(':checked');

    //alert(pid);

    $.ajax({
        url: "ajaxupdatepermissions",
        type: "GET",
        data: {permission_id: pid, active: chk},
        dataType: "json",
        success: function(response) {
            //
        }
    });
});

//For Appointments Dates
Array.prototype.getUnique = function (createArray) {
    createArray = createArray === true ? true : false;
    var temp = JSON.stringify(this);
    temp = JSON.parse(temp);
    if (createArray) {
        var unique = temp.filter(function (elem, pos) {
            return temp.indexOf(elem) == pos;
        }.bind(this));
        return unique;
    }
    else {
        var unique = this.filter(function (elem, pos) {
            return this.indexOf(elem) == pos;
        }.bind(this));
        this.length = 0;
        this.splice(0, 0, unique);
    }
}


$('#app_doc_id').change(function () {
    var doc_id = $(this).val();

    $.ajax({
        url: '../../get_schedule',
        type: 'GET',
        data: {doc_id:doc_id},
        dataType: 'json',
        success: function (response) {
            var ndays = [];
            var ndow = [0,1,2,3,4,5,6];


            if(response == 0)
            {
                $('#app_date_here').css('display','none');
                alert('Sorry! No Appointment Schedule Available of this doctor');
            }
            else {
                $('#app_date_here').css('display','block');

                var html = '';
                response.schedule_details.forEach(function (data, i) {
                    html += `
                        <tr>
                            <td>` + g_day[data.days] + `</td>
                            <td>` + data.start_time + ` <b>&nbsp;&nbsp;TO&nbsp;&nbsp;</b> ` + data.end_time + `</td>
                            <td>` + data.tokens + `</td>
                        </tr>
                `;
                    ndays.push(data.days);
                });

                var abc = ndays.getUnique(true);
                //console.log(abc);

                var position = '';


                abc.forEach(function(data,index){
                    position = ndow.indexOf(data*1);
                    ndow.splice(position, 1);
                    //console.log(ndow);
                });
                //console.log(ndow);

                $('#datepicker2').datepicker({
                    startDate: new Date(),
                }).datepicker('setDaysOfWeekDisabled', ndow);

                $('#table_row_app').html(html);
            }


        }
    });
});

$('#datepicker2').change(function () {
    var app_date = $(this).val();
    var doc_id = $('#app_doc_id').val();
    $.ajax({
        url: '../../get_token_chek',
        type: 'GET',
        data: {
            app_date: app_date,
            doc_id: doc_id
        },
        dataType: 'json',
        success: function (response) {
            //console.log(response.check);
            if(response.check == 2)
            {
                var timing = '';

                response.schedule_details.forEach(function (data,index) {
                    timing += `
                        <option value="`+data.id+`">`+data.start_time+` to `+data.end_time+`</option>
                    `;
                });

                var html2 = `
                    <span style="color: #0000F0"><b>Day has two schedules select any one time</b></span>
                    <br>
                    <br>
                    <select class="form-control" name="time" id="select_time">
                        <option selected disabled="disabled">Select Time</option>
                        `+timing+`
                    </select>
                    div
                `;
                $('#problem_app').attr('disabled','disabled');
                $('#time_here').html(html2);
            }
            else if(response.check == 1)
            {
                var html2 = `
                    <br><span style="color: #2ca02c"><b>Token Available !</b></span>
                    <input type="hidden" name="schedule_detail_id" value="`+response.schedule_details[0].id+`">
                    
                `;
                $('#problem_app').removeAttr('disabled','disabled');
                $('#time_here').html(html2);
            }
            else if(response.check == 0)
            {
                var html2 = `
                    <br><span style="color: #ac2925"><b>Token Full Sorry !</b></span>
                    
                `;
                $('#problem_app').attr('disabled','disabled');
                $('#time_here').html(html2);
            }
        }
    });
});

$('body').on('change','#select_time',function () {

    var app_date = $('#datepicker2').val();
    var schedule_id = $(this).val();

    $.ajax({
        url: '../../get_token_time_chek',
        type: 'GET',
        data: {
            schedule_id: schedule_id,
            app_date: app_date
        },
        dataType: 'json',
        success: function (response) {
            if(response.check == 1)
            {
                var html2 = `
                    <br><span style="color: #2ca02c"><b>Token Available !</b></span>
                    <input type="hidden" name="schedule_detail_id" value="`+response.schedule_details.id+`">
                    
                `;
                $('#problem_app').removeAttr('disabled','disabled');
                $('#time_here').append(html2);
            }
            else if(response.check == 0)
            {
                var html2 = `
                    <br><span style="color: #ac2925"><b>Token Full Sorry !</b></span>
                    <input type="hidden" name="schedule_detail_id" value="`+response.schedule_details.id+`">
                    
                `;
                $('#problem_app').attr('disabled','disabled');
                $('#time_here').append(html2);
            }
        }
    });
});

/*
$('.modal_select').click(function () {
    $(".select2").select2('refresh');
    //abc.select2('refresh');
    //abc.select2('open');
});*/
/*states for cities*/
$('#country').change(function () {
    var country_id = $(this).val();
    $.ajax({
        url: 'get_states',
        type: 'GET',
        data: {country_id: country_id},
        dataType: 'json',
        success: function (response) {
            var html = '<option disabled selected value="0">Select State</option>';
            response.forEach(function (data) {
                html+= `
                    <option value="`+data.name+`">`+data.name+`</option>
                `;
            });

            $('#state').html(html);
        }
    });
});

$('#state').change(function () {
    var state_id = $(this).val();
    $.ajax({
        url: 'get_cities',
        type: 'GET',
        data: {state_id: state_id},
        dataType: 'json',
        success: function (response) {
            var html = '<option disabled selected value="0">Select City</option>';
            response.forEach(function (data) {
                html+= `
                    <option value="`+data.name+`">`+data.name+`</option>
                `;
            });

            $('#city').html(html);
        }
    });
});

/*for edit patients*/
$('body').on('click','.edit_patient_modal',function () {

    var patient_id = $(this).data('patientid');

    var country_id = $('#country'+patient_id).val();
    var state_id = $('#state'+patient_id).val();
    var city_id = $('#city'+patient_id).val();

    $.ajax({
        url: 'get_states',
        type: 'GET',
        data: {country_id: country_id},
        dataType: 'json',
        success: function (response) {
            var html = `<option selected>`+state_id+`</option>`;
            response.forEach(function (data) {
                html+= `
                    <option value="`+data.name+`">`+data.name+`</option>
                `;
            });

            $('#state'+patient_id).html(html);
        }
    });

    $.ajax({
        url: 'get_cities',
        type: 'GET',
        data: {state_id: state_id},
        dataType: 'json',
        success: function (response) {
            var html = '<option selected>'+city_id+'</option>';
            response.forEach(function (data) {
                html+= `
                    <option value="`+data.name+`">`+data.name+`</option>
                `;
            });

            $('#city'+patient_id).html(html);
        }
    });
});

$('body').on('change','.country2',function () {
    var patient_id = $(this).data('patientid');

    var country_id = $(this).val();
    $.ajax({
        url: 'get_states',
        type: 'GET',
        data: {country_id: country_id},
        dataType: 'json',
        success: function (response) {
            var html = '<option disabled selected value="0">Select State</option>';
            var html2 = '<option disabled selected value="0">Select City</option>';
            response.forEach(function (data) {
                html+= `
                    <option value="`+data.name+`">`+data.name+`</option>
                `;
            });

            $('#state'+patient_id).html(html);

            $('#city'+patient_id).html(html2);
        }
    });
});

$('body').on('change','.state2',function () {

    var patient_id = $(this).data('patientid');

    var state_id = $(this).val();
    $.ajax({
        url: 'get_cities',
        type: 'GET',
        data: {state_id: state_id},
        dataType: 'json',
        success: function (response) {
            var html = '<option disabled selected value="0">Select City</option>';
            response.forEach(function (data) {
                html+= `
                    <option value="`+data.name+`">`+data.name+`</option>
                `;
            });

            $('#city'+patient_id).html(html);
        }
    });
});
$.fn.modal.Constructor.prototype.enforceFocus = function() {};


/*For Data Tables*/

/*function populate()
{
    console.time('populate');
    var t = $('#datatable-responsive12').dataTable();

    for (var irow = 0; irow < 2500; irow++)
    {
        var cells = new Array();
        var r = jQuery('<tr id=' + irow + '>');
        for (var icol = 0; icol < 4; icol ++)
            cells[icol] = 'Row ' + irow + '; col ' + icol;
        var ai = t.fnAddData(cells,false);
    }
    t.fnDraw();
    console.timeEnd('populate');
}

$(window).load(function () {
    populate();
});

console.time('render');
jQuery('#datatable-responsive12').dataTable(
    {
        'bDestroy': true,
        "bInfo": true,
        "bProcessing": true,
        "bDeferRender": true,
        'iDisplayLength': 10,
        'sPaginationType': 'full_numbers',
        'sDom': '<"top"i> T<"clear">lfrtip',
        'sPageButtonActive': "paginate_active",
        'sPageButtonStaticDisabled': "paginate_button",
        "oLanguage": {
            "sSearch": "Futher Filter Search results:",
            "sInfo": "Got a total of _TOTAL_ results to show (_START_ to _END_)",
            "sLengthMenu": 'Show <select>' +
            '<option value="5">5</option>' +
            '<option value="10">10</option>' +
            '<option value="15">15</option>' +
            '<option value="20">20</option>' +
            '<option value="25">25</option>' +
            '</select> results'
        },
        "bSort": false
    }
);
console.timeEnd('render');*/

/*For DataTables End*/



/*For TExtArea start*/


/* End Tet Area End*/
