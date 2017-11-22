<?php 
$nomes = explode(" ", $template->guard->user['Nome']);
if($nomes[0] !== $nomes[count($nomes)-1])
    $nome = $nomes[0]." ".$nomes[count($nomes)-1];
else
    $nome = $nomes[0];

$CodUsuario1 = $this->template->guard->user['CodUsuario'];
$busca = $this->db->query("SELECT COUNT(mensagem.CodMensagem) AS n_lidas FROM mensagem WHERE Lido = 0 AND CodPara = '$CodUsuario1'");

if($busca->num_rows() > 0)
    $n_lidas = $busca->result_array()[0]['n_lidas'];
else
    $n_lidas = 0;

if($template->item('container') === 'Home')
    $class_nav = "";
else
    $class_nav = "navbar-fixed-top fh5co-animated slideInDown";

$template->guard->update();

 ?>


<header role="banner" id="fh5co-header" class="<?php echo $class_nav ?>">
        <div class="container">
            <nav class="navbar navbar-default">
            <style>
                #dropdown_menu_ajuda li a{
                    padding: 15px;
                    font-size: 1.1em;
                }

            </style>
            <?php if ( $template->guard->logged() ):?>

            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-left">
                <?php if($template->item('container') === "Home"): ?>

                    <li class="active"><a href="#" data-nav-section="home"><span>Home</span></a></li>
                    <li><a href="#" data-nav-section="about"><span>Sobre</span></a></li>
                    <li><a href="#" data-nav-section="contact"><span>Contato</span></a></li>
                    
                    <?php $template->print_component('dropdown_ajuda') ?>

                <?php else: ?>

                    <li><a role="button" href="<?php echo site_url() ?>"><span>Home</span></a></li>
                    <li class="<?php if($template->item('container') === 'anuncios') echo 'active'; ?>"><a role="button" href="<?php echo site_url('anuncios') ?>"><span>Encontrar trabalhos</span></a></li>
                    <li class="<?php if($template->item('container') === 'profissionais') echo 'active'; ?>"><a role="button" href="<?php echo site_url('profissionais') ?>"><span>Encontrar profissionais</span></a></li>
                    <?php $template->print_component('dropdown_ajuda') ?>


                <?php endif; ?>

                </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a style="border-color: transparent!important;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>&ensp;<?php echo $nome; ?>
                    </a>
                    <ul class="dropdown-menu" style="width: 100%;">
                        <li><a href="<?php echo site_url( 'meus_dados' );?>"><i class="fa fa-cog"></i>&ensp;Minha conta</a></li>
                        <li><a href="<?php echo site_url( 'conversas' );?>"><i class="fa fa-comments-o"></i>&ensp;Mensagens <?php if($n_lidas > 0): ?> <span class="label label-success pull-right"><?php echo $n_lidas ?></span> <?php endif; ?></a></li>
                        <li><a href="<?php echo site_url( 'anuncios' );?>"><i class="fa fa-eye"></i>&ensp;Ver Anúncios</a></li>

                    <?php if(!$template->guard->profissional): ?>
                        <li><a href="<?php echo site_url( 'anuncios/criar_anuncio');?>"><i class="fa fa-plus"></i>&ensp;Criar Anúncio</a></li>
                        <li><a href="<?php echo site_url( 'meus_dados/curriculo');?>"><i class="fa fa-plus"></i>&ensp;Criar Currículo</a></li>

                    <?php else: 
                    ?>

                        <?php if($template->guard->profissional['ativo'] == 1): ?>

                        <li><a href="<?php echo site_url( 'meus_dados/curriculo')?>"><i class="fa fa-pencil"></i>&ensp;Editar Currículo</a></li>
                        <li><a href="<?php echo site_url( 'meus_dados/desativar_perfil/'.$template->guard->item("CodUsuario").'' );?>"><i class="fa fa-remove"></i>&ensp;Inativar Currículo</a></li>

                        <?php else: ?>

                        <li><a href="<?php echo site_url( 'meus_dados/ativar_perfil/'.$template->guard->item("CodUsuario").'' );?>"><i class="fa fa-check"></i>&ensp;Ativar Currículo</a></li>

                        <?php endif; ?>

                        <li><a href="#" onclick="return false;" data-toggle="modal" data-target="#confimar_exclusao"><i class="fa fa-trash"></i>&ensp;Excluir Currículo</a></li>

                    <?php endif; ?>
            
<!--                         <li><a href="<?php echo site_url( 'meus_dados/editar_perfil/senha' ); ?>"><i class="fa fa-lock"></i>&ensp;Alterar Senha</a></li>
 -->                        <li><a href="<?php echo site_url( 'login/logout' ); ?>"><i class="fa fa-sign-out"></i>&ensp;Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>

            <?php else: ?>

            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-left">
                <?php if($template->item('container') === 'Home'): ?>
                <li><a href="#" data-nav-section="home"><span>Home</span></a></li>
                <li><a href="#" data-nav-section="about"><span>Sobre</span></a></li>
                <li><a href="#" data-nav-section="contact"><span>Contato</span></a></li>
                <?php $template->print_component('dropdown_ajuda') ?>
                <?php else: ?>
                <li class=""><a href="<?php echo site_url() ?>"><span>Home</span></a></li>

                <?php $template->print_component('dropdown_ajuda') ?>

                <?php endif; ?>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a class="" style="border-color: transparent!important;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>&ensp;Entrar
                    </a>
                    <div class="dropdown-menu" style="width: 350px; padding: 0;">

        <?PHP echo form_open('login/logar', [ 'class' => 'col-md-12 center', 'style' => 'background: #333; padding: 30px 15px; border: 1px solid rgba(51,51,51,.3)' ] ); ?>
                
        <?php $template->print_component('login') ?>

        <?PHP echo form_close(); ?>

                    </div>
                </li>



              </ul>
            </div>
            <?php endif; ?>
            </nav>
          <!-- </div> -->
      </div>
