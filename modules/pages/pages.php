<h1 class="grid_12 margin-top no-margin-top-phone"><?php echo __("Pages") ?></h1>

<div class="grid_12">
	<form action="" class="box validate">
	
		<div class="header">
			<h2><?php echo __("Add new page") ?></h2>
		</div>
		
		<div class="content">
		
			<div class="row">
				<label for="v2_normal_input">
					<strong>Título</strong>
				</label>
				<div>
					<input data-error-type=inline class="required" type="text" name="v2_normal_input" id="v2_normal_input" />
				</div>
			</div>
			
			<div class="row">
				<label for="v2_normal_input">
					<strong>Slug</strong>
				</label>
				<div>
					<input data-error-type=inline class="required" type="text" name="v2_normal_input" id="v2_normal_input" />
				</div>
			</div>
			
			<div class="row">
				<label for="v2_select">
					<strong>Página principal</strong>
				</label>
				<div>
					<select name="v2_select" id="v2_select" class="search" data-placeholder="Choose a Name">
						<option value="">Sem página principal</option>
						<option value="Home">Home</option> 
					</select>
				</div>
			</div>
			
			<div class="row">
				<label for="v2_normal_input">
					<strong>Intro</strong>
				</label>
				<div>
					<input data-error-type=inline class="required" type="textarea" name="v2_normal_input" id="v2_normal_input" />
				</div>
			</div>
			
			<div class="row">
				<label for="f1_wysiwyg">
					<strong>Texto completo</strong>
				</label>
				<div>
					<textarea class="tinymce required" name="f1_wysiwyg" id="f1_wysiwyg" ></textarea>
				</div>
			</div>

			<div class="row">
				<label>
					<strong>Estado</strong>
				</label>
				<div>
					<div><input type="checkbox" class="required" name="v2_checkbox" id="v2_checkbox" value="1" /> <label for="v2_checkbox">Activado?</label></div>
				</div>
			</div>
			
		</div><!-- End of .content -->
		
		<div class="actions">
			<div class="left">
				<input type="reset" value="<?php echo __("Cancel")?>" />
			</div>
			<div class="right">
				<input type="submit" value="<?php echo __("Save")?>" name="submit" />
			</div>
		</div><!-- End of .actions -->
		
	</form><!-- End of .box -->
</div><!-- End of .grid_4 -->