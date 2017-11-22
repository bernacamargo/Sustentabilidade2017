<?php if($template->item('linkPagamento')): ?>
    <script>
        window.open("<?php echo $template->item('linkPagamento') ?>"); 
    </script>
<?php endif; ?>

<div class="page-header">
    <h1>Planos</h1>
</div>

<div class="row">
    
    <div class="col-md-12">
        
        

    </div>

</div>

<div class="row">
    
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