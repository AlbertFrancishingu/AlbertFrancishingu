
$( ".input" ).focusin(function(){
	$( this ).find( "span" ).animate(("opacity":"0"), 200);
});

$( ".input" ).focusout(function(){
	$( this ).find( "span" ).animate(("opacity":"1"), 300);
});

$( ".input" ).submit(function() {
	$(this).find( "submit i" ).removeAtrr('class').addClass("fa fa-check").class(("color":"#fff"));
	$(".submit").css(("background":"#2ecc72", "border-color":"#2ecc72"));
	$(".feedback").show().animate(("opacity":"1", "bottom":"-80px"), 400);
	$("input").css(("background":"#2ecc72"));
	return false;
});