<?PHP $template->print_component('header'); ?>
<div class="container has-header">
    <div class="page-header center">
        <h1 class="center main-title inline">Contato</h1>
    </div>
    <div class="row ">
        
        <div class="button-wrapper col-md-8 col-sm-12 col-md-offset-2">
            <div class="row">
                <h3 class="welcome center">Estamos felizes em te atender</h3>
            </div>

            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <?PHP echo form_open('paginas/contato', [ 'class' => 'col-md-12' ] ); ?>
                        
                        <?PHP if ( $template->item( 'errors' ) ): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <?PHP echo $template->item( 'errors' ); ?>
                                    </div>
                                </div>
                            </div>
                        <?PHP endif; ?><!-- erros de validacao -->
                        <?PHP if ( $template->item( 'sucesso' ) ): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        <?PHP echo $template->item( 'sucesso' ); ?>
                                    </div>
                                </div>
                            </div>
                        <?PHP endif; ?><!-- erros de validacao -->

                        <div class="form-group">
                            <label for="Nome">Nome</label>
                            <input  type="text" 
                                    value="<?php echo set_value('Nome')?>" 
                                    class="form-control" 
                                    id="Nome" 
                                    name="Nome" 
                                    placeholder="João Pereira">
                        </div><!-- nome -->

                        <div class="form-group">
                            <label for="CPF">CPF</label>
                            <input  type="text" 
                                    value="<?php echo set_value('CPF')?>"  
                                    class="form-control" 
                                    id="CPF" 
                                    name="CPF" 
                                    placeholder="XXX.XXX.XXX-XX">
                        </div><!-- CPF -->
                        
                        <div class="form-group">
                            <label for="CEP">CEP</label>
                            <input  type="text" 
                                    value="<?php echo set_value('CEP')?>"                              
                                    class="form-control" 
                                    id="CEP" 
                                    name="CEP" 
                                    placeholder="XXXXX-XX">
                        </div><!-- CEP -->

                        <div class="form-group">
                            <label for="Email">E-mail</label>
                            <input  type="email" 
                                    value="<?php echo set_value('Email')?>"  
                                    class="form-control" 
                                    id="Email" 
                                    name="Email" 
                                    placeholder="email@email.com">
                        </div><!-- email -->

                        <div class="form-group">
                            <label for="Telefone">Telefone</label>
                            <input  type="tel" 
                                    value="<?php echo set_value('Telefone')?>"  
                                    class="form-control" 
                                    id="Telefone" 
                                    name="Telefone" 
                                    placeholder="(__) ____-____">
                        </div><!-- telefone -->

                        <div class="form-group">
                            <label for="Mensagem">Mensagem</label>
                            <textarea value="<?php echo set_value('Mensagem')?>"  
                                    class="form-control" 
                                    id="Mensagem" 
                                    name="Mensagem" 
                                    placeholder="Sua mensagem..." cols="30" rows="8"></textarea>
                        </div><!-- telefone -->

                        <button class="btn btn-block btn-lg btn-warning">Enviar Mensagem</button><!-- submit -->

                    <?PHP echo form_close(); ?><!-- formulario de usuário -->
                </div>
            </div><!-- coluna direita -->

        </div>

    </div>
</div>