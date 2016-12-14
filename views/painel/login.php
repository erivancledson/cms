<form method="POST">
    
    <!--painel de login -->
	E-mail:<br/>
	<input type="email" name="email" /><br/><br/>

	Senha:<br/>
	<input type="password" name="senha" /><br/><br/>

	<input type="submit" value="Entrar" /><br/><br/>
<!--exibe o erro se existir -->
	<?php
	if(!empty($erro)) {
		echo $erro;
	}
	?>
</form>