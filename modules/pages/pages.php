<h1 class="grid_12 margin-top no-margin-top-phone"><?php echo __("Pages") ?></h1>

<div class="grid_12">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Listagem de Páginas</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-add-client-dialog" href="?st=<?php echo $_GET['st'] ?>&add"><i class="icon-plus"></i>Nova Página</a>
				</div>
				<div class="right">								
				</div>
			</div>
			
			<?php ListTable("pages","id,title,fk_pages,status,delete,created","edit,delete,see,reply,send,map,qrcode") ?>
		
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->