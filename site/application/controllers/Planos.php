<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planos extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();
    }

	public function index()
	{
        // carrega biblioteca de Planos
        $this->load->model( 'Planos_model' );

        $planos = $this->Planos_model->obterPlano($this->guard->user['CodUsuario']);

        $this->template->set('plano_usuario', $planos);

        var_dump($planos);

        // seta a pagina
		$this->template->set( 'container', 'planos' );
		$this->template->render( 'minha_conta' );

	}

}

/* End of file planos.php */
/* Location: ./application/controllers/planos.php */