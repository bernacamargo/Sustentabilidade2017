<?php
    $mensagens = $template->item( 'mensagens' );
    if( $mensagens ):
        $mensagem  = $mensagens[ count( $mensagens ) - 1 ];

?>
<script>
    var UltimaMensagem = '<?php echo $mensagem['CodMensagem']; ?>';
</script>
<?php else: ?>
<script>
    var UltimaMensagem = null;
</script>
<?php endif; 

    $nomes = explode(" ", $template->item('conversando'));
    if(count($nomes) > 1)
        $nome = $nomes[0] . " " . $nomes[count($nomes)-1];
    else
        $nome = $nomes[0];
?>
<div class="container-fluid padding-bottom-30">
<?php if(1): ?>
<?php $mensagem = $template->item( 'mensagens' ); ?>
<div class="row" style="padding: 15px; background: #fff; border-bottom: 1px solid rgba(51,51,51,.3); cursor: pointer;" onclick="location.href='<?php echo site_url('profissionais/ver/'.$template->item("conversa_id").'') ?>'" title="Clique aqui para ver o perfil profissional do <?php echo $nome ?>">
    <div class="col-md-2">
        <a href="<?php echo site_url('profissionais/ver/'.$template->item("conversa_id").'') ?>">
            <!-- <img class="img-circle media-object" width="70" src="<?php echo base_url().'uploads/'.$template->item('conversando_foto'); ?>"> -->
            <img class="img-circle media-object" width="70" src="<?php echo $template->item('conversando_foto') ? base_url( 'uploads/'.$template->item('conversando_foto') ) : 'http://www.ozkurtun.bel.tr/upload/images/Karisik/kisi.png'; ?>">

        </a>
    </div>

    <div class="col-md-10" style="margin-top: 20px;">
        <?php 
 ?>
        &ensp;&ensp;<?php echo $nome; ?>
    </div>
</div>
<div class="row">
<div class="col-md-12 conversa" id="conversaMensagem" style="height: 100%;">

    <?php foreach( $mensagem as $msg ):?>

        <?php if ( $msg['CodUsuario'] == $template->guard->user['CodUsuario'] ): ?>
        <div class="row">
            <div class="col-md-8 col-md-offset-4">
                <div class="media">
                    <div class="media-body media-message-body">
                        <h4 class="media-heading text-muted">Você  <small class="pull-right"><i class="glyphicon glyphicon-time"></i> <?php echo $msg['time'] . "&ensp;". $msg['time_tipo'] ?> atrás</small></h4><br>
                        <?php echo $msg['Mensagem']; ?>                         
                    </div><!-- mensagem -->
                    <!-- <div class="media-right" style="vertical-align: middle;">
                        <a href="#">
                            <img class="img-circle media-object" width="70" src="<?php echo $template->guard->user['Foto'] ? base_url( 'uploads/'.$template->guard->user['Foto'] ) : 'http://www.ozkurtun.bel.tr/upload/images/Karisik/kisi.png'; ?>">
                        </a>
                    </div> -->
                </div>
            </div>
            <div class="col-md-12"><br></div>
        </div><!-- mensagem enviada -->
        <br>
        <?php else: 
            $nomes = explode(" ", $msg['NomeRecebeu']);
            $nome = $nomes[0] . " " . $nomes[count($nomes)-1];
        ?>

        <div class="row">
            <div class="col-md-8">
                <div class="media">
               <!--  <div class="media-left"  style="vertical-align: middle;">
                        <a href="#">
                            <img class="img-circle media-object" width="70" src="<?php echo base_url().'uploads/'.$msg['FotoRecebeu']; ?>">
                        </a>
                    </div> -->
                    <div class="media-body media-message-body">
                        <h4 class="media-heading text-muted"><?php echo $nome; ?> <small class="pull-right"><i class="glyphicon glyphicon-time"></i> <?php echo $msg['time'] . "&ensp;". $msg['time_tipo'] ?> atrás</small></h4><br>
                        <?php echo $msg['Mensagem']; ?> 
                    </div><!-- mensagem -->
                </div>
            </div>
        </div><!-- mensagem recebida-->
<br>
        <?php endif; ?>
    <?php endforeach; ?>
</div><!-- fim conversa -->
</div>
<?php endif; ?>

<div class="">
    <form>
        <div class="col-md-12">
            <input type="hidden" id="conversaId" name="conversaId" value="<?php echo $template->item( 'conversa_id' ); ?>">
            <div class="row">
                <div class="input-group">
                    <textarea   class="form-control"
                                autofocus 
                                rows="3" 
                                id="texto"
                                placeholder="Digite sua mensagem..."></textarea>
                    <span class="input-group-addon" style="height: 100%;">                
                    <button id="enviar_mensagem" type="button" onclick="enviarMensagem();" class="btn btn-primary" style="height: 100%;">
                    Enviar
                    </button>
                    </span>
                </div>
            </div>
        </div>
    </form>
</div>
</div>