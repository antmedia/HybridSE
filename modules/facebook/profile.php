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
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Lista de Amigos</h2>
		</div>
		
		<div class="content">
			<!-- FACEBOOK -->
			<?php
				foreach($friends_list['data'] as $key=>$value) {
					if($key!=0)
					$data['friends'].=",";
					$data['friends'].=$value['id'];
					if(count($friends_res)==0) {
						//$friends['id']=$value['id'];
						//$friends['name']=$value['name'];
						echo "<a href='http://www.facebook.com/$value[id]' target='_blank'><img src='https://graph.facebook.com/$value[id]/picture?type=large&width=50&height=50' width='50' height='50' alt='$value[name]' title='$value[name]' border='0'></a>";
						//echo $value['name'];
					}
				}
			?>
			<!-- FACEBOOK -->
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_4 -->

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Detalhes de utilizador</h2>
		</div>
		
		<div class="content">
			<!-- FACEBOOK -->
				<div class='row'><label for='start'><strong>Avatar</strong></label><div><img src="https://graph.facebook.com/<?php echo $info_user['id']; ?>/picture?type=large&width=50&height=50" alt="<?php echo $info_user['name'] ?>" title="<?php echo $info_user['name'] ?>"></div></div>
				<div class='row'><label for='start'><strong>ID</strong></label><div><?php echo $info_user['id'] ?></div></div>
				<div class='row'><label for='start'><strong>Nome</strong></label><div><?php echo $info_user['name'] ?></div></div>
				<div class='row'><label for='start'><strong>Primeiro Nome</strong></label><div><?php echo $info_user['first_name'] ?></div></div>
				<div class='row'><label for='start'><strong>Último Nome</strong></label><div><?php echo $info_user['last_name'] ?></div></div>
				<div class='row'><label for='start'><strong>Link</strong></label><div><?php echo $info_user['link'] ?></div></div>
				<div class='row'><label for='start'><strong>Nome de Utilizador</strong></label><div><?php echo $info_user['username'] ?></div></div>
				<div class='row'><label for='start'><strong>Idioma</strong></label><div><?php echo $info_user['locale'] ?></div></div>
				<div class='row'><label for='start'><strong>Data de Nascimento</strong></label><div><?php echo $info_user['birthday'] ?></div></div>
				<div class='row'><label for='start'><strong>Sexo</strong></label><div><?php echo $info_user['gender'] ?></div></div>
				<div class='row'><label for='start'><strong>E-mail</strong></label><div><?php echo $info_user['email'] ?></div></div>
				<div class='row'><label for='start'><strong>Localização</strong></label><div><?php echo $info_user['location']['name'] ?></div></div>
				<div class='row'><label for='start'><strong>Amigos</strong></label><div><?php echo $total_friends ?></div></div>
			<!-- FACEBOOK -->
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_4 -->

<div class="grid_6">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Gostos</h2>
		</div>
		
		<div class="content">
			<!-- FACEBOOK -->
			<?php
				foreach($likes['data'] as $key=>$value) {
					if($key!=0)
					$data['likes'].=",";
					$data['likes'].=$value['id'];
					if(count($likes_res)==0) {
						//$likes['id']=$value['id'];
						//$likes['name']=$value['name'];
						//$likes['category']=$value['category'];
						echo "<a href='http://www.facebook.com/$value[id]' target='_blank'><img src='https://graph.facebook.com/$value[id]/picture?type=large&width=50&height=50' width='50' height='50' alt='$value[name]' title='$value[name]' border='0'></a>";
						//echo "$value[name]";
					}
				}
			?>
			<!-- FACEBOOK -->
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_4 -->
<?php } ?>