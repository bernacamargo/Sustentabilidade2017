<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'usuario';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodUsuario';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // faz o login
    public function login( $email, $senha ) {

        // faz a busca no banco
        $this->db->from( $this->table )
        ->select( '*' )
        ->where( "( Senha = '".md5( $senha )."' OR NovaSenha = '$senha' ) AND Email = '$email' AND Status = 'A' " );
        $query = $this->db->get();

        // verifica se existem resultados
        if ( $query->num_rows() > 0 ) {

            // pega o usuario
            $user = $query->result_array()[0];

            // seta o token
            $token = md5( uniqid( time() * rand() ) );

            // prepara os dados
            $dados = [  'Token' => $token,
                        'Login' => date( 'Y-m-d H:i:s', time() ),
                        'id'    => $user['CodUsuario'] ];

            // faz o update
            $this->update( $dados );

            // adiciona o token na resposta
            $user['Token'] = $token;
            return $user;
         } else return false;
    }

    // pega a qtd usuarios
    public function obterTotalUsuarios() {
        
        // prepara a busca
        $this->db->from( $this->table.' u' );

        // faz a busca
        $busca = $this->db->get();

        // retorna os resultados
        return $busca->num_rows();
    }



    // faz o login com facebook
    public function login_facebook( $email ) {

        // faz a busca no banco
        // $this->db->from( $this->table )
        // ->select( '*' )
        // ->where( " Email = '$email' AND Status = 'A' " )
        // ->limit( 1 );
        // $query = $this->db->get();

        $query = $this->db->query("SELECT * FROM usuario WHERE Email LIKE '".$this->db->escape_like_str($email)."' AND Status = 'A'");

        // verifica se existem resultados
        if ( $query->num_rows() > 0 ) {

            // pega o usuario
            $user = $query->result_array()[0];

            // seta o token
            $token = md5( uniqid( time() * rand() ) );

            // prepara os dados
            $dados = [  'Token' => $token,
                        'Login' => date( 'Y-m-d H:i:s', time() ),
                        'id'    => $user['CodUsuario'] ];

            // faz o update
            $this->update( $dados );

            // adiciona o token na resposta
            $user['Token'] = $token;
            return $user;
         } else return false;
    }

    // retorna os dados de perfil de um usuário
    public function obterDadosPerfil( $CodUsuario ) {

        // faz a busca no banco
        $this->db->from( $this->table )
        ->select( '*' )
        ->where( "CodUsuario = $CodUsuario" );

        // guarda a busca
        $busca = $this->db->get();

        // retorna os resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array()[0] : false;
    }

    // seta os dados do perfil
    public function assinarPlano( $CodUsuario, $CodPlano, $data = NULL ) {

        // prepara os dados
        $dados = [
            'CodPlano' => $CodPlano,
            'id'       => $CodUsuario,
            'DataVencimento' =>  $data ? date( 'Y-m-d H:i:s', $data ) : NULL
        ];

        // salva os dados
        return $this->update( $dados );
    }



    public function existeUsuario($email) {
        $busca = $this->db->query("SELECT * FROM usuario WHERE Email = '$email' LIMIT 1");

        return ($busca->num_rows() > 0) ? $busca : false;
    }
}
