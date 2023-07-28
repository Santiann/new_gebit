
flag=0;
$('#next-price').click(function(){
    if(flag == 0){
        $('.slide-item.i1').css({'transform':'translateX(0) scale(1.0)','z-index':'10'});
        $('.slide-item.i2').css({'transform':'translateX(69px) scale(0.9)','z-index':'9'});
        $('.slide-item.i3').css({'transform':'translateX(129px) scale(0.8)','z-index':'8'});
    flag = 1;
    } else if(flag == 1){
        $('.slide-item.i2').css({'transform':'translateX(0) scale(1.0)','z-index':'10'});
        $('.slide-item.i3').css({'transform':'translateX(69px) scale(0.9)','z-index':'9'});
        $('.slide-item.i1').css({'transform':'translateX(129px) scale(0.8)','z-index':'8'});
    flag = 2;
    }else if(flag == 2){
        $('.slide-item.i3').css({'transform':'translateX(0) scale(1.0)','z-index':'10'});
        $('.slide-item.i1').css({'transform':'translateX(69px) scale(0.9)','z-index':'9'});
        $('.slide-item.i2').css({'transform':'translateX(129px) scale(0.8)','z-index':'8'});
    flag = 0;
    }
});
