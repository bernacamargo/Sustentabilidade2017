
<h3>Contatos</h3>

<?php if(!$template->item('cvs')): ?>

<div class="row">
	<div class="alert alert-warning">
		<i class="fa fa-info"></i>&ensp;Nenhum contato feito ainda
	</div>
</div>

<?php else: ?>
<?php foreach ($template->item('cvs') as $conversa): 

$CodUsuario = $conversa['CodUsuario'];
$CodUsuario2 = $this->template->guard->user['CodUsuario'];
?>

<?php $n_lidas = $this->db->query("SELECT COUNT(mensagem.CodMensagem) AS n_lidas FROM mensagem WHERE Lido = 0 AND CodPara = '$CodUsuario2' AND CodUsuario = '$CodUsuario'")->result_array()[0]['n_lidas']; ?>

<div class="row row_contato" onclick="location.href='<?php echo site_url('conversas/conversa/'.$conversa['CodUsuario'].'') ?>'">
	<div class="col-md-12 ">
	    <div class="media" style="height: 80px;padding-top: 15px;">
	        <div class="media-left">
	            <a href="<?php echo site_url('conversas/conversa/'.$conversa['CodUsuario'].'') ?>">
	                <img class="img-circle media-object" width="50" src="<?php echo $conversa['Foto'] ? base_url( 'uploads/'.$conversa['Foto'] ) : 'http://www.ozkurtun.bel.tr/upload/images/Karisik/kisi.png'; ?>">
	            </a><!-- imagem do usuario -->
	        </div>
	        <div class="media-body" style=" vertical-align: middle;">
	            <h4 class="media-heading"><?php echo $conversa['Nome']; ?></h4>
	        </div><!-- mensagem -->
	        <div class="media-right" style="padding-top: 10px;">
	        	<?php if($n_lidas > 0): ?>
	        		<span class="label label-success"><?php echo $n_lidas ?></span>
	        	<?php endif; ?>
	        </div>
	    </div>
	</div>
</div><!-- mensagem enviada -->

<?php endforeach; ?>



<style>
	.row_contato {
		background: #fff; 
		border: 1px solid rgba(51,51,51,.2); 
		boder-radius: 5px;
		cursor: pointer;
	}

	.row_contato:hover {
		background: #f0f0f0;
		color: #555;
	}

</style>

<?php endif; ?>