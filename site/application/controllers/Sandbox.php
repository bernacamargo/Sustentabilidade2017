<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sandbox extends MY_Controller {

    // metodo construtor
    public function __construct() {
        parent::__construct();
        $this->load->library('Pagamentos');
    }

    // exibe o formulario de cadastro
	public function index() {	
        
        $this->pagamentos->novoPagamento();
	}

    public function set_status() {
        $this->pagamentos->consultarStatusPagamento();
    }
}
