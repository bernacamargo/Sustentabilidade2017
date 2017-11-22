<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profissionais_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'profissional';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodProfissional';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // pega profissionais
    public function obterProfissionais( $CodUsuario, $pagina = 0, $query = '' ) {
        
        $offset = ($pagina-1) * 15;

        $where = "p.ativo = 1";
        if ( strlen( trim( $query ) ) > 0 )
            $where .= " AND ( u.Nome LIKE '%$query%' OR c.Categoria LIKE '%$query%' ) ";

        // prepara a busca
        $this->db->from( $this->table.' p' )
        ->select( 'p.*, u.*, c.*' )
        ->join( 'usuario u', 'p.CodUsuario = u.CodUsuario' )
        ->join( 'categoriaservico c', 'p.CodCategoriaServico = c.CodCategoriaServico' )
        ->limit( 30, $offset )
        ->where( $where );

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : [];
    }

    // pega a qtd profissionais
    public function obterTotalProfissionais( $CodUsuario, $query = '') {
        
        $where = "u.CodUsuario <> $CodUsuario";
        if ( strlen( trim( $query ) ) > 0 )
            $where .= " AND ( u.Nome LIKE '%$query%' OR c.Categoria LIKE '%$query%' ) ";

        // prepara a busca
        $this->db->from( $this->table.' p' )
        ->select( 'p.*, u.*, c.*' )
        ->join( 'usuario u', 'p.CodUsuario = u.CodUsuario' )
        ->join( 'categoriaservico c', 'p.CodCategoriaServico = c.CodCategoriaServico' )
        ->where( $where );

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return $busca->num_rows();
    }

    public function obterTotalCurriculos(){

        $this->db->from($this->table . ' u');

        $busca = $this->db->get();

        return $busca->num_rows();
    }



    // pega profissionais relacionados
    public function getProfissionaisRelacionados($CodUsuario, $CodCategoriaServico) {

        // prepara a busca
        $this->db->from( $this->table.' p')
        ->select( 'p.*, u.*, c.*' )
        ->join( 'usuario u', 'p.CodUsuario = u.CodUsuario' )
        ->join( 'categoriaservico c', 'p.CodCategoriaServico = c.CodCategoriaServico' )
        ->limit( 6 )
        ->where( "p.CodUsuario <> $CodUsuario AND p.CodCategoriaServico = $CodCategoriaServico" );

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : [];
    }

    // pega o perfil profissional de um usuario
    public function obterPerfilProfissional( $CodUsuario ) {

        // prepara a busca
        $this->db->from( $this->table.' p' )
        ->select( '*' )
        ->join( 'usuario u', 'u.CodUsuario = p.CodUsuario')
        ->join('categoriaservico cs', 'p.CodCategoriaServico = cs.CodCategoriaServico')
        ->where( "p.CodUsuario = $CodUsuario" );

        // faz a busca
        $busca = $this->db->get();

        // verifica se existem resultado
        return ( $busca->num_rows() > 0 ) ? $busca->result_array()[0] : false;
    }

    public function obterPerfilProfissional_CodProf ($CodProfissional) {
        // prepara a busca
        $this->db->from( $this->table.' p' )
        ->select( '*' )
        ->join( 'usuario u', 'u.CodUsuario = p.CodUsuario')
        ->join('categoriaservico cs', 'p.CodCategoriaServico = cs.CodCategoriaServico')
        ->where( "p.CodProfissional = $CodProfissional" );

        // faz a busca
        $busca = $this->db->get();

        // verifica se existem resultado
        return ( $busca->num_rows() > 0 ) ? $busca->result_array()[0] : false;
    }

    // cria o perfil profissional
    public function criarPerfilProfissional( $dados ) {

        // verifica se o usuario ja tem um perfil profissonal
        if ( $perfil = $this->obterPerfilProfissional( $dados['CodUsuario'] ) ) {
            $dados['id'] = $perfil['CodProfissional'];
            return $this->update( $dados );
        } else {
            return $this->create( $dados );
        }
    }


    // desativa o perfil profissional de um usuario
    public function desativarPerfilProfissional( $CodUsuario ) {

        // prepara a busca
        $this->db->from( $this->table.' p' )
        ->select( '*' )
        ->where( "p.CodUsuario = $CodUsuario" );

        // faz a busca
        $busca = $this->db->get()->result_array()[0];
        $busca['id'] = $busca['CodProfissional'];
        $busca['ativo'] = 0;
        return $this->update($busca);
    }    

    // ativar o perfil profissional de um usuario
    public function ativarPerfilProfissional( $CodUsuario ) {

        // prepara a busca
        $this->db->from( $this->table.' p' )
        ->select( '*' )
        ->where( "p.CodUsuario = $CodUsuario" );

        // faz a busca
        $busca = $this->db->get()->result_array()[0];
        $busca['id'] = $busca['CodProfissional'];
        $busca['ativo'] = 1;
        return $this->update($busca);
    }   

    // ativar o perfil profissional de um usuario
    public function excluirPerfilProfissional( $CodUsuario ) {

        // prepara a busca
        return $this->db->query("DELETE FROM profissional WHERE CodUsuario = $CodUsuario");
    }    
}
