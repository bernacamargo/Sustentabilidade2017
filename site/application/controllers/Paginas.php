<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paginas extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();

    }

    // Carrega a home como módulo inicial
    public function index(){

        $this->load->model(['Profissionais_model', 'Anuncios_model', 'Usuarios_model']);

        $total_usuarios = $this->Usuarios_model->obterTotalUsuarios();

        $total_anuncios = $this->Anuncios_model->obterTotalAnuncios2();

        $total_curriculos = $this->Profissionais_model->obterTotalCurriculos();

        $this->template->set('total_usuarios', $total_usuarios);
        $this->template->set('total_anuncios', $total_anuncios);
        $this->template->set('total_curriculos', $total_curriculos);

        $this->template->use_module( 'home' );
        $this->template->set('container', 'Home');
        $this->template->render('home');
    }

    public function sobre() {

        // seta o titulo da pagina
        $this->template->set_title( 'Work for all - Sobre' );

        // renderiza a pagina
		$this->template->render( 'sobre' );
    }

    public function contato() {
        
        $this->enviaEmail();  

        // seta o titulo da pagina
        $this->template->set_title( 'Work for all - Contato' );

        // renderiza a pagina
		$this->template->render( 'contato' );
       

    }

    public function validaFormularioContato() {


         // regras de validacao
        $rules = [
			[
				'field' => 'Nome',
                'label' => 'Nome',
                'rules' => 'required|trim|min_length[2]|max_length[60]'
			], [
                'field' => 'CPF',
                'label' => 'CPF',
                'rules' => 'required|trim|valid_cpf'
            ], [
                'field' => 'CEP',
                'label' => 'CEP',
                'rules' => 'required|trim|integer|max_length[10]'
            ], [
                'field' => 'Email',
                'label' => 'Email',
                'rules' => 'required|trim|valid_email'
            ], [
                'field' => 'Telefone',
                'label' => 'Telefone',
                'rules' => 'required|integer|min_length[10]|max_length[11]'
            ], [
                'field' => 'Mensagem',
                'label' => 'Mensagem',
                'rules' => 'required|trim|min_length[20]'
            ]
        ];

        // valida o formulário
        $this->form_validation->set_rules( $rules );
        
        return $this->form_validation->run();
    }

    public function enviaEmail() {
        
        if ( $this->validaFormularioContato() ) {

            $this->load->library('email');

            $this->email->from( $this->input->post( 'Email' ), $this->input->post( 'Nome' ) );
            $this->email->to( 'vihh.fernando@gmail.com' );

            $this->email->subject('Contato');
            $this->email->message( $this->input->post( 'Nome' ) 
                                   .'<br>CPF:' .$this->input->post( 'CPF' )
                                   .'<br>CEP:' .$this->input->post( 'CEP' )
                                   .'<br>Telefone:' .$this->input->post( 'Telefone' )
                                   .'<br>' .$this->input->post( 'Mensagem' ) );

            $this->email->send();

            $this->template->set( 'sucesso', 'Sua mensagem foi enviada.' );
        } else {
            $this->template->set( 'errors', validation_errors() );
            return false;
        }
    }
}
