<?php
class Core {

	public function run() {
        $url = explode('index.php', $_SERVER['PHP_SELF']);
        $url = end($url);

		$params = array();
		if(!empty($url)) {
			$url = explode('/', $url);
			array_shift($url);

			$currentController = $url[0].'Controller';
			array_shift($url);

			if(isset($url[0])) {
				$currentAction = $url[0];
				array_shift($url);
			} else {
				$currentAction = 'index';
			}

			if(count($url) > 0) {
				$params = $url;
			}

		} else {
			$currentController = 'homeController';
			$currentAction = 'index';
		}
                   //para saber se o controle existe
		if(file_exists('controllers/'.$currentController.'.php')) {
			$c = new $currentController();
		} else {
                    // o que for pagina é esse paginaController
			$c = new paginaController();
			$currentAction = "index";
			$pNome = explode("Controller", $currentController);
			$pNome = $pNome[0];
			$params = array($pNome);
		}

		call_user_func_array(array($c, $currentAction), $params);

	}

}