<?php
	//error_reporting(E_ALL);
	session_start();
    include('config.php');
    include('extras/functions.php');
	//print_r($_COOKIE);
    
	//Translate module 
	include("extras/translate.php");
	if(isset($_GET['ln'])) $_SESSION['language'] = $_GET['ln'];
	Language::Set($_SESSION['language']);
	Language::SetAuto(true);
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <link rel="dns-prefetch" href="http://fonts.googleapis.com" />
    <link rel="dns-prefetch" href="http://themes.googleusercontent.com" />
    
    <link rel="dns-prefetch" href="http://ajax.googleapis.com" />
    <link rel="dns-prefetch" href="http://cdnjs.cloudflare.com" />
    <link rel="dns-prefetch" href="http://agorbatchev.typepad.com" />
    
    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <title>HybridSE - <?php echo __("Licensed to") ?> Danone</title>
    <meta name="description" content="Mango is a slick and responsive Admin Template build with modern techniques like HTML5 and CSS3 to be used for backend solutions of any size.">
    <meta name="author" content="Simon Stamm &amp; Markus Siemens">

    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"> 
    <!-- iPhone: Don't render numbers as call links -->
    <meta name="format-detection" content="telephone=no">
    
    <link rel="shortcut icon" href="favicon.ico" />
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
    <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
    
    
    
    
    
    
    
    <!-- The Styles -->
    <!-- ---------- -->
    
    <!-- Layout Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/layout.css">
    
    <!-- Icon Styles -->
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/fonts/font-awesome.css">
    <!--[if IE 8]><link rel="stylesheet" href="css/fonts/font-awesome-ie7.css"><![endif]-->
    
    <!-- External Styles -->
    <link rel="stylesheet" href="css/external/jquery-ui-1.9.1.custom.css">
    <link rel="stylesheet" href="css/external/jquery.chosen.css">
    <link rel="stylesheet" href="css/external/jquery.cleditor.css">
    <link rel="stylesheet" href="css/external/jquery.colorpicker.css">
    <link rel="stylesheet" href="css/external/jquery.elfinder.css">
    <link rel="stylesheet" href="css/external/jquery.fancybox.css">
    <link rel="stylesheet" href="css/external/jquery.jgrowl.css">
    <link rel="stylesheet" href="css/external/jquery.plupload.queue.css">
    <link rel="stylesheet" href="css/external/syntaxhighlighter/shCore.css" />
    <link rel="stylesheet" href="css/external/syntaxhighlighter/shThemeDefault.css" />
    
    <!-- Elements -->
    <link rel="stylesheet" href="css/elements.css">
    <link rel="stylesheet" href="css/forms.css">
    
    <!-- OPTIONAL: Print Stylesheet for Invoice -->
    <link rel="stylesheet" href="css/print-invoice.css">
    
    <!-- Typographics -->
    <link rel="stylesheet" href="css/typographics.css">
    
    <!-- Responsive Design -->
    <link rel="stylesheet" href="css/media-queries.css">
    
    <!-- Bad IE Styles -->
    <link rel="stylesheet" href="css/ie-fixes.css">
    
    
    
    
    
    
    
    <!-- The Scripts -->
    <!-- ----------- -->
    
    <!-- JavaScript at the top (will be cached by browser) -->
    
    
    <!-- Grab frameworks from CDNs -->
        <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-1.8.2.js"><\/script>')</script>
    
        <!-- Do the same with jQuery UI -->
    <!--<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>-->
    <script>window.jQuery.ui || document.write('<script src="js/libs/jquery-ui-1.9.1.js"><\/script>')</script>
    
        <!-- Do the same with Lo-Dash.js -->
    <!--[if gt IE 8]><!-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.8.2/lodash.js"></script>
    <script>window._ || document.write('<script src="js/libs/lo-dash.js"><\/script>')</script>
    <!--<![endif]-->
    <!-- IE8 doesn't like lodash -->
    <!--[if lt IE 9]><script src="http://documentcloud.github.com/underscore/underscore.js"></script><![endif]-->

    <!-- Do the same with require.js -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/require.js/2.0.6/require.js"></script>
    <script>window.require || document.write('<script src="js/libs/require-2.0.6.min.js"><\/script>')</script>
    
    
    <!-- Load Webfont loader -->
    <script type="text/javascript">
        window.WebFontConfig = {
            google: { families: [ 'PT Sans:400,700' ] },
            active: function(){ $(window).trigger('fontsloaded') }
        };
    </script>
    <script defer async src="https://ajax.googleapis.com/ajax/libs/webfont/1.0.28/webfont.js"></script>
    
    <!-- Essential polyfills -->
    <script src="js/mylibs/polyfills/modernizr-2.6.1.js"></script>
    <script src="js/mylibs/polyfills/respond.js"></script>
    <script src="js/mylibs/polyfills/matchmedia.js"></script>
    <!--[if lt IE 9]><script src="js/mylibs/polyfills/selectivizr.js"></script><![endif]-->
    <!--[if lt IE 10]><script src="js/mylibs/polyfills/excanvas.js"></script><![endif]-->
    <!--[if lt IE 10]><script src="js/mylibs/polyfills/classlist.js"></script><![endif]-->
    
    
    <!-- scripts concatenated and minified via build script -->
    
    <!-- Scripts required everywhere -->
    <script src="js/mylibs/jquery.hashchange.js"></script>
    <script src="js/mylibs/jquery.idle-timer.js"></script>
    <script src="js/mylibs/jquery.plusplus.js"></script>
    <script src="js/mylibs/jquery.scrollTo.js"></script>
    <script src="js/mylibs/jquery.ui.touch-punch.js"></script>
    <script src="js/mylibs/jquery.ui.multiaccordion.js"></script>
    <script src="js/mylibs/number-functions.js"></script>
    <script src="js/mylibs/fullstats/jquery.css-transform.js"></script>
    <script src="js/mylibs/fullstats/jquery.animate-css-rotate-scale.js"></script>
    <script src="js/mylibs/forms/jquery.validate.js"></script>
        
    <!-- Do not touch! -->
    <script src="js/mango.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
    
    <!-- Your custom JS goes here -->
    <script src="js/app.js"></script>
    <!-- Load TinyMCE -->
	<script type="text/javascript" src="js/mylibs/tiny_mce/jquery.tinymce.js"></script>
	<script type="text/javascript">
		$().ready(function() {
			$('textarea.tinymce').tinymce({
				// Location of TinyMCE script
				script_url : 'js/mylibs/tiny_mce/tiny_mce.js',

				// General options
				skin : "cirkuit",
				theme : "advanced",
				plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

				// Theme options
				theme_advanced_buttons1 : "pasteword,|,bold,italic,underline,strikethrough,|,styleselect,justifyleft,justifycenter,justifyright,justifyfull,undo,redo,link,unlink,image,|,code,preview,fullscreen,|,search,replace",
                theme_advanced_buttons2 : "",
                theme_advanced_buttons3 : "",
				//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,
				forced_root_block : false, //To don't begin with <p>

				// Example content CSS (should be your site CSS)
				content_css : "css/content.css",
				
				// HTML5 formats
                style_formats : [
                        {title : 'h1', block : 'h1'},
                        {title : 'h2', block : 'h2'},
                        {title : 'h3', block : 'h3'},
                        {title : 'h4', block : 'h4'},
                        {title : 'h5', block : 'h5'},
                        {title : 'h6', block : 'h6'},
                        {title : 'p', block : 'p'},
                ],

				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "lists/template_list.js",
				external_link_list_url : "lists/link_list.js",
				external_image_list_url : "lists/image_list.js",
				media_external_list_url : "lists/media_list.js",

				// Replace values for the template plugin
				template_replace_values : {
					username : "Some User",
					staffid : "991234"
				},
				file_browser_callback : function(field_name, url, type, win) {
                    var w = window.open('../../../../../extras/explorer/elfinder.php', null, 'width=900,height=430');
                    w.tinymceFileField = field_name;
                    w.tinymceFileWin = win;
                }
			});
		});
	</script>
	<!-- /TinyMCE -->

    <!-- end scripts -->
    
