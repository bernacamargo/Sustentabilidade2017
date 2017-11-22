<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Planos_rotinas_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'planorotina';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodPlanoRotina';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }
}
