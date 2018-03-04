/*for patients*/
$('.add_drug1').click(function(){
    //alert('ok');
    var drug_name = $('.drug_name_pat').val();

    if(drug_name !== '' )
    {

        var html = `
					<div class="col-sm-12">
					    <h6 style="margin: 2px;">- `+drug_name+`&nbsp;&nbsp; <button type="button" class="btn btn-pink remove_item1" style="font-size: 11px; padding: 2px;">X</button></h6>
					    <input type="hidden" name="drug_name[]" value="`+drug_name+`">
                    </div>
		`;
        $('#here_drug_allegy1').append(html);
        $('.drug_name_pat').val('');

    }
    else{
        alert('please Enter Drug Name');
    }
});

$('body').on('click', '.remove_item1', function(){
    var itemData = $(this).parent().parent();
    itemData.remove();
});

$('body').on('click','.add_drug2',function () {
    //alert('ok');
    var drug_name = $('.drug_name_pat2').val();


    if(drug_name !== '' )
    {

        var html = `
					<div class="col-sm-12">
					    <h6 style="margin: 2px;">- `+drug_name+` &nbsp;&nbsp;<button type="button" class="btn btn-pink remove_item1" style="font-size: 11px; padding: 2px;">X</button></h6>
					    <input type="hidden" name="drug_name[]" value="`+drug_name+`">
                    </div>
		`;
        $('#here_drug_allegy2').append(html);
        $('.drug_name_pat2').val('');
        //$('.name_of_item').val().prop('selected',true);

    }
    else{
        alert('please Enter Drug Name');
    }
});

$('body').on('click', '.remove_item2', function(){
    var itemData = $(this).parent().parent();
    itemData.remove();
});



$('.add_history1').click(function(){
    //alert('ok');
    var history_name = $('.medical_history_pat1').val();

    if(history_name !== '' )
    {

        var html = `
					<div class="col-sm-12">
					    <h6 style="margin: 2px;">- `+history_name+`&nbsp;&nbsp; <button type="button" class="btn btn-pink remove_item1" style="font-size: 11px; padding: 2px;">X</button></h6>
					    <input type="hidden" name="medical_info[]" value="`+history_name+`">
                    </div>
		`;
        $('#here_medical_history1').append(html);
        $('.medical_history_pat1').val('');
        //$('.name_of_item').val().prop('selected',true);

    }
    else{
        alert('please Enter Medical History');
    }
});

$('body').on('click','.add_history2',function () {

    var history_name = $('.medical_history_pat2').val();

    if(history_name !== '' )
    {

        var html = `
					<div class="col-sm-12">
					    <h6 style="margin: 2px;">- `+history_name+`&nbsp;&nbsp; <button type="button" class="btn btn-pink remove_item2" style="font-size: 11px; padding: 2px;">X</button></h6>
					    <input type="hidden" name="medical_info[]" value="`+history_name+`">
                    </div>
		`;
        $('#here_medical_history2').append(html);
        $('.medical_history_pat2').val('');
        //$('.name_of_item').val().prop('selected',true);

    }
    else{
        alert('please Enter Medical History');
    }
});


$('.patient_all_info').click(function () {
    var patient_id = $(this).data('patient_id');

    $.ajax({
        url: 'get_patient_info',
        type: 'GET',
        data: {patient_id: patient_id},
        dataType: 'json',
        success: function (response) {

            $('#profie_pat_here').html(response);
            $('.select2').select2();


        }
    });
});



$('.upload_image_pat').click(function () {
    $('.uploading').css('display','block');
    $('.taking_pic').css('display','none');
    $('.hidden_div').css('display','none');
});

