<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plano_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'plano';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodPlano';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'Recorrencia', 
            'label'  => 'Recorrência'       
        ], [
            'column' => 'Plano', 
            'label'  => 'Nome'       
        ], [
            'column' => 'Valor', 
            'label'  => 'Valor'       
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

		$this->_crud->change_field_type('Recorrencia','dropdown', [	'M' => 'Mensal', 
																	'T' => 'Trimestral',
																	'S' => 'Semestral',
																	'A' => 'Anual' ]);
    }    
}
