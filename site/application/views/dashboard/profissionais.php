<?php if(!$template->item( 'interessados' )): ?>

<div class="row" style="padding-top: 30px;">
    <?PHP echo form_open( 'profissionais/index', [ 'method' => 'get', 'class' => 'col-md-8 col-md-offset-2' ] ); ?>
    <div class="input-group input-group-lg">
        <span class="input-group-btn">
            <button data-placement="bottom" data-toggle="tooltip" data-html="true" class="btn btn-default"
            title="
                <b style='font-size: 1.1em;'>Categorias</b> <br>
                <?php foreach( $template->item( 'servicos' ) as $servico ){
                    echo $servico['Categoria'];
                    echo '<br>';
                }?>
">
                <span class="glyphicon glyphicon-question-sign"></span>
            </button>
        </span>
        <input  name="query" 
                type="text" 
                class="form-control" 
                value="<?php echo ( $template->item('query') ) ? $template->item('query') : ''; ?>"
                placeholder="Pesquise pelo nome ou pela categoria de serviço.">
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div><!-- /input-group -->
    <?php echo form_close(); ?>
</div>



<div class="row" style="margin-top: 50px;">
    <div class="col-md-12">
        <button class="btn btn-default hidden" onclick="location.href = '<?php echo site_url('profissionais/mapa_profissionais'); ?>'">
            Ver Mapa &nbsp;
            <span class="glyphicon glyphicon-globe"></span>
        </button>
    </div>
</div>

<?php else: ?>
<br>
<h2 class="center text-primary">Perfis interessados em seu anúncio</h2>
<br><hr>
<?php endif; ?>

<div class="row" style="padding: 10px">
    <?php if ( !$template->item( 'profissionais' ) ): ?>
        <div class="col-md-12 alert alert-danger">
            <br>
            <i class="fa fa-warning"></i>&ensp;Nenhum profissional encontrado
        </div>
    <?php else: $cont=1;?>
        <?php foreach( $template->item( 'profissionais' ) as $profissional ): 

            if($cont == 1)
                echo '<div class="row">';

        ?>

            <div  class="conversas col-md-4">
                <div class="media" style="background: #fff; padding: 20px 10px;">
                    <div class="media-center">
                        <a title="Clique aqui para visualizar a página de perfil do(a) profissional <?php echo $profissional['Nome']?>" href="<?php echo site_url('profissionais/ver/'.$profissional['CodUsuario']); ?>">
                            <img    class="media-object center-block" 
                                    width="150"
                                    onerror="broken( this )"
                                    src="<?php echo $profissional['Foto'] ? base_url( 'uploads/'.$profissional['Foto'] ) : base_url( 'uploads/avatar.jpg' ); ?>"><br>
                        </a>
                    </div>
                    <div class="media-body center" title="Clique aqui para visualizar a página de perfil do(a) profissional <?php echo $profissional['Nome']?>" onclick="location.href = '<?php echo site_url('profissionais/ver/'.$profissional['CodUsuario']); ?>'">
                        <h4 class="media-heading"><?php echo $profissional['Nome']; ?></h4>
                        <div class="tags row">
                            <div class="col-md-12">
                                <strong>
                                    <?php echo $profissional['Categoria']; ?>
                                </strong>
                            </div>
                            <div class="col-md-12">
                                <strong><?php echo $profissional['Experiencia']; ?> anos de experiencia</strong>
                            </div>
                            <div class="col-md-12">
                                <?php if( !$profissional['Login'] ): ?>
                                Agora mesmo
                                <?php else: ?>
                                <?php echo $profissional['Login']; ?> 
                                <?php echo $profissional['Tipo']; ?> atrás
                                <?php endif; ?>
                            </div> 
                            <div class="col-md-12">
                                <strong>R$ <?php echo $profissional['Valor']; ?></strong>
                            </div>
                        </div><!-- descrição -->
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-block btn-primary" onclick="location.href = '<?php echo site_url('conversas/conversa/'.$profissional['CodUsuario']); ?>'">
                                <span class="glyphicon glyphicon-envelope"></span>
                                Entrar em contato
                            </button>
                        </div>
                    </div><!-- botão -->
                </div>
            </div>
        <?php 
        if($cont == 3){
            echo '</div>';
            $cont = 1;
        }
        else
            $cont++;
        endforeach; ?>
    <?php endif; ?>
</div>


<?php 

$atual = $template->item('pagina');
$anterior = $atual - 1;
$anterior2 = $anterior - 1;
$proximo = $atual + 1;
$proximo2 = $proximo + 1;
$total = $template->item('total');
 ?>

<!-- Existe mais de uma pagina -->
<?php if($total >= 1): ?>

<div class="container-fluid center">
    <ul class="pagination center">
      <li><a <?php if($atual == 1): ?> class="disabled" disabled <?php else: ?> href="<?php echo base_url('profissionais/index/'.$anterior.'')?>" <?php endif; ?>>«</a></li>

        <?php if($atual-1 > 0 && $atual-2 > 0): ?>

      <li><a href="<?php echo base_url('profissionais/index/'.$anterior2.''); ?>"><?php echo $anterior2; ?></a></li>  
      <li><a href="<?php echo base_url('profissionais/index/'.$anterior.''); ?>"><?php echo $anterior; ?></a></li>  
    
        <?php elseif($atual-1 > 0 && $atual-2 == 0): ?>

      <li><a href="<?php echo base_url('profissionais/index/'.$anterior.''); ?>"><?php echo $anterior; ?></a></li>  
        
        <?php endif; ?>

      <li class="active"><a href="<?php echo base_url('profissionais/index/'.$template->item( 'pagina' ).'') ?>"><?php echo $template->item( 'pagina' ) ?><span class="sr-only">(current)</span></a></li>


    <?php if($atual+1 < $total && $atual+2 < $total): ?>

      <li><a href="<?php echo base_url('profissionais/index/'.$proximo.''); ?>"><?php echo $proximo; ?></a></li>
      <li><a href="<?php echo base_url('profissionais/index/'.$proximo2.''); ?>"><?php echo $proximo2; ?></a></li>

      <?php elseif($atual+1 == $total && $atual+2 > $total): ?> 

      <li><a href="<?php echo base_url('profissionais/index/'.$proximo.''); ?>"><?php echo $proximo; ?></a></li>

    <?php endif; ?>

    <li><a <?php if($atual == $total): ?> class="disabled" disabled <?php else: ?> href="<?php echo base_url('profissionais/index/'.$proximo.'')?>" <?php endif; ?>>»</a></li>

    </ul>
</div>

<?php endif; ?>