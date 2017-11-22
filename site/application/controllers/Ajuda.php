<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajuda extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();  
    }

    public function index() {

    }

	// pagina vistos
	public function vistos() {
		// carrega a pagina
		$this->template->set( 'container', 'vistos' );
		$this->template->render( 'ajuda' );
	}

	// pagina links uteis
	public function links_uteis() {
		// carrega a pagina
		$this->template->set( 'container', 'links_uteis' );
		$this->template->render( 'ajuda' );
	}



}
