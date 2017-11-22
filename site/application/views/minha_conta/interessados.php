<?php 
$interessados = $template->item('interessados');
 ?>

 <div class="container-fluid">
<br>
	<h2 class="text-primary text-center">Interesses em seu perfil</h2>
	<hr>
 	<?php 

 	if(!$interessados): ?>

	<div class="alert alert-danger col-md-12 center">
		<i class="fa fa-warning"></i>&ensp;Nenhum resultado encontrado.
	</div>

<?php else:
 	$cont = 1;
 	foreach ($interessados as $interessado): 

 		if($cont == 1)
 			echo '<div class="row" style="margin-top: 20px;">';
 	?>
	
 	
		<div class="col-md-3" <?php if($cont != 4 && $cont != count($interessados)) echo 'style="border-right: 1px solid rgba(51,51,51,.2)"' ?>>
		        <h4 class="text-center text-primary"><?php echo $interessado['Nome'] ?></h4>
		        <img class="img-responsive center-block" 
		        height="100%"
		        onerror="broken( this )"
		        src="<?php echo $interessado['Foto'] ? base_url( 'uploads/'.$interessado['Foto'] ) : base_url( 'uploads/avatar.jpg' ); ?>">
		        
		</div>


	<?php 
	if($cont == 4){
		echo '</div>';
		$cont = 1;
	}
	else
		$cont++;
	endforeach; 


endif;
	?>
 </div>