<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Assinaturas_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'assinatura';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodAssinatura';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // cria uma nova assinatura para o usuário
    public function assinarPlano( $CodPlano, $CodUsuario ) {

        // monta os dados
        $dados = [
            'CodPlano' => $CodPlano,
            'CodUsuario' => $CodUsuario,
            'HoraAssinatura' => date( 'Y-d-m H:i:s', time() )
        ];

    }

    // pega a assinatura atual do cliente
    public function obterAssinaturaUsuario( $CodUsuario ) {

        // monta a busca
        $this->db->from( $this->table )
        ->select( '*' )
        ->where( " CodUsuario = $CodUsuario AND Status = 'A'" );

        // faz a busca
        $busca = $this->db->get();

        // verifica se existem resultado
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : false;
    }
}
