<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Classe para a manipulação de templates
class Guard {

    // instancia do codeigniter
    public $ci;

    // dados do usuario logado
    public $user = false;

    // perfil profissional do usuario
    public $profissional = false;

    // método construtor
    public function __construct() {

        // pega a instancia do ci
        $this->ci =& get_instance();

        // carrega a librarie de sessao
        $this->ci->load->library( 'session' );

        // pega os dados do usuario
        if ( $user = $this->ci->session->userdata( 'user' ) ) {
            $this->user = $user;
        }
        // pega os dados do profissional
        if ( $perfil = $this->ci->session->userdata( 'profissional' ) ) {
            $this->profissional = $perfil;
        }
    }

    // verifica se o usuário atual esta logado
    public function logged(){
        return $this->user ? true : false;
    }

    // pega um item do usuario
    public function item( $key ) {
        return isset( $this->user[$key] ) ? $this->user[$key] : null;
    }

    // faz o login
    public function login( $email, $senha ) {

        // carrega a model de usuários
        $this->ci->load->model( 'Usuarios_model' );

        // faz o login
        if ( $user = $this->ci->Usuarios_model->login( $email, $senha ) ) {
            
            // guarda na sessao
            $this->ci->session->set_userdata( 'user', $user );            
            
            // guarda no atributo
            $this->user = $user;

            // pega os dados do perfil
            $this->profissional_profile();

            return true;
        } else return false;
    }

    public function login_facebook($email){
        $this->ci->load->model('Usuarios_model');

        if($user = $this->ci->Usuarios_model->login_facebook($email)) {

            // guarda na sessao
            $this->ci->session->set_userdata( 'user', $user );            
            
            // guarda no atributo
            $this->user = $user;

            // pega os dados do perfil
            $this->profissional_profile();

            return true;
        }
        else
            return false;
    }

    // faz o update dos dados do usuário logado
    public function update() {

        // verifica se existe um usuário logado
        if ( !$this->user ) return false;

        // carrega a model de usuários
        $this->ci->load->model( 'Usuarios_model' );

        // pega os dados do perfil do usuario logado
        if ( $user = $this->ci->Usuarios_model->obterDadosPerfil( $this->user['CodUsuario'] ) ) {

            // seta a sessao
            $this->ci->session->set_userdata( 'user', $user );

            // seta o usuario
            $this->user = $user;

            // pega os dados do perfil
            $this->profissional_profile();
        } else return false;
    }

    // carrega o perfil profissional
    public function profissional_profile() {

        // verifica se existe um profissional logado
        if ( !$this->logged() ) return false;

        // carrega a model
        $this->ci->load->model( 'Profissionais_model' );

        // verifica se existe um perfil profissional
        if ( $perfil = $this->ci->Profissionais_model->obterPerfilProfissional( $this->user['CodUsuario'] ) ) {
            
            // seta a sessao
            $this->ci->session->set_userdata( 'profissional', $perfil );

            // salva o perfil profissional
            $this->profissional = $perfil;

            return true;
        } else {
            $this->profissional = false;
            return false;
        }
    }

    // verifica se o úsuario já está interessado no anúncio
	public function interessado( $CodAnuncio ){

		// carrega a model
		$this->ci->load->model( 'Interesse_model' );

		// pega o codigo do usuario logado
		$CodUsuario = $this->user['CodUsuario'];

        // chama o metodo da model
		return $this->ci->Interesse_model->jaCandidatou( $CodAnuncio, $CodUsuario );
		
	}

    // faz o logout
    public function logout() {
        $this->ci->session->sess_destroy();
    }
}