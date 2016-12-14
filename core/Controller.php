<?php
class controller {

	private $config;

	public function __construct() {
		$cfg = new Config();
		$this->config = $cfg->getConfig();
	}
	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		include 'views/templates/'.$this->config['site_template'].'.php';
	}
          //do painel adm
	public function loadTemplateInPainel($viewName, $viewData = array()) {
		include 'views/painel.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}
        //ele vai carregar o model menu e pegar as informacoes
        //jogar no template
	public function loadMenu() {
		$m = array();
		$menu = new Menu();		
		$m['menu'] = $menu->getMenu();
                //loadView carrega um view qualquer
                //nesse caso vai ser o view menu
		$this->loadView("menu", $m);		
	}

}