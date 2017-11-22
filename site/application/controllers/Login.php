<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }

    // valida o formulário de cadastro
    private function _validarFormulario() {
        
        // regras de validacao
        $rules = [
            [
                'field' => 'Email',
                'label' => 'E-mail',
                'rules' => 'required|trim|valid_email'
            ], [
                'field' => 'Senha',
                'label' => 'Senha',
                'rules' => 'required|min_length[8]|max_length[16]'
            ]
        ];

        // valida o formulário
        $this->form_validation->set_rules( $rules );
        return $this->form_validation->run();
    }

    public function index() {
        if ( $this->guard->logged() ) {
            redirect( site_url() );
            exit();
        }

        // seta o titulo da pagina
        $this->template->set_title( 'Work for all - Login' );

        // renderiza a pagina
        $this->template->render( 'login' );
    }

    public function facebook_login() {

        // require_once ('D:\xampp\htdocs\workforall\site\application\libraries\autoload.php');
        require_once '/home/storage/e/64/40/workforall1/public_html/site/application/views/components/autoload.php';
        
        $fb = new \Facebook\Facebook([
          'app_id' => '112430766139075',
          'app_secret' => 'b03c9bcbfae4f55c6510b09d3ba36f87',
          'default_graph_version' => 'v2.9',
          //'default_access_token' => '{access-token}', // optional
        ]);

        $helper = $fb->getRedirectLoginHelper();
        //var_dump($helper);
        $permissions = ['email']; // Optional permissions

        try {
            if(isset($_SESSION['face_access_token'])){
                $accessToken = $_SESSION['face_access_token'];
            }else{
                $accessToken = $helper->getAccessToken();
            }
            
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            // $url_login = 'http://localhost/workforall/';
            $url_login = 'http://workforall.com/';
            $loginUrl = $helper->getLoginUrl($url_login, $permissions);
            var_dump($loginUrl);
        }else{
            // $url_login = 'http://localhost/workforall/';
            $url_login = 'http://workforall.com/';            
            $loginUrl = $helper->getLoginUrl($url_login, $permissions);
            //Usuário ja autenticado
            if(isset($_SESSION['face_access_token'])){
                $fb->setDefaultAccessToken($_SESSION['face_access_token']);
            }//Usuário não está autenticado
            else{
                $_SESSION['face_access_token'] = (string) $accessToken;
                $oAuth2Client = $fb->getOAuth2Client();
                $_SESSION['face_access_token'] = (string) $oAuth2Client->getLongLivedAccessToken($_SESSION['face_access_token']);
                $fb->setDefaultAccessToken($_SESSION['face_access_token']); 
            }
            
            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $fb->get('/me?fields=name, picture, email');
                $user = $response->getGraphUser();
                var_dump($user);
                // pega os dados do usuário

                $this->facebook_logar($user);


            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
            }
        }

    }

    public function facebook_logar($user) {
        $this->load->model('Usuarios_model');

        // verifica se o usuário ja existe        
        if ( $existe_usuario = $this->Usuarios_model->existeUsuario($user['email']) ) {

            if($this->guard->login_facebook($user['email'])){
                // redireciona para a pagina inicial    
                redirect( site_url() );
            }

            return true;

        } 
        // Usuario não existe
        else {

            $dados = [
                'Nome'      => $user['name'],
                'Email'     => $user['email']
            ];

            // carrega a model e salva o usuario
            $this->load->model( 'Usuarios_model' );
            if ( $this->Usuarios_model->create( $dados ) ) {

                if($this->guard->login_facebook($dados['Email'])){
                    // redireciona para a pagina inicial
                    redirect( site_url('meus_dados/editar_perfil') );
                }
                
                return true;

            }
            else
                return false;

    }
}   

    // mostra o formulario de login
    public function logar() {
        // verifica se o formulário é valido
        if ( $this->_validarFormulario() !== false ) {

            // pega os dados do usuário
            $email    = $this->input->post( 'Email' );
            $password = $this->input->post( 'Senha' );

            // tenta fazer o login
            if ( $this->guard->login( $email, $password ) ) {
                
                // redireciona para a pagina inicial
                redirect( site_url() );
                exit();
            } else $this->template->set( 'errors', 'E-mail ou senha incorretos' );

        } else $this->template->set( 'errors', validation_errors() );

        // seta o titulo da pagina
        $this->template->set_title( 'Work for all - Login' );

        // renderiza a pagina
		$this->template->render( 'login' );
    }

    public function logout() {

        $this->guard->logout();
        redirect( site_url('login')); 
    }

}
