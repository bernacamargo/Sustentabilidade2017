<div class="page-header">
    <h1>Dados do anúncios</h1>
</div>

<?PHP echo form_open_multipart('anuncios/criar_anuncio/'.$template->item('CodAnuncio'), [ 'class' => '<row></row>' ] ); ?>

    <div class="col-md-12">

        <?php $anuncio = $template->item( 'anuncio' ); ?>

        <?php if ( $template->item('CodAnuncio') ): ?>
        <input type="hidden" value="<?php echo $template->item('CodAnuncio');?>">
        <?php endif; ?>

        <?php if ( $template->item( 'errors' ) ): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <?php echo $template->item( 'errors' ); ?>
                </div>
            </div>
        </div><!-- mensagem de erro -->
        <?php endif; ?>

        <?php if ( $template->item( 'success' ) ): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <?php echo $template->item( 'success' ); ?>
                </div>
            </div>
        </div><!-- mensagem de erro -->
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Servico">Escolha uma categoria</label>
                    <select class="form-control" name="Servico" >
                        <option value="">-- Selecione --</option>
                        <?php $servicos = $template->item('servicos'); ?>
                        <?php foreach( $servicos as $servico ): ?>
                        <option value="<?php echo $servico['CodCategoriaServico']; ?>"
                                <?php echo isset( $anuncio['CodCategoriaServico'] ) 
                                            && $anuncio['CodCategoriaServico'] == $servico['CodCategoriaServico'] ?
                                            'selected="selected"' : ''; ?>>
                            <?php echo $servico['Categoria'];?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div><!-- servicos disponiveis -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Frequencia">Frequência</label>
                    <select class="form-control" name="Frequencia" >
                        <option>-- Selecione --</option>
                        <option <?php echo isset( $anuncio['Frequencia'] ) && $anuncio['Frequencia'] == 'Segunda a Sabado' ? 'selected="selected"' : ''; ?>>Segunda a Sabado</option>
                        <option <?php echo isset( $anuncio['Frequencia'] ) && $anuncio['Frequencia'] == 'Segunda a Sexta' ? 'selected="selected"' : ''; ?>>Segunda a Sexta</option>
                        <option <?php echo isset( $anuncio['Frequencia'] ) && $anuncio['Frequencia'] == '3x por semana' ? 'selected="selected"' : ''; ?>>3x por semana</option>
                        <option <?php echo isset( $anuncio['Frequencia'] ) && $anuncio['Frequencia'] == '2x por semana' ? 'selected="selected"' : ''; ?>>2x por semana</option>
                        <option <?php echo isset( $anuncio['Frequencia'] ) && $anuncio['Frequencia'] == '1x por semana' ? 'selected="selected"' : ''; ?>>1x por semana</option>
                    </select>
                </div>
            </div><!-- recorrencia dos anuncios -->
        </div><!-- categoria -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Salario">Salário</label>
                    <div class="input-group">
                        <div class="input-group-addon">R$</div>
                        <input  type="number"
                                step="0.01" 
                                name="Salario" 
                                class="form-control" 
                                value="<?php echo isset( $anuncio['Valor'] ) ? $anuncio['Valor'] :'' ?>"
                                placeholder="0000.00">
                    </div>
                </div>
            </div><!-- salario -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="CEP">CEP</label>
                    <a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" target="_blank" style="text-decoration: underline;"><i>Não sabe o CEP?</i></a>
                    <input  type="number" 
                            name="CEP" 
                            value="<?php echo isset( $anuncio['CEP'] ) ? $anuncio['CEP'] :'' ?>"
                            class="form-control"
                            onchange="obterCEP( $(this).val() )"
                            placeholder="57925-970">
                </div>
                <div id="loading" class="text-center hidden">
                    <img src="<?php echo base_url( 'assets/img/loading.gif' ); ?>" width="50">
                </div>
            </div><!-- cep -->
        </div><!-- salario -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Quando">Para quando você precisa</label>
                    <select class="form-control" name="Quando" >
                        <option>-- Selecione --</option>
                        <option <?php echo isset( $anuncio['Quando'] ) && $anuncio['Quando'] == 'Hoje ou Amanhã' ? 'selected="selected"' : ''; ?>>Hoje ou Amanhã</option>
                        <option <?php echo isset( $anuncio['Quando'] ) && $anuncio['Quando'] == 'Essa semana' ? 'selected="selected"' : ''; ?>>Essa semana</option>
                        <option <?php echo isset( $anuncio['Quando'] ) && $anuncio['Quando'] == 'Esse mês' ? 'selected="selected"' : ''; ?>>Esse mês</option>
                        <option <?php echo isset( $anuncio['Quando'] ) && $anuncio['Quando'] == 'Sem previsão' ? 'selected="selected"' : ''; ?>>Sem previsão</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <p><i>Esse campo será preenchido automaticamente</i></p>
                    <input  type="text"
                            id="endereco" 
                            name="Endereco" 
                            value="<?php echo isset( $anuncio['Endereco'] ) ? $anuncio['Endereco'] :'' ?>"
                            class="form-control" 
                            placeholder="José Figueredo">
                </div>
            </div><!-- cep -->
        </div><!-- frequencia -->

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Descricao">Fale um pouco sobre este anúncio</label>
                    <textarea id="descricao_anuncio"   class="form-control" maxlength="150" 
                                name="Descricao"
                                max="150"
                                rows="5" 
                                placeholder="Ao descrever seu anúncio evite solicitar características que possam discriminar pessoas, ex: idade, sexo, raça, religião, cor, etc."><?php echo isset( $anuncio['Descricao'] ) ? $anuncio['Descricao'] : ''; ?></textarea>
                </div>
                <p id="descricao_anuncio_cont_container" style="color: red;">
                    <span id="descricao_anuncio_cont">150</span> caracteres restantes
                </p>
            </div>
        </div><!-- descrição do anúncio -->

        <!-- geocordenadas -->
        <input id="Latitude"  name="Latitude" value="<?php echo isset( $anuncio['Latitude'] ) ? $anuncio['Latitude'] : '';?>" type="hidden">
        <input id="Longitude"  name="Longitude" value="<?php echo isset( $anuncio['Longitude'] ) ? $anuncio['Longitude'] : '';?>" type="hidden">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="btn btn-success btn-block btn-lg">Criar anúncio</button>
            </div>
        </div><!-- botão -->
    </div>
        
    </div>
<?PHP echo form_close(); ?><!-- fim do formulario -->