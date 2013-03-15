/* FORM WIZARD VALIDATION SIGN UP ======================================== */	
$(function() {

				$('#custom').stepy({
					backLabel:	'Passo Anterior',
					block:		true,
					errorImage:	true,
					nextLabel:	'Passo Seguinte',
					titleClick:	true,
					description:	true,
					legend:			false,
					validate:	true
				});

				$('#custom').validate({
					errorPlacement: function(error, element) {
					$('#custom .stepy-error').append(error);
					}, rules: {
						'marca':		'required',
						'desconto':		'required',
						'impressoras':	'required' 	// BE CAREFUL: last has no comma
					}, messages: {
						'marca':		{ required: 	 'Tem de escolher pelo mennos uma marca' },
						'desconto':		{ required: 	 'Por favor escolha um desconto' },
						'impressoras':	{ required: 	 'Tem de escolher uma impressora' },
					}
				});

			
			});
			