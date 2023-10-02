$(function(){
    'use strict';
    console.log('ahmed')
    console.log("أحمد");
    $('input').attr('placeholder',function(){
        $(this).focus(function(){
            $(this).attr('data-text',$(this).attr('placeholder'));
            $(this).attr('placeholder','');
        }).blur(function(){
            $(this).attr('placeholder',$(this).attr('data-text'));
        })
    })

});