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

    // faz a paginacao dos anuncios
    public function obterPagina( $CodUsuario, $pagina = 1, $query = '' ){

        // monta a busca
        $this->db->from( $this->table.' a' )
        ->select( 'a.*, c.*, u.Endereco' )
        ->join( 'usuario u', "u.CodUsuario = a.CodUsuario" )
        ->join( 'categoriaservico c', 'c.CodCategoriaServico = a.CodCategoriaServico' )
        ->limit( 20, $pagina - 1 )
        ->where( "a.CodUsuario <> $CodUsuario AND c.Categoria LIKE '%$query%'" );

        // faz a busca
        $busca = $this->db->get();

        // retorno os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : array();
    }
}
