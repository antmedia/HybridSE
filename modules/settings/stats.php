<h1 class="grid_12 margin-top no-margin-top-phone"><?php echo __("Stats") ?></h1>

<div class="grid_12">
	<div class="box">
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png"><?php echo __("Last visits") ?></h2>
		</div>
		<div class="content">
			<div id="widgetIframe"><iframe width="100%" height="350" src="http://localhost/HybridSE/piwik/index.php?module=Widgetize&action=iframe&columns[]=nb_visits&widget=1&moduleToWidgetize=VisitsSummary&actionToWidgetize=getEvolutionGraph&idSite=1&period=day&date=today&disableLink=1&widget=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe>
		</div><!-- End of .content -->
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->

<div class="grid_6">
	<div class="box">
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png"><?php echo __("Visitors Map") ?></h2>
		</div>
		<div class="content">
			<div id="widgetIframe"><iframe width="100%" height="350" src="http://localhost/HybridSE/piwik/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=UserCountryMap&actionToWidgetize=visitorMap&idSite=1&period=day&date=today&disableLink=1&widget=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		</div><!-- End of .content -->
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->

<div class="grid_6">
	<div class="box">
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png"><?php echo __("Real-time visits") ?></h2>
		</div>
		<div class="content">
			<div id="widgetIframe"><iframe width="100%" height="350" src="http://localhost/HybridSE/piwik/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=Live&actionToWidgetize=widget&idSite=1&period=day&date=today&disableLink=1&widget=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		</div><!-- End of .content -->
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->

<div class="grid_6">
	<div class="box">
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png"><?php echo __("Real-time Map") ?></h2>
		</div>
		<div class="content">
			<div id="widgetIframe"><iframe width="100%" height="350" src="http://localhost/HybridSE/piwik/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=UserCountryMap&actionToWidgetize=realtimeMap&idSite=1&period=day&date=today&disableLink=1&widget=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		</div><!-- End of .content -->
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->

<div class="grid_6">
	<div class="box">
		<div class="header">
			<h2><img class="icon" src="img/icons/packs/fugue/16x16/table.png"><?php echo __("Social network") ?></h2>
		</div>
		<div class="content">
			<div id="widgetIframe"><iframe width="100%" height="350" src="http://localhost/HybridSE/piwik/index.php?module=Widgetize&action=iframe&widget=1&moduleToWidgetize=Referers&actionToWidgetize=getSocials&idSite=1&period=day&date=today&disableLink=1&widget=1" scrolling="no" frameborder="0" marginheight="0" marginwidth="0"></iframe></div>
		</div><!-- End of .content -->
	</div><!-- End of .box -->
</div><!-- End of .grid_12 -->