<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller {

    // metodo construtor
    public function __construct() {
        parent::__construct();
        $this->load->library( 'Picture' );

        // carrega o css
        $this->template->use_module( 'signup' );

        // verifica se está logado
        if ( $this->guard->logged() ) redirect( site_url() );
    }

    // valida o formulário de cadastro
    private function _validarFormulario() {
        
        // regras de validacao
        $rules = [
            [
                'field' => 'Nome',
                'label' => 'Nome',
                'rules' => 'required|trim|min_length[2]|max_length[60]'
            ], [
                'field' => 'CPF',
                'label' => 'CPF',
                'rules' => 'required|trim'
            ], [
                'field' => 'Email',
                'label' => 'E-mail',
                'rules' => 'required|trim|valid_email|is_unique[usuario.Email]'
            ], [
                'field' => 'Senha',
                'label' => 'Senha',
                'rules' => 'required|min_length[8]|max_length[16]'
            ], [
                'field' => 'Estado',
                'label' => 'Estado',
                'rules' => 'required|trim|integer'
            ], [
                'field' => 'Cidade',
                'label' => 'Cidade',
                'rules' => 'required|trim|integer'
            ], [
                'field' => 'CEP',
                'label' => 'CEP',
                'rules' => 'required|trim|max_length[10]'
            ], [
                'field' => 'Endereco',
                'label' => 'Endereco',
                'rules' => 'required|trim|min_length[10]|max_length[255]'
            ], [
                'field' => 'Celular',
                'label' => 'Celular',
                'rules' => 'required|trim|min_length[11]|max_length[255]'
            ]

        ];

        // valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
    }

    // salva o usuario
    private function _salvarUsuario() {
        // verifica se o usuário é válido
        if ( $this->_validarFormulario() ) {

            // faz o upload da imagem
            $file_name = $this->picture->upload( 'Foto', [ 'square' => 200 ] );

            // pega os dados do usuário
            $userData = [
                'Nome'      => $this->input->post( 'Nome' ),
                'CPF'       => $this->input->post( 'CPF' ),
                'Celular'   => $this->input->post( 'Celular' ),
                'Email'     => $this->input->post( 'Email' ),
                'Senha'     => md5( $this->input->post( 'Senha' ) ),
                'CodCidade' => $this->input->post( 'Cidade' ),
                'CodPlano'  => 1,
                'CEP'       => $this->input->post( 'CEP' ),
                'Endereco'  => $this->input->post( 'Endereco' ),
                'Foto'      => $file_name ? $file_name : null
            ];

            // carrega a model e salva o usuario
            $this->load->model( 'Usuarios_model' );
            if ( !$this->Usuarios_model->create( $userData ) ) {
                $this->picture->delete( $userData['Foto'] );
            } else {

                if($this->guard->login($userData['Email'], $this->input->post( 'Senha' ))){
                    return true;
                }
            }
        } else {
            $this->template->set( 'errors', validation_errors() );
            return false;
        }
    }

    // exibe o formulario de cadastro
	public function index() {

        // carrega a model de estados
        $this->load->model( 'Estados_model' );
        $estados = $this->Estados_model->getAll();
        $this->template->set( 'estados', $estados );

        $this->load->model( 'Paises_model' );
        $paises = $this->Paises_model->getAll();
        $this->template->set( 'paises', $paises );

        // seta o titulo da pagina
        $this->template->set_title( 'Work for All - Cadastrar' );
        
        // carrega a pagina de cadastro
		$this->template->render( 'signup' );
	}


    public function profissional () {

        // se criar o usuário
        if ( $this->_salvarUsuario() ) {
            redirect( site_url('meus_dados/curriculo') );
            exit();
        }

        // carrega a model de estados
        $this->load->model( 'Estados_model' );
        $estados = $this->Estados_model->getAll();
        $this->template->set( 'estados', $estados );

        // seta o titulo da pagina
        $this->template->set_title( 'Work for all - Cadastrar' );
        $this->template->set('container', 'profissional');
        $this->template->render('signup');
    }

    public function contratante () {
        // se criar o usuário
        if ( $this->_salvarUsuario() ) {
            redirect( site_url('anuncios/criar_anuncio') );
            exit();
        }

        // carrega a model de estados
        $this->load->model( 'Estados_model' );
        $estados = $this->Estados_model->getAll();
        $this->template->set( 'estados', $estados );

        // seta o titulo da pagina
        $this->template->set_title( 'Work for all - Cadastrar' );
        $this->template->set('container', 'contratante');
        $this->template->render('signup');        
    }
}

