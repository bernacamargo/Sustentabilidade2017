<h2 class="text-primary text-bold center">
    Meus profissionais
</h2>

<hr>

<?php 

$plano = $template->item('planos');

if(!$template->item('interessados')): ?>


	<div class="row">
		<div class="col-md-12 alert alert-danger center"><i class="fa fa-warning"></i>&ensp;Nenhum profissional declarou interesse em seus anúncios.</div>
	</div>

<?php else: $cont = 1;?>

<div class="container-fluid">
	
<?php foreach ($template->item('interessados') as $interessado): ?>

<div class="row" style="padding-top: 30px;">
    <div class="col-md-2">
        <img class="img-responsive center-block" 
            onerror="broken( this )"
            src="<?php echo $interessado['Foto'] ? base_url( 'uploads/'.$interessado['Foto'] ) : base_url( 'uploads/avatar.jpg' ); ?>
        ">    
    </div>
    <div class="col-md-5">
        <h4 class="text-primary">
        <div id="litResultado"></div>
            <b><a href="<?php echo site_url('profissionais/ver/'.$interessado['CodUsuario'].'') ?>" title="Clique aqui para ver o perfil profissional do <?php echo $interessado['Nome'] ?>"><?php echo $interessado['Nome']; ?></a></b><span class="text-normal">/Cod. <?php echo $interessado['CodUsuario']?></span> <br>
            
            <?PHP 
                $dados = [
                    'CodProfissional' => $interessado['CodProfissional']
                ];

                $template->print_component( 'avaliacao', $dados ); 
            ?>

<br>
            <small><?php echo $interessado['Categoria'] ?>&ensp;|&ensp;<?php echo $interessado['Idade']; ?> anos&ensp;|&ensp;<?php echo $interessado['Experiencia']; ?> anos de experiência</small> <br>
            <small>R$ <?php echo number_format($interessado['Valor'], 2, ',', '.'); ?></small> <br>

        </h4>
    </div>

    <?php if($plano['CodPlano'] == 4): ?>

    <div class="col-md-5 text-right">
        <button type="button" class="btn btn-info" onclick="location.href='<?php echo site_url('meu_plano') ?>'">Ver contatos</button> 
        <br><br>
        <p>
            Para visualizar o contato desse profissional, 
            <a href="<?php echo site_url('meu_plano') ?>" class="text-info">contrate um de nossos planos.</a>
        </p> <br><br>

        <p>
        </p>
    </div>

    <?php else: ?>
    
    <div class="col-md-5 text-right">
        <button type="button" class="btn btn-primary <?php if($interessado['CodUsuario'] == $template->guard->item('CodUsuario')): echo 'disabled'; ?>" <?php else: ?> onclick="location.href='<?php echo site_url('conversas/conversa/'.$interessado['CodUsuario']); ?>'" <?php endif; ?>><i class="fa fa-comments-o"></i> Enviar Mensagem</button>
        
        <h4>
            <small style="color: #999!important;">
                <i class="fa fa-phone"></i>&ensp;<?php echo $interessado['Celular'] ?>        
                <br>
                <a style="color: #999;" href="mail:<?php echo $interessado['Email'] ?>"><i class="fa fa-envelope"></i>&ensp;<?php echo $interessado['Email'] ?></a>  
                <br>
                <b>CPF</b>&ensp;<?php echo $interessado['CPF'] ?>                    
            </small>
        </h4>
    </div>



    <?php endif; ?>
</div>

<?php if($cont < count($template->item('interessados'))) echo '<hr>'; ?>

<?php $cont++; endforeach; ?>



</div>


<?php endif; ?>