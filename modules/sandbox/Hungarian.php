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
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao apagar. Verificar query!</div>";
	}
	
	if(isset($_GET['new_moderator'])){
		if(mysql_query("INSERT INTO admins (fk_admins_types,username_admins,password_admins,name_admins,email_admins) VALUES ('$_POST[fk_admins_types]','$_POST[username_admins]','$_POST[password_admins]','$_POST[name_admins]','$_POST[email_admins]')"))echo "<div class='alert success no-margin-top'><span class='icon'></span><strong>Adicionado!</strong> O moderador foi adicionado correctamente</div>";
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao adicionar moderador. Verificar query!</div>";
	}
	
	if(isset($_GET['new_rule'])){
		switch($_POST['type_rules']){
			case "local":$myterm=$_POST['filter_local'];break;
			case "age":$myterm=$_POST['filter_age'];break;
			case "sex":$myterm=$_POST['filter_sex'];break;
		}
		if(mysql_query("INSERT INTO rules (fk_admins,type_rules,term_rules,points_priority_rules) VALUES ('$_POST[fk_admins]','$_POST[type_rules]','$myterm','$_POST[points_priority_rules]')"))echo "<div class='alert success no-margin-top'><span class='icon'></span><strong>Adicionado!</strong> A regra foi adicionada correctamente</div>";
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao adicionar regra. Verificar query!</div>";
	}
	
	if(isset($_GET['status'])){
		mysql_query("UPDATE admins SET status_admins=$_GET[status] WHERE id_admins=$_GET[m]");
	}
	
	if(isset($_GET['delm'])){
		if(mysql_query("DELETE FROM admins WHERE id_admins=$_GET[delm]")) echo "<div class='alert success no-margin-top'><span class='icon'></span><strong>Apagado!</strong> Regra apagada correctamente</div>";
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao apagar. Verificar query!</div>";
	}
	if(isset($_GET['delr'])){
		if(mysql_query("DELETE FROM rules WHERE id_rules=$_GET[delr]")) echo "<div class='alert success no-margin-top'><span class='icon'></span><strong>Apagado!</strong> Regra apagada correctamente</div>";
		else echo "<div class='alert error no-margin-top'><span class='icon'></span><strong>Erro!</strong> Erro ao apagar. Verificar query!</div>";
	}
	
	if(isset($_GET['distribuir'])){
		//Distribuir por POST
		$sql_posts=mysql_query("SELECT * FROM pipeline");
		//$sql_posts=mysql_query("SELECT * FROM pipeline WHERE fk_user<>".USER_ID_FACEBOOK);//Para ser diferente do proprio utilizador
		while($data_posts=mysql_fetch_array($sql_posts)){
			atribuir_tarefa($data_posts['id_pipeline']);
		}
	}
	
	function atribuir_tarefa($post){
		//Verificar Fluxograma criado para o efeito em http://www.gliffy.com/pubdoc/4480635/L.png
		$sql_post=mysql_query("SELECT * FROM pipeline WHERE id_pipeline=$post");
		$data_post=mysql_fetch_array($sql_post);
		
		//Verificar se já está a ser tratado
		$tratado=mysql_num_rows(mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$post"));
		
		if($tratado==0){
			if($data_post['fk_pipeline']>0){ //Post de resposta
				$data_post_principal=mysql_fetch_array(mysql_query("SELECT * FROM pipeline WHERE id_pipeline=$data_post[fk_pipeline]"));//Verifica qual o post principal
				$sql_moderador=mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$data_post_principal[id_pipeline]");//Verifica se já existe algum moderador a tratar do post principal
				$data_moderador=mysql_fetch_array($sql_moderador);
				$conta_moderador=mysql_num_rows($sql_moderador);
				if($conta_moderador>0){ //Se existir tem de passar esse post para o mesmo moderador
					mysql_query("INSERT INTO pipeline_x_admins (fk_pipeline,fk_admins) VALUES ($post,$data_moderador[fk_admins])");
				} else { //Se não, tem de verificar se existe algum moderador com filtros
					$resultado=detect_administrator($post);
					mysql_query("INSERT INTO pipeline_x_admins (fk_pipeline,fk_admins) VALUES ($post,$resultado)");
				}
			} else { //Post principal
				$resultado=detect_administrator($post);
				mysql_query("INSERT INTO pipeline_x_admins (fk_pipeline,fk_admins) VALUES ($post,$resultado)");
			}
		}
	}
	
	function detect_administrator($post){	
		//mysql_query("TRUNCATE TABLE priority"); //Limpa a tabela priority
		$data_post=mysql_fetch_array(mysql_query("SELECT * FROM pipeline WHERE id_pipeline=$post")); //Para saber os dados da Pipeline
		//$sql_admin_filter_age=mysql_query("SELECT * FROM admins WHERE filter_age_start <= $data_post[age_user] AND filter_age_end >= $data_post[age_user] AND status = 1");
		//while($data_admin_filter_age=mysql_fetch_array($sql_admin_filter_age)){
		//	mais_um($post,$data_admin_filter_age['id_admins'],$data_admin_filter_sex['points_priority_rules']);
		//}
		//$sql_admin_filter_local=mysql_query("SELECT * FROM admins WHERE filter_local = '$data_post[local_user]' AND status = 1");
		$sql_admin_filter_local=mysql_query("SELECT
											admins.id_admins AS admins,
											admins.name_admins AS name,
											rules.points_priority_rules AS points
											FROM
											rules
											INNER JOIN admins ON rules.fk_admins = admins.id_admins
											LEFT JOIN priority ON priority.fk_admins = admins.id_admins
											LEFT JOIN pipeline_x_admins ON pipeline_x_admins.fk_admins = admins.id_admins
											WHERE
											rules.fk_admins IS NOT NULL AND
											rules.type_rules = 'local' AND
											pipeline_x_admins.fk_admins IS NULL AND
											admins.status_admins = 1 AND
											rules.term_rules = '$data_post[local_user]'");
		while($data_admin_filter_local=mysql_fetch_array($sql_admin_filter_local)){
			mais_um($post,$data_admin_filter_local['admins'],$data_admin_filter_local['points']);
		}
		//$sql_admin_filter_sex=mysql_query("SELECT * FROM admins WHERE filter_local = $data_post[sex_user] AND status = 1");
		$sql_admin_filter_sex=mysql_query("SELECT
											admins.id_admins AS admins,
											admins.name_admins AS name,
											rules.points_priority_rules AS points
											FROM
											rules
											INNER JOIN admins ON rules.fk_admins = admins.id_admins
											LEFT JOIN priority ON priority.fk_admins = admins.id_admins
											LEFT JOIN pipeline_x_admins ON pipeline_x_admins.fk_admins = admins.id_admins
											WHERE
											rules.fk_admins IS NOT NULL AND
											rules.type_rules = 'age' AND
											pipeline_x_admins.fk_admins IS NULL AND
											admins.status_admins = 1 AND
											rules.term_rules = '$data_post[sex_user]'");
		while($data_admin_filter_sex=mysql_fetch_array($sql_admin_filter_sex)){
			mais_um($post,$data_admin_filter_sex['admins'],$data_admin_filter_sex['points']);
		}
		
		/*
		$sql_resultado=mysql_query("SELECT * FROM priority ORDER BY busy_priority ASC, points_priority DESC LIMIT 1");
		$conta_resultado=mysql_num_rows($sql_resultado);
		if($conta_resultado==0){
			$sql_admin_nofilter=mysql_query("SELECT * FROM admins WHERE status=1 AND filter_age_start IS NULL AND filter_age_end IS NULL AND filter_local IS NULL AND filter_sex IS NULL");
			while($data_admin_nofilter=mysql_fetch_array($sql_admin_nofilter)){
				$conta=mysql_num_rows(mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$post AND fk_admins=$data_admin_nofilter[id_admins]"));
				mysql_query("INSERT INTO priority (fk_pipeline,fk_admins,busy_priority,points_priority) VALUES ('$post','$data_admin_nofilter[id_admins]','$conta','1')");
			}
		}
		*/
		
		//Multi check moderators
		//Procurar por moderadores livres com filtro
		$sql_mcf=mysql_query("SELECT * FROM priority WHERE fk_pipeline=$post AND busy_priority=0 ORDER BY points_priority DESC LIMIT 1");
		$conta_mcf=mysql_num_rows($sql_mcf);
		$data_mcf=mysql_fetch_array($sql_mcf);
		//Se não encontrar, procurar por moderadores livres sem filtros
		if($conta_mcf==0){
			$sql_msf=mysql_query("SELECT * FROM rules RIGHT JOIN admins ON rules.fk_admins = admins.id_admins WHERE rules.id_rules IS NULL");
			$conta_msf=mysql_num_rows($sql_mcf);
			$data_msf=mysql_fetch_array($sql_msf);
			if($conta_msf==0){
				//Se não encontrar procurar de novo por moderadores com filtro mas com menos carga
				$sql_mcf2=mysql_query("SELECT * FROM priority WHERE fk_pipeline=$post ORDER BY busy_priority ASC, points_priority DESC LIMIT 1");
				$data_mcf2=mysql_fetch_array($sql_mcf2);
				$conta=mysql_fetch_array(mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$post AND fk_admins=$data_mcf[fk_admins]'"));
				$adiciona=$conta['busy_priority']+1;
				mysql_query("UPDATE priority SET busy_priority=$adiciona WHERE fk_admins=$data_mcf2[fk_admins] AND fk_pipeline=$post");
				return $data_mcf2['fk_admins'];
			} else {
				$conta=mysql_fetch_array(mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$post AND fk_admins=$data_mcf[fk_admins]'"));
				$adiciona=$conta['busy_priority']+1;
				mysql_query("UPDATE priority SET busy_priority=$adiciona WHERE fk_admins=$data_msf[fk_admins] AND fk_pipeline=$post");
				return $data_msf['id_admins'];
			}
		} else {
			$conta=mysql_fetch_array(mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$post AND fk_admins=$data_mcf[fk_admins]'"));
			$adiciona=$conta['busy_priority']+1;
			mysql_query("UPDATE priority SET busy_priority=$adiciona WHERE fk_admins=$data_mcf[fk_admins] AND fk_pipeline=$post");
			return $data_mcf['fk_admins'];			
		}
	
		//$resultado=mysql_fetch_array(mysql_query("SELECT * FROM priority WHERE fk_pipeline=$post ORDER BY points_priority DESC, busy_priority ASC LIMIT 1"));
		//$conta=mysql_num_rows(mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$post AND fk_admins=$resultado[fk_admins]"));
		//mysql_query("UPDATE priority SET busy_priority=$conta WHERE fk_pipeline=$post AND fk_admins='$resultado[fk_admins]'");
		
		
		/* ESCOLHER ADMINS QUE NAO ESTAO NOS FILTROS //
		SELECT
		*
		FROM
		rules
		RIGHT JOIN admins ON rules.fk_admins = admins.id_admins
		WHERE
		rules.id_rules IS NULL
		*/

	}
	
	function mais_um($post,$admin,$points){
		//Este bloco serve para construir a tabela de pontos de prioridade para ver qual o amdinistrador que ganha o post.
		$sql_last_row=mysql_query("SELECT * FROM priority WHERE fk_admins=$admin AND fk_pipeline=$post");
		$count_last_row=mysql_num_rows($sql_last_row);
		$data_last_row=mysql_fetch_array($sql_last_row);
		if($count_last_row>0){
			$mais_um=$data_last_row['points_priority']+$points;
			//$conta=mysql_num_rows(mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$post AND fk_admins=$admin"));
			mysql_query("UPDATE priority SET points_priority='$mais_um' WHERE fk_admins=$admin AND fk_pipeline=$post");
			//mysql_query("UPDATE priority SET points_priority='$mais_um' WHERE fk_admins=$admin AND fk_pipeline=$post");
		} else {
			//$conta=mysql_num_rows(mysql_query("SELECT * FROM pipeline_x_admins WHERE fk_pipeline=$post AND fk_admins=$admin"));
			mysql_query("INSERT INTO priority (fk_pipeline,fk_admins,points_priority) VALUES ('$post','$admin','$points')");
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
										<h3><?php echo $info_user_resp['name'] ?> ID:<?php echo $data_msg['id_pipeline'] ?> <span>disse:</span><small><?php echo $data_msg['now_pipeline'] ?></small></h3>
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
			if($data_moderators['status_admins']==1){
				$status="<a href='?st=$_GET[st]&status=0&m=$data_moderators[id_admins]' title='colocar offline'><span class='badge green dark'>ONLINE</span></a>";
				$cor_work=($count>0)?"<span class='badge red dark'>Ocupado</span>":"<span class='badge green dark'>Livre</span>";
			} else {
				$status="<a href='?st=$_GET[st]&status=1&m=$data_moderators[id_admins]' title='Colocar online'><span class='badge red dark'>Offline</span></a>";
				$cor_work=NULL;
			}
			echo "<tr><td>$data_moderators[id_admins]</td><td>".utf8_encode($data_moderators['name_admins'])."</td><td class='center'>$cor_work $status <a href='?st=$_GET[st]&delm=$data_moderators[id_admins]' class='button small grey tooltip' data-gravity='s' title='Apagar' onclick=\"javascript:return confirm('Tem a certeza?')\"><i class='icon-remove'></i></a></td></tr>";
		}
	}
	
	function list_rules(){
		$sql_rules=mysql_query("SELECT * FROM rules");
		while($data_rules=mysql_fetch_array($sql_rules)){
			echo "<tr><td>$data_rules[id_rules]</td><td>$data_rules[fk_admins]</td><td>$data_rules[type_rules]</td><td>$data_rules[term_rules]</td><td>$data_rules[points_priority_rules]</td><td class='center'><a href='?st=$_GET[st]&delr=$data_rules[id_rules]' class='button small grey tooltip' data-gravity='s' title='Apagar' onclick=\"javascript:return confirm('Tem a certeza?')\"><i class='icon-remove'></i></a></td></tr>";
		}
	}
?>

<style>
.a{display:none}
.b{display:none}
.c{display:none}
</style>

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

<div style="display: none;" id="dialog_add_rule" title="Adicionar regra">
	<form action="?st=<?php echo $_GET['st'] ?>&new_rule" class="full validate" method="POST">
		<?php fields_type("fk_admins",NULL) ?>
		<div class="row">
			<label for="points_priority_rules">
				<strong>Prioridade</strong>
			</label>
			<div>
				<input data-type="range" name="points_priority_rules" id="points_priority_rules" />
			</div>
		</div>
		<div class="row">
			<label for="type_rules">
				<strong>Tipo</strong>
			</label>
			<div>
				<div>
					<input name="type_rules" id="a" class="radio required" type="radio" value="local">Local
					<input name="type_rules" id="b" class="radio required" type="radio" value="age">Idade
					<input name="type_rules" id="c" class="radio required" type="radio" value="sex">Sexo
				</div>
			</div>
		</div>
		<div class="row type a">
			<label for="filter_local">
				<strong>Local</strong>
			</label>
			<div>
				<input type="text" name="filter_local" id="filter_local" class="required" />
			</div>
		</div>
		<div class="row type b">
			<label for="filter_age">
				<strong>Idade</strong>
			</label>
			<div>
				<input data-type="range" data-range='[13,19]' name="filter_age" id="filter_age" />
			</div>
		</div>
		<div class="row type c">
			<label for="filter_sex">
				<strong>Sexo</strong>
			</label>
			<div>
				<div><input type="radio" name="filter_sex" id="filter_sexM" class="required" value="1" /> Masculino <input type="radio" name="filter_sex" id="filter_sexF" class="required"  value="0"/> Feminino</div>
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
        $( "#dialog_add_moderator").dialog({
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
		
		$( "#dialog_add_rule").dialog({
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
        
        $( ".open-add-rule-dialog" ).click(function() {
            $( "#dialog_add_rule" ).dialog( "open" );
            return false;
        });
    });
	
	$(function() {
		$('.radio').on('click', function(){
			var ID = $(this).attr('id');
			RadioClick(ID);
		});    
	});

	function RadioClick(elem){
		$('.type').hide();
		$('.'+ elem).show();     
		$('.'+ elem).addClass("required");     
	};
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
						<th>ID</th>
						<th>Nome</th>
						<th>Acções</th>
					</tr>
				</thead>
				<tbody>
					<?php list_moderators() ?>
				</tbody>
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
	<div class="box">
	
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png">Lista de regras</h2>
		</div>
		
		<div class="content">
			<div class="tabletools">
				<div class="left">
					<a href="javascript:void(0);" class="open-add-rule-dialog"><i class="icon-plus"></i>Nova regra</a>
					<a href="?st=<?php echo $_GET['st'] ?>&distribuir"><i class="icon-wrench"></i>Distribuir tarefas</a>
				</div>
				<div class="right">								
				</div>
			</div>
			<table class="dynamic styled" data-table-tools='{"display":true}'> <!-- OPTIONAL: with-prev-next -->
				<thead>
					<tr>
						<th>ID</th>
						<th>Moderador</th>
						<th>Tipo</th>
						<th>Regra</th>
						<th>Prioridade</th>
						<th>Acções</th>
					</tr>
				</thead>
				<tbody>
					<?php list_rules() ?>
				</tbody>
			</table>
		</div><!-- End of .content -->
		
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->