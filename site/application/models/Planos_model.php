<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Planos_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'plano';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodPlano';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    public function obterPlanoPadrao() {
        $this->db->from( $this->table )
        ->select('*')
        ->where( "Plano = 'Padrão' " );

        // faz a busca
        $busca = $this->db->get();

        // volta os dados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array()[0] : [];
    }

    public function obterPlanos() {
        $this->db->from( $this->table )
        ->select('*')
        ->where( "Plano <> 'Padrão' " );

        // faz a busca
        $busca = $this->db->get();

        // volta os dados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : [];
    }

    public function obterPlano($CodUsuario) {
        $this->db->from($this->table . ' p')
        ->select('p.*')
        ->join('usuario u', 'u.CodPlano = p.CodPlano')
        ->where('u.CodUsuario = '.$CodUsuario.'');

        // faz a busca
        $busca = $this->db->get();

        // volta os dados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array()[0] : [];
    }

}
