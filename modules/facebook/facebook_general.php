<?php
	include_once "extras/insights/fb.php";
	include("modules/facebook/classes.php");
?>

<?php if(count($user_info)==0) { ?>
<div style="display: none;" id="dialog_facebook_login" title="Facebook Login">
	<center><a href="<?php echo $loginUrl; ?>" title=""><img src="extras/insights/images/fb-connect-large.png" border="0" alt=""></a></center>
</div>
<script>
$$.ready(function() {
	$( "#dialog_facebook_login" ).dialog({
		autoOpen: true,
		modal: true,
		width: 400,
		open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
	});
});
</script>
<?php } ?>

<h1 class="grid_12">Facebook</h1>

<?php if(count($user_info)>0) { ?>
<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Filtrar</h2>
		</div>
		
		<form name="frm_page" id="frm_page" action="?st=<?php echo $_GET['st'] ?>" method="GET"  class="full validate">
		<div class="content">
			<!-- FACEBOOK -->
				<div class='row'><label for='$field'><strong>Escolher página</strong></label><div><div>
				<select name="sel_id" class="required">
				<option value="">Escolher página</option>
				<?php 
				foreach($user_info['accounts']['data'] as $key=>$value) { 
					?>
					<option value="<?php echo $value['id']; ?>" <?php echo ($value['id']==$page_id)?"selected":NULL; ?> ><?php echo $value['name']; ?></option>
					<?php 
				}
				?>
				</select>
				</div></div></div>
				<div class='row'><label for='start'><strong>Intervalo</strong></label><div><div> De: <input type='date' name='start' id='start' value="<?php echo (isset($_GET['start']))?$_GET['start']:NULL ?>" class="required" /> Até: <input type='date' name='end' id='end' value="<?php echo (isset($_GET['end']))?$_GET['end']:NULL ?>" class="required" /></div></div></div>
			<!-- FACEBOOK -->
		</div><!-- End of .content -->
		<div class="actions">
			<div class="left">
				<input type="reset" value="Cancelar" />
			</div>
			<div class="right">
				<input type="hidden" name="st" value="<?php echo $_GET['st'] ?>">
				<input type="submit" value="Mostrar" name=send />
			</div>
		</div><!-- End of .actions -->
		</form>
		
	</div><!-- End of .box -->
</div><!-- End of .grid_4 -->

<?php if(isset($_GET['sel_id'])) { ?>
<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Detalhes da Página</h2>
		</div>
		
		<div class="content">
			<div class='row'><label for='start'><strong>Nome</strong></label><div><?php echo $about['name'];?></div></div>
			<div class='row'><label for='start'><strong>Categoria</strong></label><div><?php echo $about['category'];?></div></div>
			<div class='row'><label for='start'><strong>Link</strong></label><div><a href="<?php echo $about['link'];?>" title="<?php echo $about['name'];?>" target="_blank"><?php echo $about['link'];?></a></div></div>
			<div class='row'><label for='start'><strong>Gostos</strong></label><div><?php echo $about['likes'];?></div></div>
			<div class='row'><label for='start'><strong>Sobre</strong></label><div><?php echo $about['about'];?></div></div>
		</div>
	</div><!-- End of .box -->
</div><!-- End of .grid_4 -->

<div class="grid_12">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/chart-up-color.png">Estatísticas</h2>
		</div>
		
		<div class="content" style="height: 250px;">
			<table class="chart">
				<thead>
					<tr>
						<th></th>
						<?php 
							foreach($story as $key=>$value){
								$arr=explode("-",$value['end_time']);
								$myday1=explode("T",$arr[2][0]);
								$myday2=explode("T",$arr[2][1]);
								$year=$arr[0];
								$mounth=$arr[1];
								$day=$myday1[0].$myday2[0];
								echo"<th>$day/$mounth</th>";
							}
						?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Histórias Diárias</th>
						<?php 
							foreach($story as $key=>$value){
								$arr=explode("-",$value['end_time']);
								echo "<td>".$value['value']."</td>";
							}
						?>
					</tr>
					<tr>
						<th>Alcance Diário</th>
						<?php 
							foreach($story as $key=>$value){
								$arr=explode("-",$value['end_time']);
								echo "<td>".$reach[$key]['value']."</td>";
							}
						?>
					</tr>
					<tr>
						<th>Pessoas que falam sobre isto</th>
						<?php 
							foreach($story as $key=>$value){
								$arr=explode("-",$value['end_time']);
								echo "<td>".$talk[$key]['value']."</td>";
							}
						?>
					</tr>
				</tbody>	
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->
<?php } ?>
<?php } ?>