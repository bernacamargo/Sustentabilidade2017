

<?PHP echo form_open_multipart('meus_dados/salvar_perfil', [ 'class' => 'row', 'style' => 'padding-top: 30px;' ] ); ?>
                
    <?PHP if ( $template->item( 'errors' ) ): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?PHP echo $template->item( 'errors' ); ?>
            </div>
        </div>
    </div>
    <?PHP endif; ?><!-- erros de validacao -->

    <input type="hidden" name="CodUsuario" value="<?PHP echo $template->guard->item('CodUsuario'); ?>">

    <div class="col-md-12">
        <h4>Meus dados</h4><hr>
    </div>

    <?php if ( isset( $errors ) ): ?>
    <div class="col-md-12">
        <div class="alert-alert-danger">
            <?php echo $errors; ?> 
        </div>
    </div>
    <?php endif; ?><!-- erros de validação -->

    <div class="col-md-6">
        <div class="form-group">
            <label for="Nome">Nome</label>
            <input  type="text" 
                    value="<?php echo $template->guard->item('Nome'); ?>" 
                    class="form-control" 
                    id="Nome" 
                    name="Nome" 
                    placeholder="João Pereira">
        </div><!-- nome -->
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="CPF">CPF</label>
            <input  type="text" 
                    value="<?php echo $template->guard->item('CPF'); ?>"  
                    class="form-control" 
                    id="CPF" 
                    name="CPF" 
                    placeholder="XXX.XXX.XXX-XX">
        </div><!-- CPF -->
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="CPF">Celular</label>
            <input  type="text" 
                    value="<?php echo $template->guard->item('Celular'); ?>"  
                    class="form-control" 
                    id="Celular" 
                    name="Celular" 
                    placeholder="(XX) XXXXX-XXXX">
        </div><!-- Celular -->
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="Email">E-mail</label>
            <input  type="email" 
                    value="<?php echo $template->guard->item('Email'); ?>"  
                    class="form-control" 
                    id="Email" 
                    name="Email" 
                    placeholder="email@exemplo.com">
        </div><!-- email -->
    </div>

    <div class="col-md-6" hidden>
        <div class="form-group">
            <label for="Senha">Senha</label>
            <input  type="password" 
                    value="<?php echo set_value('Senha')?>"
                    class="form-control" 
                    id="Senha" 
                    name="Senha" 
                    placeholder="********">
        </div><!-- senha -->
    </div>
    

    <div class="col-md-12"><br> 
        <h4>Dados de localização</h4><hr>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="Estado">Estado</label>
            <select class="form-control" name="Estado" id="Estado" onchange="updateSelect('obter_cidades', '#Cidade', $(this) )">
                <?php foreach( $template->item('estados') as $estado ): ?>
                <?php $atual = $template->item( 'estado' ); ?>
                <option value="<?php echo $estado['CodEstado']; ?>" 
                    <?php echo ( $atual['CodEstado'] == $estado['CodEstado'] ) ? 'selected="selected"': '';?>>
                    <?php echo $estado['Estado']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div><!-- estado -->
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="Cidade">Cidade</label>
            <select class="form-control" id="Cidade" name="Cidade">
                <?php $cidade = $template->item('cidade'); ?>
                <option value="<?php echo $cidade['CodCidade']; ?>"><?php echo $cidade['Cidade']; ?></option>
            </select>
        </div><!-- cidade -->
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="CEP">CEP</label>
            <input  type="text" 
                    value="<?php echo $template->guard->item('CEP'); ?>"                              
                    class="form-control" 
                    id="CEP" 
                    name="CEP" 
                    placeholder="XXXXX-XX">
        </div><!-- CEP -->
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="Endereco">Endereço</label>
            <input  type="text" 
                    value="<?php echo $template->guard->item('Endereco'); ?>"                                                             
                    class="form-control" 
                    id="Endereco" 
                    name="Endereco" 
                    placeholder="Av. José Gomes, 96">
        </div><!-- Endereço -->
    </div>
    
    <div class="col-md-12"><br>
        <h4>Foto do perfil</h4><hr>
    </div>

    <div class="col-md-4 col-md-offset-4 center">
        <img style="border: 2px dashed rgba(51,51,51,.3);" onerror="broken( this )" src="<?php echo $template->guard->user['Foto'] ? base_url( 'uploads/'.$template->guard->user['Foto'] ) : base_url( 'uploads/avatar.jpg' ); ?>" alt="" class="center-block img-responsive">
        <a href="<?php echo site_url('meus_dados/excluir_foto') ?>">Deletar foto</a>
    </div>

    <div class="col-md-6 col-md-offset-3 center">
        <div class="form-group center"><br>
            <input type="file" name="Foto" id="Foto" class="form-control">
        </div><!-- Foto -->
    </div>


    <!--<div class="col-md-12">
        <h4>Cartão de crédito</h4><hr>
    </div>-->
<hr>
    <div class="col-md-12 center"><br>
        <button class="btn btn-primary btn-lg">Atualizar dados</button><!-- submit -->
    </div>
    
<?PHP echo form_close(); ?><!-- formulario de usuário -->
