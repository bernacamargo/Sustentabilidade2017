<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cobrancas_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'cobranca';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodCobranca';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // pega todas as cobrancas
    public function obterCobrancasUsuarios( $CodUsuario ) {

        // monta a busca
        $this->db->from( $this->table.' c' )
        ->select( 'c.*, p.*' )
        ->join( 'plano p', 'p.CodPlano = c.CodPlano' )
        ->where( "c.CodUsuario = $CodUsuario AND c.Status <> 'A'" )
        ->order_by('Emissao', 'desc');

        // faz a busca
        $busca = $this->db->get();

        // verifca se existem resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : false;
    }

    // pega cobrancas abertas
    public function obterCobrancasAbertas( $CodUsuario ) {
        
        // monta a busca
        $this->db->from( $this->table.' c' )
        ->select( 'c.*, p.*' )
        ->join( 'plano p', 'p.CodPlano = c.CodPlano' )
        ->where( "c.CodUsuario = $CodUsuario AND c.Status = 'A'" );

        // faz a busca
        $busca = $this->db->get();

        // verifca se existem resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : false;
    }

    // pega cobranca aberta
    public function obterCobrancaAberta( $CodUsuario ) {
        
        $cobranca = $this->obterCobrancasAbertas( $CodUsuario );

        // verifca se existem resultados
        return ( $cobranca ) ? $cobranca[0] : false;
    }

    // gera uma nova cobranca
    public function gerarCobranca( $plano, $CodUsuario ) {

        // verifica se o usuario tem cobrancas abertas
        if ( $this->obterCobrancasAbertas( $CodUsuario ) ) $this->cancelarCobrancasAbertas( $CodUsuario );

        // seta os dados
        $dados = [
            'CodPlano'   => $plano['CodPlano'],
            'Codusuario' => $CodUsuario,
            'Valor'      => $plano['Valor'],
            'Token'      => $plano['Token'],
            'Link'      => $plano['Link'],
            'IdPagamento'      => $plano['IdPagamento'],
            'Status'     => 'A',
            'Emissao'    => date( 'Y-m-d H:i:s', time() )
        ];

        // cria a cobranca
        return $this->create( $dados );
    }

    // pega cobrancas abertas
    public function obterCobranca( $CodCobranca ) {
        
        // monta a busca
        $this->db->from( $this->table )
        ->select( '*' )
        ->where( "CodCobranca = $CodCobranca" );

        // faz a busca
        $busca = $this->db->get();

        // verifca se existem resultados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : false;
    }

    // cancelar cobranca
    public function cancelarCobranca( $CodCobranca ) {
            $c['Status'] = 'C';
            $c['id'] = $CodCobranca;
            return $this->update($c);        
    }

    // paga cobranca
    public function pagarCobranca( $CodCobranca ) {
            $c['Status'] = 'P';
            $c['id'] = $CodCobranca;
            return $this->update($c);        
    }

    // cancela cobrança em aberto
    public function cancelarCobrancasAbertas( $CodUsuario ) {

        // obtem as cobrancas em aberto
        $cobranca = $this->obterCobrancasAbertas( $CodUsuario );

        // percorre todas cobrancas em aberto
        foreach( $cobranca as $c ){

            // cancela as cobrancas
            $this->cancelarCobranca($c['CodCobranca']);
        }
    }

    public function statusCobranca( $Status ) {
        echo $Status;
    }
}
