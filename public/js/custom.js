
var base_uri = $('#baseUrl').val();
$('.add_drug').click(function(){
    //alert('ok');
    var drug_name = $('.drug_name').val();
    var drug_comment = $('.drug_comment').val();


    if(drug_name !== '' )
    {

        var html = `
					<tr>
					    
			            <td>`+drug_name+`<input type="hidden" name="drug_name[]" value="`+drug_name+`"></td>
			            <td>`+drug_comment+`<input type="hidden" name="drug_comment[]" value="`+drug_comment+`"></td>
			            <td>
			            <button type="button" class="btn btn-icon btn-danger m-b-5 remove_item">
			            <i class="fa fa-remove"></i>
			            </button>
			            </td>
			        </tr>
		`;
        $('#item_row').append(html);
        //$('.name_of_item').val().prop('selected',true);





        $('.drug_name').val('');
        $('.drug_comment').val('');
    }
    else{
        alert('please Enter Drug Name');
    }
});

$('body').on('click', '.remove_item', function(){
    var itemData = $(this).parent().parent();
    itemData.remove();
});

$('.add_drug1').click(function(){
    //alert('ok');
    var drug_name = $('.drug_name1').val();
    var drug_comment = $('.drug_comment1').val();


    if(drug_name !== '' )
    {

        var html = `
					<tr>
					    
			            <td>`+drug_name+`<input type="hidden" name="drug_name[]" value="`+drug_name+`"></td>
			            <td>`+drug_comment+`<input type="hidden" name="drug_comment[]" value="`+drug_comment+`"></td>
			            <td>
			            <button type="button" class="btn btn-icon btn-danger m-b-5 remove_item1">
			            <i class="fa fa-remove"></i>
			            </button>
			            </td>
			        </tr>
		`;
        $('#item_row1').append(html);
        //$('.name_of_item').val().prop('selected',true);





        $('.drug_name1').val('');
        $('.drug_comment1').val('');
    }
    else{
        alert('please Enter Drug Name');
    }
});

$('body').on('click', '.remove_item1', function(){
    var itemData = $(this).parent().parent();
    itemData.remove();
});

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


    if(day !== '' && start !== '' && end !== '')
    {

        var html = `
					<tr>
					    
			            <td>`+day+`<input type="hidden" name="opd_day[]" value="`+day+`"></td>
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


    if(day !== '' && start !== '' && end !== '')
    {

        var html = `
					<tr>
					    
			            <td>`+day+`<input type="hidden" name="app_day[]" value="`+day+`"></td>
			            <td>`+start+`<input type="hidden" name="app_start_time[]" value="`+start+`"></td>
			            <td>`+end+`<input type="hidden" name="app_end_time[]" value="`+end+`"></td>
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

$('#pats').change(function () {
    var pat_id = $(this).val();

    $('#add_here').attr("href",base_uri+"/medical_records/"+pat_id+"/edit");
});

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
                                <input type="radio" id="inlineRadio1" name="answers[`+abcd+`]" value="`+ans+`">
                                <label for="inlineRadio1"> `+ans+` </label>
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
                console.log(abcd);
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

    if (drug !== 0)
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

            }

        });
    }


});

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
    //alert(drug_name);

    if(dosage_unit !== '' && price_med !== '' && stock_unit !== '' && gst !== '' && drug_pres !== '' &&
        medicine_qnt !== '' && dosage_qnt !== '' && instruction !== ''
        && days !== '')
    {
        var sub_total = Math.round((medicine_qnt*price_med)*100)/100;

        var gst_total = Math.round(((sub_total/100 *gst)+sub_total)*100)/100;

        var dissc_total = Math.round((gst_total-(gst_total/100 *discount))*100)/100;

        var line_total = dissc_total;
        var html = `<tr>
                        <td>`+drug_name+`<input type="hidden" name="drug_name[]" value="`+drug_name+`">
                        <input type="hidden" name="drug_id" value="`+drug_id+`"></td>
                        <td>`+medicine_qnt+`<input type="hidden" name="medicine_qnt[]" value="`+medicine_qnt+`"></td>
                        <td>`+price_med+`<input type="hidden" name="price[]" value="`+price_med+`"></td>
                        <td>`+sub_total+`<input type="hidden" name="sub_total[]" value="`+sub_total+`"></td>
                        <td>`+discount+`<input type="hidden" name="discount[]" value="`+discount+`"></td>
                        <td>`+remark+`<input type="hidden" name="remark[]" value="`+remark+`"></td>
                        <td>`+gst+`<input type="hidden" name="gst[]" value="`+gst+`"></td>
                        <td>`+line_total+`<input type="hidden" name="line_total[]" value="`+line_total+`"></td>
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
        $('#drug_pres option').text('Select Medicines');


        $(this).attr('data-dismiss','modal');
    }
    else
    {
        alert('Fill All Fields');
    }


});

$('body').on('click','.remove_table_pres',function () {
   var item = $(this).parent().parent();
   item.remove();

});




