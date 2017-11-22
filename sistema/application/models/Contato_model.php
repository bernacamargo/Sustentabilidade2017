<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contato_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'contato';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodContato';

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
            'column' => 'Nome', 
            'label'  => 'Tipo'       
        ], [
            'column' => 'Valor', 
            'label'  => 'Telefone'
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