</head>
<?//php if($_SESSION['admin_id']!=NULL){ ?>
<?php if($_SESSION['admin_id']!=NULL or $_COOKIE["remember"]!=""){ ?>
<body>
	<?//php what_to_talk("TEST"); ?>
    <!-- ----------------- -->
    <!-- Some dialogs etc. -->

    <!-- The loading box -->
    <!--
	<div id="loading-overlay"></div>
    <div id="loading">
        <span><?php echo __("Loading...") ?></span>
    </div>
	-->
    <!-- End of loading box -->
    
    <!-- The lock screen -->
    <div id="lock-screen" title="Screen Locked">
        
        <a href="?logout" class="header right button grey flat"><?php echo __("Logout") ?></a>
        
        <p><?php echo __("Due to the inactivity of this session, your account was temporarily locked.") ?></p>
        <p><?php echo __("To unlock your account, simply slide the button and enter your password.") ?></p>
        
        <div class="actions">
            <div id="slide_to_unlock">
                <img src="img/elements/slide-unlock/lock-slider.png" alt="<?php echo __("slide me") ?>">
                <span><?php echo __("slide to unlock") ?></span>
            </div>
            <form action="?login" method="POST">
                <input type="password" name="password" id="pwd" placeholder="<?php echo __("Enter your password here...") ?>" autocorrect="off" autocapitalize="off"> 
				<input type="submit" name="send" value="<?php echo __("Unlock") ?>" disabled> 
				<input type="reset" value="X">
            </form>
        </div><!-- End of .actions -->
        
    </div><!-- End of lock screen -->
    
    <!--------------------------------->
    <!-- Now, the page itself begins -->
    <!--------------------------------->
    
    <!-- The toolbar at the top -->
    <section id="toolbar">
        <div class="container_12">
        
            <!-- Left side -->
            <div class="left">
                <ul class="breadcrumb">
                    <li><a href="?">Hybrid</a></li>
					<li><a href="?"><?php echo __("Dashboard")?></a></li>
                </ul>
            </div>
            <!-- End of .left -->
            
            <!-- Right side -->
            <div class="right">
                <ul>
                
                    <li><a href="pages_profile.html"><span class="icon i14_admin-user"></span><?php echo __("Profile") ?></a></li>
                    
                    <li>
                        <a href="#"><span><?php panel_messages("count") ?></span><?php echo __("Messages") ?></a>
                        
                        <!-- Mail popup -->
                        <div class="popup">
                            <h3><?php echo __("New Messages") ?></h3>
                            
                            <!-- Button bar -->
                            <a class="button flat left grey" onclick="$(this).parent().fadeToggle($$.config.fxSpeed)"><?php echo __("Close") ?></a>
                            <a class="button flat right" href="tables_dynamic.html"><?php echo __("Inbox") ?></a>
                            
                            <!-- The mail content -->
                            <div class="content mail">
                                <ul>
									<?php panel_messages("messages") ?>
                                </ul>
                            </div><!-- End of .contents -->
                            
                        </div><!-- End of .popup -->
                    </li><!-- End of li -->
                    
                    <li class="space"></li>
                    
                    <li><a href="javascript:void(0);" id="btn-lock"><span>--:--</span><?php echo __("Lock screen") ?></a></li>
                    
                    <li class="red"><a href="?logout"><?php echo __("Logout") ?></a></li>
                    
                </ul>
            </div><!-- End of .right -->
            
            <!-- Phone only items -->
            <div class="phone">
                
                <!-- User Link -->
                <li><a href="pages_profile.html"><span class="icon icon-user"></span></a></li>
                <!-- Navigation -->
                <li><a class="navigation" href="#"><span class="icon icon-list"></span></a></li>
            
            </div><!-- End of phone items -->
            
        </div><!-- End of .container_12 -->
    </section><!-- End of #toolbar -->
    
    <!-- The header containing the logo -->
    <header class="container_12">
    
        <!-- Your logos -->
        <a href="?"><img src="img/logo.png" alt="Hybrid" width="191" height="60"></a>
        <a class="phone-title" href="?"><img src="img/logo-mobile.png" alt="Hybrid" height="22" width="70" /></a>
        
        <div class="buttons">
            <a href="statistics.html">
                <span class="icon icon-sitemap"></span>
                Statistics
            </a>
            <a href="forms.html">
                <span class="icon icon-list-alt"></span>
                Forms
            </a>
            <a href="tables_dynamic.html">
                <span class="icon icon-table"></span>
                Tables
            </a>
        </div><!-- End of .buttons -->
    </header><!-- End of header -->
    
    <!-- The container of the sidebar and content box -->
    <div role="main" id="main" class="container_12 clearfix">
    
        <!-- The blue toolbar stripe -->
        <section class="toolbar">
            <div class="user">
                <div class="avatar">
                    <img src="<?php echo $_SESSION['admin_avatar']?>" width="26" height="26">
                    <span><?php panel_messages("count") ?></span>
                </div>
                <span><?php echo $_SESSION['admin_username'] ?></span>
                <ul>
                    <li><a href="#"><?php echo __("Settings") ?></a></li>
                    <li><a href="#"><?php echo __("Profile") ?></a></li>
                    <li class="line"></li>
                    <li><a href="?logout"><?php echo __("Logout") ?></a></li>
                </ul>
            </div>
            <ul class="shortcuts">
                <li><a href="javascript:void(0);"><span class="icon i24_user-business"></span></a></li>
                <li><a href="javascript:void(0);"><span class="icon i24_inbox-document"></span></a></li>
                <li><a href="javascript:void(0);"><span class="icon i24_calendar"></span></a></li>
                <li><a href="javascript:void(0);"><span class="icon i24_application-blue"></span></a></li>
            </ul><!-- End of .shortcuts -->
            <input type="search" data-source="extras/search.php" placeholder="<?php echo __("Search...") ?>" autocomplete="off" class="tooltip" title="<?php echo __("Anything")?>" data-gravity="s" x-webkit-speech="x-webkit-speech">
        </section><!-- End of .toolbar-->
        
        <!-- The sidebar -->
        <aside>
            <div class="top">

                
<!-- Navigation -->
                <nav><ul class="collapsible accordion">
                
                    <li class="current"><a href="?"><img src="img/icons/packs/fugue/16x16/dashboard.png" alt="" height=16 width=16><?php echo __("Dashboard") ?></a></li>
                    <li><a href="?"><img src="img/icons/packs/fugue/16x16/ui-layered-pane.png" alt="" height=16 width=16><?php echo __("Pages") ?></a></li>
					<li>
                        <a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/ui-layered-pane.png" alt="" height="16" width="16"><?php echo __("Configurations") ?><span class="badge">6</span></a>
                        <ul>
                            <li><a href="?st=dft2"><span class="icon icon-list"></span><?php echo __("Configurations") ?></a></li>
                            <li><a href="?st=dft3"><span class="icon icon-cog"></span><?php echo __("Backups") ?></a></li>
                            <li><a href="?st=dft4"><span class="icon icon-picture"></span><?php echo __("File Manager") ?></a></li>
                            <li><a href="?st=dft5"><span class="icon icon-th"></span><?php echo __("Help") ?></a></li>
                            <li><a href="?st=dft6"><span class="icon icon-th"></span><?php echo __("Languages") ?></a></li>
                            <li><a href="?st=dft7"><span class="icon icon-th"></span><?php echo __("Recycling") ?></a></li>
                            <li><a href="?st=dft8"><span class="icon icon-th"></span><?php echo __("Stats") ?></a></li>
                            <li><a href="?st=dft9"><span class="icon icon-th"></span><?php echo __("Mail themes") ?></a></li>
                        </ul>
                    </li>
					<li>
                        <a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/ui-layered-pane.png" alt="" height="16" width="16">Webmaster<span class="badge">5</span></a>
                        <ul>
                            <li><a href="?st=wm1"><span class="icon icon-list"></span>Administradores</a></li>
                            <li><a href="?st=wm3"><span class="icon icon-cog"></span>Logs</a></li>
                            <li><a href="?st=wm4"><span class="icon icon-picture"></span>Módulos</a></li>
                            <li><a href="?st=wm2"><span class="icon icon-th"></span>Menu</a></li>
                            <li><a href="?st=wm5"><span class="icon icon-th"></span>SandBox</a></li>
                            <li><a href="?st=wm6"><span class="icon icon-th"></span>Create módulo</a></li>
                        </ul>
                    </li>
					<li>
						<a href="javascript:void(0);"><img src="img/icons/packs/fugue/16x16/ui-layered-pane.png" alt="" height="16" width="16">SandBox<span class="badge">5</span></a>
						<ul>
							<?php
								if ($handle = opendir('modules/sandbox')) {
									$aux_file=1;
									while (false !== ($file = readdir($handle))) {
										if ($file != "." && $file != "..") {
											$myfile=pathinfo($file,PATHINFO_FILENAME);
											echo "<li><a href='?st=sb$aux_file'><span class='icon icon-list'></span>".utf8_encode($myfile)."</a></li>";
											$aux_file++;
										}
									}
									closedir($handle);
								}
							?>
						</ul>
					</li>
                </ul></nav><!-- End of nav -->
                
            </div><!-- End of .top -->
            
            <div class="bottom sticky">
                <div class="divider"></div>
                <div class="progress">
                    <div class="bar" data-title="<?php echo __("Disk Space Usage") ?>" data-value="1285" data-max="5120" data-format="0,0 MB"></div>
                    <div class="bar" data-title="<?php echo __("Bandwidth") ?>" data-value="8.61" data-max="14" data-format="0.00 GB"></div>
                    <div class="bar" data-title="<?php echo __("Email Accounts") ?>" data-value="2" data-max="10" data-format=""></div>
                </div>
            </div><!-- End of .bottom -->
            
        </aside><!-- End of sidebar -->

        <!-- Here goes the content. -->
        <section id="content" class="container_12 clearfix" data-sort=true>
			<?php include("modules.php"); ?>
        </section><!-- End of #content -->
        
    </div><!-- End of #main -->
    
    <!-- The footer -->
    <footer class="container_12">
        <ul class="grid_6">
            <li><a href="http://www.whalelabs.com" target="_blank">Sobre</a></li>
            <li><a href="http://www.whalelabs.com" target="_blank">Clientes</a></li>
            <li><a href="http://www.whalelabs.com" target="_blank">www.whalelabs.com</a></li>
        </ul>
        
        <span class="grid_6">
            Copyright &copy; 2013 Whale
        </span>
    </footer><!-- End of footer -->
    
    <!-- Spawn $$.loaded -->
    <script>
        $$.loaded();
    </script>
    
    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 7 ]>
    <script defer src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->
	<!--<script src="http://cdn.wibiya.com/Toolbars/dir_0765/Toolbar_765618/Loader_765618.js" type="text/javascript"></script><noscript><a href="http://www.wibiya.com/">Web Toolbar by Wibiya</a></noscript> -->
