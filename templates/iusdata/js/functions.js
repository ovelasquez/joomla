/* 
* Franklin Salcedo
* 03/07/2012
*/

document.createElement("article");
document.createElement("footer");
document.createElement("header");
document.createElement("hgroup");
document.createElement("nav");
document.createElement("section");
document.createElement("aside");
document.createElement("address");
document.createElement("figure");

$(document).ready(function(e) {
    $("nav li:first, nav li:last").css("border","none");
	$(".last_box:last").css("margin","0");
	if($("#slider").length > 0){
		$("#slider").coinslider({
			width: 644,
			height: 164,
			delay: 10000,
			effect: 'rain',
			opacity: 0.9,
			links: true
		});
	}
	
	if($(".ls_cont").length > 0){
		$(".ls_cont:odd").css("background-color","#FFFFFF");
	}
});