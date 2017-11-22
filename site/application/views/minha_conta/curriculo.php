<div class="page-header row">

    <div class="col-md-12 center">
        <?php if(!$template->guard->profissional): ?>
            
        <?php elseif($template->guard->profissional['ativo'] == 1): ?>

            <button title="Clique aqui para visualizar seu perfil profissional" class="btn btn-primary" onclick="location.href='<?php echo base_url('profissionais/ver/'.$template->guard->profissional['CodUsuario'].'') ?>'"><i class="fa fa-eye"></i>&ensp;Visualizar</button>&ensp;&ensp;
            <button title="Clique aqui para desativar seu perfil profissional" class="btn btn-default" onclick="location.href='<?php echo base_url('meus_dados/desativar_perfil/'.$template->guard->profissional['CodUsuario'].'') ?>'"><i class="fa fa-remove"></i>&ensp;Desativar</button>&ensp;&ensp;
            <button title="Clique aqui para excluir seu perfil profissional" class="btn btn-default" onclick="location.href='<?php echo base_url('meus_dados/excluir_perfil/'.$template->guard->profissional['CodUsuario'].'') ?>'"><i class="fa fa-trash"></i>&ensp;Excluir</button>&ensp;&ensp;<br><br><br>
       
        <?php  else:?>

            <button title="Clique aqui para visualizar seu perfil profissional" class="btn btn-primary" onclick="location.href='<?php echo base_url('profissionais/ver/'.$template->guard->profissional['CodUsuario'].'') ?>'"><i class="fa fa-eye"></i>&ensp;Visualizar</button>&ensp;&ensp;
            
            <button title="Clique aqui para ativar seu perfil profissional" class="btn btn-default" onclick="location.href='<?php echo base_url('meus_dados/ativar_perfil/'.$template->guard->profissional['CodUsuario'].'') ?>'"><i class="fa fa-check"></i>&ensp;Ativar</button>&ensp;&ensp;
            
            <button title="Clique aqui para excluir seu perfil profissional" class="btn btn-default" onclick="location.href='<?php echo base_url('meus_dados/excluir_perfil/'.$template->guard->profissional['CodUsuario'].'') ?>'"><i class="fa fa-trash"></i>&ensp;Excluir</button>&ensp;&ensp;<br><br><br>
       

        <?php endif; ?>
    </div>
    <div class="">
        <h1>
            Currículo <br>
            <small>
                Crie seu perfil profissional agora mesmo e começe a procurar por trabalhos!
            </small>
        </h1>
    </div>
</div>

