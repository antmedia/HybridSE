<h1 class="grid_12">Nova instalação</h1>
			
<div class="grid_12">
	<form class="box wizard manual validate" id="wiz">
	
		<div class="header">
			<h2><img src="img/icons/packs/fugue/16x16/ui-tab--arrow.png" class="icon">Wizard</h2>
		</div>
		
		<div class="content">
			<ul class="steps">
				<li><a class="current" href="#tab1">Base de Dados</a></li>
				<li><a href="#tab2">Login Details</a></li>
				<li><a href="#tab3">Finish</a></li>
			</ul>
			<fieldset id="tab1">
				<div class="row">
					<label for="w1_server">
						<strong>Database Server</strong>
						<small>e.g. localhost</small>
					</label>
					<div>
						<input type="text" class="required" name=w1_server id=w1_server />
					</div>
				</div>
				<div class="row">
					<label for="w1_name">
						<strong>Database Name</strong>
					</label>
					<div>
						<input type="text" class="required" value="db_mango" name=w1_name id=w1_name />
					</div>
				</div>
				<div class="row">
					<label for="w1_username">
						<strong>Username</strong>
					</label>
					<div>
						<input type="text" class="required" value="mangosql1" name=w1_username id=w1_username />
					</div>
				</div>
				<div class="row">
					<label for="w1_password">
						<strong>User Password</strong>
					</label>
					<div>
						<input type="password" class="required" value="ThisSecretPassIsCool!" name=w1_password id=w1_password />
					</div>
				</div>
			</fieldset>
			
			<fieldset id="tab2">
				<div class="row">
					<label for="w1_email">
						<strong>E-Mail</strong>
					</label>
					<div>
						<input type="text" class="required" email=true name=w1_email id=w1_email />
					</div>
				</div>
				<div class="row">
					<label for="w1_userpassword">
						<strong>Password</strong>
					</label>
					<div>
						<input type="password" class="required" name=w1_userpassword id=w1_userpassword />
					</div>
				</div>
			</fieldset>
			
			<fieldset id="tab3">
				<div class="alert note top">
					<span class="icon"></span>
					<strong>Congratulations!</strong> You just finished the main steps.
				</div>
				<p>Press &quotFinish&quot; to end this cool Wizard and submit the data.</p>
			</fieldset>
			
		</div><!-- End of .content -->
		
		<div class="actions">
			<div class="left">
				<a href="#" class="button grey"><span><img src="img/icons/packs/fugue/16x16/arrow-180.png" width=16 height=16></span>Back</a>
			</div>
			<div class="right">
				<a href="#" class="button grey"><span><img src="img/icons/packs/fugue/16x16/arrow.png" width=16 height=16></span>Next</a>
				<a href="#" class="button finish"><span><img src="img/icons/packs/fugue/16x16/arrow.png" width=16 height=16></span>Finish</a>
			</div>
		</div><!-- End of .actions -->
		
	</form><!-- End of .box -->
</div><!-- End of .grid_4 -->

<script>
	$$.ready(function(){
		$('#wiz').wizard({
			onSubmit: function(){
				alert('Your Data:\n' + $('form#wiz').serialize());
				return false;
			}
		});
	});
</script>