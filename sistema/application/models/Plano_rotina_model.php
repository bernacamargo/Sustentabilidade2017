<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plano_rotina_model extends MY_Model {


   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'planorotina';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodPlanoRotina';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'Rotina', 
            'label'  => 'Rotina'       
        ], [
            'column' => 'REF', 
            'label'  => 'REF'       
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
