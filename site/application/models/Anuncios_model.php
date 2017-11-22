<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Anuncios_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'anuncio';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodAnuncio';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // cria o anuncio
    public function criarAnuncio( $dados ) {

        // cria o anuncio
        return $this->create( $dados );
    }

    // pega os anuncios de um usuário
    public function obterAnunciosUsuarios( $CodUsuario ) {

        // prepara a busca
        $this->db->from( $this->table.' a' )
        ->select( 'a.*, c.Categoria' )
        ->join( 'categoriaservico c', 'a.CodCategoriaServico = c.CodCategoriaServico' )
        ->where( "a.CodUsuario = $CodUsuario" );

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return  ( $busca->num_rows() > 0 ) ? $busca->result_array() : array();
    }

    // pega o total de anuncios
    public function obterTotalAnuncios( $CodUsuario, $query = '' ){

        $where = "a.CodUsuario <> $CodUsuario";
        if ( strlen( trim( $query ) ) > 0 )
            $where .= " AND c.Categoria LIKE '%$query%'";

        // monta a busca
        $this->db->from( $this->table.' a' )
        ->select( 'a.*, c.*, u.Endereco' )
        ->join( 'usuario u', "u.CodUsuario = a.CodUsuario" )
        ->join( 'categoriaservico c', 'c.CodCategoriaServico = a.CodCategoriaServico' )
        ->where( $where );

        // faz a busca
        $busca = $this->db->get();

        // retorno os resultados
        return $busca->num_rows();
    }

    // pega o total de anuncios
    public function obterTotalAnuncios2(){

        // monta a busca
        $this->db->from( $this->table.' a' );

        // faz a busca
        $busca = $this->db->get();

        // retorno os resultados
        return $busca->num_rows();
    }

    // faz a paginacao dos anuncios
    public function obterPagina( $CodUsuario, $pagina = 1, $query = '' ){

        $offset = ($pagina-1) * 15;

        // monta a busca
        $this->db->from( $this->table.' a' )
        ->select( 'a.*, c.*, u.Endereco' )
        ->join( 'usuario u', "u.CodUsuario = a.CodUsuario" )
        ->join( 'categoriaservico c', 'c.CodCategoriaServico = a.CodCategoriaServico' )
        ->limit( 15, $offset )
        ->where( "c.Categoria LIKE '%$query%'" )
        ->order_by( "a.Data", "DESC" );

        // faz a busca
        $busca = $this->db->get();

        // retorno os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : array();
    }

    public function getAnunciosRelacionados($CodAnuncio){
        
        // monta a busca
        $this->db->from($this->table.' a' ) 
        ->select( 'a.*, c.*, u.Endereco' )
        ->join( 'usuario u', "u.CodUsuario = a.CodUsuario" )
        ->join( 'categoriaservico c', 'c.CodCategoriaServico = a.CodCategoriaServico' )
        ->limit(8)
        ->where("a.CodAnuncio <> $CodAnuncio");

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : array();
    }

    public function visualizarAnuncio($CodAnuncio){

        $dados = [
            'CodUsuario' => $this->template->guard->user['CodUsuario'],
            'CodAnuncio' => $CodAnuncio,
            'Data' => date(('Y-m-d'), time())
        ];

        $CodUsuario = $dados['CodUsuario'];
        $Data = $dados['Data'];

        return $this->db->query("INSERT INTO visualizar_anuncio (CodUsuario, CodAnuncio, Data) VALUES ('$CodUsuario', '$CodAnuncio', '$Data')");
    }

    public function jaVisualizou($CodAnuncio) {
        $CodUsuario = $this->template->guard->user['CodUsuario'];
        $busca = $this->db->query("SELECT * FROM visualizar_anuncio WHERE CodAnuncio = '$CodAnuncio' AND CodUsuario = '$CodUsuario'");

        return ($busca->num_rows() > 0) ? true : false;
    }

    public function getVisualizacoes($CodAnuncio) {

        $busca = $this->db->query("SELECT COUNT(CodUsuario) AS qtd, CodAnuncio FROM visualizar_anuncio WHERE CodAnuncio = '$CodAnuncio'");

        return ($busca->num_rows() > 0) ? $busca->result_array()[0]['qtd'] : 0;
    }

    public function getAllVisualizacoesECandidatos(){

        $CodUsuario = $this->template->guard->user['CodUsuario'];

        $busca_visualizacoes = $this->db->query("SELECT COUNT(va.CodVisualizacao) AS qtd_visualizacoes, va.Data FROM visualizar_anuncio AS va JOIN anuncio ON anuncio.CodUsuario = '$CodUsuario' WHERE anuncio.CodAnuncio = va.CodAnuncio GROUP BY va.Data ORDER BY va.Data");

        $busca_candidatos = $this->db->query("SELECT COUNT(i.Codigo) AS qtd_candidatos, i.Data FROM interesseanuncio AS i JOIN anuncio ON anuncio.CodUsuario = '$CodUsuario' WHERE anuncio.CodAnuncio = i.CodAnuncio GROUP BY i.Data ORDER BY i.Data");

        $busca = [
            'visualizacoes' => $busca_visualizacoes,
            'candidatos'    => $busca_candidatos
        ];

        return $busca;
    }
}
