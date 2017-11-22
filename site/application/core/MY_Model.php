<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table;

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id;

    public function __construct() {
        parent::__construct();
    }

    /**
	* create
	* 
	* insere um novo dado
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
	public function create( $dados ){
		return $this->db->insert( $this->table, $dados );
	}

   /**
	* update
	* 
	* atualiza um dado
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
	public function update( $dados ) {

		// prepara os dados
		$this->db->where( $this->table_id, $dados['id']);

		// deleta o id
		unset( $dados['id'] );
		if ( isset( $dados[$this->table_id] ) ) unset( $dados[$this->table_id] );

		// faz o update
		return $this->db->update($this->table, $dados); 
	}

   /**
	* delete
	* 
	* deleta um dado
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
	public function delete( $id ) {
		$this->db->where( $this->table_id, $id );
		return $this->db->delete( $this->table ); 
	}

	/**
	* getById
	* 
	* pega um dado por id
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
	public function getById( $id ){
		
		// faz a busca
		$this->db->select( '*' )
		->from( $this->table )
		->where( [$this->table_id => $id ] );
		$query = $this->db->get();

		// verifica se existem resultados
		return ( $query->num_rows() > 0 ) ? $query->result_array()[0] : false;
	}

	/**
	* getAll
	* 
	* pega todos os registros
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/

	public function getAll( $where = false, $fields = '*' ) {
		
		// monta a busca
        $this->db->select( $fields );
        $this->db->from( $this->table );

		//verifica se existe um where
		if ( $where ) $this->db->where( $where );

		// pega os dados do banco
		$query = $this->db->get();

		// verifica se existem resultados
		return ( $query->num_rows() > 0 ) ? $query->result_array() : false;
	}	

	/**
	* table
	* 
	* pega a tabela atual
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
	public function table() {
		return $this->table;
	}

    /**
	* table_id
	* 
	* pega a tabela atual
	* 
	* @author Gustavo Vilas Boas
	* @since 12-2016
	*/
	public function table_id() {
		return $this->table_id;
	}
}

/* end of file */