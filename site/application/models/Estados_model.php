<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Estados_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'estado';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodEstado';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }
}
