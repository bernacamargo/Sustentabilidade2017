<?PHP echo form_open_multipart('meus_dados/alterar_senha', [ 'class' => 'row', 'style' => 'padding-top: 30px;' ] ); ?>

    <?PHP if ( $template->item( 'success' ) ): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <?PHP echo $template->item( 'success' ); ?>
            </div>
        </div>
    </div>
    <?PHP elseif ( $template->item( 'errors' ) ): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?PHP echo $template->item( 'errors' ); ?>
            </div>
        </div>
    </div>
    <?PHP endif; ?><!-- erros de validacao -->


    <div class="col-md-12">
        <h3>Alterar senha</h3>
        <hr>
    </div>

    <div class="col-md-4 form-group">
        <label for="">Senha atual</label>
        <input name="Senha_antiga" id="senha_antiga" type="password" class="form-control">
    </div>

    <div class="col-md-4 form-group">
        <label for="">Senha nova</label>
        <input name="Senha_nova" id="senha_nova" type="password" class="form-control">
    </div>

    <div class="col-md-4 form-group">
        <label for="">Confirmar senha nova</label>
        <input name="Senha_nova_confirm" id="senha_nova_confirm" type="password" class="form-control">
    </div>

    <div class="col-md-12 text-center"><br>
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-lock"></i>&ensp;Alterar senha
        </button>
    </div>
        
<?PHP echo form_close(); ?><!-- formulario de usuário -->
