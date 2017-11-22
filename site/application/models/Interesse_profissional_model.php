<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Interesse_profissional_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'interesseprofissional';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodInteresseProfissional';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // metodo que verifica se o candidato ja se candidatou a vaga
    public function visitarPerfil( $CodUsuario) {
        $dados = [
            'CodUsuario' => $CodUsuario,
            'CodUsuarioInteressado' => $this->guard->user['CodUsuario']
        ];

        return $this->create($dados);
    }

    // recupera os interessados no perfil
    public function obterInteressados( $CodUsuario ) {

        // monta a query
        $this->db->from( $this->table.' i' )
        ->select( '*' )
        ->join( 'usuario u', 'i.CodUsuarioInteressado = u.CodUsuario' )
        ->where( "i.CodUsuario = $CodUsuario" )
        ->group_by('i.CodUsuarioInteressado');

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : false;
        
    }

}
