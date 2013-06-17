<?php
	function design_form($form_id){
		$sql=mysql_query("SELECT * FROM form_fields WHERE fk_forms='$form_id' AND status_form_fields='1' AND delete_form_fields='0' ORDER BY sort_form_fields ASC");
		while($data=mysql_fetch_array($sql)){
			//echo "$data[name_form_fields]<br/>";
			field_type(utf8_encode($data['title_form_fields']),$data['name_form_fields'],$data['id_form_fields'],$data['type_form_fields']);
		}
	}
	
	function field_type($title,$field,$idField,$type){
		switch($type){
			case "text": echo "<div class='dropzones'><div class='global_$field dragzones'><label for='$field'>$title</label><br/> <div class='outside'><input type='text' name='$field' id='$field'></div></div></div><br/>"; break;
			case "textarea": echo "<div class='dropzones'><div class='global_$field dragzones'><label for='$field'>$title</label><br/> <div class='outside'><textarea name='$field' id='$field'></textarea></div></div></div><br/>"; break;
			case "select": echo "<div class='dropzones'><div class='global_$field dragzones'><label for='$field'>$title</label><br/> <div class='outside'><select name='$field' id='$field'><br/>";
							$sql_options=mysql_query("SELECT * FROM form_options WHERE fk_form_fields='$idField' AND status_form_options='1' AND delete_form_options='0'");
							while($data_options=mysql_fetch_array($sql_options)){
								echo "<option value='$data_options[value_form_options]'>".utf8_encode($data_options['name_form_options'])."</option>";
							}
							echo "</select></div></div><br/>";
							break;
			case "datepicker": echo "<div class='dropzones'><div class='global_$field dragzones'><label for='$field'>$title</label><br/> <div class='outside'><input type='text' name='$field' id='$field'></div> <button id='calendar_$field' type='button'>...</button></div></div><br/>";
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
			case "secCode": echo "<div class='dropzones'><div class='global_$field dragzones'><label for='$field'>$title</label><br/> <div class='outside'><input type='text' name='secCode'></div> <b>&laquo;</b> <img src='lib/seccode.php' width='71' height='21' align='absmiddle'></div></div><br/>";
							break;
			case "submit": echo "<div class='dropzones'><div class='global_$field dragzones'><input type='submit' name='$field' id='$field' value='Enviar'></div></div><br/>";
							break;
			case "reset": echo "<div class='dropzones'><div class='global_$field dragzones'><input type='reset' name='$field' id='$field' value='Apagar'></div></div>";
							break;
			case "button": echo "<div class='dropzones'><div class='global_$field dragzones'><input type='button' name='$field' id='$field'></div></div>";
							break;
			default: echo "<div class='dropzones'><div class='global_$field dragzones'><label for='$field'>$title</label><br/> <div class='outside'><input type='text' name='$field' id='$field'></div></div></div><br/>"; break;
		}
	}
?>