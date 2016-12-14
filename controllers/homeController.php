<?php
class homeController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //array de retorno que vai ser enviado para o view home
        $dados = array(
        	'depoimentos' => array()
        );

        // Código para pegar os depoimentos
        $depo = new Depoimentos();
        //dois ele so vai pegar dois depoimentos
        $dados['depoimentos'] = $depo->getDepoimentos(2);
        
        $this->loadTemplate('home', $dados);
    }

}