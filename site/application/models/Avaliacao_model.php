<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao_model extends MY_Model {


    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'avaliacao';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodAvaliacao';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    public function getAvaliacoes( $CodProfissional ){

    	$this->db->from($this->table.' a')
        ->join('profissional p', 'p.CodProfissional = a.CodProfissional')
        ->join('usuario u', 'u.CodUsuario = p.CodUsuario')
        ->where('p.CodProfissional = '.$CodProfissional.'');

    	$busca = $this->db->get();

        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : false;
    }

    public function setAvaliacao($CodProfissional, $Nota){

        $dados = [
            'CodUsuario'        => $this->guard->user['CodUsuario'],
            'CodProfissional'   => $CodProfissional,
            'Avaliacao'         => $Nota
        ];

        $this->create($dados);

    }
	

}

/* End of file avaliacao_model.php */
/* Location: ./application/models/avaliacao_model.php */

?>