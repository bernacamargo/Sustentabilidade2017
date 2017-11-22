<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plano_permissao_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'planopermissao';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodPlanoPermissao';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'CodPlano', 
            'label'  => 'Plano'       
        ], [
            'column' => 'CodPlanoRotina', 
            'label'  => 'Rotina'       
        ], [
            'column' => 'Permissao', 
            'label'  => 'Permissão',
			'display' => false        
        ]
    ];

   /**
	* _relations
	*
	* @protected 
	*/
	protected $_relations = [
		[
			'field' => 'CodPlano',
			'table' => 'plano',
			'use'   => 'Plano'
		],
		[
			'field' => 'CodPlanoRotina',
			'table' => 'planorotina',
			'use'   => 'Rotina'
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
		
		$this->_crud->change_field_type('Permissao','dropdown', [	'P' => 'Permitir', 'N' => 'Negar' ]);
	}
}
