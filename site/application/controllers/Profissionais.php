<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profissionais extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();  

        // verifica se está logado
        if ( !$this->guard->logged() ) redirect( site_url('login') );
    }

	// pagina inicial
	public function index( $pagina = 1 ) {	

    // carrega a model
        $this->load->model( 'Categorias_servicos_model' );
        // pega todas as categorias possiveis
        $servicos = $this->Categorias_servicos_model->getAll();
        $this->template->set( 'servicos',  $servicos );
        
		$this->load->library( 'Planos' );

		// carrega a model
		$this->load->model( 'Profissionais_model' );

		$query = $this->input->get( 'query' ) ? $this->input->get( 'query' ) : '';

		// faz a busca
		$profissionais = $this->Profissionais_model->obterProfissionais( $this->guard->item( 'CodUsuario' ), $pagina, $query );

		// pega o total de resultado
		$total = $this->Profissionais_model->obterTotalProfissionais( $this->guard->item( 'CodUsuario' ), $query );
		$totPag = ceil( $total / 15 );

		$profissionais = array_map( function( $value ) {

			// transforma a data em time stamp
			$time = strtotime( $value['Login'] );

			// transforma em horas
			$horas = floor( ( time() - $time ) / 3600 );

			// pega o total
			$value['Tipo'] = ( $horas > 24 ) ? 'dia(s)' : 'hora(s)';

			// verifica se horas é zero
			if ( $horas == 0 ) {
				$value['Tipo'] = 'Agora mesmo';
				$value['Login'] = false;
			} else if ( $value['Tipo'] == 'dia(s)' ) {
				$value['Login'] = floor( $horas / 24 );
			} else {
				$value['Login'] = $horas;
			}

			// volta o novo objeto
			return $value;
		}, $profissionais );
		$this->template->set( 'profissionais', $profissionais );
		$this->template->set( 'pagina', $pagina );
		$this->template->set( 'total', $totPag );

		// cria a paginacao
		$this->load->library('pagination');
		$config['base_url'] = site_url( 'profissionais' );
		$config['total_rows'] = count( $profissionais );
		$config['per_page'] = 15;
		$this->pagination->initialize($config);

		// seta o link da paginação
		$this->template->set( 'pages', $this->pagination->create_links() );

		// seta a query, se existir
		$this->template->set( 'query', $query );

		// carrega a pagina
		$this->template->set( 'container', 'profissionais' );
		$this->template->render( 'dashboard' );


	}

	// perfis interessados
	public function interessados( $CodAnuncio = false ) {

		// verifica se existe um codigo anuncio
		if ( !$CodAnuncio ) {
			redirect( site_url( 'profissionais/index' ) );
			return false;
		}

		// carrega a model de interessados
		$this->load->model( 'Interesse_model' );

		// pega os candidatos
		$candidatos = $this->Interesse_model->obterCandidatos( $CodAnuncio );		
		$candidatos = array_map( function( $value ) {

			// transforma a data em time stamp
			$time = strtotime( $value['Login'] );

			// transforma em horas
			$horas = floor( ( time() - $time ) / 3600 );

			// pega o total
			$value['Tipo'] = ( $horas >= 24 ) ? 'dia(s)' : 'hora(s)';

			// verifica se horas é zero
			if ( $horas == 0 ) {
				$value['Tipo'] = 'Agora mesmo';
				$value['Login'] = false;
			} else if ( $value['Tipo'] == 'dia(s)' ) {
				$value['Login'] = floor( $horas / 24 );
			} else {
				$value['Login'] = $horas;
			}

			// volta o novo objeto
			return $value;
		}, $candidatos );
		$this->template->set( 'profissionais', $candidatos );
		$this->template->set( 'interessados', 1 );

		// carrega a pagina
		$this->template->set( 'container', 'profissionais' );
		$this->template->render( 'dashboard' );
	}

	// pagina do mapa
	public function mapa_profissionais() {	
		$this->template->set( 'container', 'mapa_profissionais' );
		$this->template->render( 'dashboard' );
	}


	// pagina de perfil do profissional
	public function ver($CodUsuario) {

		// Interessados no perfil
		if($this->guard->user['CodUsuario'] != $CodUsuario){

			$this->load->model('Interesse_profissional_model');
			$interessados = $this->Interesse_profissional_model->visitarPerfil($CodUsuario);

		}
		
		// carrega biblioteca de Planos
		$this->load->model( 'Planos_model' );

		$planos = $this->Planos_model->obterPlano($CodUsuario);

		// carrega a model de Profissionais
		$this->load->model( 'Profissionais_model' );		

		// Busca os dados do perfil
		$dados = $this->Profissionais_model->obterPerfilProfissional($CodUsuario);

		$this->load->model('Avaliacao_model');

        // Avaliacao
        $this->template->set('avaliacoes', $this->Avaliacao_model->getAvaliacoes($this->template->guard->user['CodUsuario']));

		$this->template->set( 'Planos', $planos);
		$this->template->set( 'Dados', $dados);

		// Profissionais relacionados
		$profissionais_relacionados = $this->Profissionais_model->getProfissionaisRelacionados($CodUsuario, $dados['CodCategoriaServico']);

		$profissionais_relacionados = array_map( function( $value ) {

			// transforma a data em time stamp
			$time = strtotime( $value['Login'] );

			// transforma em horas
			$horas = floor( ( time() - $time ) / 3600 );

			// pega o total
			$value['Tipo'] = ( $horas > 24 ) ? 'dia(s)' : 'hora(s)';

			// verifica se horas é zero
			if ( $horas == 0 ) {
				$value['Tipo'] = 'Agora mesmo';
				$value['Login'] = false;
			} else if ( $value['Tipo'] == 'dia(s)' ) {
				$value['Login'] = floor( $horas / 24 );
			} else {
				$value['Login'] = $horas;
			}

			// volta o novo objeto
			return $value;
		}, $profissionais_relacionados );
		
		$this->template->set('profissionais_relacionados', $profissionais_relacionados);


		$this->template->set( 'container', 'ver' );
		$this->template->render( 'dashboard' );
	}


	public function profissionais_relacionados( $CodUsuario, $CodCategoriaServico ) {
		
		$profissionais = $this->Profissionais_model->getProfissionaisRelacionados($CodUsuario, $CodCategoriaServico);

		$this->$template->set('profissionais_relacionados', $profissionais);

	}

    public function favoritos() {

        // Carrega model de interesses anuncios
        $this->load->model('Interesse_model');

        $interessados = $this->Interesse_model->obterCandidadosPorUsuario($this->guard->user['CodUsuario']);

        $this->template->set('interessados', $interessados);

        $this->template->set('container', 'favoritos');
        $this->template->render('minha_conta');

    }



}