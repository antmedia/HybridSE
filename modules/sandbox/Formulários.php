<?php
	if(isset($_GET['send'])){
		print_r($_POST);
		//echo $_POST['select_tags'];
		//foreach ($_POST['select_tags'] as $tags){
		//	echo $tags;
		//}
	}
?>
<h1 class="grid_12"><?php echo __("Beta testing area") ?></h1>

<div class="grid_12">
	<form action="?st=<?php echo $_GET['st'] ?>&send" class="box validate" method="POST">
		<div class="header">
			<h2>Form Validation with Popups</h2>
		</div>
		
		<div class="content">
			<?php
				/*fields_type("name_client","O MEU TESTE");
				fields_type("client_password");
				fields_type("client_password2");
				fields_type("test_nogrow","LALALAL");
				fields_type("test_grow","LALALAL");
				fields_type("wysiwyg","LALALAL");
				fields_type("select_search","32");
				fields_type("select_search2","2");
				fields_type("select_nosearch","11");
				fields_type("select_nosearch2","3");*/
				fields_type("select_tags","11,32");
				fields_type("select_tags2","1,2,3");
				fields_type("select_dual","11,32");
				fields_type("select_dual2","1,2");
				/*fields_type("picker_date","2013-03-21");
				fields_type("picker_time","16:40");
				fields_type("picker_date_time","2013-03-21 16:39");
				fields_type("picker_color");
				fields_type("checkbox","11,32");
				fields_type("checkbox2","1,2");
				fields_type("checkbox3");
				fields_type("radio","11");
				fields_type("radio2","2");
				fields_type("slider","10");
				fields_type("slider_range","40,90");*/
				//fields_type("autocomplete"); //Corrigir
				//fields_type("spinner","10");
				//fields_type("file");
				//fields_type("image","TESTE");
				//fields_type("document","TESTERERER");
				
			?>
		</div><!-- End of .content -->
		
		<div class="actions">
			<div class="left">
				<input type="reset" value="Cancel" />
			</div>
			<div class="right">
				<input type="submit" value="Submit" name="submit" />
			</div>
		</div><!-- End of .actions -->
		
	</form><!-- End of .box -->
</div><!-- End of .grid_4 -->