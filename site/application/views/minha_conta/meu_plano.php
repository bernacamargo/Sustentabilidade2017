<?php if($template->item('linkPagamento')): ?>
    <script>
        window.open("<?php echo $template->item('linkPagamento') ?>"); 
    </script>
<?php endif; ?>

<?php 

$plano = $template->item('plano_usuario');

 ?>

<!-- NENHUM PLANO -->
<?php if($template->guard->user['CodPlano'] == 4): ?>

<div class="row" style="padding-top: 30px;">
    
    <div class="col-md-12">
        
        <h4 class="text-primary text-bold">
            Meu Plano
        </h4>
        <p>
            Seu currículo foi publicado de forma gratuita. Agora todos os anunciantes de vagas domésticas poderão ver seu currículo e te contatar.
            <br>    <br>    
            Assine um dos nossos planos para obter mais vantagens!
            <br>    

        </p>

    </div>

</div>

<hr>

<div class="row">
    <h1 class="center">Planos</h1>


    <?php foreach( $template->plano->planos as $plano ): ?>
    <?php echo form_open('meu_plano/contratar_plano', [ 'class' => 'col-md-4' ] );?>
        <input type="hidden" name="CodPlano" value="<?php echo $plano['CodPlano']; ?>">
        <div class="panel panel-info">
            <div class="panel-heading text-center"><?php echo $plano['Plano']; ?></div>
            <div class="panel-body center">
                <?php $inteiro = floor( $plano['Valor'] ); ?>
                <?php $decimal = ( $plano['Valor'] - $inteiro ) * 10; ?>
                <?php $decimal = strlen( $decimal ) == 1 ? $decimal.'0' : $decimal; ?>
                <h1>R$ <?php echo $inteiro; ?><small>,<?php echo $decimal; ?></small></h1>
            </div>
            <ul class="list-group">
                <?php foreach( $template->plano->rotinas as $rotina ): ?>
                <li class="list-group-item">
                    <?php echo $rotina['Rotina']; ?>
                    <?php if ( $template->plano->hasPermission( $plano['CodPlano'], $rotina['REF'] ) ): ?>
                    <span class="badge">
                        <span class="glyphicon glyphicon-ok"></span>
                    </span>
                    <?php endif; ?>
                </li>
                <?php endforeach;?>
                <?php if ( $template->guard->item('CodPlano') != $plano['CodPlano'] ): ?>
                <li class="list-group-item">
                    <button class="btn btn-warning btn-block">Contratar</button>
                </li>
                <?php else: ?>
                <li class="list-group-item">
                    <button class="btn btn-default btn-block" disabled="disabled">Contratado</button>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    <?php echo form_close(); ?>
    <?php endforeach; ?>

</div>

<?php else: ?>
<div class="row" style="padding-top: 30px;">

    <div class="col-md-12">
        <h3 class="text-bold">Plano ativo</h3>
        <p>
            Seu plano <b class="text-primary"><?php echo $plano['Plano'] ?></b> no valor de <b class="text-primary">R$<?php echo number_format($plano['Valor'], 2, ',', '.') ?></b> tem duração até <b class="text-primary"><?php echo date('d/m/Y H:i:s', strtotime($template->guard->user['DataVencimento'])) ?></b>
        </p>
    </div>

    <div class="col-md-12"><br>
        <a href="<?php echo site_url('meu_plano/planos') ?>" class="btn btn-primary" title="Clique aqui para ver outros planos">Veja outros planos</a>
    </div>
</div>

<div class="row" style="padding-top: 30px;">
    <div class="col-md-12">
        <h3 class="text-bold">Método de pagamento</h3>
    </div>
</div>
<?php endif; ?>
