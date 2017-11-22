<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends MY_Model {

   /**
	* _table
	* 
	* @protected
	*/
    protected $_table = 'usuario';

   /**
	* _table_id
	* 
	* @protected
	*/
    protected $_table_id = 'CodUsuario';

   /**
	* _fields
	* 
	* @protected
	*/
	protected $_fields = [
        [
            'column' => 'CodPlano', 
            'label'  => 'Plano',
            'display' => false         
        ], [
            'column' => 'CodCidade', 
            'label'  => 'Cidade',
            'display' => false         
        ], [
            'column' => 'Nome', 
            'label'  => 'Nome'       
        ], [
            'column'  => 'NovaSenha', 
            'label'   => 'NovaSenha',
            'display' => false       
        ], [
            'column'  => 'Senha', 
            'label'   => 'Senha',
            'display' => false       
        ], [
            'column' => 'Token', 
            'label'  => 'Token',
            'display' => false        
        ], [
            'column' => 'Email', 
            'label'  => 'E-mail'       
        ], [
            'column' => 'CPF', 
            'label'  => 'CPF',
            'display' => false         
        ], [
            'column' => 'Endereco', 
            'label'  => 'Endereço',
            'display' => false         
        ], [
            'column' => 'CEP', 
            'label'  => 'CEP',
            'display' => false         
        ], [
            'column' => 'Foto', 
            'label'  => 'Foto'       
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
		], [
			'field' => 'CodCidade',
			'table' => 'cidade',
			'use'   => 'Cidade'
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

        // seta o campo da senha
        $this->_crud->change_field_type('Senha','password');
        $this->_crud->change_field_type('Email','email');
        $this->_crud->change_field_type('NovaSenha','hidden');
        $this->_crud->change_field_type('Token','hidden');
        $this->_crud->change_field_type('Login','hidden');
        $this->_crud->set_field_upload('Foto', 'uploads');
        $this->_crud->change_field_type('flg_ativo','dropdown', ['A' => 'Ativo', 'N' => 'Inativo']);

        // seta os callbacks
        $this->_crud->callback_before_insert( array( $this, 'hashPassword' ) );
        $this->_crud->callback_before_update( array( $this, 'hashPassword' ) );
    }

   /**
	* getUserByEmail
	* 
	* pega um usuario pelo id
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
    public function getUserByEmail( $email ) {

        // faz a busca
		$this->db->select( '*' );
		$this->db->from( $this->_table );
		$this->db->where( ['desc_email' => $email ] );
		$query = $this->db->get();

		// verifica se existem resultados
		return ( $query->num_rows() > 0 ) ? (array)$query->result()[0] : false;
    }

    /**
	* hashPassword
	* 
	* enripta a senha
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
    public function hashPassword( $value, $primary_key = null ) {
        
        // verifica se não é nulo
        if ( !is_null( $primary_key ) ) {
            $user = $this->getById( $primary_key );
            
            // verifica se a senhas são iguais
            if ( $user['Senha'] === $value['Senha']) return $value;
        }

        // volta o objeto formatado
        $value['Senha'] = md5( $value['Senha'] );

        // retorno
        return $value;
    }
}
