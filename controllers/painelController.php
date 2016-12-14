<?php

//controller do painel do adm
class painelController extends controller {

	public function __construct() {
        parent::__construct();
    }

    public function index() {
        $u = new Usuarios();
        $u->verificarLogin();

        $dados = array();
        //paginas do menu do painel do adm
        $p = new Paginas();
        $dados['paginas'] = $p->getPaginas();
          
        $this->loadTemplateInPainel('painel/home', $dados);
    }
  //pagina de manus do painel
    public function menus() {
        $u = new Usuarios();
        $u->verificarLogin();

        $dados = array();

        $m = new Menu();
        $dados['menus'] = $m->getMenu();

        $this->loadTemplateInPainel('painel/menus', $dados);
    }
  //botão de excluir dos menus
    public function menus_del($id) {
        $u = new Usuarios();
        $u->verificarLogin();

        $m = new Menu();
        //model/menu
        $m->delete($id);
        //redireciona para a listagem de menus
        header("Location: ".BASE.'painel/menus');
    }
    //botão editar menu
    public function menus_edit($id) {
        $u = new Usuarios();
        $u->verificarLogin();

        $dados = array();
        $m = new Menu();

        if(isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $url = addslashes($_POST['url']);

            $m->update($nome, $url, $id);
            header("Location: ".BASE."painel/menus");
            exit;
        }

        $dados['menu'] = $m->getMenu($id);

        $this->loadTemplateInPainel('painel/menus_edit', $dados);
    }
   //adicionar um menu
    public function menus_add() {
        $u = new Usuarios();
        $u->verificarLogin();

        $dados = array();
        $m = new Menu();

        if(isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $url = addslashes($_POST['url']);

            $m->insert($nome, $url);
            header("Location: ".BASE."painel/menus");
            exit;
        }

        $this->loadTemplateInPainel('painel/menus_add', $dados);
    }
    //deleta a pagina no painel
    public function pagina_del($id) {
        $u = new Usuarios();
        $u->verificarLogin();

        $p = new Paginas();
        $p->delete($id);

        header("Location: ".BASE.'painel');
    }
    //edita as paginas do painel
    public function pagina_edit($id) {
        $u = new Usuarios();
        $u->verificarLogin();

        $dados = array();
        $p = new Paginas();

        if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
            $titulo = utf8_decode(addslashes($_POST['titulo']));
            $url = addslashes($_POST['url']);
            $corpo = addslashes($_POST['corpo']);

            $p->update($titulo, $url, $corpo, $id);
            header("Location: ".BASE."painel");
            exit;
        }

        $dados['pagina'] = $p->getPaginaById($id);

        $this->loadTemplateInPainel('painel/pagina_edit', $dados);
    }
   //adicionando uma pagina
    public function pagina_add() {
        $u = new Usuarios();
        $u->verificarLogin();

        $dados = array();
        $p = new Paginas();
 
        if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
            $titulo = utf8_decode(addslashes($_POST['titulo']));
            $url = addslashes($_POST['url']);
            $corpo = addslashes($_POST['corpo']);
            $p->insert($titulo, $url, $corpo);
          //inserindoo menu automatico
            if(isset($_POST['add_menu']) && !empty($_POST['add_menu'])) {
                $m = new Menu();
                $m->insert($titulo, $url);
            }

            header("Location: ".BASE."painel");
            exit;
        }

        $this->loadTemplateInPainel('painel/pagina_add', $dados);
    }
 //configurações do painel
    public function config() {
        $u = new Usuarios();
        $u->verificarLogin();
          $dados = array();
        if(isset($_POST['site_title']) && !empty($_POST['site_title'])) {
              
              
            $site_title = addslashes($_POST['site_title']);
            $home_welcome = addslashes($_POST['home_welcome']);
            $site_template = addslashes($_POST['site_template']);
            $home_banner = addslashes($_POST['home_banner']);
            
         


			if(!empty($imagem['home_banner'])) {
                                //gera o nome da imagem
				$home_banner = md5(time().rand(0,9999)).'.jpg';
                                //tipos permitidos da imagem
				$types = array('image/jpeg', 'image/jpg', 'image/png');
                                //salvando a imagem
				if(in_array($imagem['type'], $types)) {
					move_uploaded_file($imagem['home_banner'], "/assets/images/".$home_banner);
					
					
				}

                        }

		
            
            
            
            
            $c = new Config();
            //alterando as configurações do site, no menu configurações do painel, model config é aonde esta o update
            $c->setPropriedade('site_title', $site_title);
            $c->setPropriedade('home_welcome', $home_welcome);
            $c->setPropriedade('site_template', $site_template);
            $c->setPropriedade('home_banner', $home_banner);  
            header("Location: ".BASE."painel/config");
            exit;
        }

       

        $this->loadTemplateInPainel('painel/config', $dados);
    }

    public function login() {
    	$dados = array(
    		'erro' => ''
    	);
          //verifica email e senha
    	if(isset($_POST['email']) && !empty($_POST['email'])) {
    		$email = addslashes($_POST['email']);
    		$senha = md5($_POST['senha']);
                //verificar se existe o usuario
                // se der algum erro ele vai para o login
    		$u = new Usuarios();
    		$dados['erro'] = $u->logar($email, $senha);
    	}

    	$this->loadView("painel/login", $dados);
    }
   //saindo do painel
    public function logout() {
    	unset($_SESSION['lgpainel']);
    	header("Location: ".BASE."painel/login");
		exit;
    }

}