<?php
	define("USER_ID_FACEBOOK","1275890894");

	if(isset($_GET['comment'])){
		if(mysql_query("INSERT INTO pipeline (post_pipeline,fk_pipeline,fk_user,age_user,local_user,sex_user) VALUES ('$_POST[post_pipeline]','$_GET[post]','$_POST[fk_user]','$_POST[age_user]','$_POST[local_user]','$_POST[sex_user]')"))echo "<div class='alert success no-margin-top'><span class='icon'></span><strong>Enviado!</strong> O seu post foi enviado correctamente</div>";
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao gravar. Verificar query!</div>";
	}
	
	if(isset($_GET['new_post'])){
		if(mysql_query("INSERT INTO pipeline (post_pipeline,fk_user,age_user,local_user,sex_user) VALUES ('$_POST[post_pipeline]','$_POST[fk_user]','$_POST[age_user]','$_POST[local_user]','$_POST[sex_user]')")) echo "<div class='alert success no-margin-top'><span class='icon'></span><strong>Enviado!</strong> O seu post foi enviado correctamente</div>";
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao gravar. Verificar query!</div>";
	}
	
	if(isset($_GET["del_post"])){
		if(mysql_query("DELETE FROM pipeline WHERE id_pipeline=$_GET[del_post]") && mysql_query("DELETE FROM pipeline WHERE fk_pipeline=$_GET[del_post]")) echo "<div class='alert success no-margin-top'><span class='icon'></span><strong>Apagado!</strong> Os seus posts foram apagados correctamente</div>";
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao gravar. Verificar query!</div>";
	}
	
	if(isset($_GET['new_moderator'])){
		//print_r($_POST);
		$age=explode(":",$_POST['filter_age']);
		$age_start=$age[0];
		$age_end=$age[1];
		if(mysql_query("INSERT INTO admins (fk_admins_types,username_admins,password_admins,name_admins,email_admins,filter_local,filter_age_start,filter_age_end,filter_sex) VALUES ('$_POST[fk_admins_types]','$_POST[username_admins]','$_POST[password_admins]','$_POST[name_admins]','$_POST[email_admins]','$_POST[filter_local]','$age_start','$age_end','$_POST[filter_sex]')"))echo "<div class='alert success no-margin-top'><span class='icon'></span><strong>Adicionado!</strong> O moderador foi adicionado correctamente</div>";
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao adicionar moderador. Verificar query!</div>";
	}
	
	if(isset($_GET['status'])){
		mysql_query("UPDATE admins SET status=$_GET[status] WHERE id_admins=$_GET[m]");
	}
	
	if(isset($_GET['distribuir'])){
		$sql_moderators=mysql_query("SELECT * FROM admins WHERE status=1");
		while($data_moderators=mysql_fetch_array($sql_moderators)){
			echo "<br>Moderator: ".$data_moderators['name_admins']."» ";
			$sql_posts=mysql_query("SELECT * FROM pipeline WHERE fk_pipeline=0 AND fk_user<>".USER_ID_FACEBOOK." AND age_user<$data_moderators[filter_age_end] AND age_user>$data_moderators[filter_age_start]");
			while($data_posts=mysql_fetch_array($sql_posts)){
				echo $data_posts['id_pipeline']."|";
			}echo "<br>";
		}
	}

	function list_posts(){
		$sql=mysql_query("SELECT * FROM pipeline WHERE fk_pipeline=0");
		while($data=mysql_fetch_array($sql)){
			$xml=@file_get_contents("https://graph.facebook.com/$data[fk_user]");
			$info_user_post=json_decode($xml, TRUE);
			?>
			<div class="grid_6">
				<form class="box validate" action="?st=<?php echo $_GET['st'] ?>&post=<?php echo $data['id_pipeline'] ?>&comment" method="post">
							
					<div class="header">
						<h2><img class="icon" src="img/icons/packs/fugue/16x16/newspaper.png">Pipeline | ID: <?php echo $data['id_pipeline'] ?></h2>
					</div>
					
					<div class="content">
						<div class="spacer"></div>
						<div class="messages full chat">

							<div class="msg reply">
								<img src="https://graph.facebook.com/<?php echo $data['fk_user'] ?>/picture?type=large&width=25&height=25" title="<?php echo $data['age_user'] ?> | <?php echo $data['local_user'] ?> | <?php echo $info_user_post['gender'] ?>"/>
								<a href='?st=<?php echo $_GET['st']?>&del_post=<?php echo $data['id_pipeline'] ?>' class='button small grey tooltip' data-gravity='s' title='Apagar' onclick="javascript:return confirm('Tem a certeza?')"><i class='icon-remove'></i></a>
								<div class="content">
									<h3><?php echo $info_user_post['name'] ?> <span>disse:</span><small><?php echo $data['now_pipeline'] ?></small></h3>
									<p><?php echo $data['post_pipeline'] ?></p>
								</div>
							</div>
							
							<?php
								$sql_msg=mysql_query("SELECT * FROM pipeline WHERE fk_pipeline=$data[id_pipeline]");
								while($data_msg=mysql_fetch_array($sql_msg)){
								$xml=@file_get_contents("https://graph.facebook.com/$data_msg[fk_user]");
								$info_user_resp=json_decode($xml, TRUE);
								?>
								<div class="msg">
									<img src="https://graph.facebook.com/<?php echo $data_msg['fk_user'] ?>/picture?type=large&width=25&height=25" title="<?php echo $data_msg['age_user'] ?> | <?php echo $data_msg['local_user'] ?> | <?php echo $info_user_resp['gender'] ?>"/>
									<a href='?st=<?php echo $_GET['st']?>&del_post=<?php echo $data_msg['id_pipeline'] ?>' class='button small grey tooltip' data-gravity='s' title='Apagar' onclick="javascript:return confirm('Tem a certeza?')"><i class='icon-remove'></i></a>
									<div class="content">
										<h3><?php echo $info_user_resp['name'] ?> <span>disse:</span><small><?php echo $data_msg['now_pipeline'] ?></small></h3>
										<p><?php echo $data_msg['post_pipeline'] ?></p>
									</div>
								</div>
								<?php
								}
							?>
						</div>
					</div>
					
					<div class="actions">
						<div class="left">
							<input type="text" name="fk_user" placeholder="Utilizador" size="4"/>
							<input type="text" placeholder="Resposta" class="required" name="post_pipeline" id="post_pipeline" />
							<input type="text" placeholder="Idade" name="age_user" id="age_user" size="2" maxlength="2" />
							<input type="text" placeholder="Localidade" name="local_user" id="local_user"/>
							<input type="radio" name="sex_user" id="sex_user" value="1"/>M
							<input type="radio" name="sex_user" id="sex_user" value="0"/>F
						</div>
						<div class="right">
							<input type="reset" value="Cancelar" class="grey" />
							<input type="submit" value="Enviar" name="send" />
						</div>
					</div>
					
				</form>
				
			</div>
			<?php
		}
	}
	
	function list_moderators(){
		$sql_moderators=mysql_query("SELECT * FROM admins WHERE id_admins<>2");
		while($data_moderators=mysql_fetch_array($sql_moderators)){
			$sql_work=mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_admins=$data_moderators[id_admins]");
			$count=mysql_num_rows($sql_work);
			if($data_moderators['status']==1){
				$status="<a href='?st=$_GET[st]&status=0&m=$data_moderators[id_admins]' title='colocar offline'><span class='badge green dark'>ONLINE</span></a>";
				$cor_work=($count>0)?"<span class='badge red dark'>Ocupado</span>":"<span class='badge green dark'>Livre</span>";
			} else {
				$status="<a href='?st=$_GET[st]&status=1&m=$data_moderators[id_admins]' title='Colocar online'><span class='badge red dark'>Offline</span></a>";
				$cor_work=NULL;
			}
			echo "<tr><td>".utf8_encode($data_moderators['name_admins'])."</td><td>$data_moderators[filter_local]</td><td>$data_moderators[filter_age_start] - $data_moderators[filter_age_end]</td><td>$data_moderators[filter_sex]</td><td class='center'>$cor_work $status</td></tr>";
		}
	}
