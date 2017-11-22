<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Classe para a manipulação de templates
class Planos {

    // instancia do codeigniter
    public $ci;

    // rotinas 
    public $rotinas;

    // planos
    public $planos;

    // usuario logado
    public $user;

    // método construtor
    public function __construct() {

        // pega a instancia do ci
        $this->ci =& get_instance();

        // carrega a librarie de guard
        $this->ci->load->library( 'Guard' );

        // pega o usuario logado
        $this->user = $this->ci->guard->user;

        // carrega as models necessários
        $models = [
            'Planos_model',
            'Planos_rotinas_model',
            'Planos_permissao_model'
        ];
        $this->ci->load->model( $models );

        // seta as rotinas
        $this->rotinas = $this->ci->Planos_rotinas_model->getAll();
        $this->planos  = $this->ci->Planos_model->obterPlanos();
    }

    // verifica se um plano tem permissão em uma rotina
    public function hasPermission( $CodPlano, $CodRotina ) {
        
        // chama o método da model
        return $this->ci->Planos_permissao_model->existePermissao( $CodPlano, $CodRotina );
    }

}