$('.snap_image_pat').click(function () {
    Webcam.set({
        width: 120,
        height: 150,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#main_camera');

    $('.uploading').css('display','none');
    $('.taking_pic').css('display','block');
    $('.hidden_div').css('display','none');
});


$('body').on('click','.upload_image_pat2',function () {
    $(":file").filestyle({input: false});
    $('.uploading2').css('display','block');
    $('.taking_pic2').css('display','none');
    $('.hidden_div2').css('display','none');
});


$('body').on('click','.snap_image_pat2',function () {
    Webcam.set({
        width: 120,
        height: 150,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#main_camera2');

    $('.uploading2').css('display','none');
    $('.taking_pic2').css('display','block');
    $('.hidden_div2').css('display','none');
});




$('.upload_to_plus').change(function (event) {

    //debugger;
    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
    var fileName = event.target.files[0].name;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    if ($.inArray(fileNameExt, validExtensions) == -1) {
        event.type = '';
        event.type = 'file';

        alert("Only these file types are accepted : "+validExtensions.join(', '));
    }
    else
    {
        var file_img = URL.createObjectURL(event.target.files[0]);

        var html = `
                    <img src="`+file_img+`" id="webcam_photo" width="100%" height="100%" style="border-radius: 60px;"/>
                    <input type="hidden" name="upload_photo" value="0">
                    `;

        $('.upload_to_plus').attr('name','profile_photo');
        $('#results').html(html);

    }

});



$('body').on('change','.upload_to_plus2',function (event) {

    var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
    var fileName = event.target.files[0].name;
    var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
    if ($.inArray(fileNameExt, validExtensions) == -1) {
        event.type = '';
        event.type = 'file';

        alert("Only these file types are accepted : "+validExtensions.join(', '));
    }
    else
    {
        var file_img = URL.createObjectURL(event.target.files[0]);

        var html = `
                    <img src="`+file_img+`" id="webcam_photo" width="100%" height="100%" style="border-radius: 60px;"/>
                    <input type="hidden" name="upload_photo" value="0">
                    `;

        $('.upload_to_plus2').attr('name','profile_photo');
        $('#results2').html(html);

    }
});

$('.take_snapshot').click(function () {
    var url = $('#basepath').val();
    //var csrf_token = $("meta[name=csrf-token]").attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    Webcam.snap( function(data_uri) {
        var html = `
                        <img src="`+data_uri+`" id="webcam_photo" width="100%" height="100%" style="border-radius: 60px;"/>
                        <input type="hidden" name="webcam_photo" value="`+data_uri+`">
                        <input type="hidden" name="upload_photo" value="1">
                `;
        $('#results').html(html);

    });
});

$('body').on('click','.take_snapshot2',function () {
    var url = $('#basepath').val();
    //var csrf_token = $("meta[name=csrf-token]").attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    Webcam.snap( function(data_uri) {
        var html = `
                        <img src="`+data_uri+`" id="webcam_photo" width="100%" height="100%" style="border-radius: 60px;"/>
                        <input type="hidden" name="webcam_photo" value="`+data_uri+`">
                        <input type="hidden" name="upload_photo" value="1">
                `;
        $('#results2').html(html);

    });
});


var allowSubmit = 0;
$('#patient_add_submit').on('submit',function (e) {

    if(allowSubmit == 0) {

        e.preventDefault();


        var validation = [];
        //alert(document.getElementById('inlineRadio8').checked);
        //var full_name = document.getElementsByName('country')[0].value;
        if (document.getElementsByName('full_name')[0].value == "") {
            validation.push("Please Enter Full Name");

        }
        if (document.getElementsByName('contact_no')[0].value == "") {

            validation.push("Please Enter Contact No");
        }
        if (document.getElementById('inlineRadio8').checked == false && document.getElementById('inlineRadio9').checked == false) {

            validation.push("Please Select Gender");
        }
        if (document.getElementsByName('date_of_birth')[0].value == "") {

            validation.push("Please Enter Date Of Birth");
        }
        if (document.getElementsByName('country')[0].value == 0) {

            validation.push("Please Select Country");
        }
        if (document.getElementsByName('state')[0].value == 0) {

            validation.push("Please Select state");
        }
        if (document.getElementsByName('city')[0].value == 0) {

            validation.push("Please Select city");
        }

        if(document.getElementsByName('full_name')[0].value == "" || document.getElementsByName('contact_no')[0].value == ""
        || document.getElementsByName('date_of_birth')[0].value == "" || document.getElementsByName('country')[0].value == 0
            || document.getElementsByName('state')[0].value == 0 || document.getElementsByName('city')[0].value == 0)
        {
            var errors = '';
            validation.forEach(function (data) {
                errors += '<li>'+data+'</li>';
            });
            var htmlError = `
                        <div class="alert alert-danger">
                            <ul>
                                `+errors+`
                            </ul>
                        </div>
                `;

            $('#error_here').html(htmlError);

        }
        else {
            if(document.getElementById('inlineRadio8').checked == false && document.getElementById('inlineRadio9').checked == false)
            {
                var errors = '';
                validation.forEach(function (data) {
                    errors += '<li>'+data+'</li>';
                });
                var htmlError = `
                        <div class="alert alert-danger">
                            <ul>
                                `+errors+`
                            </ul>
                        </div>
                `;

                $('#error_here').html(htmlError);
            }
            else {
                allowSubmit = 1;
                $(this).submit();

            }

        }
    }

});


