<?php
require 'extras/gapi.class.php';
$ga = new gapi('oxymedia@gmail.com','31101985');
$ga->requestAccountData();

function analytics_calendar($idGa,$startDate,$endDate){
	$ga = new gapi('oxymedia@gmail.com','31101985');
	
	$data_de_inicio=explode('-',$startDate);
	$data_de_fim=explode('-',$endDate);
	$diaInicio=$data_de_inicio[2];
	$diaFim=$data_de_fim[2];
	$mesInicio=$data_de_inicio[1];
	$mesFim=$data_de_fim[1];
	$anoInicio=$data_de_inicio[0];
	$anoFim=$data_de_fim[0];
	
	//$conta=strlen($dia);
	//$contaDia=($conta==1)?"0$dia":$dia;
	
	//$diaInicial_aux=($startDate==NULL)?1:$dia;
	$diaInicial=($startDate==NULL)?1:$diaInicio;
	$diaFinal=($endDate==NULL)?date('d'):$diaFim;
	
	//$ga->requestReportData('48669862',array('browser','browserVersion'),array('pageviews','visits'),null,null,'2013-01-01','2013-01-01');
	
	echo"<thead><tr>";
	echo "<th></th>";
	for($dia=$diaInicial; $dia<=$diaFinal ; $dia++){
		$conta=strlen($dia);
		$contaDia=($conta==1)?"0$dia":$dia;
	
		$inicioData="$anoInicio-$mesInicio-$contaDia";
		//$inicioData=($startDate==NULL)?$inicioData_aux:$startDate;
		
		echo "<th>$inicioData</th>";
	}
	echo"</tr></thead><tbody><tr>";
	echo"<th>Visualização de Páginas</th>";
	for($dia=$diaInicial; $dia<=$diaFinal ; $dia++){
		$conta=strlen($dia);
		$contaDia=($conta==1)?"0$dia":$dia;
	
		$inicioData="$anoInicio-$mesInicio-$contaDia";
		//$inicioData=($startDate==NULL)?$inicioData_aux:$startDate;
		
		$ga->requestReportData($idGa,array('browser','browserVersion'),array('pageviews','visits'),NULL,NULL,$inicioData,$inicioData);
		echo "<td>".$ga->getPageviews()."</td>";
	}
	echo"</tr><tr>";
	echo"<th>Páginas Visitadas</th>";
	for($dia=$diaInicial; $dia<=$diaFinal ; $dia++){
		$conta=strlen($dia);
		$contaDia=($conta==1)?"0$dia":$dia;
	
		$inicioData="$anoInicio-$mesInicio-$contaDia";
		//$inicioData=($startDate==NULL)?$inicioData_aux:$startDate;
		
		$ga->requestReportData($idGa,array('browser','browserVersion'),array('pageviews','visits'),NULL,NULL,$inicioData,$inicioData);
		echo "<td>".$ga->getVisits()."</td>";
	}
	echo"</tr></tbody>";
}

?>

<?php
	$dataActual=date('Y-m-d');
	$dataInicial=date('Y-m')."-01";
?>

<h1 class="grid_12">Google Analytics</h1>

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Filtrar</h2>
		</div>
		
		<form name="frm_page" id="frm_page" action="?st=<?php echo $_GET['st'] ?>" method="GET"  class="full validate">
		<div class="content">
			<!-- Analytics -->
				<div class='row'><label for='$field'><strong>Escolher página</strong></label><div><div>
				<select name="sel_id" class="required">
				<option value="">Escolher página</option>
				<?php 
				foreach($ga->getResults() as $result){
					?>
					<option value="<?php echo $result->getProfileId(); ?>"><?php echo $result ?></option>
					<?php 
				}
				?>
				</select>
				</div></div></div>
			<!-- Analytics -->
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

<div class="grid_12">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/chart-up-color.png">Estatísticas mês actual</h2>
		</div>
		
		<div class="content" style="height: 250px;">
			<table class="chart">
				<?//php analytics_calendar(48669862,NULL,NULL); ?>	
				<?php analytics_calendar(48669862,"2013-04-01",$dataActual); ?>	
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->

<div class="grid_12">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/chart-up-color.png">Estatísticas mês anterior</h2>
		</div>
		
		<div class="content" style="height: 250px;">
			<table class="chart">
				<?php analytics_calendar(48669862,"2013-03-01","2013-03-31"); ?>	
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->