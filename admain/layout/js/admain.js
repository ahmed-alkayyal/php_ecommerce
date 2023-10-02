$(function(){
    $('input').attr('placeholder',function(){
        $(this).focus(function(){
            $(this).attr('data-text',$(this).attr('placeholder'));
            $(this).attr('placeholder','');
        }).blur(function(){
            $(this).attr('placeholder',$(this).attr('data-text'));
        })
    })
    // ADD Astreisk
    $('input').each(function(){
        if($(this).attr('required')==='required'){
            $(this).after("<span class='astreisk'>*</span>");
        }
    });
    //confirm btn delete
    $('.confirm').click(function(){
        return confirm('Are you sure يا عشور');
        console.log("ahmed");
    })

});
