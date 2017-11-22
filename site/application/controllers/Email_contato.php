<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_contato extends MY_Controller {


    public function __construct() {
        parent::__construct();
    }

    public function index(){

    }

	public function enviar_email() {	
	    $this->load->library('email');

	    $nome = $this->input->post('nome');
	    $email = $this->input->post('email');
	    $assunto = $this->input->post('assunto');
	    $mensagem = $this->input->post('mensagem');
	    
	    $this->email->from($email, $nome);
	    $this->email->to('contato@workforall.com');
	    
	    $this->email->subject($assunto);
	    $this->email->message($mensagem);
	    
	    if($this->email->send()){
	    	$html = "
		    	<div class='alert alert-success'> Mensagem enviada com sucesso, logo retornaremos seu contato</div>";
	    }
	    else {
			$html = "
				<div class='alert alert-success'> Sua mensagem não foi enviada, aguarde um estante e tente novamente.</div>
			";
		}

		echo $html;
	}	

}
/* End of file Email_contato.php */
/* Location: ./application/controllers/Email_contato.php */