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
			
			ListTable("form_fields","id,title,name,type,created","FielEdit,FieldDelete,FieldOptions","fk_forms='$form' AND step_form_fields='$step'");
	echo"</div>
				</div>
			</div>";
		}
	}
	
	function fields_styles($title,$types,$field){
		$exp_Type=explode(',',$types);
		//$newArrayTypes=array();
		echo"<div class='header'>
				<h2>".__("$title")."</h2>
				<ul>";
					foreach ($exp_Type as $type){
						echo "<li><a href='#t1-$type'>".ucwords($type)."</a></li>";
					}
		echo 	"</ul>
			</div>";
		
		echo"<div class='content tabbed'>";
				foreach ($exp_Type as $type){
					echo "<div id='t1-$type' style='line-height:200%'>";
					$sql=mysql_query("SELECT * FROM form_fields_styles WHERE type_form_fields_styles='$type'");
					while($data=mysql_fetch_array($sql)){
						fields_type($data['title_form_fields_styles'],$data['form_fields_styles'],NULL,FALSE);
						$what=explode("_",$data['form_fields_styles']);
						?>
							<script>
								$(document).ready(function() {
									$('#<?php echo $data['form_fields_styles'] ?>').change(
										function(){
											$("#form_preview").contents().find(".global_<?php echo $field?>").css("<?php echo $what[1] ?>",$("#<?php echo $data['form_fields_styles'] ?>").val());
										}
									);
								});
							</script>
						<?php
					}
					echo "<p></p></div>";
				}
		echo "</div>";
		
	}
?>