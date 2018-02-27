
$(function () {

    var base_url = $('#baseUrl').val();
    // loader


    /*$('#abcde').click(function () {
        //console.log($(this).children());
        $(this).children().children('.lower-canvas').attr('width','200');
        $(this).children().children('.upper-canvas').attr('width','200');
    });*/


    /*var c = $("#c");


    function draw() {
        var ctx = c[0].getContext('2d');
        ctx.canvas.width  = window.innerWidth;
        ctx.canvas.height = window.innerHeight;
        //...drawing code...
    }*/
    /*ctx.canvas.height = 300;
    ctx.canvas.width = 200;*/
    var c = $("#c");
    var ctx = c[0].getContext('2d');

    var w = $(window).width();

    if(w > 1000)
    {
        ctx.canvas.height = 600;
        ctx.canvas.width = 730;
    }
    else if (w < 1000 && w > 800)
    {

        ctx.canvas.height = 500;
        ctx.canvas.width = 600;
    }
    else if(w < 800 && w > 600)
    {
        ctx.canvas.height = 350;
        ctx.canvas.width = 460;
    }
    else if(w < 600)
    {
        ctx.canvas.height = 200;
        ctx.canvas.width = 230;
    }
    /*$(window).resize(function () {
        //alert('ok');
        w = $(window).width();

        //alert(w);

        if(w < 1000 && w > 600)
        {

            c.width = window.innerWidth;
            c.height = window.innerHeight;
           /!* var per = (20/100)*w;
            context.canvas.height = 300;
            context.canvas.width = 200;
            draw();*!/
        }
    });*/
    /*var w = $(window).width();
    var h = $(window).height();

    $('#c').attr('width',w);
    $('#c').attr('height',h);*/

    $(".loader").fadeOut(500, function () {
        $(".page_wrapper").show();
    });

    // create a canvas
    var canvas = new fabric.Canvas('c', {

        isDrawingMode: true
    });

    // drag&drop area settings
    /*$('[name="image"]').ezdz({
        text: '<p>Drop or select a picture<p>',
        validators: {
            maxSize: 4000000
        },
        reject: function (file, errors) {
            if (errors.mimeType) {
                alert(file.name + ' must be jpg or png.');
            }
            if (errors.maxSize) {
                alert(file.name + ' must be size:4mb max.');
            }
        }
    });*/

    // canvas background color
    $('#canvas-background-color').minicolors({
        defaultValue: '#fff',
    });
    var canvasbcolor = $("#canvas-background-color").val();
    canvas.backgroundColor = canvasbcolor;
    canvas.renderAll();

    $("#canvas-background-color").on("change", function () {
        //alert('ok');
        var canvasbcolor = $("#canvas-background-color").val();
        canvas.backgroundColor = canvasbcolor;
        canvas.renderAll();
    });

    // make an image canvas background
    $("#image-background").change(function (e) {

        var x = URL.createObjectURL(e.target.files[0]);
        //URL.createObjectURL(event.target.files[0]);
        if(w > 1000)
        {
            canvas.setBackgroundImage(x,

                canvas.renderAll.bind(canvas), {

                    width: 630,
                    height: 500,
                    backgroundImageStretch: false
                });
        }
        else if (w < 1000 && w > 800)
        {
            canvas.setBackgroundImage(x,

                canvas.renderAll.bind(canvas), {

                    width: 430,
                    height: 350,
                    backgroundImageStretch: false
                });
        }
        else if(w < 800 && w > 600)
        {
            canvas.setBackgroundImage(x,

                canvas.renderAll.bind(canvas), {

                    width: 350,
                    height: 250,
                    backgroundImageStretch: false
                });
        }
        else if(w < 600)
        {
            canvas.setBackgroundImage(x,

                canvas.renderAll.bind(canvas), {

                    width: 200,
                    height: 140,
                    backgroundImageStretch: false
                });
        }


        $("#c").css("border", "none");
        return false;
    });

    // add an image to canvas
    $('#my_template').change(function () {
        var temp = $(this).val();
        var uri;
        $.ajax({
            url: "../../temp_change",
            type: "GET",
            data: {temp: temp},
            dataType: "json",
            success: function (response) {


                uri = base_url+'/public/uploads/'+response.images;

                if(w > 1000)
                {
                    fabric.Image.fromURL(uri, function (oImg) {
                        canvas.add(oImg);

                    }, {
                        "scaleX": 0.80,
                        "scaleY": 0.80
                    });

                }
                else if (w < 1000 && w > 800)
                {
                    fabric.Image.fromURL(uri, function (oImg) {
                        canvas.add(oImg);

                    }, {
                        "scaleX": 0.65,
                        "scaleY": 0.60
                    });
                }
                else if(w < 800 && w > 600)
                {
                    fabric.Image.fromURL(uri, function (oImg) {
                        canvas.add(oImg);

                    }, {
                        "scaleX": 0.50,
                        "scaleY": 0.50,
                    });
                }
                else if(w < 600)
                {
                    fabric.Image.fromURL(uri, function (oImg) {
                        canvas.add(oImg);

                    }, {
                        "scaleX": 0.25,
                        "scaleY": 0.30
                    });
                }


                $("#c").css("border", "none");
                return false;
            }
        });
    });
    $("#image-on").click(function () {
        var x2 = $('.ezdz-dropzone img').attr('src');

        fabric.Image.fromURL(x2, function (oImg) {
            canvas.add(oImg);

        }, {
            "scaleX": 0.40,
            "scaleY": 0.40
        });

        $("#c").css("border", "none");
        return false;
    });

    // default text color
    $('.text-color').minicolors({
        defaultValue: '#333',
    });


    $("header p").click(function () {
        text.set({
            fill: '#000'
        })
    });
    // hit enter and add text
    $('#add-text').click(function (e) {
        //alert('ok')

            var myText = $("#text").val();
            $("#text").val('');
            //alert(myText);

            var mycolor = $("#text-color").val();
            //console.log(mycolor);
            //var myfont = $("#text-font option:selected").val();

            var text = new fabric.Text(myText, {
                fontFamily: 'Arial',
                fontSize: 40,
                fill: mycolor,
                left: 40,
                top: 50
            });
            text.hasRotatingPoint = true;
            canvas.add(text);

            $("#selection").trigger("click");


    });
    /*$('#text').bind('change keyup input', function (e) {
        var key = e.which;
        if (key == 13) {

            var myText = $("#text").val();
            $("#text").val('');

            var mycolor = $(".text-color").val();
            var myfont = $("#text-font option:selected").val();

            var text = new fabric.Text(myText, {
                fontFamily: myfont,
                fontSize: 40,
                fill: mycolor,
                left: 40,
                top: 50
            });
            text.hasRotatingPoint = true;
            canvas.add(text);

            $("#selection").trigger("click");
        }
        return false;
    });*/

    // defaut draw color
    $('#draw-color').minicolors({
        defaultValue: '#333',
    });
    $("#draw-color").on("change", function () {
        var mycolor = $("#draw-color").val();
        canvas.freeDrawingBrush.color = mycolor;
        return false;
    });

    // click button and start to draw
    $("#draw").click(function () {
        canvas.isDrawingMode = true;

        $("#draw-color").on("change", function () {
            var mycolor = $("#draw-color").val();
            canvas.freeDrawingBrush.color = mycolor;
            return false;
        });

        canvas.renderAll();
        $(this).addClass('active');
        $("#selection").removeClass('active');
        return false;
    });

    // click button to activate selection mode
    $("#selection").addClass('active');
    $("#selection").click(function () {
        canvas.isDrawingMode = false;
        $(this).addClass('active');
        $("#draw").removeClass('active');
        return false;
    });

    // update brush width
    $("#range").on("change", function () {
        var rangeVal = $(this).val();
        $("#value").val(rangeVal);
        canvas.freeDrawingBrush.width = rangeVal;
        return false;
    });

    $("#value").on("keyup", function () {
        var rangeShownVal = $(this).val();
        if (rangeShownVal < 51) {
            $("#range").val(rangeShownVal);
            canvas.freeDrawingBrush.width = rangeShownVal;
        } else {
            alert("Max is 50");
            var rangeVal2 = $("#range").val();
            $("#value").val(rangeVal2);
        }
        return false;
    });

    // delete selected object
    function deleteObjects() {
        var activeObject = canvas.getActiveObject(),
            activeGroup = canvas.getActiveGroup();
        if (activeObject) {
            if (confirm('Are you sure?')) {
                canvas.remove(activeObject);
            }
        }
    };
    $("#delete").click(function () {
        deleteObjects();
        return false;
    });

    // clear canvas
    $("#delete-all").click(function () {
        if (confirm('Are you sure?')) {
            canvas.backgroundImage = false;
            canvas.clear();
        }
        return false;
    });

    // save canvas as image
    $('#record_submit').one('submit',function (e) {
        e.preventDefault();

        var dataurl = canvas.toDataURL();
        //console.log(dataurl);
        //alert(dataurl);
        var html =
                '<input type="hidden" value="'+dataurl+'" name="canvas_image"/>';

        $('#abcde').append(html);

        $(this).submit();

    });
    /*$("#save").click(function () {
        $("#save").attr("href", canvas.toDataURL());
        $("#save").attr("download","draweditor")
    });*/

    // about modal
    var modal = $('.modal');
    var overlay = $(".overlay");
    overlay.hide();
    $('.open-modal').click(function () {
        modal.show();
        overlay.show();
    });

    $('.close-modal').click(function () {
        modal.hide();
        overlay.hide();
    });

    $(".overlay").click(function () {
        modal.hide();
        overlay.hide();
    });
});


// confirmation before closing the tab

