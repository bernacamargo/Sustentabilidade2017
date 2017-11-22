<div class="row" style="padding-top: 30px;">
    <?php $abertas = $template->item( 'abertas' ); ?>
    <?php if ( $abertas ): ?>

    <div class="col-md-12">
        <h4>Abertas</h4><hr>
    </div>
    <?php foreach( $abertas as $aberta ): ?>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Referente ao plano <b><?php echo $aberta['Plano']; ?></b></div>
            <div class="panel-body">
                <?php $inteiro = floor( $aberta['Valor'] ); ?>
                <?php $decimal = ( $aberta['Valor'] - $inteiro ) * 10; ?>
                <?php $decimal = strlen( $decimal ) == 1 ? $decimal.'0' : $decimal; ?>
                <h2>R$ <?php echo $inteiro; ?><small>,<?php echo $decimal; ?></small></h2>
                <p><a class="btn btn-danger" onclick="location.href='<?php echo base_url('meu_plano/cancelarCobranca/'.$aberta['CodCobranca'].'') ?>'">Cancelar</a>&ensp;<a class="btn btn-success" href="<?php echo $aberta['Link']; ?>" target="_blank">Pagar</a></p>
            </div>
            <div class="panel-footer">
                <b>Emissão: </b><?php echo date( 'H:i:s d/m/Y', strtotime( $aberta['Emissao'] ) ); ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="col-md-12">
        <p>Nenhuma cobrança aberta</p>
    </div>
    <?php endif; ?>
</div><!-- cobrancas abertas -->

<div class="row">
    <?php $transferencias = $template->item( 'transferencias' ); ?>
    <?php if ( $transferencias ): ?>
    <div class="col-md-12">
        <h4>Transferências</h4><hr>
    </div>
    <?php foreach( $transferencias as $transferencia ): ?>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Referente ao plano <b><?php echo $transferencia['Plano']; ?></b></div>
            <div class="panel-body">
                <?php $inteiro = floor( $transferencia['Valor'] ); ?>
                <?php $decimal = ( $transferencia['Valor'] - $inteiro ) * 10; ?>
                <?php $decimal = strlen( $decimal ) == 1 ? $decimal.'0' : $decimal; ?>
                <h2>R$ <?php echo $inteiro; ?><small>,<?php echo $decimal; ?></small></h2>
                <h5><?php if ( $transferencia['Status'] == 'P' )
                                echo "Paga";
                          if ( $transferencia['Status'] == 'C' )
                                echo "Cancelada"  ; ?></h5>
            </div>
            <div class="panel-footer">
                <b>Emissão: </b><?php echo date( 'H:i:s d/m/Y', strtotime( $transferencia['Emissao'] ) ); ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="col-md-12">
        <p>Nenhuma transferência encontrada</p>
    </div>
    <?php endif; ?>
</div><!-- transferencias -->
