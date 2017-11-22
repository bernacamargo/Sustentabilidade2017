<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Anuncio_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'anuncio';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodAnuncio';

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
            'column' => 'Titulo', 
            'label'  => 'Titúlo'       
        ], [
            'column'  => 'Descricao', 
            'label'   => 'Descrição'
        ], [
            'column' => 'Data', 
            'label'  => 'Data'
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
           'use'   => 'Nome'
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

   /**
	* getUserByEmail
	* 
	* pega um usuario pelo id
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
    
}
