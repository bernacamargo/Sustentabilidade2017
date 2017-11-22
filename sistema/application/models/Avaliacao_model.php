<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Avaliacao_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'avaliacao';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodAvaliacao';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'CodUsuario', 
            'label'  => 'Usuário'       
        ], [
            'column' => 'CodProfissional', 
            'label'  => 'Profissional'       
        ], [
            'column' => 'Avaliacao', 
            'label'  => 'Avaliação'       
        ]
    ];

   /**
	* _relations
	*
	* @protected 
	*/
	protected $_relations = [
		[
			'field' => 'CodUsuario',
			'table' => 'usuario',
			'use'   => 'Email'
		], [
			'field' => 'CodProfissional',
			'table' => 'usuario',
			'use'   => 'Email'
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

   /**
	* getUserByEmail
	* 
	* pega um usuario pelo id
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
    
}
