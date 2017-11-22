<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paises_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'pais';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'paisId';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }
}
