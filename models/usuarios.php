<?php
class Usuarios extends model {
      //verificar se tem uma sessao aberta e se está preenchida
	public function verificarLogin() {
		if(
			!isset($_SESSION['lgpainel']) || 
			( isset($_SESSION['lgpainel']) && empty($_SESSION['lgpainel']) )
		)
		{
			header("Location: ".BASE."painel/login");
			exit;
		}
	}
           //conferindo email e senha para entrar no painel
	public function logar($email, $senha) {
		$retorno = '';

		$sql = "SELECT id FROM usuarios WHERE email = '$email' AND senha = '$senha'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
                    //se existe entra no painel
			$f = $sql->fetch();
                         //cria a sessao do usuario
			$_SESSION['lgpainel'] = $f['id'];

			header("Location: ".BASE."painel");
		} else {
			$retorno = 'E-mail e/ou Senha não conferem.';
		}

		return $retorno;
	}

}