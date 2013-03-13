<script type="text/javascript">

jQuery(function($) {

    var multiTags = $("#multi");

    function handler(e) {
        var jqEl = $(e.currentTarget);
        var tag = jqEl.parent();
        switch (jqEl.attr("data-action")) {
        case "add":
            tag.after(tag.clone().find("input").val("").end());
            break;
        case "delete":
            tag.remove();
            break;
        }
        return false;
    }

    function save(e) {
        var tags = multiTags.find("input.tag").map(function() {
            return $(this).val();
        }).get().join(',');
        alert(tags);
        return false;
    }

    multiTags.submit(save).find("a").live("click", handler);
});

</script>

<h1 class="grid_12 margin-top no-margin-top-phone"><?php echo __("Create module") ?></h1>

<div class="grid_6">
	<form class="box validate" id="multi">
	
		<div class="header">
			<h2><?php echo __("Add new page") ?></h2>
		</div>

		<div class="content" id="sheepItForm_template">
		
			<div class="row">
				<label for="v2_normal_input">
					<strong>Título</strong>
				</label>
				<div>
					<p class="_60">
						<input data-error-type=inline class="required field" type="text" name="tag" id="v2_normal_input" value="1" />						
					</p>
					<p class="_60">
						<input data-error-type=inline class="required field" type="text" name="tag" id="v2_normal_input" value="1" />
					</p>
					<a href="#" class="button grey" data-action="add">add</a>
					<a href="#" class="button grey" data-action="delete">delete</a>				
				</div>
			</div>
			
			<div class="row">
							<p class="_60">
								<input type="text" value="80">
							</p>
							<p class="_50">
								<input type="text" value="50%">
							</p>
						</div>
		
		</div><!-- End of .content -->
		
		<div class="actions">
			<div class="left">
				
			</div>
			<div class="right">
				<input type="reset" value="<?php echo __("Cancel")?>" />
				<input type="submit" value="<?php echo __("Save")?>" name="submit" />
			</div>
		</div><!-- End of .actions -->
		
	</form><!-- End of .box -->
</div><!-- End of .grid_4 -->

