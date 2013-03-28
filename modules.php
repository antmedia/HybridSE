<?php
	if(isset($_GET['st'])){
		/*
		$sql_inc_modules=mysql_query("SELECT * FROM modules WHERE status_modules='1' ORDER BY sort_modules ASC");  
        while($data_inc_modules=mysql_fetch_array($sql_inc_modules)){
            if($_GET['st']==$data_inc_modules['id_modules']) include("modules/$data_inc_modules[folder_modules]/$data_inc_modules[file_modules]");
            //echo "ID: $data_inc_modules[id_modules] | $data_inc_modules[folder_modules]/$data_inc_modules[file_modules]<br>";
        }
		*/
		if($_GET['st']=='1') include("modules/pages/pages.php");
		
		if($_GET['st']=='fb1') include("modules/facebook/facebook_general.php");
		if($_GET['st']=='fb2') include("modules/facebook/facebook_fans.php");
		if($_GET['st']=='fb3') include("modules/facebook/facebook_page.php");
		if($_GET['st']=='fb4') include("modules/facebook/facebook_reach.php");
		if($_GET['st']=='fb5') include("modules/facebook/facebook_talking.php");

		if($_GET['st']=='dft1') include("modules/settings/profile.php");
		if($_GET['st']=='dft2') include("modules/settings/configurations.php");
		if($_GET['st']=='dft3') include("modules/settings/backups.php");
		if($_GET['st']=='dft4') include("modules/settings/documents.php");
		if($_GET['st']=='dft5') include("modules/settings/help.php");
		if($_GET['st']=='dft6') include("modules/settings/languages.php");
		if($_GET['st']=='dft7') include("modules/settings/recycling.php");
		if($_GET['st']=='dft8') include("modules/settings/stats.php");
		if($_GET['st']=='dft9') include("modules/settings/themes.php");
		if($_SESSION['admin_type']==1) {
			if($_GET['st']=='wm1') include("modules/webmaster/admins.php");
            if($_GET['st']=='wm2') include("modules/webmaster/menu.php");
            if($_GET['st']=='wm3') include("modules/webmaster/logs.php");
            if($_GET['st']=='wm4') include("modules/webmaster/modules.php");
            if($_GET['st']=='wm5') include("modules/webmaster/sandbox.php");
            if($_GET['st']=='wm6') include("modules/webmaster/create_module.php");
			if ($handle = opendir('modules/sandbox')) {
				$aux_file=1;
				while (false !== ($file = readdir($handle))) {
					if ($file != "." && $file != "..") {
						if($_GET['st']=="sb$aux_file") include("modules/sandbox/$file");
						$aux_file++;
					}
				}
				closedir($handle);
			}
		}
	} else include ('modules/home.php');
?>