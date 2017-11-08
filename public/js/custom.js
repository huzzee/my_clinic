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