</body>
<?php } else { ?> 
<body class=login>

	<!-- Some dialogs etc. -->

	<!-- The loading box -->
	<!--
	<div id="loading-overlay"></div>
	<div id="loading">
		<span><?php echo __("Loading...") ?></span>
	</div>
	-->
	<!-- End of loading box -->
	
	<!--------------------------------->
	<!-- Now, the page itself begins -->
	<!--------------------------------->
	
	<!-- The toolbar at the top -->
	<section id="toolbar">
		<div class="container_12">
		
			<!-- Left side -->
			<div class="left">
				<ul class="breadcrumb">
					<li><a href="javascript:void(0);">Hybrid</a></li>
					<li><a href="javascript:void(0);"><?php echo __("Login") ?></a></li>
				</ul>
			</div>
			<!-- End of .left -->
			
			<!-- Right side -->
			<div class="right">
				<ul>
					<li><a href="../"><span class="icon i14_bended-arrow-left"></span><?php echo __("Visit site") ?></a></li>
					<li class="red"><a href="http://www.whalelabs.com" target="_blank"><?php echo __("Info") ?></a></li>
				</ul>
			</div><!-- End of .right -->
			
			<!-- Phone only items -->
			<div class="phone">
				
				<!-- User Link -->
				<li><a href="#"><span class="icon icon-home"></span></a></li>
				<!-- Navigation -->
				<li><a href="#"><span class="icon icon-heart"></span></a></li>
			
			</div><!-- End of .phone -->
			
		</div><!-- End of .container_12 -->
	</section><!-- End of #toolbar -->
	
	<!-- The header containing the logo -->
	<header class="container_12">
		
		<div class="container">
		
			<!-- Your logos -->
			<a href="?"><img src="img/logo-light.png" alt="Mango" width="210" height="67"></a>
			<a class="phone-title" href="login.html"><img src="img/logo-mobile.png" alt="Mango" height="22" width="70" /></a>
			
		</div><!-- End of .container -->
	
	</header><!-- End of header -->
	
	<!-- The container of the sidebar and content box -->
	<section id="login" class="container_12 clearfix">
	
		<form action="?login" method="post" class="box validate">
		
			<div class="header">
				<h2><span class="icon icon-lock"></span><?php echo __("Login") ?></h2>
			</div>
			
			<div class="content">
				
				<!-- Login messages -->
				<div class="login-messages">
					<div class="message welcome"><?php echo __("Welcome back!") ?></div>
					<div class="message failure"><?php echo __("Invalid credentials.") ?></div>
				</div>
			
				<!-- The form -->
				<div class="form-box">
				
					<div class="row">
						<label for="login_name">
							<strong><?php echo __("Username") ?></strong>
						</label>
						<div>
							<input tabindex=1 type="text" class="required noerror" name="username" id="login_name" />
						</div>
					</div>
					
					<div class="row">
						<label for="login_pw">
							<strong><?php echo __("Password") ?></strong>
						</label>
						<div>
							<input tabindex=2 type="password" class="required noerror" name="password" id="login_pw" />
						</div>
					</div>
					
				</div><!-- End of .form-box -->
				
			</div><!-- End of .content -->
			
			<div class="actions">
				<div class="left">
					<div class="rememberme">
						<input tabindex=4 type="checkbox" name="login_remember" id="login_remember" checked /><label for="login_remember"><?php echo __("Remember me?") ?></label>
					</div>
				</div>
				<div class="right">
					<input tabindex=3 type="submit" value="<?php echo __("Sign In") ?>" name="login_btn" />
				</div>
			</div><!-- End of .actions -->
			
		</form><!-- End of form -->

	</section>
	
	<!-- Spawn $$.loaded -->
	<script>
		$$.loaded();
	</script>
	
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	   chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7 ]>
	<script defer src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

</body>
<?php } ?>
</html>