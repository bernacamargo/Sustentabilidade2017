<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Classe para a manipulação de templates
class Pagamentos {

    // moip
    public $moip;
    
    // variavel do ambiente
    public $Ambiente = 'test';

    // credencial do moip
    public $Credencial = [
            'key' => 'AIWP9JCGUIEDBXN3GGO7GBCAYRVBGHC1MHL2NGUI',
            'token' => 'MSCAUL5YHGIHQHPWDJBNQ01IZVBASI3S'
        ];

    // razao do pagamento
    public $Razao = null;

    // tipo de validacao
    public $Validacao = 'Basic';

    // construtor
    public function __construct() {

        // iniciando o moip
        $this->moip = new Moip();
    }

    // cria um novo pagamento
    public function novoPagamento( $plano ) {

        // seta um id para o pagamento
        $idPagamento = md5(uniqid(rand()*time()));

        // seta as variaveis do moip
        $this->moip->setEnvironment( $this->Ambiente )
        ->setCredential( $this->Credencial )
        ->setBilletConf(10,
        	false,
        	array())
        ->setUniqueID( $idPagamento )
        ->setValue($plano['Valor'])
        ->setReason('Teste do Moip-PHP')
        ->validate( $this->Validacao )
        ->setReturnURL(site_url())        
        ->setNotificationURL(site_url('sandbox/set_status'));

        // envia a requisicao
        $this->moip->send();

        // guarda o id do pagamento
        $dadosMoip['IdPagamento'] = $idPagamento;

        $Answer = $this->moip->getAnswer();

        // guarda o link do pagamento
        $dadosMoip['Link'] = $this->moip->getAnswer()->payment_url;

        // guarda o token
        $dadosMoip['Token'] = $this->moip->getAnswer()->token;

        // retorna os dados do pagamento
        return $dadosMoip;
    }

    // consulta o status do pagamento de uma conta
    public function consultarStatusPagamento( $token ) {

        // seta a credencial
        $credentials = $this->Credencial['token'] . ':' . $this->Credencial['key'];

        // seta o header
        $header[] = "Authorization: Basic " . base64_encode($credentials);

        // inicia o curl
        $curl = curl_init();

        // setando a url de consulta
        curl_setopt($curl, CURLOPT_URL, 'https://desenvolvedor.moip.com.br/sandbox/ws/alpha/ConsultarInstrucao/'.$token);

        // header
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        // credentials
        curl_setopt($curl, CURLOPT_USERPWD, $credentials);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // resultado
        $ret = curl_exec( $curl );

        // erro
        $err = curl_error( $curl );

        // encerra o curl
        curl_close($curl);

        // converte o resultado
        $xml = simplexml_load_string($ret);

        if ( $xml->RespostaConsultar->Status == 'Sucesso' 
             && isset( $xml->RespostaConsultar->Autorizacao )
             && isset( $xml->RespostaConsultar->Autorizacao->Pagamento )
             && isset( $xml->RespostaConsultar->Autorizacao->Pagamento->Status ) )
                return $xml->RespostaConsultar->Autorizacao->Pagamento->Status;
        
        return false;        
    }
    
}
