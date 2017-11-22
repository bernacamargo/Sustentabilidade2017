<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cidade_model extends MY_Model {


   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'cidade';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodCidade';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'Cidade', 
            'label'  => 'Cidade'       
        ], [
            'column' => 'CodEstado', 
            'label'  => 'Estado'       
        ]
    ];

	/**
	* _relations
	*
	* @protected 
	*/
	protected $_relations = [
		[
			'field' => 'CodEstado',
			'table' => 'estado',
			'use'   => 'Estado'
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