</header>


<nav class="navbar navbar-default navbar-fixed-top" hidden>
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url(); ?>">LOGO</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <ul class="nav navbar-nav navbar-left">
                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                <li><a href="<?php echo site_url( 'paginas/sobre' );?>">Sobre</a></li>
                <li><a href="<?php echo site_url( 'paginas/contato' );?>">Contato</a></li>
            </ul><!-- lado esquerdo -->

            <?php if ( $template->guard->logged() ):?>
            <ul class="nav navbar-nav navbar-right navbar-logged">
                <!-- <li><a style="border: 1px solid rgba(255,255,255,.5); color: #fff!important;" href="<?php echo site_url( 'meu_plano/planos' );?>">Planos</a></li>                 -->
                <li><a style="border: 1px solid rgba(255,255,255,.5); color: #fff!important;" href="<?php echo site_url( 'meu_plano/planos' );?>">Planos</a></li>                
                <li class="dropdown">
                    <a style="border-color: transparent!important;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>&ensp;<?php echo $nome; ?>
                    </a>
                    <ul class="dropdown-menu" style="width: 100%;">
                        <li><a href="<?php echo site_url( 'meus_dados' );?>"><i class="fa fa-drivers-license"></i>&ensp;Minha conta</a></li>
                        <li><a href="<?php echo site_url( 'conversas' );?>"><i class="fa fa-comments-o"></i>&ensp;Mensagens <?php if($n_lidas > 0): ?> <span class="label label-success pull-right"><?php echo $n_lidas ?></span> <?php endif; ?></a></li>
                        <li><a href="<?php echo site_url( 'anuncios' );?>"><i class="fa fa-eye"></i>&ensp;Ver Anúncios</a></li>

                    <?php if(!isset($template->guard->profissional['CodProfissional'])): ?>
                        <li><a href="<?php echo site_url( 'meus_dados/curriculo');?>"><i class="fa fa-plus"></i>&ensp;Criar Currículo</a></li>
                        <li><a href="<?php echo site_url( 'anuncios/criar_anuncio');?>"><i class="fa fa-plus"></i>&ensp;Criar Anúncio de emprego</a></li>
                    <?php else: ?>
                        <?php if($template->guard->profissional['ativo'] == 1): ?>
                        <li><a href="<?php echo site_url( 'meus_dados/curriculo')?>"><i class="fa fa-pencil"></i>&ensp;Editar Currículo</a></li>
                        <li><a href="<?php echo site_url( 'meus_dados/desativar_perfil/'.$template->guard->item("CodUsuario").'' );?>"><i class="fa fa-remove"></i>&ensp;Inativar Currículo</a></li>
                        <?php else: ?>
                        <li><a href="<?php echo site_url( 'meus_dados/ativar_perfil/'.$template->guard->item("CodUsuario").'' );?>"><i class="fa fa-check"></i>&ensp;Ativar Currículo</a></li>
                        <?php endif; ?>
                        <li><a href="#" onclick="return false;" data-toggle="modal" data-target="#confimar_exclusao"><i class="fa fa-trash"></i>&ensp;Excluir Currículo</a></li>
                    <?php endif; ?>
                        <li><a href="<?php echo site_url( 'login/logout' ); ?>"><i class="fa fa-sign-out"></i>&ensp;Sair</a></li>
                    </ul>
                </li>
            </ul><!-- lado direito -->
            <?php else: ?>
             <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="btn btn-success" style="border-color: transparent!important;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>&ensp;Entrar
                    </a>
                    <div class="dropdown-menu" style="width: 350px">

        <?PHP echo form_open('login/logar', [ 'class' => 'col-md-12 bg-primary', 'style' => 'background: #fff; padding: 30px 15px; border: 1px solid rgba(51,51,51,.3)' ] ); ?>

            <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>

            <hr>

            <p class="text-center">ou</p>

            <hr>

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

            <?PHP if ( $template->item( 'errors' ) ): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <?PHP echo $template->item( 'errors' ); ?>
                    </div>
                </div>
            </div>
            <?PHP endif; ?><!-- erros de validacao -->

            <!-- botoes de ação -->
            <div class="row">
                <div class="col-md-12">
                    <a href="#">Esqueci minha senha</a><br>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-block btn-lg btn-success">Entrar</button>
                </div>
                <br><br><br><hr>
                <p class="text-center">Ainda não possui uma conta?</p>

                <div class="col-md-12 text-center">
                    <a href="<?PHP echo site_url('signup'); ?>" class="btn btn-default">Cadastre-se</a>                    
                </div>
                


            </div><!-- links de acao -->
        <?PHP echo form_close(); ?>

                    </div>
                </li>

             </ul>
            <?php endif; ?>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>

<div class="modal fade center" id="confimar_exclusao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-left: auto; margin-right: auto;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmar Ação</h4>
      </div>
      <div class="modal-body">
        <p>
            Tem certeza que seja <b>excluir</b> seu currículo?
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
        <a class="btn btn-danger " href="<?php echo site_url('meus_dados/excluir_perfil/'.$template->guard->item('CodUsuario').'') ?>"><i class="fa fa-trash"></i>&ensp;Excluir</a>
      </div>
    </div>
  </div>
</div>