<?PHP echo form_open_multipart('meus_dados/curriculo', [ 'class' => 'row' ] ); ?>
                
    <?PHP if ( $template->item( 'errors' ) ): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <i class="fa fa-remove"></i>&ensp;<?PHP echo $template->item( 'errors' ); ?>
            </div>
        </div>
    </div>
    <?PHP endif; ?><!-- erros de validacao -->

    <?PHP if ( $template->item( 'success' ) ): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <i class="fa fa-check"></i>&ensp;<?PHP echo $template->item( 'success' ); ?>
            </div>
        </div>
    </div>
    <?PHP endif; ?><!-- sucesso de validacao -->

    <div class="col-md-12">
        <h4>Dados pessoais</h4><hr>
    </div><!-- dados pessoais -->

    <div class="col-md-6">
        <div class="form-group">
            <label for="Idade">Idade ( anos )</label>
            <input  type="number"
                    class="form-control" 
                    id="Idade" 
                    value="<?php echo isset( $template->guard->profissional['Idade'] ) ? $template->guard->profissional['Idade'] : set_value('Idade'); ?>" 
                    name="Idade" 
                    placeholder="18">
        </div>
    </div><!-- Idade -->

     <div class="form-group col-md-6">
            <label for="Estado">País de Origem</label>
            <select class="form-control" name="Pais_origem" id="pais">
                <option value="">-- Selecione --</option>
                <?php foreach( $template->item('paises') as $pais ): ?>
                <option <?php if($template->guard->profissional['Pais_origem'] === $pais['paisNome']) echo 'selected' ?> title="<?php echo $pais['paisName'] ?>" value="<?php echo $pais['paisNome']; ?>">
                    <?php echo $pais['paisNome']; ?>
                </option>
                <?php endforeach; ?>
            </select>

        </div>    

    <div class="col-md-12">
        <div class="form-group">
            <label for="sobre">Sobre</label>
            <textarea name="Sobre" id="sobre" cols="30" rows="10" class="form-control" placeholder="Fale um pouco sobre você..."><?php echo isset( $template->guard->profissional['Sobre'] ) ? $template->guard->profissional['Sobre'] : set_value('Sobre'); ?></textarea>
        </div>
    </div>

    <div class="col-md-12">
        <h4>Serviço</h4><hr>
    </div><!-- serviço -->

    <div class="col-md-6">
        <div class="form-group">
            <label for="Servico">Serviço prestado</label>
            <select class="form-control" id="Servico" name="Servico">
                <option value="" hidden>-- Selecione --</option>
                <?php foreach( $template->item( 'servicos' ) as $servico ): ?>
                <option value="<?php echo $servico['CodCategoriaServico']; ?>"
                        <?php echo isset( $template->guard->profissional['CodCategoriaServico'] ) 
                                    && $servico['CodCategoriaServico'] == $template->guard->profissional['CodCategoriaServico'] 
                                    ? 'selected="selected"': '';?>>
                    <?php echo $servico['Categoria']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div><!-- servico prestado -->

    <div class="col-md-6">
        <div class="form-group">
            <label for="Experiencia">Experiência ( anos )</label>
            <input  type="number"
                    class="form-control" 
                    id="Experiencia" 
                    name="Experiencia"
                    value="<?php echo isset( $template->guard->profissional['Experiencia'] ) ? $template->guard->profissional['Experiencia'] : set_value('Experiencia'); ?>" 
                    placeholder="4">
        </div>
    </div><!-- Experiencia -->

    <div class="col-md-6">
        <div class="form-group">
            <label for="Valor">Valor cobrado</label>
            <input  type="number"
                    class="form-control" 
                    id="Valor" 
                    name="Valor"
                    value="<?php echo isset( $template->guard->profissional['Valor'] ) ? $template->guard->profissional['Valor'] : set_value('Valor'); ?>" 
                    placeholder="1200,00">
        </div>
    </div><!-- Valor cobrado -->
    
    <div class="col-md-12">
        <h4>Dados de localidade</h4><hr>
    </div><!-- dados pessoais -->


    <div class="col-md-6">
        <div class="form-group">
            <label for="Valor">CEP</label>
            <p><i>Informe o CEP para buscarmos o endereço.</i></p>            
            <input  type="text"
                    class="form-control" 
                    id="CEP"
                    onchange="obterCEP( $(this).val() )"
                    name="CEP"
                    value="<?php echo isset( $template->guard->profissional['CEP'] ) ? $template->guard->profissional['CEP'] : set_value('CEP'); ?>" 
                    placeholder="99999999">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="Valor">Endereço</label>
            <p><i>Esse campo será preenchido automaticamente.</i></p>
            <input  type="text"
                    class="form-control" 
                    id="endereco" 
                    name="Endereco"
                    value="<?php echo isset( $template->guard->profissional['Endereco'] ) ? $template->guard->profissional['Endereco'] : set_value('Endereco'); ?>" 
                    placeholder="José Cerrano 123">
        </div>
    </div>

    <div class="col-md-12">
        <input id="Latitude"  name="Latitude" value="<?php echo isset( $anuncio['Latitude'] ) ? $anuncio['Latitude'] : '';?>" type="hidden">
        <input id="Longitude"  name="Longitude" value="<?php echo isset( $anuncio['Longitude'] ) ? $anuncio['Longitude'] : '';?>" type="hidden">
    </div>

    <input type="hidden" name="ativo" value="1">

    <div class="col-md-12 text-center"><br><br>
    <?php if($template->guard->profissional): ?>
        <button class="btn btn-primary btn-lg">Atualizar</button>
    <?php else: ?>
        <button class="btn btn-primary btn-lg">Criar</button>

    <?php endif; ?>
    </div><!-- submit -->

<?PHP echo form_close(); ?><!-- formulario de usuário -->