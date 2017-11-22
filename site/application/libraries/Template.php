<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Classe para a manipulação de templates
class Template {

    // instancia do codeigniter
    public $ci;

    // arquivos de css para carregar na página
    public $css;

    // arquivos de js para carregar na página
    public $js;

    // as views que serão carregadas
    public $views = array();

    // modulos para carregar
    public $modules = array();

    // adiciona uma variavel a ser carregada na view
    public $data = array();

    // pagina a ser carregada
    public $p_page = 'home';

    // guard
    public $guard;

    // permissoes
    public $plano;

    // titulo da pagina
    public $title = 'Work for all - Sua casa em boas mãos';

    // método construtor
    public function __construct() {

        // pega a instancia do ci
        $this->ci =& get_instance();

        // pega a biblioteca de configuração
        $this->ci->config->load( 'assets' );

        // pega a biblioteca de guard
        $this->ci->load->library( 'Guard' );
        $this->ci->load->library( 'Planos' );
        $this->guard = $this->ci->guard;
        $this->plano = $this->ci->planos;

        // carrega os módulos padrão
        $this->loadDefault();
    }

    // seta o titulo da pagina
    public function set_title( $title ) {
        $this->title = $title;
    }

    // carrega os módulos padrão
    public function loadDefault() {

        // pega os módulos setados no arquivo de configuracao
        $default = $this->ci->config->item('default');

        // junta com o que já tem guardado
        $this->modules = array_merge( $this->modules, $default );
    }

    // adiciona um novo modulo a ser carregado
    public function use_module( $module ) {

        // adiciona o módulo
        $this->modules[] = $module;
    }

    // adiciona o css
    public function addCss( $css ) {
        $this->css[] = $css;
    }

    // adiciona o js
    public function addJs( $js ) {
        $this->js[] = $js;
    }

    // adiciona uma nova view
    public function view( $chave, $view ) {
        $this->view[$chave] = $view;
    }

    // pega o valor de um atributo
    public function get( $array, $chave ) {
        return isset( $this->$array[$chave] ) ? $this->$array[$chave] : false;
    }

    // seta o valor para uma variavel
    public function set( $chave, $valor ) {
        $this->data[$chave] = $valor;
    }

    // pega o valor de uma varivel
    public function item( $chave ) {
        return ( isset( $this->data[$chave] ) ) ? $this->data[$chave] : null;
    }

    // carrega uma view
    public function print_view( $view ) {
        $view = $this->get( 'view', $view );
        $this->ci->load->view( $view );
    } 

    // seta a pagina a ser carregada
    public function page( $page ) {
        $this->p_page = $page;
    }

    // carrega um componente
    public function print_component( $component , $var = false) {
        
        // carrega a pagina
        $this->ci->load->view( 'components/'.$component, $var);
    }

    // carrega uma view
    public function print_page( $page = false ){

        // verifica se o usuário deseja carregar uma pagina em especifico
        $this->p_page = $page ? $page : $this->p_page;

        // carrega a pagina
        $this->ci->load->view( 'pages/'.$this->p_page );
    }

    // carrega os modulos
    public function loadModules(){

        // pega os modulos
        $modules = array_unique( $this->modules );

        // percorre todos os modulos
        foreach( $modules as $module ) {

            // carrega os arquivos de configuração
            $config = $this->ci->config->item( $module );

            // verifica se existem css
            if ( isset( $config['css'] ) ) {
                foreach ( $config['css'] as $css ) {
                    $this->addCss( $css );
                }
            }

            // verifica se existem js
            if ( isset( $config['js'] ) ) {
                foreach ( $config['js'] as $js ) {
                    $this->addJs( $js );
                }
            }
        }
    }

    // imprime o js
    public function print_js() {
        foreach( $this->js as $js ) echo '<script src="'.$js.'" type="text/javascript"></script>';
    }

    // imprime o css
    public function print_css() {
        foreach( $this->css as $css ) echo '<link href="'.$css.'" rel="stylesheet" media="screen"></script>';
    }

    // renderiza a pagina
    public function render( $page = false ) {

        // carrega os modulos
        $this->loadModules();

        // verifica se o usuário deseja carregar uma pagina em especifico
        $this->p_page = $page ? $page : $this->p_page;

        // carrega a view
        $this->ci->load->view( 'master', [ 'template' => $this ] );
    }

    // exibe o titulo
    public function print_title() {
        echo $this->title;
    }

    // pega a tab ative
    public function link( $label, $url, $container = '' ) {
        
        // verifica se a url é igual ao link
        if ( $this->item( 'container' ) === $container ) {
            echo '<a href="'.site_url( $url ).'" class="list-group-item active">'.$label.' <i class="fa fa-caret-right pull-right" style="margin-top: 6px;"></i></a>';
        } else {
            echo '<a href="'.site_url( $url ).'" class="list-group-item">'.$label.'</a>';
        }
    }
}
