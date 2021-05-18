$(document).ready(function()
{
	$('.pass_show').append('<button class="ptxt" type="button" id="passShow">Show</button>');
});
$(document).on('click','.pass_show .ptxt', function()
{ 
	$(this).text($(this).text() == "Show" ? "Hide" : "Show");
    $(this).toggleClass("ptxt-hide");
	$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });
});