<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Conversas extends MY_Controller {

	// metodo construtor
    public function __construct() {
        parent::__construct();

		// carrega a model de mensage
		$this->load->model( 'Mensagens_model' );

        // verifica se está logado
        if ( !$this->guard->logged() ) redirect( site_url('login') );

		// pega o codigo do usuario logado
		$CodUsuario = $this->guard->user['CodUsuario'];        
		// pega as conversas
		$conversas = $this->Mensagens_model->obterConversas( $CodUsuario );

		$this->template->set( 'cvs', $conversas );
    }

	// pagina inicial
	public function index() {

		if( !$this->planos->hasPermission( $this->guard->item( 'CodPlano' ), '004' ) ){
			$this->template->set( 'container', 'permissao' );
			$this->template->render( 'chat' );
			return false;
		}

		// pega o codigo do usuario logado
		$CodUsuario = $this->guard->user['CodUsuario'];        
		// pega as conversas
		$conversas = $this->Mensagens_model->obterConversas( $CodUsuario );

		$this->template->set( 'cvs', $conversas );
		
		$this->template->set( 'container', 'conversas' );
		$this->template->render( 'chat' );
	}

	// pagina inicial
	public function conversa( $conversa ) {

		// seta o id da conversa
		$this->template->set( 'conversa_id', $conversa );
		$CodUsuario = $this->guard->user['CodUsuario'];

		// obtem os dados do usuario
		$this->load->model( 'Usuarios_model' );
		$usuario = $this->Usuarios_model->getById( $conversa );
        $this->template->set( 'conversando', $usuario['Nome'] );
        $this->template->set( 'conversando_foto', $usuario['Foto'] );

		// Marca mensagens não lidas como lidas ao abrir a conversa
		$this->Mensagens_model->visualizarMensagens($conversa);

		// pega as conversas
		$conversas = $this->Mensagens_model->obterConversas( $CodUsuario );

		$this->template->set( 'cvs', $conversas );

		// pega as mensagens dessa conversa
		$mensagens = $this->Mensagens_model->obterMensagens( $conversa, $CodUsuario );
		
		$mensagens = array_map(function($value){
			
			$time1 = strtotime($value['Data']);
            $time2 = time();

            $time_final = floor($time2 - $time1);
            $time_flag = 0;
            
            // Segundos
            if($time_final == 1){
                $time_flag = 0;
            }
            else if($time_final > 1 && $time_final < 60){
                $time_flag = 0;                  
            }
            // Minutos
            else if($time_final == 60){
                $time_final = $time_final/60;
                $time_flag = 1;                            
            }
            else if($time_final > 60 && $time_final < 3600){
                $time_final = $time_final/60;   
                $time_flag = 1;
            }
            // Horas
            else if($time_final == 3600){
                $time_final = $time_final/(60*60);
                $time_flag = 2;                 
            }
            else if($time_final > 3600 && $time_final < 86400){
                $time_final = $time_final/(60*60);
                $time_flag = 2;                 
            }
            // Dias
            else if($time_final == 86400) {
                $time_final = $time_final/(60*60*24);
                $time_flag = 3;                 
            }
            elseif($time_final > 1440 && $time_final < 2592000){
                $time_final = $time_final/(60*60*24);
                $time_flag = 3;                 
            }
            // Meses
            elseif($time_final == 2592000) {
                $time_final = $time_final/(60*60*24*30);
                $time_flag = 4;                 
            }
            elseif($time_final > 2592000 && $time_final < 31104000){
                $time_final = $time_final/(60*60*24*30);
                $time_flag = 4;                 
            }
            // Anos
            elseif($time_final == 31104000) {
                $time_final = $time_final/(60*60*24*30*12);
                $time_flag = 5;
            }
            elseif($time_final > 31104000){
                $time_final = $time_final/(60*60*24*30*12);
                $time_flag = 5;                      
            }

            $time_final = floor($time_final);

            if($time_flag == 0 && $time_final == 1){
                $time_txt = 'segundo';
            }
            else if($time_flag == 0 && $time_final > 1)
                $time_txt = 'segundos';
            else if($time_flag == 1 && $time_final == 1)
                $time_txt = 'minuto';
            else if($time_flag == 1 && $time_final > 1)
                $time_txt = 'minutos';
            else if($time_flag == 2 && $time_final == 1)
                $time_txt = 'hora';
            else if($time_flag == 2 && $time_final > 1)
                $time_txt = 'horas';
            else if($time_flag == 3 && $time_final == 1)
                $time_txt = 'dia';
            else if($time_flag == 3 && $time_final > 1)
                $time_txt = 'dias';
            else if($time_flag == 4 && $time_final == 1)
                $time_txt = 'mes';
            else if($time_flag == 4 && $time_final > 1)
                $time_txt = 'meses';
            else if($time_flag == 5 && $time_final == 1)
                $time_txt = 'ano';
            else if($time_flag == 5 && $time_final > 1)
                $time_txt = 'anos';

            $value['time_tipo'] = $time_txt;
            $value['time'] = $time_final;


            return $value;
		}, $mensagens);

		// var_dump($mensagens);

		$this->template->set( 'mensagens', $mensagens );
		$this->template->use_module( 'conversa' );	
		$this->template->set( 'container', 'conversa' );
		$this->template->render( 'chat' );
	}

	// envia uma mensagem
	public function enviar() {

		// pega os dados da mensagem
		$dados = [
			'CodUsuario' => $this->guard->user['CodUsuario'],
			'CodPara'    => $this->input->post( 'CodUsuario' ),
			'Mensagem'   => $this->input->post( 'Texto' ),
			'Data'       => date( 'Y-m-d H:i:s', time() ),
			'Lido'		 => 0
		];

		// cria a mensagem
		$this->Mensagens_model->enviarMensagem( $dados );
		
		// volta os dados da mensagem criada
		echo json_encode( $dados );
	}

	// verifica se existem mensagens novas
	public function carrega_mensagens() {

		// pega os dados
		$CodUsuario = $this->guard->user['CodUsuario'];
		$idMensagem = $this->input->post( 'idMensagem' );
		$conversa = $this->input->post( 'CodUsuario' );

		// pega as novas mensagens dessa conversa
		$newMsg = $this->Mensagens_model->obterMensagens( $CodUsuario, $conversa, $idMensagem );

		$newMsg = array_map(function($value){
			
			$time1 = strtotime($value['Data']);
            $time2 = time();

            $time_final = floor($time2 - $time1);
            $time_flag = 0;
            
            // Segundos
            if($time_final == 1){
                $time_flag = 0;
            }
            else if($time_final > 1 && $time_final < 60){
                $time_flag = 0;                  
            }
            // Minutos
            else if($time_final == 60){
                $time_final = $time_final/60;
                $time_flag = 1;                            
            }
            else if($time_final > 60 && $time_final < 3600){
                $time_final = $time_final/60;   
                $time_flag = 1;
            }
            // Horas
            else if($time_final == 3600){
                $time_final = $time_final/(60*60);
                $time_flag = 2;                 
            }
            else if($time_final > 3600 && $time_final < 86400){
                $time_final = $time_final/(60*60);
                $time_flag = 2;                 
            }
            // Dias
            else if($time_final == 86400) {
                $time_final = $time_final/(60*60*24);
                $time_flag = 3;                 
            }
            elseif($time_final > 1440 && $time_final < 2592000){
                $time_final = $time_final/(60*60*24);
                $time_flag = 3;                 
            }
            // Meses
            elseif($time_final == 2592000) {
                $time_final = $time_final/(60*60*24*30);
                $time_flag = 4;                 
            }
            elseif($time_final > 2592000 && $time_final < 31104000){
                $time_final = $time_final/(60*60*24*30);
                $time_flag = 4;                 
            }
            // Anos
            elseif($time_final == 31104000) {
                $time_final = $time_final/(60*60*24*30*12);
                $time_flag = 5;
            }
            elseif($time_final > 31104000){
                $time_final = $time_final/(60*60*24*30*12);
                $time_flag = 5;                      
            }

            $time_final = floor($time_final);

            if($time_flag == 0 && $time_final == 1){
                $time_txt = 'segundo';
            }
            else if($time_flag == 0 && $time_final > 1)
                $time_txt = 'segundos';
            else if($time_flag == 1 && $time_final == 1)
                $time_txt = 'minuto';
            else if($time_flag == 1 && $time_final > 1)
                $time_txt = 'minutos';
            else if($time_flag == 2 && $time_final == 1)
                $time_txt = 'hora';
            else if($time_flag == 2 && $time_final > 1)
                $time_txt = 'horas';
            else if($time_flag == 3 && $time_final == 1)
                $time_txt = 'dia';
            else if($time_flag == 3 && $time_final > 1)
                $time_txt = 'dias';
            else if($time_flag == 4 && $time_final == 1)
                $time_txt = 'mes';
            else if($time_flag == 4 && $time_final > 1)
                $time_txt = 'meses';
            else if($time_flag == 5 && $time_final == 1)
                $time_txt = 'ano';
            else if($time_flag == 5 && $time_final > 1)
                $time_txt = 'anos';

            $value['time_tipo'] = $time_txt;
            $value['time'] = $time_final;


            return $value;
		}, $newMsg);


		echo json_encode( $newMsg );

	}

}
