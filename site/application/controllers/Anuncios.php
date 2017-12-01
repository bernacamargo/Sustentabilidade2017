<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Anuncios extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();  

        // adiciona o css
        $this->template->use_module( 'anuncios' );

		// carrega o model
		$this->load->model( 'Anuncios_model' );

        // verifica se está logado
        if ( !$this->guard->logged() ) redirect( site_url('') );
    }

	// pagina inicial
	public function index( $pagina = 1 ) {
		$this->load->model('Interesse_model');

        $this->load->model( 'Categorias_servicos_model' );
        // pega todas as categorias possiveis
        $servicos = $this->Categorias_servicos_model->getAll();
        $this->template->set( 'servicos',  $servicos );


		// pega os dados para a busca
		$CodUsuario = $this->guard->user['CodUsuario'];
		$query      = $this->input->get( 'query' ) ? $this->input->get( 'query' ) : '';

		// Visualização dos anuncios
		$anuncios_aux = $this->Anuncios_model->obterPagina( $CodUsuario, $pagina, $query );	
		foreach ($anuncios_aux as $aux) {
			if(!$this->Anuncios_model->jaVisualizou($aux['CodAnuncio'])){
				$this->Anuncios_model->visualizarAnuncio($aux['CodAnuncio']);
			}
		}
		
		// carrega os anuncios da pagina
		$anuncios = $this->Anuncios_model->obterPagina( $CodUsuario, $pagina, $query );

		// pega o total de resultado
		$total = $this->Anuncios_model->obterTotalAnuncios( $CodUsuario, $query );
		$totPag = ceil( $total / 15 );

		// filtra os anuncios
		$anuncios = array_map( function( $value ) {

			$value['Visualizacoes'] = $this->Anuncios_model->getVisualizacoes($value['CodAnuncio']);
			$value['Interessados'] =  count($this->Interesse_model->obterCandidatos($value['CodAnuncio']));

			// transforma a data em time stamp
			$time = strtotime( $value['Data'] );

			// transforma em horas
			$horas = floor( ( time() - $time ) / 3600 );

			// pega o total
			$value['Tipo'] = ( $horas >= 24 ) ? 'dia(s)' : 'hora(s)';

			// verifica se horas é zero
			if ( $horas == 0 ) {
				$value['Tipo'] = 'Agora mesmo';
				$value['Data'] = false;
			} else if ( $value['Tipo'] == 'dia(s)' ) {
				$value['Data'] = floor( $horas / 24 );
			} else {
				$value['Data'] = $horas;
			}

			// volta o novo objeto
			return $value;
		}, $anuncios );

		// seta a query, se existir
		$this->template->set( 'query', $query );
		$this->template->set( 'pagina', $pagina );
		$this->template->set( 'total', $totPag );

		// seta os anuncios
		$this->template->set( 'anuncios', $anuncios );

		// carrega a pagina
		$this->template->set( 'container', 'anuncios' );
		$this->template->render( 'dashboard' );
	}

	// valida o formulario
	private function _validarAnuncio() {

		// regras de validacao
        $rules = [
			[
				'field' => 'Servico',
                'label' => 'Serviço',
                'rules' => 'required'
			], [
                'field' => 'Frequencia',
                'label' => 'Frequência',
                'rules' => 'required'
            ], [
                'field' => 'Salario',
                'label' => 'Salário',
                'rules' => 'required|trim'
            ], [
                'field' => 'CEP',
                'label' => 'CEP',
                'rules' => 'required|trim'
            ], [
                'field' => 'Quando',
                'label' => 'Quando',
                'rules' => 'required|trim'
            ], [
                'field' => 'Descricao',
                'label' => 'Descricao',
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

	// salva o anuncio
	private function _criarAnuncio( $CodAnuncio = false ) {

		// verifica se o formulário é válido
		if ( $this->_validarAnuncio() ) {

			// prepara os dados
			$dados = [
				'CodUsuario'          => $this->guard->item( 'CodUsuario' ),
				'CodCategoriaServico' => $this->input->post( 'Servico' ),
				'Descricao'           => $this->input->post( 'Descricao' ),
				'Valor'               => $this->input->post( 'Salario' ),
				'Frequencia'          => $this->input->post( 'Frequencia' ),
				'CEP'                 => $this->input->post( 'CEP' ),
				'Quando'              => $this->input->post( 'Quando' ),
				'Endereco'            => $this->input->post( 'Endereco' ),
				'Latitude'            => $this->input->post( 'Latitude' ),
				'Longitude'           => $this->input->post( 'Longitude' ),
				'Data'                => date( 'Y-m-d H:i:s', time() )
			];

			// verifica se existe um id
			if ( $CodAnuncio ) {
				$dados['id'] = $CodAnuncio;

				// tenta salvar
				if ( $anuncio = $this->Anuncios_model->update( $dados ) ) {

					// mensagem de sucesso
					$this->template->set( 'success', 'Anúncio editado com sucesso!' );
					return true;
				} else return false;
			}

			// tenta criar o anuncio
			if ( $anuncio = $this->Anuncios_model->criarAnuncio( $dados ) ) {

				// mensagem de sucesso
				$this->template->set( 'success', 'Anúncio criado com sucesso!' );
				return true;
			} else {

				// seta os erros
				$this->template->set( 'errors', 'Não foi possivel criar o anúncio' );
			}
		} else {

			// seta os erros de validação
			$this->template->set( 'errors', validation_errors() );
		}
		
		// retorna false por padrao
		return false;
	}

    // pagina inicial
	public function meus_anuncios() {

		if( !$this->planos->hasPermission( $this->guard->item( 'CodPlano' ), '007' ) ){
			$this->template->set( 'container', 'permissao' );
			$this->template->render( 'dashboard' );
			return false;
		}

		$visualizacoesTotais 	= $this->Anuncios_model->getAllVisualizacoesECandidatos()['visualizacoes'];
		$candidatosTotais 		= $this->Anuncios_model->getAllVisualizacoesECandidatos()['candidatos'];

		if($visualizacoesTotais->num_rows() == 0)
			$visualizacoesTotais = false;

		if($candidatosTotais->num_rows() == 0)
			$candidatosTotais = false;

		// Pega o total de visualizacoes separados por dia
		$this->template->set('visualizacoesTotais', $visualizacoesTotais);
		$this->template->set('candidatosTotais', $candidatosTotais);

		// carrega os models
		$this->load->model('Interesse_model');
		$anuncios = $this->Anuncios_model->obterAnunciosUsuarios( $this->guard->item( 'CodUsuario') );
		$anuncios = array_map( function( $value ) {

			$value['Visualizacoes'] = $this->Anuncios_model->getVisualizacoes($value['CodAnuncio']);
			$value['Interessados'] =  count($this->Interesse_model->obterCandidatos($value['CodAnuncio']));

			// volta o novo objeto
			return $value;
		}, $anuncios );

		$total_anuncios = $this->Anuncios_model->obterTotalAnuncios2();
		$this->template->set( 'anuncios', $anuncios );
		$this->template->set('total_anuncios', $total_anuncios);

		// mostra os anuncios
		$this->template->set( 'container', 'meus_anuncios' );
		$this->template->render( 'minha_conta' );
	}

	// exclui um anuncio
	public function excluir_anuncio(  $CodAnuncio = false  ) {

		// verifica se o anuncio existe
		if ( $anuncio = $this->Anuncios_model->getById( $CodAnuncio ) ) { 
			
			// verifica se o usuario logado é o mesmo
			if ( $anuncio['CodUsuario'] == $this->guard->item( 'CodUsuario' ) ){

				// deleta o anuncio
				$this->Anuncios_model->delete( $anuncio['CodAnuncio'] );
			}
		}

		// redireciona
		redirect( site_url( 'anuncios/meus_anuncios' ) );
	}

	// pagina de formulario de anuncio
	public function criar_anuncio( $CodAnuncio = false ) {	

		// verifica se o codigo do anuncio foi informado
		if ( $CodAnuncio ) {
			if ( $anuncio = $this->Anuncios_model->getById( $CodAnuncio ) ) {
				$this->template->set( 'anuncio', $anuncio );
				$this->template->set( 'CodAnuncio', $anuncio['CodAnuncio'] );
			} else $CodAnuncio = false;
		}

		// tenta criar o anuncio
		$this->_criarAnuncio( $CodAnuncio );

		// carrega as models necessárias
		$this->load->model( 'Categorias_servicos_model' );

		// carrega as categorias de serviços disponiveis
		$servicos = $this->Categorias_servicos_model->getAll();
		$this->template->set( 'servicos', $servicos );

		// seta a pagina
		$this->template->set( 'container', 'criar_anuncio' );
		$this->template->render( 'minha_conta' );
	}

	// pagina do mapa
	public function mapa_anuncios() {	
		$this->template->set( 'container', 'mapa_anuncios' );
		$this->template->render( 'dashboard' );
	}

	// cadastra o candidato como interessado na vaga
	public function interesse( $CodAnuncio ) {

		// carrega a model
		$this->load->model( 'Interesse_model' );

		// pega o codigo do usuario logado
		$CodUsuario = $this->guard->item( 'CodUsuario');
		
		// chama o metodo da model
		$this->Interesse_model->candidatarSe( $CodAnuncio, $CodUsuario );

		redirect( site_url( 'anuncios' ) );
	}

	// cadastra o candidato como interessado na vaga
	public function desistir( $CodAnuncio ) {

		// carrega a model
		$this->load->model( 'Interesse_model' );

		// pega o codigo do usuario logado
		$CodUsuario = $this->guard->item( 'CodUsuario');
		
		// chama o metodo da model
		$this->Interesse_model->desistir( $CodAnuncio, $CodUsuario );

		redirect( site_url( 'anuncios' ) );
	}


}
