<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Estado_model extends MY_Model {


   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'estado';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodEstado';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'Estado', 
            'label'  => 'Estado'       
        ], [
            'column' => 'UF', 
            'label'  => 'UF'       
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
