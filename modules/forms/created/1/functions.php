<?php
	function design_form($form_id){
		$sql=mysql_query("SELECT * FROM form_fields WHERE fk_forms='$form_id'");
		while($data=mysql_fetch_array($sql)){
			//echo "$data[name_form_fields]<br/>";
			field_type(utf8_encode($data['name_form_fields']),$data['name_form_fields'],$data['id_form_fields'],$data['type_form_fields']);
		}
	}
	
	function field_type($title,$field,$idField,$type){
		switch($type){
			case "text": echo"<label for='$field'>$title <input type='text' name='$field' id='$field'></label><br/>"; break;
			case "textarea": echo"<label for='$field'>$title <textarea name='$field' id='$field'></textarea></label><br/>"; break;
			case "select": echo"<label for='$field'>$title <select name='$field' id='$field'>";
							$sql_options=mysql_query("SELECT * FROM form_options WHERE fk_form_fields='$idField' AND status_form_options='1' AND delete_form_options='0'");
							while($data_options=mysql_fetch_array($sql_options)){
								echo "<option value='$data_options[value_form_options]'>".utf8_encode($data_options['name_form_options'])."</option>";
							}
							echo "</select></label><br/>";
							break;
			case "datepicker": echo"<label for='$field'>$title <input type='text' name='$field' id='$field'> <button id='calendar_$field' type='button'>...</button></label><br/>";
							?>
							<script type="text/javascript">
							Calendar.setup({
								inputField : "<?php echo $field?>",
								trigger    : "calendar_<?php echo $field?>",
								//showTime   : 12,
								onSelect   : function() { this.hide() }
							});
							</script>
							<?php
							break;
			default: echo"<label for='$field'>$title <input type='text' name='$field' id='$field'></label><br/>"; break;
		}
	}
?>