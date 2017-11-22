<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao extends MY_Controller {
	// metodo construtor
    public function __construct() {
        parent::__construct();  

		// carrega o model
		$this->load->model( 'Avaliacao_model' );

        // verifica se está logado
        if ( !$this->guard->logged() ) redirect( site_url('login') );
    }

	public function index()
	{
		
	}

	public function obterAvaliacoes($CodProfissional){

		$avaliacoes = $this->Avaliacao_model->getAvaliacoes($CodProfissional);
		
	}

    public function avaliar($CodProfissional, $Nota){

        $this->Avaliacao_model->setAvaliacao($CodProfissional, $Nota);

        $this->load->model('Profissionais_model');
        $profissional = $this->Profissionais_model->obterPerfilProfissional_CodProf($CodProfissional);
        $CodUsuario = $profissional['CodUsuario'];

        redirect(site_url('profissionais/ver/'.$CodUsuario),'location');

    }
}

/* End of file avaliacao.php */
/* Location: ./application/controllers/avaliacao.php */