<?php
	//Function anti mysql injection
	function anti_sql_injection ($str) { 
		if (!is_numeric($str)) { 
			$str= get_magic_quotes_gpc() ? stripslashes($str) : $str; 
			$str= function_exists("mysql_real_escape_string") ? mysql_real_escape_string($str) : mysql_escape_string($str); 
		} 
		return $str;
	}

	if($_COOKIE["remember"]!=NULL){
        $_SESSION['admin_id']=$_COOKIE["admin_id"];    
        $_SESSION['admin_type']=$_COOKIE["admin_type"];    
        $_SESSION['admin_name']=$_COOKIE["admin_name"];
        $_SESSION['admin_username']=$_COOKIE["admin_username"];
        $_SESSION['admin_avatar']=$_COOKIE["admin_avatar"];
        $_SESSION['admin_tour']=$_COOKIE["admin_tour"];
    }
    
    if(isset($_GET['login'])){
        //echo "AQUI: ".$_POST['remember'].$_POST['username'].$_COOKIE["admin_id"].$_COOKIE['admin_name'].$_COOKIE["admin_avatar"]; 
        //$sql=mysql_query("SELECT * FROM admins WHERE username_admins='$_POST[username]' AND password_admins='$_POST[password]'");
		if($_SESSION['admin_username']){
			$sql=mysql_query("SELECT * FROM admins WHERE username_admins='".anti_sql_injection($_SESSION['admin_username'])."' AND password_admins='".anti_sql_injection($_POST['password'])."'");
		} else {
			$sql=mysql_query("SELECT * FROM admins WHERE username_admins='".anti_sql_injection($_POST['username'])."' AND password_admins='".anti_sql_injection($_POST['password'])."'");
		}
        $conta=mysql_num_rows($sql);
        $dados=mysql_fetch_array($sql);
        if($conta>0){
            if($_POST['remember']==1)  {
                setcookie("remember", "yes", time()+3600);
                setcookie("admin_id", $dados['id_admins'], time()+3600);
                setcookie("admin_type", $dados['fk_admins_types'], time()+3600);
                setcookie("admin_name", $dados['name_admins'], time()+3600);
                setcookie("admin_username", $dados['username_admins'], time()+3600);
                setcookie("admin_avatar", $dados['image_admins'], time()+3600);
                setcookie("admin_tour", $dados['tour_admins'], time()+3600);
            } 
            $_SESSION['admin_id']=$dados['id_admins'];
            $_SESSION['admin_type']=$dados['fk_admins_types'];
            $_SESSION['admin_name']=$dados['name_admins'];
            $_SESSION['admin_username']=$dados['username_admins'];
            $_SESSION['admin_avatar']=$dados['image_admins'];
            $_SESSION['admin_tour']=$dados['tour_admins'];
            mysql_query("UPDATE admins SET last_ip_admins='".getenv("HTTP_X_FORWARDED_FOR")."' WHERE id_admins='$dados[id_admins]'");
            //$readme=what_to_talk("This is my first test 2");
        } else {
            //$alert_msg="<div class='alert error no-margin top'><span class='hide'>x</span>".__("Wrong username or password.")."</div>";
            //what_to_talk("Your logon information is incorrect");
            //mysql_query("INSERT INTO block (ip_block) VALUES ('".getenv("HTTP_X_FORWARDED_FOR")."')");
        }
    }
    
    if (isset($_GET['logout'])){
        setcookie("remember",""); 
        setcookie("admin_id","");  
        setcookie("admin_name",""); 
        setcookie("admin_username",""); 
        setcookie("admin_avatar","");
        session_unset(); 
        session_destroy(); 
        //header('Location: ?');
        //what_to_talk("Goodbye. Thank you for using the Hybrid");    
    }
	
	function what_to_talk($talk=NULL){
		if($talk!=NULL) {
			echo("<audio src='http://translate.google.com/translate_tts?tl=en&q=$talk' autoplay></audio>");
		} else {
			$talk=__("Hello ").utf8_encode($_SESSION['admin_name']).". ";
			//$talk=__("Hello ").utf8_encode($_SESSION['admin_name']).__(". Welcome to Hybrid BackOffice. ");
			//$talk.=__("I will now check for news on your site. Please wait. ");
			$sql_contacts=mysql_query("SELECT * FROM contacts WHERE seen_contacts='0'");
			$conta_contacts=mysql_num_rows($sql_contacts);
			$talk.=($conta_contacts>0)?__("You have ").$conta_contacts.__(" new messages from site. "):__("No new messages. ");
			$sql_shop_orders=mysql_query("SELECT * FROM shop_orders WHERE status_shop_orders='1'");
			$conta_shop_orders=mysql_num_rows($sql_shop_orders);
			$talk.=($conta_shop_orders>0)?__("You have ").$conta_shop_orders.__(" orders in progress "):__("No new orders in progress");
			//echo $talk;
			//echo "<embed src='http://translate.google.com/translate_tts?tl=$_SESSION[language]&q=$talk' autostart='true' loop='false' width='300px' height='30'></embed>";
			echo"<audio src='http://translate.google.com/translate_tts?tl=$_SESSION[language]&q=$talk' autoplay></audio>";
			//echo "<embed type='application/x-shockwave-flash' flashvars='audioUrl=http://translate.google.com/translate_tts?tl=$_SESSION[language]&q=$talk' src='http://www.google.com/reader/ui/3523697345-audio-player.swf' width='300' height='27' quality='best'></embed>";
		}
	}
	
	function panel_messages($what){
		$sql_contacts=mysql_query("SELECT * FROM contacts WHERE seen_contacts='0'");
		$count_contacts=mysql_num_rows($sql_contacts);
		
		switch($what){
			case "count": echo $count_contacts; break;
			case "messages": 
				while($data_contacts=mysql_fetch_array($sql_contacts)){
					echo "<li>
								<div class='avatar'>
									<img src='img/elements/mail/avatar.png' height='40 width=40'/>
								</div>
								<div class='info'>
									<strong>".utf8_encode($data_contacts['name_contacts'])."</strong>
									<span>".utf8_encode($data_contacts['subject_contacts'])."</span>
									<small>$data_contacts[now_contacts]</small>
								</div>
								<div class='text'>
									<p>".utf8_encode($data_contacts['message_contacts'])."</p>
									<div class='actions'>
										<a href='#' class='left'>".__('Reply')."</a>
										<a class='red right' href='#'>".__('Delete')."</a>
									</div>
								</div>
							</li>";
				}
				break;
		}
	}
	
	function fields_type($field){
	//function fields_type($table,$field,$what){
		//$what (form OR list)
		//$database_field=$what."_fields";
		//$name_field=explode("_$table",$field);
		
		$sql=mysql_query("SELECT * FROM $database_field WHERE name_fields='$field'");
		$data=mysql_fetch_array($sql);
		
		$title_field=($data['help_fields'])?" title='$data[help_fields]' alt='$data[help_fields]'":NULL;
		$class_field=($data['class_fields'])?" class='$data[class_fields]'":NULL;
		
		switch($data['type_fields']){
			case "text":"<input type=\"text\" name=\"$field\" id=\"$field\" $class_field>";Break;
			case "autocomplete":"";Break;
			case "password":"<input type=\"password\" data-gravity=\"n\" name=\"$field\" id=\"$field\" $title_field $class_field>";Break;
			case "password_meter":"";Break;
			case "placeholder":"";Break;
			case "textarea_nogrow":"";Break;
			case "textarea_autogrow":"";Break;
			case "wysiwyg":"";Break;
			case "select_search":"";Break;
			case "select_nosearch":"";Break;
			case "select_tags":"";Break;
			case "select_dual":"";Break;
			case "picker_date":"";Break;
			case "picker_time":"";Break;
			case "picker_date_time":"";Break;
			case "picker_color":"";Break;
			case "checkbox":"";Break;
			case "radio":"";Break;
			case "slider":"";Break;
			case "slider_range":"";Break;
			case "spinner":"";Break;
			case "file":"";Break;
		}
	}
?>