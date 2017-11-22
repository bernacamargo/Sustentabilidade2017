<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'mensagem';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodMensagem';

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
            'column' => 'CodPara', 
            'label'  => 'Para'       
        ], [
            'column'  => 'Mensagem', 
            'label'   => 'Mensagem'
        ], [
            'column' => 'Data', 
            'label'  => 'Data'
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
			'field' => 'CodPara',
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
