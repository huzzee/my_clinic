$('.add_drug').click(function(){
    //alert('ok');
    var drug_name = $('.drug_name').val();
    var drug_comment = $('.drug_comment').val();


    if(drug_name !== '' )
    {

        var html = `
					<tr>
					    
			            <td>`+drug_name+`<input type="hidden" name="drug_allergy[drug_name][]" value="`+drug_name+`"></td>
			            <td>`+drug_comment+`<input type="hidden" name="drug_allergy[drug_comment][]" value="`+drug_comment+`"></td>
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
					    
			            <td>`+drug_name+`<input type="hidden" name="drug_allergy[drug_name][]" value="`+drug_name+`"></td>
			            <td>`+drug_comment+`<input type="hidden" name="drug_allergy[drug_comment][]" value="`+drug_comment+`"></td>
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
            console.log(response);
            
            /*if(response == 1)
            {
                var html = `<p>This Doctor schedule is already added.If
                        You want to update it go to schedule list</p>`;

                $('#display_schedule').css('display','none');
                $('#here_doc').html(html);
            }
            else
            {
                $('#display_schedule').css('display','block');
            }*/
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
    var day = $('.opd_day').val();
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
