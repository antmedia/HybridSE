<h1 class="grid_12"><?php echo __("Beta testing area") ?></h1>

<div class="grid_12">
	<form action="?st=<?php echo $_GET['st'] ?>" class="box validate" method="POST">
		<div class="header">
			<h2>Form Validation with Popups</h2>
		</div>
		
		<div class="content">
			<div class="row">
				<label for="v1_normal_input">
					<strong>Input Field Validation</strong>
				</label>
				<div>
					<input class="required" type="time" name="v1_normal_input" id="v1_normal_input" />
				</div>
			</div>

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