<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Meus_dados extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();

        // verifica se está logado
        if ( !$this->guard->logged() ) redirect( site_url('login') );
    }

	// pagina inicial
	public function index() {

        // carrega biblioteca de Planos
        $this->load->model( 'Planos_model' );

        $planos = $this->Planos_model->obterPlano($this->guard->user['CodUsuario']);        

        // carrega a model de estados
        $this->load->model( [ 'Estados_model', 'Cidades_model' ] );
        $estados = $this->Estados_model->getAll();
        $this->template->set( 'estados', $estados );

        // pega a cidade do usuario
        $cidade = $this->Cidades_model->getById( $this->guard->item('CodCidade') );
        $this->template->set( 'cidade', $cidade );

        // pega o estado atual
        $estado = $this->Estados_model->getById( $cidade['CodEstado'] );
        $this->template->set( 'estado', $estado );

		// seta a pagina
		$this->template->set( 'container', 'meus_dados' );
		$this->template->render( 'minha_conta' );
	}

	// valida o formulário de cadastro
    private function _validarFormulario() {
        
        // regras de validacao
        $rules = [
			[
				'field' => 'CodUsuario',
                'label' => 'CodUsuario',
                'rules' => 'required'
			], [
                'field' => 'Nome',
                'label' => 'Nome',
                'rules' => 'required|trim|min_length[2]|max_length[60]'
            ], [
                'field' => 'CPF',
                'label' => 'CPF',
                'rules' => 'required|trim'
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
                'rules' => 'required|trim|min_length[11]|max_length[20]'
            ]
        ];

		// verifica se existe uma senha
		if ( $this->input->post( 'Senha' ) && !empty( $this->input->post( 'Senha' ) ) ) {
			$rules[] = [
                'field' => 'Senha',
                'label' => 'Senha',
                'rules' => 'required|min_length[8]|max_length[16]'
            ];
		} 

		// verifica se existe um e-mail
		if ( $this->input->post( 'Email' ) && $this->guard->item('Email') != $this->input->post( 'Email' ) ) {
			$rules[] = [
                'field' => 'Email',
                'label' => 'E-mail',
                'rules' => 'required|trim|valid_email|is_unique[usuario.Email]'
            ];
		}

        // valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
    }

    // valida o formulario de profissionais
    private function _validarPerfilProfissional() {

        // regras de validacao
        $rules = [
			[
				'field' => 'Experiencia',
                'label' => 'Experiencia',
                'rules' => 'integer|max_length[2]required'
			], [
                'field' => 'Servico',
                'label' => 'Servico',
                'rules' => 'integer|max_length[2]required'
            ], [
                'field' => 'Idade',
                'label' => 'Idade',
                'rules' => 'integer|greater_than_equal_to[18]required'
            ], [
                'field' => 'Valor',
                'label' => 'Valor',
                'rules' => 'required|trim'
            ], [
                'field' => 'CEP',
                'label' => 'CEP',
                'rules' => 'required|trim'
            ], [
                'field' => 'Endereco',
                'label' => 'Endereço',
                'rules' => 'required|trim'
            ]
        ];

        // valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
    }

    // salva o perfil profissional
    private function _salvarPerfilProfissional() {

        // verifica se o usuário é válido
        if ( $this->_validarPerfilProfissional() ) {

            // pega os dados
            $dados = [
                'CodUsuario'          => $this->guard->item( 'CodUsuario' ),
                'CodCategoriaServico' => $this->input->post( 'Servico' ),
                'Pais_origem'         => $this->input->post( 'Pais_origem' ),
                'Idade'               => $this->input->post( 'Idade' ),
                'Sobre'               => $this->input->post( 'Sobre' ),
                'Experiencia'         => $this->input->post( 'Experiencia' ),
                'Valor'               => $this->input->post( 'Valor' ),
                'Endereco'            => $this->input->post( 'Endereco' ),
                'CEP'                 => $this->input->post( 'CEP' ),
                'Latitude'            => $this->input->post( 'Latitude' ),
                'Longitude'           => $this->input->post( 'Longitude' ),
                'ativo'               => $this->input->post( 'ativo' )
            ];

            // carrega a model
            $this->load->model( 'Profissionais_model' );

            // tenta salvar o registro
            if ( $registro = $this->Profissionais_model->criarPerfilProfissional( $dados ) ) {
                $this->guard->update();
                $this->template->set( 'success', 'Perfil profissional atualizado com sucesso.' );
            } else {
                $this->template->set( 'errors', 'Não foi possivel criar o perfil profissional.' );
            }
        } else {
            $this->template->set( 'errors', validation_errors() );
            return false;
        }
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
                'CodCidade' => $this->input->post( 'Cidade' ),
                'CEP'       => $this->input->post( 'CEP' ),
                'Endereco'  => $this->input->post( 'Endereco' ),
                'Latitude'  => $this->input->post( 'Latitude' ),
                'Longitude'  => $this->input->post( 'Longitude' )
            ];

			// verifica se existe uma foto
			if ( $file_name ) {
				$userData['Foto'] = $file_name;
			}

			// verifica se existe uma senha
			if ( $this->input->post( 'Senha' ) && !empty( $this->input->post( 'Senha' ) ) ) {
				$userData['Senha'] = md5( $this->input->post( 'Senha' ) );
			}
            
			// seta o id do usuario
			$userData['id'] = $this->guard->user['CodUsuario'];

            // carrega a model e salva o usuario
            $this->load->model( 'Usuarios_model' );
            if ( !$this->Usuarios_model->update( $userData ) ) {
                
				// deleta a foto upada se existir
				if ( isset( $userData['Foto'] ) ) { 
                    $this->picture->delete( $userData['Foto'] );
                }
                
				// seta a mensagem de erro
				$this->template->set( 'errors', 'Houve um erro ao tentar atualizar os dados. Por favor, tente novamente mais tarde.' );

				// retorna false
				return false;

            } else {

                if($this->guard->login($userData['Email'], $this->input->post( 'Senha' ))){
                    // redireciona para a pagina inicial    
                    redirect( site_url() );
                }

                return true;
            }
        } else {
            $this->template->set( 'errors', validation_errors() );
            return false;
        }
    }

    // Editar perfil
    public function editar_perfil($senha = false) {

        if($senha === 'senha'){
            $this->template->set( 'container', 'senha' );
            $this->template->render( 'minha_conta' );
        }
        else{

            // carrega a model de estados
            $this->load->model( [ 'Estados_model', 'Cidades_model' ] );
            $estados = $this->Estados_model->getAll();
            $this->template->set( 'estados', $estados );

            // pega a cidade do usuario
            $cidade = $this->Cidades_model->getById( $this->guard->item('CodCidade') );
            $this->template->set( 'cidade', $cidade );

            // pega o estado atual
            $estado = $this->Estados_model->getById( $cidade['CodEstado'] );
            $this->template->set( 'estado', $estado );
            $this->template->set( 'container', 'editar_dados' );
            $this->template->render( 'minha_conta' ); 
        }
    }

        // valida o formulario de profissionais
    private function _validarAlterarSenha() {

        // regras de validacao
        $rules = [
            [
                'field' => 'Senha_antiga',
                'label' => 'Senha atual',
                'rules' => 'required|min_length[8]|max_length[16]'
            ], [
                'field' => 'Senha_nova',
                'label' => 'Senha nova',
                'rules' => 'required|min_length[8]|max_length[16]'
            ], [
                'field' => 'Senha_nova_confirm',
                'label' => 'Confimar senha nova',
                'rules' => 'required|min_length[8]|max_length[16]'
            ]
        ];

        // valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
    }


    public function alterar_senha() {

        if($this->_validarAlterarSenha()){

            $senha_antiga = md5($this->input->post('Senha_antiga'));
            $senha_nova = md5($this->input->post( 'Senha_nova' ));
            $senha_nova_confirm = md5($this->input->post( 'Senha_nova_confirm' ));

            $this->load->model('Usuarios_model');

            // Verifica se a senha é válida
            if($senha_antiga === $this->guard->user['Senha']){

                // Compara as senhas para ver se conferem
                if($senha_nova === $senha_nova_confirm){

                    // Seta os dados
                    $dados = [
                        'id'                    => $this->guard->item( 'CodUsuario' ),
                        'CodUsuario'            => $this->guard->item( 'CodUsuario' ),
                        'Senha'                 => md5($this->input->post( 'Senha_nova' ))
                    ];

                    // Verifica se atualizou a senha
                    if($this->Usuarios_model->update($dados)){

                        // Atualiza os dados dinamicos
                        $this->guard->update();

                        // Mensagem de retorno
                        $this->template->set('success', 'Senha alterada com sucesso!');
                    }
                    else {
                        // Mensagem de retorno
                        $this->template->set('errors', 'Erro ao atualizar a senha, tente novamente mais tarde.');
                    }

                }
                else{
                    // Senhas não conferem

                    // Mensagem de retorno
                    $this->template->set('errors', 'As senhas digitadas não conferem.');
                }

            }
            else {
                // Senha incorreta
                $this->template->set('errors', 'Senha incorreta. <a href="#" class="">esqueceu sua senha?</a>');
            }
        }
        else {
            $this->template->set( 'errors', validation_errors() );
        }

        $this->template->set( 'container', 'senha' );
        $this->template->render( 'minha_conta' );

    }

    public function excluir_foto() {
        // carrega a librarie de fotos
        $this->load->library( 'Picture' );

        $this->picture->delete( $this->guard->item( 'Foto' ) );
        $this->template->set('container', 'editar_perfil');
        redirect('meus_dados/editar_perfil','location');
    }

    public function salvar_perfil() {

        // carrega a librarie de fotos
        $this->load->library( 'Picture' );

        // seta o usuario
        if ( $this->_salvarUsuario() ) {
            $this->template->set( 'success', 'Dados alterados com sucesso!' );
            // $this->picture->delete( $this->guard->item( 'Foto' ) );
            $this->guard->update();
        }

        $this->template->set( 'container', 'editar_dados' );
        $this->template->render( 'minha_conta' );
        redirect(site_url('meus_dados'),'location');

    }

	// perfil profisional
	public function curriculo() {

        if( !$this->planos->hasPermission( $this->guard->item( 'CodPlano' ), '002' ) ){
			$this->template->set( 'container', 'permissao' );
			$this->template->render( 'dashboard' );
			return false;
		}	

        // carrega o perfil profissional
        $this->guard->update();
        $this->guard->profissional;

        // seta o usuario
		if ( $this->_salvarPerfilProfissional() ) {
			$this->template->set( 'success', 'Dados alterados com sucesso!' );
            $this->guard->update();
		}

        // carrega a model
        $this->load->model( 'Categorias_servicos_model' );

        // carrega a model de estados
        $this->load->model( ['Paises_model', 'Estados_model', 'Cidades_model' ] );
        $paises = $this->Paises_model->getAll();
        $this->template->set( 'paises', $paises );

        $estados = $this->Estados_model->getAll();
        $this->template->set( 'estados', $estados );

        // pega a cidade do usuario
        $cidade = $this->Cidades_model->getById( $this->guard->item('CodCidade') );
        $this->template->set( 'cidade', $cidade );

        // pega todas as categorias possiveis
        $servicos = $this->Categorias_servicos_model->getAll();
        $this->template->set( 'servicos',  $servicos );

        // renderiza a pagina
		$this->template->set( 'container', 'curriculo' );
		$this->template->render( 'minha_conta' );
	}

    // desativar perfil profissional
    public function desativar_perfil($CodUsuario) {
        $this->load->model('Profissionais_model');

        if(!$this->Profissionais_model->obterPerfilProfissional($CodUsuario)){
            // Erro
            $this->template->set('errors', 'Você não possui um currículo cadastrado. Preencha os dados abaixo para criar um perfil profissional.');

            redirect( site_url( 'meus_dados/curriculo' ) );
        }


        // Verifica se pode desativar o perfil
        if($this->Profissionais_model->desativarPerfilProfissional($CodUsuario)){

            // Atualiza os dados
            $this->guard->update();

            // Seta mensagem de sucesso
            $this->template->set('success', 'Perfil desativado com sucesso.');

            redirect( site_url( 'meus_dados/curriculo' ) );
        }
    }

    // ativar perfil profissional
    public function ativar_perfil($CodUsuario) {
        $this->load->model('Profissionais_model');

        if(!$this->Profissionais_model->obterPerfilProfissional($CodUsuario)){
            // Erro
            $this->template->set('errors', 'Você não possui um currículo cadastrado. Preencha os dados abaixo para criar um perfil profissional.');

            // Renderiza a pagina
            $this->template->set('container', 'curriculo');
            $this->template->render('minha_conta');
            return false;            
        }


        // Verifica se pode ativar o perfil
        if($this->Profissionais_model->ativarPerfilProfissional($CodUsuario)){

            // Atualiza os dados
            $this->guard->update();

            // Seta mensagem de sucesso
            $this->template->set('success', 'Perfil ativado com sucesso.');

            // Renderiza a pagina
            $this->template->set('container', 'curriculo');
            $this->template->render('minha_conta');
            redirect(site_url('meus_dados/curriculo'));
            return true;
        }
    }

    // excluir perfil profissional
    public function excluir_perfil($CodUsuario) {
        $this->load->model('Profissionais_model');

        if(!$this->Profissionais_model->obterPerfilProfissional($CodUsuario)){
            // Erro
            $this->template->set('errors', 'Você não possui um currículo cadastrado. Preencha os dados abaixo para criar um perfil profissional.');

            // Renderiza a pagina
            $this->template->set('container', 'curriculo');
            $this->template->render('minha_conta');
            redirect(site_url('meus_dados/curriculo'));   
        }

        // Verifica se pode pode deletar o perfil
        if($this->Profissionais_model->excluirPerfilProfissional($CodUsuario)){

            // Atualiza os dados
            $this->guard->profissional = false;
            // $this->guard->update();

            // Seta mensagem de sucesso
            $this->template->set('success', 'Perfil excluído com sucesso.');

            // Renderiza a pagina
            $this->template->set('container', 'curriculo');
            $this->template->render('minha_conta');
            redirect(site_url('meus_dados/curriculo'));            
            return true;
        }
        else
            return false;
    }

    public function interessados() {

        // verifica se o usuario tem permissao para ver um módulo
        if( !$this->planos->hasPermission( $this->guard->item( 'CodPlano' ), '006' ) ){
            $this->template->set( 'container', 'permissao' );
            $this->template->render( 'dashboard' );
            return false;
        }

        // Carrega model de interesses
        $this->load->model('Interesse_profissional_model');


        $interessados = $this->Interesse_profissional_model->obterInteressados($this->guard->user['CodUsuario']);

        $this->template->set('interessados', $interessados);


        $this->template->set('container', 'interessados');
        $this->template->render('minha_conta');

        return true;
        

    }



}
