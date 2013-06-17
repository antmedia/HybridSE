$(document).ready(function() {
	//Global change
	/*
	$('#global_border_color').change(
		function(){
			$("#form_preview").contents().find(".global").css("border-color",$("#global_border_color").val());
		}
	);
	$('#global_background_color').change(
		function(){
			$("#form_preview").contents().find(".global").css("background-color",$("#global_background_color").val());
		}
	);
	$('#global_float').change(
		function(){
			$("#form_preview").contents().find(".global").css("float",$("#global_float").val());
		}
	);
	$('#global_padding').change(
		function(){
			$("#form_preview").contents().find(".global").css("padding",$("#global_padding").val());
		}
	);
	$('#global_margin').change(
		function(){
			$("#form_preview").contents().find(".global").css("margin",$("#global_margin").val());
		}
	);
	$('#global_width').change(
		function(){
			$("#form_preview").contents().find(".global").css("width",$("#global_width").val());
		}
	);
	$('#global_height').change(
		function(){
			$("#form_preview").contents().find(".global").css("height",$("#global_height").val());
		}
	);
	*/
	//Inside change
	$('#inside_border_color').change(
		function(){
			$("#form_preview").contents().find("input:text").css("border-color",$("#inside_border_color").val());
			$("#form_preview").contents().find("textarea").css("border-color",$("#inside_border_color").val());
			$("#form_preview").contents().find("select").css("border-color",$("#inside_border_color").val());
		}
	);
	$('#inside_background_color').change(
		function(){
			$("#form_preview").contents().find("input:text").css("background-color",$("#inside_background_color").val());
			$("#form_preview").contents().find("textarea").css("background-color",$("#inside_background_color").val());
			$("#form_preview").contents().find("select").css("background-color",$("#inside_background_color").val());
		}
	);
	$('#inside_border_radius').change(
		function(){
			$("#form_preview").contents().find("input:text").css({
				'border-radius': $("#inside_border_radius").val(),
				'-moz-border-radius': $("#inside_border_radius").val(),
				'-webkit-border-radius': $("#inside_border_radius").val(),
				'-ms-border-radius': $("#inside_border_radius").val()
			});
			$("#form_preview").contents().find("textarea").css({
				'border-radius': $("#inside_border_radius").val(),
				'-moz-border-radius': $("#inside_border_radius").val(),
				'-webkit-border-radius': $("#inside_border_radius").val(),
				'-ms-border-radius': $("#inside_border_radius").val()
			});
			$("#form_preview").contents().find("select").css({
				'border-radius': $("#inside_border_radius").val(),
				'-moz-border-radius': $("#inside_border_radius").val(),
				'-webkit-border-radius': $("#inside_border_radius").val(),
				'-ms-border-radius': $("#inside_border_radius").val()
			});
		}
	);
	$('#inside_padding').change(
		function(){
			$("#form_preview").contents().find("input:text").css("padding",$("#inside_padding").val());
			$("#form_preview").contents().find("textarea").css("padding",$("#inside_padding").val());
			$("#form_preview").contents().find("select").css("padding",$("#inside_padding").val());
		}
	);
	$('#style_margin').change(
		function(){
			$("#form_preview").contents().find("input:text").css("margin",$("#style_margin").val());
			$("#form_preview").contents().find("textarea").css("margin",$("#style_margin").val());
			$("#form_preview").contents().find("select").css("margin",$("#style_margin").val());
		}
	);
	$('#inside_width').change(
		function(){
			$("#form_preview").contents().find("input:text").css("width",$("#inside_width").val());
			$("#form_preview").contents().find("textarea").css("width",$("#inside_width").val());
			$("#form_preview").contents().find("select").css("width",$("#inside_width").val());
		}
	);
	$('#inside_height').change(
		function(){
			$("#form_preview").contents().find("input:text").css("height",$("#inside_height").val());
			$("#form_preview").contents().find("select").css("height",$("#inside_height").val());
		}
	);
	$('#inside_font_family').change(
		function(){
			$("#form_preview").contents().find("input:text").css("font-family",$("#inside_font_family").val());
			$("#form_preview").contents().find("textarea").css("font-family",$("#inside_font_family").val());
			$("#form_preview").contents().find("select").css("font-family",$("#inside_font_family").val());
		}
	);
	$('#inside_font_size').change(
		function(){
			$("#form_preview").contents().find("input:text").css("font-size",$("#inside_font_size").val());
			$("#form_preview").contents().find("textarea").css("font-size",$("#inside_font_size").val());
			$("#form_preview").contents().find("select").css("font-size",$("#inside_font_size").val());
		}
	);
	$('#inside_font_color').change(
		function(){
			$("#form_preview").contents().find("input:text").css("color",$("#inside_font_color").val());
			$("#form_preview").contents().find("textarea").css("color",$("#inside_font_color").val());
			$("#form_preview").contents().find("select").css("color",$("#inside_font_color").val());
		}
	);
	//Ouside change
	$('#outside_border_color').change(
		function(){
			$("#form_preview").contents().find(".outside").css("border-color",$("#outside_border_color").val());
		}
	);
	$('#outside_background_color').change(
		function(){
			$("#form_preview").contents().find(".outside").css("background-color",$("#outside_background_color").val());
		}
	);
	$('#outside_border_radius').change(
		function(){
			$("#form_preview").contents().find(".outside").css({
				'border-radius': $("#outside_border_radius").val(),
				'-moz-border-radius': $("#outside_border_radius").val(),
				'-webkit-border-radius': $("#outside_border_radius").val(),
				'-ms-border-radius': $("#outside_border_radius").val()
			});
		}
	);
	$('#outside_padding').change(
		function(){
			$("#form_preview").contents().find(".outside").css("padding",$("#outside_padding").val());
		}
	);
	$('#outside_margin').change(
		function(){
			$("#form_preview").contents().find(".outside").css("margin",$("#outside_margin").val());
		}
	);
	$('#outside_width').change(
		function(){
			$("#form_preview").contents().find(".outside").css("width",$("#outside_width").val());
		}
	);
	$('#outside_height').change(
		function(){
			$("#form_preview").contents().find(".outside").css("height",$("#outside_height").val());
		}
	);
	//Label
	$('#label_padding').change(
		function(){
			$("#form_preview").contents().find("label").css("padding",$("#label_padding").val());
		}
	);
	$('#label_margin').change(
		function(){
			$("#form_preview").contents().find("label").css("margin",$("#label_margin").val());
		}
	);
	$('#label_font_family').change(
		function(){
			$("#form_preview").contents().find("label").css("font-family",$("#label_font_family").val());
		}
	);
	$('#label_font_size').change(
		function(){
			$("#form_preview").contents().find("label").css("font-size",$("#label_font_size").val());
		}
	);
	$('#label_font_color').change(
		function(){
			$("#form_preview").contents().find("label").css("color",$("#label_font_color").val());
		}
	);
	//Button
	$('#button_border_color').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("border-color",$("#button_border_color").val());
			$("#form_preview").contents().find("input:reset").css("border-color",$("#button_border_color").val());
			$("#form_preview").contents().find("input:button").css("border-color",$("#button_border_color").val());
			$("#form_preview").contents().find("button:button").css("border-color",$("#button_border_color").val());
		}
	);
	$('#button_background_color').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("background-color",$("#button_background_color").val());
			$("#form_preview").contents().find("input:reset").css("background-color",$("#button_background_color").val());
			$("#form_preview").contents().find("input:button").css("background-color",$("#button_background_color").val());
			$("#form_preview").contents().find("button:button").css("background-color",$("#button_background_color").val());
		}
	);
	$('#button_border_radius').change(
		function(){
			$("#form_preview").contents().find("input:submit").css({
				'border-radius': $("#button_border_radius").val(),
				'-moz-border-radius': $("#button_border_radius").val(),
				'-webkit-border-radius': $("#button_border_radius").val(),
				'-ms-border-radius': $("#button_border_radius").val()
			});
			$("#form_preview").contents().find("input:reset").css({
				'border-radius': $("#button_border_radius").val(),
				'-moz-border-radius': $("#button_border_radius").val(),
				'-webkit-border-radius': $("#button_border_radius").val(),
				'-ms-border-radius': $("#button_border_radius").val()
			});
			$("#form_preview").contents().find("input:button").css({
				'border-radius': $("#button_border_radius").val(),
				'-moz-border-radius': $("#button_border_radius").val(),
				'-webkit-border-radius': $("#button_border_radius").val(),
				'-ms-border-radius': $("#button_border_radius").val()
			});
			$("#form_preview").contents().find("button:button").css({
				'border-radius': $("#button_border_radius").val(),
				'-moz-border-radius': $("#button_border_radius").val(),
				'-webkit-border-radius': $("#button_border_radius").val(),
				'-ms-border-radius': $("#button_border_radius").val()
			});
		}
	);
	$('#button_padding').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("padding",$("#button_padding").val());
			$("#form_preview").contents().find("input:reset").css("padding",$("#button_padding").val());
			$("#form_preview").contents().find("input:button").css("padding",$("#button_padding").val());
			$("#form_preview").contents().find("button:button").css("padding",$("#button_padding").val());
		}
	);
	$('#button_margin').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("margin",$("#button_margin").val());
			$("#form_preview").contents().find("input:reset").css("margin",$("#button_margin").val());
			$("#form_preview").contents().find("input:button").css("margin",$("#button_margin").val());
			$("#form_preview").contents().find("button:button").css("margin",$("#button_margin").val());
		}
	);
	$('#button_width').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("width",$("#button_width").val());
			$("#form_preview").contents().find("input:reset").css("width",$("#button_width").val());
			$("#form_preview").contents().find("input:button").css("width",$("#button_width").val());
			$("#form_preview").contents().find("button:button").css("width",$("#button_width").val());
		}
	);
	$('#button_height').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("height",$("#button_height").val());
			$("#form_preview").contents().find("input:reset").css("height",$("#button_height").val());
			$("#form_preview").contents().find("input:button").css("height",$("#button_height").val());
			$("#form_preview").contents().find("button:button").css("height",$("#button_height").val());
		}
	);
	$('#button_font_family').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("font-family",$("#button_font_family").val());
			$("#form_preview").contents().find("input:reset").css("font-family",$("#button_font_family").val());
			$("#form_preview").contents().find("input:button").css("font-family",$("#button_font_family").val());
			$("#form_preview").contents().find("button:button").css("font-family",$("#button_font_family").val());
		}
	);
	$('#button_font_size').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("font-size",$("#button_font_size").val());
			$("#form_preview").contents().find("input:reset").css("font-size",$("#button_font_size").val());
			$("#form_preview").contents().find("input:button").css("font-size",$("#button_font_size").val());
			$("#form_preview").contents().find("button:button").css("font-size",$("#button_font_size").val());
		}
	);
	$('#button_font_color').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("color",$("#button_font_color").val());
			$("#form_preview").contents().find("input:reset").css("color",$("#button_font_color").val());
			$("#form_preview").contents().find("input:button").css("color",$("#button_font_color").val());
			$("#form_preview").contents().find("button:button").css("color",$("#button_font_color").val());
		}
	);
	$('#button_image_button').change(
		function(){
			$("#form_preview").contents().find("input:submit").css("background-image",$("#button_image_button").val());
			//$("#form_preview").contents().find("input:submit").attr({ src: $("#button_image_button").val() });
			$("#form_preview").contents().find("input:reset").css("src",$("#button_font_color").val());
			$("#form_preview").contents().find("input:button").css("src",$("#button_font_color").val());
			$("#form_preview").contents().find("button:button").css("src",$("#button_font_color").val());
			//$('img#image').attr({ src: $("#button_image_button").val() });
		}
	);
	
});