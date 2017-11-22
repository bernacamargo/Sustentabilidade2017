<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // monta o array de resposta para select relacional
    private function _toSelectInput( $data, $value, $label ) {

        // array de resposta
        $res = [];

        // percorre todos os campos
        foreach( $data as $item ) {
            $res[] = [ 
                'value' => $item[$value],
                'label' => $item[$label]
            ];
        }

        // retorna o resultado obtido
        return $res;
    }

    // seta a resposta
    private function _res( $data = array() ) {
        echo json_encode( array( 'data' => $data ) );
        die();
    }

    // pega as cidades de um estado
    public function obter_cidades( $CodEstado = false ) {
        
        // verifica se existe o codigo do estado
        if ( !$CodEstado ) $this->_res();

        // carrega a model de cidades
        $this->load->model( [ 'Estados_model', 'Cidades_model' ] );

        // verifica se o estado existe
        if ( !$this->Estados_model->getById( $CodEstado ) ) $this->_res();

        // pega todos as cidades do estado
        $cidades = $this->Cidades_model->obterCidadesEstado( $CodEstado );

        // envia as cidades encontradas
        $this->_res( $this->_toSelectInput( $cidades, 'CodCidade', 'Cidade' ) );
    }
}
