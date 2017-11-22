<div class="row" style="padding-top: 30px;">
    <?PHP echo form_open( 'anuncios/index', [ 'method' => 'get', 'class' => 'col-md-8 col-md-offset-2' ] ); ?>
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
                placeholder="Pesquise por uma categoria...">
        <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div><!-- /input-group -->
    <?php echo form_close(); ?>
</div>

<!--<div class="row">
    <div class='col-md-12'>
        <button class="btn btn-warning" onclick="location.href = '<?php echo site_url('anuncios/mapa_anuncios'); ?>'">
            Ver Mapa &nbsp;
            <span class="glyphicon glyphicon-globe"></span>
        </button>
    </div?>
    <div class="col-md-12"><br></div>
</div>-->

<div class="row" style="margin-top: 50px;">
    <div class="col-md-12">
        <button class="btn btn-primary" onclick="location.href='<?php echo site_url('anuncios/meus_anuncios') ?>'"><i class="fa fa-eye"></i> Meus anuncios</button>
    </div>
</div>

<div class="row" style="padding: 10px; margin-top: 20px;">

    <?php $anuncios = $template->item( 'anuncios' );?>
    <?php if ( count( $anuncios ) == 0 ) : ?>
    <div class="col-md-12">
        Nenhum resultado encontrado
    </div>
    <?php else: $cont = 1;?>
    <?php foreach( $anuncios as $anuncio ): 
        if($cont == 1)
            echo '<div class="row">';

    ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body center row">
                    <div class="col-md-12">
                        <?php echo $anuncio['Categoria'] ?>
                    </div>
                    <div class="col-md-12">
                        <h4><?php echo $anuncio['Endereco']; ?></h4>
                    </div>
                    <div class="col-md-12">
                        <?php if( !$anuncio['Data'] ): ?>
                        Agora mesmo
                        <?php else: ?>
                        <?php echo $anuncio['Data']; ?> 
                        <?php echo $anuncio['Tipo']; ?> atrás
                        <?php endif; ?>
                    </div>  
                    <div class="col-md-12">
                        <strong>R$ <?php echo number_format( $anuncio['Valor'], 2, ',', ' ' ); ?></strong>
                    </div>
                    <div class="col-md-12">
                        <?php echo $anuncio['Frequencia']; ?>
                    </div>
                    <div class="col-md-12" style="overflow: hidden; max-height: 150px;  ">
                        <br>
                        <strong>Descrição</strong>
                        <br>
                        <p>
                        <?php
                            echo $anuncio['Descricao'];
                        ?>
                        </p>
                    </div>
                </div>
                <div class="panel-footer">
                    
                    <div class="col-md-12 text-center" role="group">
                    <?php if ( $template->guard->profissional AND $anuncio['CodUsuario'] != $template->guard->user['CodUsuario'] ) :?>
                            <?php if ( !$template->guard->interessado( $anuncio['CodAnuncio'] ) ) : ?>
                                <button type="button" class="btn btn-xs btn-primary" onclick="location.href = '<?php echo site_url('anuncios/interesse/'.$anuncio['CodAnuncio'] ); ?>';">
                                <span class="glyphicon glyphicon-check"></span>
                                Candidatar-se
                                </button>
                            <?php else : ?>
                                <button type="button" class="btn btn-xs btn-danger" onclick="location.href = '<?php echo site_url('anuncios/desistir/'.$anuncio['CodAnuncio'] ); ?>'">
                                <span class="glyphicon glyphicon-remove"></span>
                                Desistir
                                </button>
                            <?php endif; ?>
                    <?php endif; ?>
                        &ensp;
                        <?php if($anuncio['CodUsuario'] != $template->guard->user['CodUsuario']): ?>
                        <button type="button" class="btn btn-xs btn-default" onclick="location.href = '<?php echo site_url('conversas/conversa/'.$anuncio['CodUsuario'] ); ?>'">
                            <span class="glyphicon glyphicon-envelope"></span>
                            Contato
                        </button>
                        <?php else: ?>
                            <button onclick="location.href = '<?php echo site_url('profissionais/interessados/'.$anuncio["CodAnuncio"].'') ?>'" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Interessados</button>
            
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
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


<div class="container-fluid center">
    <ul class="pagination center">
      <li><a <?php if($atual == 1): ?> class="disabled" disabled <?php else: ?> href="<?php echo base_url('anuncios/index/'.$anterior.'')?>" <?php endif; ?>>«</a></li>

        <?php if($atual-1 > 0 && $atual-2 > 0): ?>

      <li><a href="<?php echo base_url('anuncios/index/'.$anterior2.''); ?>"><?php echo $anterior2; ?></a></li>  
      <li><a href="<?php echo base_url('anuncios/index/'.$anterior.''); ?>"><?php echo $anterior; ?></a></li>  
    
        <?php elseif($atual-1 > 0 && $atual-2 == 0): ?>

      <li><a href="<?php echo base_url('anuncios/index/'.$anterior.''); ?>"><?php echo $anterior; ?></a></li>  
        
        <?php endif; ?>

      <li class="active"><a href="<?php echo base_url('anuncios/index/'.$template->item( 'pagina' ).'') ?>"><?php echo $template->item( 'pagina' ) ?><span class="sr-only">(current)</span></a></li>


    <?php if($atual+1 < $total && $atual+2 < $total): ?>

      <li><a href="<?php echo base_url('anuncios/index/'.$proximo.''); ?>"><?php echo $proximo; ?></a></li>
      <li><a href="<?php echo base_url('anuncios/index/'.$proximo2.''); ?>"><?php echo $proximo2; ?></a></li>

      <?php elseif($atual+1 == $total): ?> 

      <li><a href="<?php echo base_url('anuncios/index/'.$proximo.''); ?>"><?php echo $proximo; ?></a></li>

    <?php endif; ?>

    <li><a <?php if($atual == $total): ?> class="disabled" disabled <?php else: ?> href="<?php echo base_url('anuncios/index/'.$proximo.'')?>" <?php endif; ?>>»</a></li>
    </ul>
</div>

<div class="row" hidden>
    <div class="col-md-12 center">
        <?php if ( $template->item( 'pagina' ) != 1 ): ?>
        <button class="btn btn-warning btn-lg">
            Anterior
        </button>
        <?php endif; ?>
        <?php if ( $template->item( 'pagina' ) <  $template->item( 'total' ) ): ?>
        <button class="btn btn-info btn-lg">
            Proximo
        </button>
        <?php endif; ?>        
    </div>
</div>


<div class="row" style="margin-top: 50px;">
    

</div>