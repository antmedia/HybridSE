$(document).ready(function() {
	$('#style_border_color').change(
		function(){
			$("#form_preview").contents().find("input").css("border-color",$("#style_border_color").val());
			$("#form_preview").contents().find("textarea").css("border-color",$("#style_border_color").val());
		}
	);
	$('#style_background_color').change(
		function(){
			$("#form_preview").contents().find("input").css("background-color",$("#style_background_color").val());
			$("#form_preview").contents().find("textarea").css("background-color",$("#style_background_color").val());
		}
	);
	$('#border_radius').change(
		function(){
			//$("#form_preview").contents().find("input").css("border-radius",$("#border_radius").val());
			$("#form_preview").contents().find("input").css({
				'border-radius': $("#border_radius").val(),
				'-moz-border-radius': $("#border_radius").val(),
				'-webkit-border-radius': $("#border_radius").val(),
				'-ms-border-radius': $("#border_radius").val()
			});
			//$("#form_preview").contents().find("textarea").css("border-radius",$("#border_radius").val());
			$("#form_preview").contents().find("textarea").css({
				'border-radius': $("#border_radius").val(),
				'-moz-border-radius': $("#border_radius").val(),
				'-webkit-border-radius': $("#border_radius").val(),
				'-ms-border-radius': $("#border_radius").val()
			});
			$("#form_preview").contents().find("select").css({
				'border-radius': $("#border_radius").val(),
				'-moz-border-radius': $("#border_radius").val(),
				'-webkit-border-radius': $("#border_radius").val(),
				'-ms-border-radius': $("#border_radius").val()
			});
		}
	);
	$('#style_padding').change(
		function(){
			$("#form_preview").contents().find("input").css("padding",$("#style_padding").val());
			$("#form_preview").contents().find("textarea").css("padding",$("#style_padding").val());
		}
	);
	$('#style_margin').change(
		function(){
			$("#form_preview").contents().find("input").css("margin",$("#style_margin").val());
			$("#form_preview").contents().find("textarea").css("margin",$("#style_margin").val());
		}
	);
	$('#style_width').change(
		function(){
			$("#form_preview").contents().find("input").css("width",$("#style_width").val());
			$("#form_preview").contents().find("textarea").css("width",$("#style_width").val());
		}
	);
	$('#style_height').change(
		function(){
			$("#form_preview").contents().find("input").css("height",$("#style_height").val());
		}
	);
	$('#style_font_family').change(
		function(){
			$("#form_preview").contents().find("input").css("font-family",$("#style_font_family").val());
			$("#form_preview").contents().find("textarea").css("font-family",$("#style_font_family").val());
		}
	);
	$('#style_font_size').change(
		function(){
			$("#form_preview").contents().find("input").css("font-size",$("#style_font_size").val());
			$("#form_preview").contents().find("textarea").css("font-size",$("#style_font_size").val());
		}
	);
	$('#style_font_color').change(
		function(){
			$("#form_preview").contents().find("input").css("color",$("#style_font_color").val());
			$("#form_preview").contents().find("textarea").css("color",$("#style_font_color").val());
		}
	);
});