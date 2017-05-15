$(document).ready(function(){

	$("#main").html($('#posts').html());
	
	$(".ajax-link").on('click',function(){
		
		var container = $("#main");
		var current = $(this);
		var currentContainer = $("#"+current.attr("data-id"));
		
		if(current.attr("data-id") == "photos" ){
			currentContainer.css("display","block");
			container.html("");
		}
		else{
			$("#photos").css("display","none");
			container.html(currentContainer.html());
		}
		
		
		
		$('.ajax-link').parent().removeClass('active');
		current.parent().addClass('active');
		
		
	});
	
	

});