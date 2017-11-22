<?php 

require_once __DIR__ . '/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '112430766139075',
    'app_secret' => 'b03c9bcbfae4f55c6510b09d3ba36f87',
  'default_graph_version' => 'v2.2'
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl(site_url('login/facebook_login'), $permissions);

// echo '<a style="background: #3b5998!important; color: #fff!important;" class="btn btn-social btn-facebook btn-lg" href="' . htmlspecialchars($loginUrl) . '"><i class="fa fa-facebook"></i>&ensp;Entrar com facebook!</a>';

 ?>
          <!--   <hr style="border-top-color: rgba(255,255,255,.15);">

            <p class="text-center" style="color: #fff">ou</p>

            <hr style="border-top-color: rgba(255,255,255,.15);"> -->
<h3 style="color: #00b8a9;">L&ensp;O&ensp;G&ensp;I&ensp;N</h3><br>
<?PHP if ( $template->item( 'errors' ) ): ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger">
            <b><i class="fa fa-warning"></i></b>&ensp;<?PHP echo $template->item( 'errors' ); ?>
        </div>
    </div>
</div>
<?PHP endif; ?><!-- erros de validacao -->


            <div class="form-group">
                <!-- <label for="Email">E-mail</label> -->
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </span>
                    <input  type="email" 
                            value="<?php echo set_value('Email')?>"  
                            class="form-control" 
                            id="Email" 
                            name="Email" 
                            placeholder="email@example.com">

                </div>
            </div><!-- email -->

            <div class="form-group">
                <!-- <label for="Senha">Senha</label> -->
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-lock"></i>
                    </span>
                
                    <input  type="password" 
                        value="<?php echo set_value('Senha')?>"
                        class="form-control" 
                        id="Senha" 
                        name="Senha" 
                        placeholder="********">
                </div>
            </div><!-- senha -->

            <!-- botoes de ação -->
            <div class="row">
                <div class="col-md-12 text-left"><br>
                    <small>
                        <a href="#" style="color: #00b8a9;">Esqueci minha senha</a><br>
                    </small>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-block btn-lg btn-primary">Entrar</button>
                </div>
                <br><hr><br><br>
                <p class="text-center" style="color: #fff"><br>Ainda não possui uma conta?</p>

                <div class="col-md-12 text-center">
                    <a href="<?PHP echo site_url('signup'); ?>" class="btn btn-secundary" style="color: #00b8a9">Cadastre-se Grátis</a>                    
                </div>
                


            </div><!-- links de acao -->