?>

<div style="display: none;" id="dialog_add_moderator" title="Adicionar moderador">
	<form action="?st=<?php echo $_GET['st'] ?>&new_moderator" class="full validate" method="POST">
		<div class="row">
			<label for="d2_username">
				<strong>Utilizador</strong>
			</label>
			<div>
				<input class="required" type="text" name="username_admins" id="username_admins" />
			</div>
		</div>
		<div class="row">
			<label for="d2_email">
				<strong>E-mail</strong>
			</label>
			<div>
				<input class="required" email="true" type="text" name="email_admins" id="email_admins" />
			</div>
		</div>
		<div class="row">
			<label for="d2_username">
				<strong>Nome</strong>
			</label>
			<div>
				<input class="required" type="text" name="name_admins" id="name_admins" />
			</div>
		</div>
		<div class="row">
			<label for="d2_username">
				<strong>Palavra-Chave</strong>
			</label>
			<div>
				<input class="meter strongpw required" type="text" name="password_admins" id="password_admins" />
			</div>
		</div>
		<div class="row">
			<label for="fk_admins_types">
				<strong>Regra</strong>
			</label>
			<div>
				<select name="fk_admins_types" id="fk_admins_types" class="search required" data-placeholder="Escolher">
					<option value=""></option>
					<option value="1">Webmaster</option> 
					<option value="2">Demo</option> 
					<option value="3">Moderador</option> 
				</select>
			</div>
		</div>
		<div class="row">
			<label for="d2_username">
				<strong>Local</strong>
			</label>
			<div>
				<input type="text" name="filter_local" id="filter_local" />
			</div>
		</div>
		<div class="row">
			<label for="d2_username">
				<strong>Idade</strong>
			</label>
			<div>
				<div><input data-type="range" data-range='[13,19]' name="filter_age" id="filter_age" /></div>
			</div>
		</div>
		<div class="row">
			<label for="d2_username">
				<strong>Sexo</strong>
			</label>
			<div>
				<div><input type="radio" name="filter_sex" id="filter_sex"  value="1"/> M <input type="radio" name="filter_sex" id="filter_sex"  value="0"> F</div>
			</div>
		</div>
	
	<div class="actions">
		<div class="left">
			<button class="grey cancel">Cancelar</button>
		</div>
		<div class="right">
			<input type="submit" value="Adicionar">
		</div>
	</div>
	</form>
