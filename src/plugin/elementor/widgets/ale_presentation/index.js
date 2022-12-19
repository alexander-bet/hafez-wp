jQuery(function($) {
    "use strict";
    
    var d1 = $('.fwc_presentation .decor .decor_1'); 
    var d2 = $('.fwc_presentation .decor .decor_2'); 
    var d3 = $('.fwc_presentation .decor .decor_3'); 
    var d4 = $('.fwc_presentation .decor .decor_4'); 

    var lastScrollTop = 0, delta = 5;

    $(window).scroll(function(event){
        var st = $(this).scrollTop();
       
        if(Math.abs(lastScrollTop - st) <= delta)
            return;
        
        if (st > lastScrollTop){
            // downscroll
            d1.appear(function(){
                d1.css({
                    'margin-left': '-100px'
                });
            },{accX: 0, accY: 0})
            d2.appear(function(){
                d2.css({
                    'margin-right': '100px'
                });
            },{accX: 0, accY: 0})
            d3.appear(function(){
                d3.css({
                    'margin-right': '-100px'
                });
            },{accX: 0, accY: 0})
        } else {
            //upscroll
            d1.appear(function(){
                d1.css({
                    'margin-left': '0'
                });
            },{accX: 0, accY: 0})
            d2.appear(function(){
                d2.css({
                    'margin-right': '0'
                });
            },{accX: 0, accY: 0})
            d3.appear(function(){
                d3.css({
                    'margin-right': '0'
                });
            },{accX: 0, accY: 0})
            
        }
        lastScrollTop = st;
    });
});