<?php
	include("config.php");
	
	function construct_form($id){
		//$sql=mysql_query("SELECT * FROM ")
	}
?>

<form action="" method="POST">
	<label for="nome">Nome: <input type="text" name="nome" id="nome"/></label><br/>
	<label for="telefone">Telefone: <input type="text" name="telefone" id="telefone"/></label><br/>
	<label for="email">E-mail: <input type="text" name="email" id="email"/></label><br/>
	<label for="morada">Morada: <textarea name="morada" id="morada"></textarea></label><br/>
</form>
