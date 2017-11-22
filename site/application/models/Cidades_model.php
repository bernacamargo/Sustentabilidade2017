<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cidades_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'cidade';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodCidade';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // pega as cidades de um estado
    public function obterCidadesEstado( $CodEstado ) {

        // prepara a busca
        $this->db->from( $this->table )
        ->select( '*' )
        ->where( "CodEstado = $CodEstado" );

        // faz a busca
        $busca = $this->db->get();

        // retorna os dados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array(): array();
    }
}
