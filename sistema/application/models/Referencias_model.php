<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Referencias_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'referencias';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodReferencia';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'CodProfissional', 
            'label'  => 'Profissional'       
        ], [
            'column' => 'Nome', 
            'label'  => 'Nome'       
        ], [
            'column' => 'Email', 
            'label'  => 'E-mail'       
        ], [
            'column'  => 'Telefone', 
            'label'   => 'Telefone'
        ], [
            'column' => 'Descricao', 
            'label'  => 'Descrição'
        ]
    ];

   /**
	* _relations
	*
	* @protected 
	*/
	protected $_relations = [
        [
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
}
