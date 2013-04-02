<?php
	include_once "extras/insights/fb.php";
	include("modules/facebook/classes.php");
	
	//var_export($posts);
	if(isset($_GET['postFB'])){
		$userPageId 	= $_POST["userpages"];
		$userMessage 	= $_POST["message"];
		$post_url = '/'.$userPageId.'/feed';
		//$msg_body = array('message' => $userMessage,);
		$msg_body = array(
			'message'		=>	$userMessage,
			//'name'				=>	'SAPO',
			//'link'			=>	'http://www.sapo.pt',
			//'description'	=>	'SAPO',
			//'picture'		=>	'http://i3.ytimg.com/vi/ZgbHt4ei-BU/mqdefault.jpg',
		);
		$postResult = $facebook->api($post_url, 'post', $msg_body );
		if($postResult)  echo"<div class='alert success'><span class='icon'></span><span class='close'>x</span><strong>Mensagem enviada para o Facebook! <a href='http://www.facebook.com/$_POST[userpages]' target='_blank'>Ver página</a></strong></div>";
		else echo "<div class='alert error'><span class='icon'></span><span class='close'>x</span><strong>Erro ao tentar enviar a sua mensagem para o Facebook. Por favor tente mais tarde.</strong></div>";
	}
?>

<script type="text/javascript" src="extras/embedify/Scripts/swfobject.js"></script> 
<script src="extras/embedify/Scripts/EmbeddedReprUrl.Config-1.0.0.js" type="text/javascript"></script> 
<script src="extras/embedify/Scripts/jquery.transform.js" type="text/javascript"></script> 
<script src="extras/embedify/Scripts/EmbeddedReprUrl-1.0.0.js" type="text/javascript"></script> 
<script src="extras/embedify/Scripts/EmbeddedRepresentationXsl-1.0.js" type="text/javascript"></script> 
<script src="extras/embedify/Scripts/jwplayer/jwplayer.js" type="text/javascript"></script> 
<link href="extras/embedify/Content/EmbeddedReprUrl.css" rel="stylesheet" type="text/css" /> 

<div style="display: none; " id="dialog_post_facebook" title="Post to Page Wall">
	<form id="facebook_post" name="facebook_post" method="post" action="?st=<?php echo $_GET['st'] ?>&postFB" class="full validate">
		<div class="row">
			<label for="upages">Página:</label>
			<div><select name="userpages" id="upages" class="required">
			<option value="">Escolher página</option>
			<?php 
			foreach($user_info['accounts']['data'] as $key=>$value) { 
				?>
				<option value="<?php echo $value['id']; ?>" <?php echo ($value['id']==$page_id)?"selected":NULL; ?> ><?php echo $value['name']; ?></option>
				<?php 
			}
			?>
			</select></div>
		</div>
		<div class="row"><label for="message">Mensagem:</label><div><textarea rows="5" name="message" id="message" class="required embeddor"></textarea></div></div>
	</form>
	<div class="actions">
		<div class="left"><input form="facebook_post" type="reset" value="Cancelar" class="grey" /></div>
		<div class="right"><input form="facebook_post" type="submit" value="Enviar" /></div>
	</div>
</div>

<script>
$$.ready(function() {
	$( "#dialog_post_facebook" ).dialog({
		autoOpen: false,
		modal: true,
		width: 500,
		open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
	});
	
	$( ".open-post_facebook" ).click(function() {
		$( "#dialog_post_facebook" ).dialog( "open" );
		return false;
	});
});
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
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Posts</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a class="open-post_facebook" href="javascript:void(0);"><i class="icon-plus"></i>Novo Post</a>
				</div>
				<div class="right">								
				</div>
			</div>
			<table class="dynamic styled" data-table-tools='{"display":true}'> <!-- OPTIONAL: with-prev-next -->
				<thead>
					<tr>
						<th>Conteúdo</th>
						<th>Viralidade</th>
						<th>Comentários</th>
						<th>Gostos</th>
						<th>Partilhas</th>
						<th>Alcance </th>
					</tr>
				</thead>
				<tbody>
					<?php if(count($posts)>0) { 
					$aux_me=0;
					foreach($posts as $key=>$value) { 
					if($aux_me++==10) break;
					if($value['message']!="") {
						$likes=$value['likes'];
						$comments=$value['comments'];
						$shares=$value['shares'];
						$xml=@file_get_contents('https://graph.facebook.com/'.$value['id'].'/insights/post_impressions_unique/lifetime?access_token='.$a_token);
						$insights_post=json_decode($xml, TRUE);
						$reach=$insights_post['data']['0']['values']['0']['value'];
						$xml=@file_get_contents('https://graph.facebook.com/'.$value['id'].'/insights/post_impressions_viral/lifetime?access_token='.$a_token);
						$insights_post=json_decode($xml, TRUE);
						$viral=$insights_post['data']['0']['values']['0']['value'];
						?>
						<tr class="gradeX">
							<td><?php echo substr($value['message'],0,60); ?></td>
							<td><?php echo $viral; ?></td>
							<td><?php echo $comments['count'];?></td>
							<td><?php echo $likes['count'];?></td>
							<td><?php echo $shares['count'];?></td>
							<td><?php echo $reach; ?></td>
						</tr>
					<?php 
							} 
						}
					}
					?>
				</tbody>
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->
<?php } ?>
<?php } ?>