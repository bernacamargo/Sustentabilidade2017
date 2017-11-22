<?php 

$avaliacoes = $this->db->query("SELECT * FROM avaliacao WHERE CodProfissional = ".$CodProfissional."")->result_array();

if($avaliacoes){
    $total = count($avaliacoes);
    $soma = 0;    
    foreach ($avaliacoes as $avaliacao) {
        $soma += $avaliacao['Avaliacao'];
    }

    $avaliacao = $soma / $total;
}
else
    $avaliacao = 0;

$nota = $avaliacao;

if($nota > 0)
    echo '<span title="Avaliação Média: '.number_format($avaliacao, 2, '.', ',').'">';
else
    echo '<span title="Nenhuma avaliação realizada ainda">';
$cont=1;
while($avaliacao >= 1) { 
    echo '<i class="fa fa-star"></i>';
    $avaliacao--;
    $cont++;
}

if($avaliacao < 1 && $avaliacao > 0)
    echo '<i class="fa fa-star-half-o"></i>';
elseif($avaliacao == 0 && $cont <= 5)
    echo '<i class="fa fa-star-o"></i>';

while($cont < 5){
    echo '<i class="fa fa-star-o"></i>';
    $cont++;
}

echo '</span>';
             
 ?>
<?php if($nota == 0): ?>
<style>
    .fa-star, .fa-star-half-o, .fa-star-o {
        color: #555;
    }
</style>
<?php else: ?>
<style>
    .fa-star, .fa-star-half-o, .fa-star-o {
        color: #f2b01e;
        border-color: #333!important;
    }
</style>

<?php endif; ?>

<?php if($CodProfissional != $template->guard->profissional['CodProfissional'] AND $template->item('container') != 'profissionais'): ?>

 <div class="btn-group" title="Clique aqui para avaliar o">
  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Avaliar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li title="1"><a href="<?php echo site_url('avaliacao/avaliar/'.$CodProfissional.'/1') ?>">
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
    </a></li>
    <li title="2"><a href="<?php echo site_url('avaliacao/avaliar/'.$CodProfissional.'/2') ?>">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
    </a></li>                
    <li title="3"><a href="<?php echo site_url('avaliacao/avaliar/'.$CodProfissional.'/3') ?>">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
        <i class="fa fa-star-o"></i>
    </a></li>                
    <li title="4"><a href="<?php echo site_url('avaliacao/avaliar/'.$CodProfissional.'/4') ?>">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
    </a></li>                
    <li><a title="5" href="<?php echo site_url('avaliacao/avaliar/'.$CodProfissional.'/5') ?>">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
    </a></li>                
  </ul>
</div>

<?php endif; ?>