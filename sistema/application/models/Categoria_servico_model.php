<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_servico_model extends MY_Model {


   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'categoriaservico';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodCategoria';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'Categoria', 
            'label'  => 'Categoria'       
        ]
    ];

   /**
	* __construct
	* 
	* constructor method
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
    public function __construct() {
        parent::__construct();
    }
}