</div>

<script>
    $$.ready(function() {
        $( "#dialog_add_moderator" ).dialog({
            autoOpen: false,
            modal: true,
            width: 400,
            open: function(){ $(this).parent().css('overflow', 'visible'); $$.utils.forms.resize() }
        }).find('button.submit').click(function(){
            var $el = $(this).parents('.ui-dialog-content');
            if ($el.validate().form()) {
                $el.find('form')[0].reset();
                $el.dialog('close');
            }
        }).end().find('button.cancel').click(function(){
            var $el = $(this).parents('.ui-dialog-content');
            $el.find('form')[0].reset();
            $el.dialog('close');;
        });
        
        $( ".open-add-moderator-dialog" ).click(function() {
            $( "#dialog_add_moderator" ).dialog( "open" );
            return false;
        });
    });
    </script>

<h1 class="grid_12">Moderar Posts</h1>

<div class="grid_12">
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Novo post</h2>
		</div>
		
		<form name="frm_page" id="frm_page" action="?st=<?php echo $_GET['st'] ?>&new_post" method="POST"  class="full validate">
		<div class="content">
			<div class='row'><label for='post_pipeline'><strong>Post</strong></label><div><textarea name="post_pipeline"></textarea></div></div>
		</div><!-- End of .content -->
		<div class="actions">
			<div class="left">
				<input type="text" name="fk_user" placeholder="Utilizador"/>
				<input type="text" placeholder="Idade" name="age_user" id="age_user" size="2" maxlength="2" />
				<input type="text" placeholder="Localidade" name="local_user" id="local_user"/>
				<input type="radio" name="sex_user" id="sex_user" value="1"/>M
				<input type="radio" name="sex_user" id="sex_user" value="0"/>F
			</div>
			<div class="right">
				<input type="reset" value="Cancelar" />
				<input type="submit" value="POST!" name="send" />
			</div>
		</div><!-- End of .actions -->
		</form>
		
	</div><!-- End of .box -->
</div><!-- End of .grid_4 -->

<?php list_posts() ?>

<div class="grid_12">
			<div class="box">
			
				<div class="header">
					<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Moderadores</h2>
				</div>
				
				<div class="content">
					<div class="tabletools">
						<div class="left">
							<a href="javascript:void(0);" class="open-add-moderator-dialog"><i class="icon-plus"></i>Novo Moderador</a>
							<a href="?st=<?php echo $_GET['st'] ?>&distribuir"><i class="icon-wrench"></i>Distribuir tarefas</a>
						</div>
						<div class="right">								
						</div>
					</div>
					<table class="dynamic styled" data-table-tools='{"display":true}'> <!-- OPTIONAL: with-prev-next -->
						<thead>
							<tr>
								<th>Nome</th>
								<th>Localidade</th>
								<th>Idade</th>
								<th>Sexo</th>
								<th>Acções</th>
							</tr>
						</thead>
						<tbody>
							<?php list_moderators() ?>
						</tbody>
					</table>
				</div><!-- End of .content -->
				
			</div><!-- End of .box -->
		</div><!-- End of .grid_12 -->
		
		
	</section><!-- End of #content -->
	
</div><!-- End of #main -->