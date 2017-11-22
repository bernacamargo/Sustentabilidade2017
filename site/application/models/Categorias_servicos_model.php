<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_servicos_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'categoriaservico';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'CodCategoriaServico';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }
}

