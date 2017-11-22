<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Interesse_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'interesseanuncio';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'Codigo';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // metodo que verifica se o candidato ja se candidatou a vaga
    public function jaCandidatou( $CodAnuncio, $CodUsuario) {
        $this->db->from( $this->table )
        ->where("CodAnuncio = '$CodAnuncio' && CodUsuario = '$CodUsuario'");

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? true : false;
    }

    // metodo que seta o usuario como um candidato a vaga
    public function candidatarSe( $CodAnuncio, $CodUsuario) {
        $dados = [
            'CodAnuncio'    => $CodAnuncio,
            'CodUsuario'    => $CodUsuario,
            'Data'          => date("Y-m-d", time())
        ];
        return $this->create( $dados );
    }

    // recupera os cadidatos a uma vaga
    public function obterCandidatos( $CodAnuncio ) {

        // monta a query
        $this->db->from( $this->table.' i' )
        ->select( 'i.*,u.*,p.*,c.*' )
        ->join( 'usuario u', 'i.CodUsuario = u.CodUsuario' )
        ->join( 'profissional p', 'p.CodUsuario = u.CodUsuario' )
        ->join( 'categoriaservico c', 'c.CodCategoriaServico = p.CodCategoriaServico' )
        ->where( "i.CodAnuncio = $CodAnuncio" );

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : [];
    }

    // metodo que seta o usuario como um candidato a vaga
    public function desistir( $CodAnuncio, $CodUsuario) {

        $this->db->where("CodAnuncio = '$CodAnuncio' && CodUsuario = '$CodUsuario'");        

        return $this->db->delete( $this->table );
    }

    public function obterCandidadosPorUsuario($CodUsuario) {

        // monta a query
        $busca = $this->db->query("SELECT i.*, u.*, p.*, c.* FROM interesseanuncio AS i JOIN anuncio AS a ON a.CodAnuncio = i.CodAnuncio JOIN usuario AS u ON i.CodUsuario = u.CodUsuario JOIN profissional AS p ON p.CodUsuario = i.CodUsuario JOIN categoriaservico AS c ON c.CodCategoriaServico = p.CodCategoriaServico WHERE a.CodUsuario = '$CodUsuario' GROUP BY i.CodUsuario");

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : false;        

    }
    public function obterTodosCandidados() {

        // monta a query
        $busca = $this->db->query("SELECT i.*, u.*, p.*, c.* FROM interesseanuncio AS i JOIN anuncio AS a ON a.CodAnuncio = i.CodAnuncio JOIN usuario AS u ON i.CodUsuario = u.CodUsuario JOIN profissional AS p ON p.CodUsuario = i.CodUsuario JOIN categoriaservico AS c ON c.CodCategoriaServico = p.CodCategoriaServico  GROUP BY i.data");

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : false;        

    }

}
