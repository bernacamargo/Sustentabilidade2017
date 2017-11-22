<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Meu_plano extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();

        // verifica se está logado
        if ( !$this->guard->logged() ) redirect( site_url('login') );
    }

	// pagina inicial
	public function index() {

        $this->load->model('Planos_model');
        $plano = $this->Planos_model->obterPlano($this->template->guard->user['CodUsuario']);

        $this->template->set('plano_usuario', $plano);

        // seta a pagina
		$this->template->set( 'container', 'meu_plano' );
		$this->template->render( 'minha_conta' );
	}

    public function teste() {
        $this->load->library( 'Pagamentos' );
    }

    // mostrar cobrancas
    public function cobrancas() {

        // seta o modulo
        $this->template->use_module( 'cobrancas' );

        // carrega a model
        $this->load->model( 'Cobrancas_model' );

        // pega o codigo do usuario
        $CodUsuario = $this->guard->user['CodUsuario'];

        // carrega as cobrancas
        $this->template->set( 'abertas', $this->Cobrancas_model->obterCobrancasAbertas( $CodUsuario ) );
        $this->template->set( 'transferencias', $this->Cobrancas_model->obterCobrancasUsuarios( $CodUsuario ) );

        // seta a pagina
		$this->template->set( 'container', 'cobrancas' );
		$this->template->render( 'minha_conta' );
    }

    // Cancelar conbrança
    public function cancelarCobranca($CodCobranca) {
        // carrega a model
        $this->load->model( 'Cobrancas_model' );

        if($this->Cobrancas_model->cancelarCobranca($CodCobranca))
            redirect(site_url('meu_plano/cobrancas'));    

    }


    // contrata um novo plano
    public function contratar_plano() {

        // carrega as models necessárias
        $this->load->model( ['Assinaturas_model', 'Planos_model', 'Cobrancas_model', 'Usuarios_model' ] );

        // pega o codigo do usuário
        $CodUsuario = $this->guard->item('CodUsuario');

            // pega o plano que o usuário deseja assinar
            $CodPlano = $this->input->post( 'CodPlano' );

            // tenta obter os dados do plano
            $dadosPlano = $this->Planos_model->getById( $CodPlano );

            // carrega a libary
            $this->load->library('Pagamentos');
            
            // atribui os dados do moip referente ao novo pagamento
            $dadosMoip = $this->pagamentos->novoPagamento($dadosPlano);

            // seta o id do pagamento
            $dadosPlano['IdPagamento'] = $dadosMoip['IdPagamento'];

            // seta o link para realizar o pagamento
            $dadosPlano['Link'] = $dadosMoip['Link'];

            // seta o token
            $dadosPlano['Token'] = $dadosMoip['Token'];

            // manda o link do pagamento para o template
            $this->template->set('linkPagamento', $dadosPlano['Link']);

            // verifica se o plano existe
            if ( !$dadosPlano ) redirect( site_url( 'meu_plano' ) );

            // cria a cobranca
            $this->Cobrancas_model->gerarCobranca( $dadosPlano, $CodUsuario );

            // chama o metodo index
            // $this->index();
            redirect(site_url('meu_plano/cobrancas'));
        
    }

    public function planos () {

        $this->template->set('container', 'planos');
        $this->template->render('minha_conta');
    }

}