$('body').on('change','.select_pres_record2',function () {
    var type = $(this).val();
    var pres_id = $(this).data('prescription_id');

    if(type == 0)
    {
        $('#vital_sign_hidden'+pres_id).css('display','block');
        $('#medical_note_hidden'+pres_id).css('display','none');
        $('#medical_template_hidden'+pres_id).css('display','none');
        $('#drawing_template_hidden'+pres_id).css('display','none');
        $('#prescription_hidden'+pres_id).css('display','none');
        $('#medical_certificate_hidden'+pres_id).css('display','none');
        $('#files_hidden'+pres_id).css('display','none');
    }
    else if(type == 1)
    {
        $('#vital_sign_hidden'+pres_id).css('display','none');
        $('#medical_note_hidden'+pres_id).css('display','block');
        $('#medical_template_hidden'+pres_id).css('display','none');
        $('#drawing_template_hidden'+pres_id).css('display','none');
        $('#prescription_hidden'+pres_id).css('display','none');
        $('#medical_certificate_hidden'+pres_id).css('display','none');
        $('#files_hidden'+pres_id).css('display','none');
    }
    else if(type == 2)
    {
        $('#vital_sign_hidden'+pres_id).css('display','none');
        $('#medical_note_hidden'+pres_id).css('display','none');
        $('#medical_template_hidden'+pres_id).css('display','block');
        $('#drawing_template_hidden'+pres_id).css('display','none');
        $('#prescription_hidden'+pres_id).css('display','none');
        $('#medical_certificate_hidden'+pres_id).css('display','none');
        $('#files_hidden'+pres_id).css('display','none');
    }
    else if(type == 3)
    {


        $('#vital_sign_hidden'+pres_id).css('display','none');
        $('#medical_note_hidden'+pres_id).css('display','none');
        $('#medical_template_hidden'+pres_id).css('display','none');
        $('#drawing_template_hidden'+pres_id).css('display','block');
        $('#prescription_hidden'+pres_id).css('display','none');
        $('#medical_certificate_hidden'+pres_id).css('display','none');
        $('#files_hidden'+pres_id).css('display','none');
    }
    else if(type == 4)
    {
        $('#vital_sign_hidden'+pres_id).css('display','none');
        $('#medical_note_hidden'+pres_id).css('display','none');
        $('#medical_template_hidden'+pres_id).css('display','none');
        $('#drawing_template_hidden'+pres_id).css('display','none');
        $('#prescription_hidden'+pres_id).css('display','block');
        $('#medical_certificate_hidden'+pres_id).css('display','none');
        $('#files_hidden'+pres_id).css('display','none');
    }
    else if(type == 5)
    {
        $('#vital_sign_hidden'+pres_id).css('display','none');
        $('#medical_note_hidden'+pres_id).css('display','none');
        $('#medical_template_hidden'+pres_id).css('display','none');
        $('#drawing_template_hidden'+pres_id).css('display','none');
        $('#prescription_hidden'+pres_id).css('display','none');
        $('#medical_certificate_hidden'+pres_id).css('display','block');
        $('#files_hidden'+pres_id).css('display','none');
    }
    else if(type == 6)
    {

        $('#vital_sign_hidden'+pres_id).css('display','none');
        $('#medical_note_hidden'+pres_id).css('display','none');
        $('#medical_template_hidden'+pres_id).css('display','none');
        $('#drawing_template_hidden'+pres_id).css('display','none');
        $('#prescription_hidden'+pres_id).css('display','none');
        $('#medical_certificate_hidden'+pres_id).css('display','none');
        $('#files_hidden'+pres_id).css('display','block');
    }
});

/*for patients end*/