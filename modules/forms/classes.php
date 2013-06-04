<?php
	function list_step_form($form){
		$data_forms=mysql_fetch_array(mysql_query("SELECT steps_forms FROM forms WHERE id_forms='$form'"));
		for ($step = 1; $step <= $data_forms['steps_forms']; $step++) {
			echo"<div class='grid_12'>
	<div class='box'>
				
		<div class='header'>
			<h2>Form - Step $step</h2>
		</div>
		
		<div class='content'>
			<div class='tabletools'>
				<div class='left'>
					<a class='open-add-client-dialog' href='?st=$_GET[st]&form=$form&step=$step&add'><i class='icon-plus'></i>".__('New Field')."</a>
				</div>
				<div class='right'>								
				</div>
			</div>";
			
			ListTable("form_fields","id,name,type,placeholder,created","FielEdit,FieldDelete,FieldOptions","fk_forms='$form' AND step_form_fields='$step'");
	echo"</div>
				</div>
			</div>";
		}
	}
?>