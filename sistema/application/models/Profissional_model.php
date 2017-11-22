<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profissional_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'profissional';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodProfissional';

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
            'column' => 'CodCategoriaServico', 
            'label'  => 'Categoria'       
        ], [
            'column' => 'Idade', 
            'label'  => 'Idade'       
        ], [
            'column'  => 'Experiencia', 
            'label'   => 'Experiência'
        ], [
            'column' => 'Valor', 
            'label'  => 'Valor'
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
            'field' => 'CodCategoriaServico',
            'table' => 'categoriaservico',
            'use'   => 'Categoria'
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
