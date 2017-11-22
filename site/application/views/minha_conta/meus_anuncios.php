
<div class="row" style="padding-top: 30px;">
    <div class="col-md-12">
        <button class="btn btn-primary" onclick="location.href = '<?php echo site_url('anuncios/criar_anuncio'); ?>'">
            <strong><i class="fa fa-plus"></i>&ensp;Criar um novo anúncio</strong>
        </button>
    </div>
    <div class="col-md-12"><br></div>
</div>

<div class="row">

    <?php foreach( $template->item( 'anuncios' ) as $anuncio ): ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body center row">
                    <div class="col-md-12">
                        <?php echo $anuncio['Categoria']; ?>
                    </div>
                    <div class="col-md-12">
                        <h5><?php echo $anuncio['Endereco'] ? $anuncio['Endereco'] : ''; ?></h5>
                    </div>
                    <div class="col-md-12">
                        há 24 dias atrás
                    </div>
                    <div class="col-md-12">
                        <strong>R$ <?php echo $anuncio['Valor']; ?></strong>
                    </div>
                    <div class="col-md-12">
                        <?php echo $anuncio['Frequencia']; ?>
                    </div>
                    <div class="col-md-12"><br>
                        <p class="text-primary">
                            <b><?php echo $anuncio['Visualizacoes'] ?></b>
                            <?php echo $anuncio['Visualizacoes'] > 1 ? 'Visualizações' : 'Visualização'; ?>
                             <br>
                            <b><?php echo $anuncio['Interessados'] ?></b>
                            <?php echo $anuncio['Interessados'] > 1 ? 'Candidatos' : 'Candidato'; ?>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <a data-toggle="tooltip" title="Clique aqui para ver os profissionais interessados em seu anúncio" href="<?php echo site_url( 'profissionais/interessados/'.$anuncio['CodAnuncio'] ); ?>" class="btn btn-default btn-sm">Perfis interessados</a>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <a data-toggle="tooltip" data-html="true" title="Clique aqui para ver outros profissionais na categoria <b><?php echo $anuncio['Categoria'] ?></b>" href="<?php echo site_url( 'profissionais/index?query='.$anuncio['Categoria'] ); ?>" class="btn btn-default btn-sm">Prestadores no perfil</a>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="text-right">
                        <a  type="button" 
                            class="btn btn-primary pull-left btn-xs" 
                            href="<?php echo site_url('anuncios/criar_anuncio/'.$anuncio['CodAnuncio'] ); ?>"
                            style="margin-top: 2px;">
                            <span class="glyphicon glyphicon-pencil"></span>
                            Editar
                        </a>
                        <a title="Clique aqui para excluir esse anúncio" href="<?php echo site_url('anuncios/excluir_anuncio/'.$anuncio['CodAnuncio'] ); ?>" type="button" class="btn-xs btn btn-default">
                            <span class="glyphicon glyphicon-trash"></span>
                            Excluir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
