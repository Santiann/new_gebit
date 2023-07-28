$(document).ready(function(){
	
	$('.inside-container').click(function(event){
		
	    $statusHolder = $(this).children('.status-holder');
	    $subitens = $(this).siblings('.subitens');
	    
	    if($subitens.data('hide'))
    	{
	    	$statusHolder.val(1);
	    	$subitens.data('hide',false);
	    	$subitens.show();
	    }
	    else
    	{
	    	$statusHolder.val(0);
	    	$subitens.data('hide',true);
	    	$subitens.hide();
	    }

	    $(this).request('onGroupStatusUpdate'); 
	    
	    return false;
		
	});
	
	$('.action-link').click(function(event){
		event.stopPropagation();
	});
	
});