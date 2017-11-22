<?php $CodUsuario1 = $this->template->guard->user['CodUsuario'];
$busca = $this->db->query("SELECT COUNT(mensagem.CodMensagem) AS n_lidas FROM mensagem WHERE Lido = 0 AND CodPara = '$CodUsuario1'");

if($busca->num_rows() > 0)
    $n_lidas = $busca->result_array()[0]['n_lidas'];
else
    $n_lidas = 0; ?>

<!-- 
========================
== VISAO PROFISSIONAL ==
========================
 -->
<?php if(($this->guard->profissional)): ?>

<div class="row">
    <div class="col-md-12">
        <ul class="list-group">
            <a class="list-group-item list-group-header" href="" onclick="return false;"><b>Minha conta</b></a>
            <?php $template->link( '<i class="fa fa-drivers-license"></i>&ensp;Meus dados', 'meus_dados', 'meus_dados' ); ?>
            <?php $template->link( '<i class="fa fa-id-badge"></i>&ensp;Currículo', 'meus_dados/curriculo', 'curriculo' ); ?>
            <?php $template->link( '<i class="fa fa-eye"></i>&ensp;Visualizações do meu perfil', 'meus_dados/interessados', 'interessados' ); ?>   
            <a href="<?php echo site_url('conversas')?>" class="list-group-item"><i class="fa fa-comments-o"></i>&ensp;Mensagens <?php if($n_lidas > 0): ?> <span class="label label-success pull-right"><?php echo $n_lidas ?></span> <?php endif; ?></a>
            <?php $template->link( '<i class="fa fa-lock"></i>&ensp;Alterar senha', 'meus_dados/editar_perfil/senha', 'senha' ); ?>            
        </ul>
    </div>
</div>


<?php else: ?>

<div class="row">
    <div class="col-md-12">
        <ul class="list-group">
            <a class="list-group-item list-group-header" href="" onclick="return false;"><b>Minha conta</b></a>
            <?php $template->link( '<i class="fa fa-drivers-license"></i>&ensp;Meus dados', 'meus_dados', 'meus_dados' ); ?>
            <?php $template->link( '<i class="fa fa-star" style="color: #555;"></i>&ensp;Favoritos', 'profissionais/favoritos', 'favoritos' ); ?>
            <?php $template->link( '<i class="fa fa-bookmark"></i>&ensp;Meus anúncios', 'anuncios/meus_anuncios', 'meus_anuncios' ); ?>            
            <?php $template->link( '<i class="fa fa-plus"></i>&ensp;Criar currículo', 'meus_dados/curriculo', 'curriculo' ); ?>            
            <?php $template->link( '<i class="fa fa-comments-o"></i>&ensp;Mensagens', 'conversas', 'conversas' ); ?>           
            <?php $template->link( '<i class="fa fa-lock"></i>&ensp;Alterar senha', 'meus_dados/editar_perfil/senha', 'senha' ); ?>                        
        </ul>
    </div>
</div>


<?php endif; ?>