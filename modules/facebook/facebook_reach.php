<?php
	include_once "extras/insights/fb.php";
	include("modules/facebook/classes.php");
?>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1', {packages: ['geomap']});

    function drawVisualization() {
      var data = google.visualization.arrayToDataTable([
        ['Country', 'Popularity'],
		<?php foreach($reach_by_country as $key=>$value) { ?>
		['<?php echo $key; ?>', <?php echo $value; ?>],
		<?php } ?>
      ]);
    
      var geomap = new google.visualization.GeoMap(
          document.getElementById('reach_by_country'));
      geomap.draw(data, 
		{ title:"Page Fans By Country ",width:"100%", height:400}	  
	  );
    }
    google.setOnLoadCallback(drawVisualization);
</script>
<script type="text/javascript">
  google.load('visualization', '1', {packages: ['corechart']});
</script>

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
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/chart-up-color.png">Alcance</h2>
		</div>
		
		<div class="content" style="height: 250px;">
			<table class="chart">
				<thead>
					<tr>
						<th></th>
						<?php 
							foreach($daily_reach as $key=>$value) {
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
						<th>Alcance Diário</th>
						<?php 
							foreach($daily_reach as $key=>$value) {
								$arr=explode("-",$value['end_time']);
								echo "<td>".$value['value']."</td>";
							}
						?>
					</tr>
				</tbody>	
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/chart-up-color.png">Alcance por Países</h2>
		</div>
		
		<div class="content">
			<div id="reach_by_country"></div>
		</div>
	</div>
</div>

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2>Alcance por Gênero</h2>
		</div>
		
		<div class="content" style="height: 250px;">
			<table class="chart" data-type="bars">
				<thead>
					<tr>
						<th></th>
						<th>13-17</th>
						<th>18-24</th>
						<th>25-34</th>
						<th>35-44</th>
						<th>45-54</th>
						<th>55-64</th>
						<th>65+</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Masculino</th>
						<td><?php echo $reach_male['13-17']; ?></td>
						<td><?php echo $reach_male['18-24']; ?></td>
						<td><?php echo $reach_male['25-34']; ?></td>
						<td><?php echo $reach_male['35-44']; ?></td>
						<td><?php echo $reach_male['45-54']; ?></td>
						<td><?php echo $reach_male['55-64']; ?></td>
						<td><?php echo $reach_male['65+']; ?></td>
					</tr>
					<tr>
						<th>Feminino</th>
						<td><?php echo $reach_female['13-17']; ?></td>
						<td><?php echo $reach_female['18-24']; ?></td>
						<td><?php echo $reach_female['25-34']; ?></td>
						<td><?php echo $reach_female['35-44']; ?></td>
						<td><?php echo $reach_female['45-54']; ?></td>
						<td><?php echo $reach_female['55-64']; ?></td>
						<td><?php echo $reach_female['65+']; ?></td>
					</tr>
				</tbody>	
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_6 -->

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2>Alcance por Cidade</h2>
		</div>
		
		<div class="content" style="height: 250px;">
			<table class="chart" data-type="bars">
				<thead>
					<tr>
						<?php
							$count=0;
							foreach($reach_by_city as $key=>$value) { 
								if($count++==10) break;
								echo "<th>$key</th>";
							}
						?>
					</tr>
				</thead>
				<tbody>				
					<tr>
						<th>Cidades</th>
						<?php
							$count=0;
							foreach($reach_by_city as $key=>$value) { 
								if($count++==10) break;
								echo "<td>$value</td>";
							}
						?>
					</tr>
				</tbody>	
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_6 -->
<?php } ?>
<?php } ?>