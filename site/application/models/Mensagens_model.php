<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagens_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'mensagem';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodMensagem';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // obtem as conversas de um usuario
    public function obterConversas( $CodUsuario ) {
        // $this->db->from( $this->table )
        // ->select( 'CodPara ' )
        // ->where( " CodUsuario = $CodUsuario OR CodPara = $CodUsuario" )
        // ->group_by( ' CodPara' );

        $busca = $this->db->query( "SELECT usuario.Nome, usuario.Foto, usuario.CodUsuario FROM usuario, mensagem WHERE usuario.CodUsuario
         IN (SELECT CodPara  FROM mensagem WHERE CodUsuario = '$CodUsuario' GROUP BY CodPara
         UNION SELECT CodUsuario FROM mensagem WHERE CodPara = '$CodUsuario' GROUP BY CodUsuario) GROUP BY usuario.CodUsuario" );

        // $busca = $this->db->query("SELECT ur.CodUsuario, ur.Nome, ur.Foto, COUNT(CASE WHEN mensagem.Lido = '0' AND mensagem.CodPara = '$CodUsuario' THEN 1 ELSE NULL END) AS n_lidas FROM mensagem JOIN usuario AS us ON us.CodUsuario = mensagem.CodUsuario JOIN usuario AS ur ON ur.CodUsuario = mensagem.CodPara WHERE us.CodUsuario = '$CodUsuario' AND ur.CodUsuario <> '$CodUsuario' GROUP BY ur.CodUsuario");

        //  SELECT u.*, m.* FROM usuario u, mensagem m WHERE u.CodUsuario 
        // IN (SELECT m.CodPara FROM mensagem m WHERE m.CodUsuario = 4 GROUP BY m.CodPara 
        // UNION SELECT m.CodUsuario FROM mensagem m WHERE m.CodPara = 4 GROUP BY m.CodUsuario) 
        // AND (u.CodUsuario=m.CodUsuario XOR u.CodUsuario=m.CodPara) ORDER BY m.CodMensagem DESC        

        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : [];

    }

    // obtem as mensagems de um usuario para outro
    public function obterMensagensEnviadas( $CodUsuario1, $CodUsuario2) {

        $where = " ( '$CodUsuario1' = m.CodUsuario AND '$CodUsuario2' = m.CodPara ) ";
        
        // faz a busca
        $this->db->from( $this->table. " m" )
        ->select( 'm.*, ur.Foto as FotoEnvio, ur.Nome as NomeEnvio, us.Foto as FotoRecebeu, us.Nome as NomeRecebeu' )
        ->where( $where )
        ->order_by('CodMensagem', 'ASC')
        ->join('usuario us', "us.CodUsuario = m.CodUsuario")
        ->join('usuario ur', "ur.CodUsuario = m.CodPara");

        // faz a busca
        $busca = $this->db->get();

        // volta os dados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : [];
    }


    // obtem as mensagems de um usuario para outro
    public function obterMensagens( $CodUsuario1, $CodUsuario2, $idMensagem = false ) {

        if($idMensagem) 
            $where = " (( '$CodUsuario1' = m.CodUsuario AND '$CodUsuario2' = m.CodPara ) 
        OR ( '$CodUsuario1' = m.CodPara AND '$CodUsuario2' = m.CodUsuario )) AND m.CodMensagem > '$idMensagem' ";
        else
            $where = " ( '$CodUsuario1' = m.CodUsuario AND '$CodUsuario2' = m.CodPara ) 
        OR ( '$CodUsuario1' = m.CodPara AND '$CodUsuario2' = m.CodUsuario ) ";
        
        // faz a busca
        $this->db->from( $this->table. " m" )
        ->select( 'm.*, ur.Foto as FotoEnvio, ur.Nome as NomeEnvio, us.Foto as FotoRecebeu, us.Nome as NomeRecebeu' )
        ->where( $where )
        ->order_by('CodMensagem', 'ASC')
        ->join('usuario us', "us.CodUsuario = m.CodUsuario")
        ->join('usuario ur', "ur.CodUsuario = m.CodPara");

        // faz a busca
        $busca = $this->db->get();

        // volta os dados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array() : [];
    }

    // envia uma nova mensagem
    public function enviarMensagem( $dados ) {
        
        // envia a mensagem
        $this->create( $dados );
    }

    public function obterMensagensNaoLidas( $CodUsuario1 = false, $CodUsuario2 = false) {

        if(!$CodUsuario1 && !$CodUsuario2){
            $CodUsuario1 = $this->template->guard->user['CodUsuario'];
            $busca = $this->db->query("SELECT COUNT(mensagem.CodMensagem) AS n_lidas FROM mensagem WHERE Lido = 0 AND CodPara = '$CodUsuario1'");
        }
        else
            $busca = $this->db->query("SELECT COUNT(mensagem.CodMensagem) AS n_lidas FROM mensagem WHERE Lido = 0 AND CodPara = '$CodUsuario2' AND CodUsuario = '$CodUsuario1'");
        
        // volta os dados
        return ( $busca->num_rows() > 0 ) ? $busca->result_array()[0] : false;
    }

    public function visualizarMensagens($CodUsuario2) {

        $CodUsuario1 = $this->template->guard->user['CodUsuario'];

        $busca = $this->obterMensagensEnviadas($CodUsuario2, $CodUsuario1);

        foreach ($busca as $result) {

            $dados = [
                'id'    => $result['CodMensagem'],
                'Lido'  => 1
            ];
            
            $this->update($dados);
        }

    }
}
