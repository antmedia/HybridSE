<?php
	//Function anti mysql injection
	function anti_sql_injection ($str) { 
		if (!is_numeric($str)) { 
			$str= get_magic_quotes_gpc() ? stripslashes($str) : $str; 
			$str= function_exists("mysql_real_escape_string") ? mysql_real_escape_string($str) : mysql_escape_string($str); 
		} 
		return $str;
	}
	
	function truncate_str($str, $maxlen) {
		if ( strlen($str) <= $maxlen ) return $str;
		$newstr = substr($str, 0, $maxlen);
		if ( substr($newstr,-1,1) != ' ' ) $newstr = substr($newstr, 0, strrpos($newstr, " "));
		return $newstr;
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
            what_to_talk("Access denied");
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
        what_to_talk("Goodbye. Thank you for using Hump");    
    }
	
	function what_to_talk($talk=NULL){
		if($talk!=NULL) {
			//echo"<audio src='http://translate.google.com/translate_tts?tl=$_SESSION[language]&q=$talk' autoplay></audio>";
			echo "<embed style='height:0' loop='false' src='http://translate.google.com/translate_tts?tl=en&q=$talk' autostart='true' hidden='true'/>";
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
	
	function email_somewhere($email_to,$email_from,$email_name,$email_subject,$email_message) {
		$to=$email_to; // recipients
		$subject=$email_subject;// subject
		$message=$email_message;// message 
		// Additional headers 
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		$headers .= "From: $email_name <$email_from>" . "\r\n";
		if(mail($to, $subject, $message, $headers)){// Mail it 
			alert_box("success","Message sent","Your message has been sent."); //$type,$title,$text		
			//mysql_query("INSERT INTO admins_changes (fk_admins,fk_modules,action_admins_changes) VALUES ('$_SESSION[admin_id]','$_GET[st]','mail')");
		} else {
			alert_box("error","An error occurred","A message was automatically sent a message to the WebMaster with the respective error.");    
		}
	}
	
	function CreateForm($title,$table,$id=NULL,$ignore,$action){
		$exp_ignore=explode(',',$ignore);
		$newArrayFields=array();
		//Verify array $exp_ignore and add _$table
		for($k=0;$k < count($exp_ignore);++$k){
			$find_fk=strpos($exp_ignore[$k],'fk');
			$newField=($find_fk===FALSE)?$exp_ignore[$k]."_".$table:$exp_ignore[$k];
			array_push($newArrayFields,$newField);//adding _$table to the array   
		}
		
		echo"<form action='$action' method='post' class='box validate'>
				<div class='header'>
					<h2>".__($title)."</h2>
				</div>
				<div class='content'>";
					$result=(isset($id))?mysql_query("SELECT * FROM $table WHERE id_$table='$id'"):mysql_query("SELECT * FROM $table");
					$dados=mysql_fetch_array($result);
					for ($i = 0; $i < mysql_num_fields($result); ++$i) {
						$field = mysql_field_name($result, $i);
						if(!in_array($field,$newArrayFields)){
							$aux_title=explode("_$table",$field);
							$aux_two_title=str_replace("_"," ",$aux_title[0]);
							$title=__(ucfirst($aux_two_title));
							//echo "$title - $field<br>";
							if($id){
								fields_type($title,$field,utf8_encode($dados[$field]));
							} else {
								fields_type($title,$field);
							}
						}
					}
		echo	"</div>
				<div class='actions'>
					<div class='left'>
						<input type='reset' value='".__("Cancel")."' />
					</div>
					<div class='right'>
						<div style='float:left;padding-right:20px'>
							<select name='form_action' id='form_action'>
								<option value=''>".__("Back to list")."</option>
								<option value='add_new'>".__("Add new")."</option>
								<option value='edit_this'>".__("Edit")."</option>
							</select>
						</div>
						<input type='submit' value='".__("Submit")."' name=submit />
					</div>
				</div>
			</form>";
		
	}
	
	function fields_type($title,$field,$data_result=NULL,$styled=TRUE){
	//function fields_type($table,$field,$what){
		//$what (form OR list)
		//$database_field=$what."_fields";
		//$name_field=explode("_$table",$field);
		
		$sql=mysql_query("SELECT * FROM fields WHERE name_fields='$field' AND status_fields=1");
		$data=mysql_fetch_array($sql);
		
		//$title_field=($data['help_fields'])?" title='$data[help_fields]' alt='$data[help_fields]' ":NULL;
		//$class_field=($data['class_fields'])?"$data[class_fields]":NULL;
		$required=($data['required_fields'])?"required":NULL;
		$placeholder=($data['placeholder_fields'])?"$data[placeholder_fields]":NULL;
		//$predefined=($data['predefined_fields'])?"$data[predefined_fields]":NULL;
		//$title_field=ucfirst(str_replace("_"," ",$field));
		$title_field=$title;
		$predefined=($data_result!=NULL)?utf8_encode($data_result):$data['predefined_fields'];
		//$predefined=$data_result;
		
		$start_input=($styled==TRUE)?"<div class='row'><label for='$field'><strong>$title_field</strong></label><div>":"<label for='$field'><strong>$title_field</strong></label><div>";
		$end_input=($styled==TRUE)?"</div></div>":"</div>";
		
		switch($data['type_fields']){
			case "text"						:	echo "$start_input<input data-error-type='inline' type='text' name='$field' id='$field' x-webkit-speech='x-webkit-speech' class='$required' placeholder='$placeholder' value='$predefined' $title_field />$end_input";Break;
			case "number"					:	echo "$start_input<input data-error-type='inline' type='number' name='$field' id='$field' x-webkit-speech='x-webkit-speech' class='$required' placeholder='$placeholder' value='$predefined' $title_field />$end_input";Break;
			case "email"					:	echo "$start_input<input data-error-type='inline' type='text' email='true' name='$field' id='$field' x-webkit-speech='x-webkit-speech' class='$required' placeholder='$placeholder' value='$predefined' $title_field />$end_input";Break;
			case "password"					:	echo "$start_input<input data-error-type='inline' type='password' data-gravity=n name='$field' id='$field' x-webkit-speech='x-webkit-speech' class='$required' placeholder='$placeholder' value='$predefined' $title_field />$end_input";Break;
			case "password_meter"			:	echo "$start_input<input data-error-type='inline' type=password name='$field' id='$field' x-webkit-speech='x-webkit-speech' class='meter strongpw $required' placeholder='$placeholder' value='$predefined' $title_field />$end_input";Break;
			case "textarea_nogrow"			:	echo "$start_input<textarea rows='5' name='$field' id='$field' class='nogrow $required' placeholder='$placeholder' $title_field>$predefined</textarea>$end_input";Break;
			case "textarea_autogrow"		:	echo "$start_input<textarea rows='5' name='$field' id='$field' class='$required' placeholder='$placeholder' $title_field>$predefined</textarea>$end_input";Break;
			case "wysiwyg"					:	echo "$start_input<textarea rows='5' name='$field' id='$field' class='tinymce $required' placeholder='$placeholder' $title_field>$predefined</textarea>$end_input";Break;
			case "select_search"			:	echo "$start_input";
														//Find data from table
														if($data['values_fields']){
															echo "<select data-error-type='inline' name='$field' id='$field' class='search $required' data-placeholder='$placeholder'>";
															echo "<option value=''></option>";
															if(mysql_query("SELECT * FROM $data[values_fields]")){
																$sql_tbl=mysql_query("SELECT * FROM $data[values_fields] WHERE status_$data[values_fields]='1'");
																while($data_tbl=mysql_fetch_array($sql_tbl)){
																	$aux_field=(mysql_query("SELECT name_$data[values_fields] FROM $data[values_fields]"))?"name_$data[values_fields]":"title_$data[values_fields]";
																	$mytable="id_".$data['values_fields'];
																	$selected=($data_tbl[$mytable]==$predefined)?"selected":NULL;
																	echo "<option value='$data_tbl[$mytable]' $selected>".ucfirst(utf8_encode($data_tbl[$aux_field]))."</option>";
																}
															} else {
																$types=explode(";",$data['values_fields']);
																$values=explode(',',$types[0]);
																$names=explode(',',$types[1]);
																foreach(array_combine($values,$names) as $value => $name){
																	$selected=($value==$predefined)?"selected":NULL;
																	echo "<option value='$value' $selected>".utf8_encode($name)."</option>";
																}
															}
															echo "</select>";
														}
												echo"$end_input";Break;
			case "select_nosearch"			:	echo "$start_input";
														//Find data from table
														if($data['values_fields']){
															echo "<select data-error-type='inline' name='$field' id='$field' class='$required' data-placeholder='$placeholder'>";
															echo "<option value=''></option>";
															if(mysql_query("SELECT * FROM $data[values_fields]")){
																$sql_tbl=mysql_query("SELECT * FROM $data[values_fields] WHERE status_$data[values_fields]='1'");
																while($data_tbl=mysql_fetch_array($sql_tbl)){
																	$aux_field=(mysql_query("SELECT name_$data[values_fields] FROM $data[values_fields]"))?"name_$data[values_fields]":"title_$data[values_fields]";
																	$mytable="id_".$data['values_fields'];
																	$selected=($data_tbl[$mytable]==$predefined)?"selected":NULL;
																	echo "<option value='$data_tbl[$mytable]' $selected>".ucfirst(utf8_encode($data_tbl[$aux_field]))."</option>";
																}
															} else {
																$types=explode(";",$data['values_fields']);
																$values=explode(',',$types[0]);
																$names=explode(',',$types[1]);
																foreach(array_combine($values,$names) as $value => $name){
																	$selected=($value==$predefined)?"selected":NULL;
																	echo "<option value='$value' $selected>".utf8_encode($name)."</option>";
																}
															}
															echo "</select>";
														}
												echo "$end_input";Break;
			case "select_tags"				:	echo "$start_input";
														//Find data from table
														if($data['values_fields']){
															$field_array="[]";
															//$name_array=$field[];
															echo "<select data-error-type='inline' name='$field$field_array' id='$field' class='$required' data-placeholder='$placeholder' multiple>";
															echo "<option value=''></option>";
															if(mysql_query("SELECT * FROM $data[values_fields]")){
																$sql_tbl=mysql_query("SELECT * FROM $data[values_fields] WHERE status_$data[values_fields]='1'");
																while($data_tbl=mysql_fetch_array($sql_tbl)){
																	$aux_field=(mysql_query("SELECT name_$data[values_fields] FROM $data[values_fields]"))?"name_$data[values_fields]":"title_$data[values_fields]";
																	$mytable="id_".$data['values_fields'];
																	$selected=($data_tbl[$mytable]==$predefined)?"selected":NULL;
																	echo "<option value='$data_tbl[$mytable]' $selected>".ucfirst(utf8_encode($data_tbl[$aux_field]))."</option>";
																}
															} else {
																$types=explode(";",$data['values_fields']);
																$values=explode(',',$types[0]);
																$names=explode(',',$types[1]);
																foreach(array_combine($values,$names) as $value => $name){
																	$find=strpos($predefined,$value);
																	$selected=($find===FALSE)?NULL:"selected";
																	var_dump($value);
																	echo "<option value='$value' $selected>".utf8_encode($name)."</option>";
																}
															}
															echo "</select>";
														}
												echo "$end_input";Break;
			case "select_dual"				:	echo "$start_input";
														//Find data from table
														if($data['values_fields']){
															$field_array="[]";
															//$name_array=$field[];
															echo "<select data-error-type='inline' name='$field$field_array' id='$field' class='dualselects $required' data-placeholder='$placeholder' data-size='small' multiple>";
															if(mysql_query("SELECT * FROM $data[values_fields]")){
																$sql_tbl=mysql_query("SELECT * FROM $data[values_fields] WHERE status_$data[values_fields]='1'");
																while($data_tbl=mysql_fetch_array($sql_tbl)){
																	$aux_field=(mysql_query("SELECT name_$data[values_fields] FROM $data[values_fields]"))?"name_$data[values_fields]":"title_$data[values_fields]";
																	$mytable="id_".$data['values_fields'];
																	$selected=($data_tbl[$mytable]==$predefined)?"selected":NULL;
																	echo "<option value='$data_tbl[$mytable]' $selected>".ucfirst(utf8_encode($data_tbl[$aux_field]))."</option>";
																}
															} else {
																$types=explode(";",$data['values_fields']);
																$values=explode(',',$types[0]);
																$names=explode(',',$types[1]);
																foreach(array_combine($values,$names) as $value => $name){
																	$find=strpos($predefined,$value);
																	$selected=($find===FALSE)?NULL:"selected";
																	echo "<option value='$value' name='$value' $selected>".utf8_encode($name)."</option>";
																}
															}
															echo "</select>";
														}
												echo "$end_input";Break;
			case "picker_date"				:	echo "$start_input<div><input data-error-type='inline' type='date' name='$field' id='$field' value='$predefined' class='$required' /></div>$end_input";Break;
			case "picker_time"				:	echo "$start_input<div><input data-error-type='inline' type='time' name='$field' id='$field' value='$predefined' class='$required' data-step-minute='10' /></div>$end_input";Break;
			case "picker_date_time"			:	echo "$start_input<div><input data-error-type='inline' type='datetime' name='$field' id='$field' value='$predefined' class='$required'/></div>$end_input";Break;
			case "picker_color"				:	echo "$start_input<div><input data-error-type='inline' type='text' name='$field' id='$field' value='$predefined' class='$required color'/></div>$end_input";Break;
			case "checkbox"					:	echo "$start_input";
														//Find data from table
														if($data['values_fields']){
															if(mysql_query("SELECT * FROM $data[values_fields]")){
																$sql_tbl=mysql_query("SELECT * FROM $data[values_fields] WHERE status_$data[values_fields]='1'");
																while($data_tbl=mysql_fetch_array($sql_tbl)){
																	$aux_field=(mysql_query("SELECT name_$data[values_fields] FROM $data[values_fields]"))?"name_$data[values_fields]":"title_$data[values_fields]";
																	$mytable="id_".$data['values_fields'];
																	$find=strpos($predefined,$data_tbl['id']);
																	$selected=($find===FALSE)?NULL:"checked";
																	echo "<div><input data-error-type='inline' type='checkbox' name='cb$data_tbl[$mytable]' id='cb$data_tbl[$mytable]' value='$data_tbl[$mytable]' $selected /> <label for='cb$data_tbl[id]'>".ucfirst(utf8_encode($data_tbl[$aux_field]))."</label></div>";
																}
															} else {
																$types=explode(";",$data['values_fields']);
																$values=explode(',',$types[0]);
																$names=explode(',',$types[1]);
																foreach(array_combine($values,$names) as $value => $name){
																	$find=strpos($predefined,$value);
																	$selected=($find===FALSE)?NULL:"checked";
																	echo "<div><input data-error-type='inline' type='checkbox' name='cb$value' id='cb$value' value='$value' $selected /> <label for='cb$value'>".utf8_encode($name)."</label></div>";
																}
															}
														} else {
															$selected=($predefined==1)?"checked":NULL;
															echo"<div><input data-error-type='inline' type='checkbox' name='$field' id='$field' value='1' class='$required' $selected/> <label for='$field'></label></div>";
														}
												echo "$end_input";Break;
			case "radio"					:	echo "$start_input";
														//Find data from table
														if($data['values_fields']){
															if(mysql_query("SELECT * FROM $data[values_fields]")){
																$sql_tbl=mysql_query("SELECT * FROM $data[values_fields] WHERE status_$data[values_fields]='1'");
																while($data_tbl=mysql_fetch_array($sql_tbl)){
																	$aux_field=(mysql_query("SELECT name_$data[values_fields] FROM $data[values_fields]"))?"name_$data[values_fields]":"title_$data[values_fields]";
																	$mytable="id_".$data['values_fields'];
																	$find=strpos($predefined,$data_tbl['id']);
																	$selected=($find===FALSE)?NULL:"checked";
																	echo "<div><input data-error-type='inline' type='radio' name='rb$field' id='rb$data_tbl[$mytable]' value='$data_tbl[$mytable]' class='$required' $selected /> <label for='rb$data_tbl[$mytable]'>".ucfirst(utf8_encode($data_tbl[$aux_field]))."</label></div>";
																}
															} else {
																$types=explode(";",$data['values_fields']);
																$values=explode(',',$types[0]);
																$names=explode(',',$types[1]);
																foreach(array_combine($values,$names) as $value => $name){
																	$find=strpos($predefined,$value);
																	$selected=($find===FALSE)?NULL:"checked";
																	echo "<div><input data-error-type='inline' type='radio' name='rb$field' id='rb$value' value='$value' class='$required' $selected /> <label for='rb$value'>".utf8_encode($name)."</label></div>";
																}
															}
														}
												echo "$end_input";Break;
			case "slider"					:	echo "$start_input<input data-error-type='inline' data-type='range' name='$field' id='$field' class='$required' value='$predefined' />$end_input";Break;
			case "slider_range"				:	echo "$start_input<input data-error-type='inline' data-type='range' data-range='[$data[values_fields]]' name='$field' id='$field' class='$required' value='$predefined' />$end_input";Break;
			//case "autocomplete"				:	echo "<div class='row'><label for='$field'><strong>$title_field</strong></label><div><input data-error-type='inline' type=text data-type='autocomplete' id='$field' name='$field' data-source='extras/autocomplete.php?what=$data[values_fields]' /></div></div>";Break;
			case "spinner"					:	echo "$start_input<div><input data-error-type='inline' data-type='spinner' name='$field' id='$field' class='$required' value='$predefined' /></div>$end_input";Break;
			case "file"						:	echo "$start_input<input data-error-type='inline' type='file' id='$field' name='$field' class='$required' />$end_input";Break;
			case "image"					:	echo "$start_input<input data-error-type='inline' type='text' name='$field' id='$field' class='$required' value='$predefined' placeholder='$placeholder' $title_field />$end_input";
												?>
												<script language='JavaScript'>
													$('#<?php echo $field?>').popupWindow({ 
														windowURL:'extras/explorer/elfinder_popup.php?aux_string=<?php echo $field?>', 
														//windowURL:'extras/explorer/elfinder_popup.php?aux_string=<?php echo $field?>&folder=<?php echo $data['values_fields'] ?>', 
														windowName:'Filebrowser',
														height:480, 
														width:950,
														centerBrowser:1 
													}); 
												</script>
												<?php
												break;
			case "document"					:	echo "$start_input<input data-error-type='inline' type='text' name='$field' id='$field' class='$required' value='$predefined' placeholder='$placeholder' $title_field />$end_input";
												?>
												<script language='JavaScript'>
													$('#<?php echo $field?>').popupWindow({ 
														windowURL:'extras/explorer/elfinder_popup.php?aux_string=<?php echo $field?>', 
														//windowURL:'extras/explorer/elfinder_popup.php?aux_string=<?php echo $field?>&folder=<?php echo $data['values_fields'] ?>', 
														windowName:'Filebrowser',
														height:480, 
														width:950,
														centerBrowser:1 
													}); 
												</script>
												<?php
												break;
			case "edit_area"				:	echo "";?><script>
													editAreaLoader.init({
														id: "<?php echo $field ?>"	// id of the textarea to transform		
														,start_highlight: true	// if start with highlight
														,allow_resize: "both"
														,allow_toggle: true
														,word_wrap: true
														,language: "pt"
														,syntax: "js"	
													});
												</script>
												<?php echo "$start_input<textarea rows='5' name='$field' id='$field' class='nogrow $required' placeholder='$placeholder' $title_field>$predefined</textarea>$end_input";Break;
			case "hidden"					:	echo "<input type='hidden' name='$field' id='$field' value='$predefined' />";Break;
			default							:	echo "$start_input<input data-error-type='inline' type='text' name='$field' id='$field' x-webkit-speech='x-webkit-speech' class='$required'  value='$predefined' placeholder='$placeholder' $title_field />$end_input";Break;
		}
	}
	
	function list_type($field,$data_result=NULL){
		$sql=mysql_query("SELECT * FROM fields WHERE name_fields='$field' AND status_fields=1");
		$data=mysql_fetch_array($sql);
		
		switch($data['type_fields']){
			case "text"			: echo "$data_result"; break;
			case "checkbox"		: echo "<input type='checkbox' name='$field' id='$field' value='1'/>"; break;
			case "image"		: echo "<a href=''><img src='$data_result' border='0'></a>"; break;
			default 			: echo "$data_result"; break;
		}
	}
	
	function ListTable($table,$fields,$options,$filter=NULL){
		// Fields Zone //
		$exp_fields=explode(',',$fields);
		$newArrayFields=array();
		//Verify array $exp_fields and add _$table
		for($k=0;$k < count($exp_fields);++$k){
			$find_fk=strpos($exp_fields[$k],'fk');
			$newField=($find_fk===FALSE)?$exp_fields[$k]."_".$table:$exp_fields[$k];
			array_push($newArrayFields,$newField);//adding _$table to the array   
		}
		// end Fields Zone //
		// Options Zone //
		$exp_option=explode(',',$options);
		$newArrayOptions=array();
		//Verify array $exp_option
		for($w=0;$w < count($exp_option);++$w){
			$newOption=$exp_option[$w];
			array_push($newArrayOptions,$newOption);
		}
		// end Options Zone //
		// get the result from the DB
		$myfilter=($filter!=NULL)?"AND $filter":NULL;
		$result=mysql_query("SELECT * FROM $table WHERE delete_$table=0 $myfilter");
		
		// Lists the table name and then the field name
		//echo "<table class=\"dynamic styled\" data-table-tools='{\"display\":true}'><thead><tr>";
		echo "<table class=\"dynamic styled with-prev-next\" data-table-tools='{\"display\":true}'><thead><tr>";
		for ($i = 0; $i < mysql_num_fields($result); ++$i) {
			$field = mysql_field_name($result, $i);        
			if(in_array($field,$newArrayFields)){
				$aux_title=explode("_$table",$field);
					$aux_two_title=str_replace("_"," ",$aux_title[0]);
					$title=__(ucfirst($aux_two_title));
					//echo "$field<br>";//Field name
					//Verify table
					$table_find=explode("fk_",$field);
					$my_table=$table_find[1];
					if(mysql_query("SELECT * FROM $my_table")){
						if(mysql_query("SELECT title_$my_table FROM $my_table")) $aux_title="title_$my_table";
						else $aux_title="name_$my_table";
						echo "<th>".__(ucfirst(str_replace("_"," ",$my_table)))."</th>";//Field title name
					} else {
						echo "<th>$title</th>";//Field title name
					}
			}
		}
		echo($options!=NULL)?"<th>".__("Options")."</th>":NULL;
		echo"</tr></thead><tbody>";
		//Rest of table
		while($data=mysql_fetch_array($result)){
			echo"<tr class='gradeX'>";
			for ($i = 0; $i < mysql_num_fields($result); ++$i) {
			$field = mysql_field_name($result, $i);
				if(in_array($field,$newArrayFields)){
					$table_find=explode("fk_",$field);
					$my_table=$table_find[1];					
					if(mysql_query("SELECT * FROM $my_table")){
						$fk_category=mysql_fetch_array(mysql_query("SELECT * FROM  $my_table WHERE id_$my_table='$data[$field]' $detect_lang_field"));
						$aux_field=(mysql_query("SELECT title_$my_table FROM $my_table"))?"title_$my_table":"name_$my_table";
						$what_fk=explode("=",$fk);
						$show=$what_fk[1];
						echo "<td>".utf8_encode(strip_tags($fk_category[$aux_field]))."</td>";
					} else {
						echo "<td>".utf8_encode(strip_tags($data[$field]))."</td>";
					}
				}			
			}
			
			
			// Options
			$aux_id="id_$table";
			$aux_address="address_$table";
			$aux_locality="locality_$table";
			$aux_name="name_$table";
			$aux_phone="mobile_$table";
			$aux_email="email_$table";
			$aux_website="website_$table";
			$aux_memo="observations_$table";
			$aux_company="company_$table";
			$aux_title="title_$table";
			$aux_intro="intro_text_$table";
			$qr_code="BEGIN%3AVCARD%0AN%3A".utf8_encode($data[$aux_name])."%0ATEL%3A$data[$aux_phone]%0AEMAIL%3A$data[$aux_email]%0AADR%3A".utf8_encode($data[$aux_address])."+".utf8_encode($data[$aux_locality])."%0AEND%3AVCARD";
			if($options!=NULL){
			echo"<td>";
				$myfields=(isset($_GET['fields']))? "&fields=$_GET[fields]":NULL;
				$myvalues=(isset($_GET['values']))? "&values=$_GET[values]":NULL;
				if(in_array("edit",$newArrayOptions))echo" <a href='?st=$_GET[st]&edit=$data[$aux_id]' title='".__("Edit")."' alt='".__("Edit")."'><i class='icon-pencil'></i></a>";
				if(in_array("delete",$newArrayOptions)) echo" <a href='?st=$_GET[st]&delete=$data[$aux_id]' onclick=\"javascript:return confirm('".__("Delete. Are you sure?")."')\" title='".__("Delete")."' alt='".__("Delete")."'><i class='icon-remove'></i></a>";
				if(in_array("see",$newArrayOptions)) echo" <a href='?st=$_GET[st]&see=$data[$aux_id]' title='".__("See")."' alt='".__("See")."'><i class='icon-magnifying-glass'></i></a>";
				if(in_array("reply",$newArrayOptions)) echo" <a href='?st=$_GET[st]&reply=$data[$aux_id]' title='".__("Reply")."' alt='".__("Reply")."'><i class='icon-speech-bubble'></i></a>";
				if(in_array("send",$newArrayOptions)) echo" <a href='?st=$_GET[st]&send=$data[$aux_id]' onclick=\"javascript:return confirm('".__("Are you sure?")."')\" title='".__("Send")."' alt='".__("Send")."'><i class='icon-mail'></i></a>";
				//if(in_array("options",$newArrayOptions))echo" <a href='?st=$_GET[st]&edit=$data[$aux_id]' title='".__("Options")."' alt='".__("Options")."'><i class='icon-cogs'></i></a>";
				if(in_array("map",$newArrayOptions)) echo" <a href='http://maps.google.com/maps?f=q&hl=en&geocode=&q=$data[$aux_address],$data[$aux_locality]&z=20' title='".__("Map")."' alt='".__("Map")."' target='_blank'><i class='icon-globe'></i></a>";
				if(in_array("qrcode",$newArrayOptions)) echo" <a href='http://chart.apis.google.com/chart?cht=qr&chs=230x230&chl=$qr_code' title='".__("QR code")."' alt='".__("QR code")."' target='_blank'><i class='icon-iphone-4'></i></a>";
				//Form options
				$form_id="fk_forms";
				$form_step="step_form_fields";
				$form_field="fk_form_fields";
				if(in_array("FielEdit",$newArrayOptions))echo" <a href='?st=$_GET[st]&form=$data[$form_id]&step=$data[$form_step]&edit=$data[$aux_id]' title='".__("Edit")."' alt='".__("Edit")."'><i class='icon-pencil'></i></a>";
				if(in_array("FieldDelete",$newArrayOptions)) echo" <a href='?st=$_GET[st]&form=$data[$form_id]&delete=$data[$aux_id]' onclick=\"javascript:return confirm('".__("Delete. Are you sure?")."')\" title='".__("Delete")."' alt='".__("Delete")."'><i class='icon-remove'></i></a>";
				if(in_array("FieldCreate",$newArrayOptions))echo" <a href='?st=f2&form=$data[$aux_id]' title='".__("Create form")."' alt='".__("Create form")."'><i class='icon-cogs'></i></a>";
				if(in_array("FieldOptions",$newArrayOptions))echo" <a href='?st=f3&form=$data[$form_id]&step=$data[$form_step]&field=$data[$aux_id]' title='".__("Field options")."' alt='".__("Field options")."'><i class='icon-cogs'></i></a>";
				if(in_array("OptionEdit",$newArrayOptions))echo" <a href='?st=$_GET[st]&form=$data[$form_id]&field=$data[$form_field]&edit=$data[$aux_id]' title='".__("Edit")."' alt='".__("Edit")."'><i class='icon-pencil'></i></a>";
				if(in_array("OptionDelete",$newArrayOptions)) echo" <a href='?st=$_GET[st]&form=$data[$form_id]&field=$data[$form_field]&delete=$data[$aux_id]' onclick=\"javascript:return confirm('".__("Delete. Are you sure?")."')\" title='".__("Delete")."' alt='".__("Delete")."'><i class='icon-remove'></i></a>";
				echo"</td>";
			}
			echo"</tr>";
			// end Options
		}
		echo "</tbody></table>";
	}
	
	function EditOnTable($table,$ignore,$id_item=NULL){
		$exp_ignore=explode(',',$ignore);
		$newArrayFields=array();

		//Verify array $exp_ignore and add _$table
		for($k=0;$k < count($exp_ignore);++$k){
			$newField= $exp_ignore[$k]."_".$table;
			array_push($newArrayFields,$newField);//adding _$table to the array   
		}
		
		$result = mysql_query("SELECT * FROM $table");
		// Lists the table name and then the field name
		for ($i = 0; $i < mysql_num_fields($result); ++$i) {
			$field = mysql_field_name($result, $i); 
			if(!in_array($field,$newArrayFields)){   
				$dados[$field]=utf8_decode($_POST[$field]); 
			}
		}
		
		if($id_item){
			$q="UPDATE ".$table." SET ";
			$aux=0;
			$n=count($dados);
			foreach($dados as $key=>$val) {   
				if  ($aux==$n-1) $v.="$key='".$val."'";    
				else $v.="$key='".$val."' , ";
				$aux++; 
			} 
			$q.="$v";
			if(mysql_query("$q WHERE id_$table='$id_item'")) alert_box("success","Success","Data updated!");
			else alert_box("error","error","Error on update data, please try again later.");
		} else {
			$q="INSERT INTO ".$table." ";
			foreach($dados as $key=>$val) {
				$n.="$key,";
				if(strtolower($val)=='null') $v.="NULL, ";
				elseif(strtolower($val)=='now()') $v.="NOW(), ";
				else $v.= "'".$val."', ";
			}
			$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";
			if(mysql_query("$q")) alert_box("success","Success","Data saved!");
			else alert_box("error","error","Error on saving data, please try again later.");
		}
	}
	
	function DeleteFromTable($table,$id){
		if(mysql_query("UPDATE $table SET delete_$table='1' WHERE id_$table='$id'"))alert_box("success","Success","Data deleted!");
		else alert_box("error","error","Error on deleting data, please try again later.");
	}
	
	function recurse_copy($src,$dst) { //Function to copy entire folder recursively 
		$dir = opendir($src); 
		@mkdir($dst); 
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					recurse_copy($src . '/' . $file,$dst . '/' . $file); 
				} 
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
				} 
			} 
		} 
		closedir($dir); 
	} 
	
	function alert_box($type,$title,$text){
		switch($type){
			case "error": echo "<div class='alert error no-margin-top'><span class='icon'></span><span class='close'>x</span><strong>".__("$title")."</strong> ".__("$text")."</div>"; break;
			case "success": echo "<div class='alert success no-margin-top'><span class='icon'></span><span class='close'>x</span><strong>".__("$title")."</strong> ".__("$text")."</div>"; break;
			case "warning": echo "<div class='alert warning no-margin-top'><span class='icon'></span><span class='close'>x</span><strong>".__("$title")."</strong> ".__("$text")."</div>"; break;
			case "information": echo "<div class='alert information no-margin-top'><span class='icon'></span><span class='close'>x</span><strong>".__("$title")."</strong> ".__("$text")."</div>"; break;
			case "note ": echo "<div class='alert note no-margin-top'><span class='icon'></span><span class='close'>x</span><strong>".__("$title")."</strong> ".__("$text")."</div>"; break;
		}
	}
?>