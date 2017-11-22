<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Planos_permissao_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'planopermissao';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodPlanoPermissao';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // verifica se existe uma permissao
    public function existePermissao( $CodPlano, $CodRotina ) {

        // monta a busca
        $this->db->from( $this->table .' p' )
        ->select( 'p.CodPlanoPermissao' )
        ->join('planorotina r', 'p.CodPlanoRotina = r.CodPlanoRotina')
        ->where( "CodPlano = $CodPlano AND REF = $CodRotina" );

        // faz a busca
        $busca = $this->db->get();

        // verifica se existe resultado
        return ( $busca->num_rows() > 0 ) ? true: false;
    }
}
