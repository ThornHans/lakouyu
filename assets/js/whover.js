

$('document').ready(function()
	{
  
	
    $("#wt").hover(function()
		{
		    $("#f img").css('display','inline-block');
		    $("#cwt").css('display','inline-block');
            $("#top-ad-container").css('display','block');
            $("#top-ad-text").slideDown(2000);
		  
		});
		  

    $('#cwt').click(function()
    {
	    $("#f img").css('display','none');
	    $(this).css('display','none');
        $("#top-ad-container").css('z-index',10);
        $("#top-ad-container").attr('class','col-md-12 top-left');
       
                    
        $("#top-ad-text").html('<marquee>口语考试已经列入中高考, 口语和听力总分高达<code>50分</code>！</marquee>');
                    
	
    });
    
                   
                    
    
});
	
				   				   
