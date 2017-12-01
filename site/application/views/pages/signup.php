<?PHP $template->print_component( 'header' ); ?>

<div class="wallpaper"></div>

<div class="container has-header padding-bottom-70">

<div id="dashboard-container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header center">
                <h1>O que você procura?</h1><br>
                <?php 
                    if($template->item('container') == 'contratante'){
                        $classe_contratante = 'btn-primary';
                        $classe_profissional = 'btn-default';
                    }
                    elseif($template->item('container') == 'profissional') {
                        $classe_contratante = 'btn-default';
                        $classe_profissional = 'btn-primary';                        
                    }
                    else {
                        $classe_contratante = 'btn-default';
                        $classe_profissional = 'btn-default';                        
                    }

                 ?>
                <a href="<?php echo site_url('signup/profissional') ?>" class="btn <?php echo $classe_profissional ?> btn-lg">Encontrar trabalho</a>&ensp;&ensp;
                <a href="<?php echo site_url('signup/contratante') ?>" class="btn <?php echo $classe_contratante ?> btn-lg">Encontrar profissionais</a>
            </div><!-- painel de cadastro -->
        </div>
    </div>


<?php if($template->item('container') == 'contratante'): ?>
    <div class="row">
        
        <div class="col-md-6 center">
            
            <div class="card panel panel-default">
                <div class="panel-heading center">
                    <img src="<?PHP echo base_url('assets/img/subscribe.png'); ?>" width="150" >
                </div>
                <h3 class="panel-body center">Inscreva-se</h3>
                <div class="center panel-footer">Se inscreva usando o formulário ao lado. É gratuito!</div>
            </div>

            <div class="card panel panel-default">
                <div class="panel-heading center">
                    <img src="<?PHP echo base_url('assets/img/loupe.png'); ?>" width="150" >
                </div>
                <h3 class="panel-body center">Encontre</h3>
                <div class="center panel-footer">Crie um anúncio de vaga e encontre trabalhadores interessados próximos a você!</div>
            </div>   

            <div class="card panel panel-default">
                <div class="panel-heading center">
                    <img src="<?PHP echo base_url('assets/img/bubble.png'); ?>" width="150" >
                </div>
                <h3 class="panel-body center">Contate</h3>
                <div class="center panel-footer">Entre em contato imediatamente!</div>
            </div>       

        </div><!-- coluna esquerda -->
        
        <div class="col-md-6">

            <div class="row">
                <?PHP echo form_open_multipart('signup/contratante', [ 'class' => 'col-md-12' ] ); ?>
                    
                    <?PHP if ( $template->item( 'errors' ) ): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <?PHP echo $template->item( 'errors' ); ?>
                            </div>
                        </div>
                    </div>
                    <?PHP endif; ?><!-- erros de validacao -->

                    <h4>Dados pessoais</h4>
<hr>
                    <div class="form-group">
                        <label for="Nome">Nome completo</label>
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
                        <label for="Celular">Celular</label>
                        <input  type="text" 
                                value="<?php echo set_value('Celular')?>"  
                                class="form-control" 
                                id="Celular" 
                                name="Celular" 
                                placeholder="(XX) XXXXX-XXXX">
                    </div><!-- Celular -->

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
                        <label for="Senha">Senha</label>
                        <input  type="password" 
                                value="<?php echo set_value('Senha')?>"
                                class="form-control" 
                                id="Senha" 
                                name="Senha" 
                                placeholder="********">
                    </div><!-- senha -->

<br>

                    <h4>Dados de localização</h4>
<hr>
                    <div class="form-group">
                        <label for="Estado">País Atual</label>
                        <select class="form-control" name="paisAtual" id="paisAtual" readonly>
                            <option value="">BRASIL</option>
                            </option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="Estado">Estado Atual</label>
                        <select class="form-control" name="Estado" id="Estado" onchange="updateSelect('obter_cidades', '#Cidade', $(this) )">
                            <option value="">-- Selecione --</option>
                            <?php foreach( $template->item('estados') as $estado ): ?>
                            <option value="<?php echo $estado['CodEstado']; ?>">
                                <?php echo $estado['Estado']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div><!-- estado -->

                    <div class="form-group">
                        <label for="Cidade">Cidade Atual</label>
                        <select class="form-control" id="Cidade" name="Cidade" disabled>
                            <option value="">-- Selecione --</option>
                        </select>
                    </div><!-- cidade -->

                    <div class="form-group">
                        <label for="CEP">CEP Atual</label>
                        <input  type="text"
                                onchange="obterCEP( $( this ).val() )"
                                value="<?php echo set_value('CEP')?>"                              
                                class="form-control" 
                                id="CEP" 
                                name="CEP" 
                                placeholder="XXXXX-XXX">
                    </div><!-- CEP -->

                    <div class="form-group">
                        <label for="endereco">Endereço Atual</label>
                        <input  type="text" 
                                value="<?php echo set_value('Endereco')?>"                                                             
                                class="form-control" 
                                id="endereco" 
                                name="Endereco" 
                                placeholder="">
                        <p class="help-block">
                            Esse campo será preenchido automaticamente ao digitar o CEP
                        </p>
                    </div><!-- Endereço -->
<br>
                    <div class="form-group">
                        <label for="Endereco">Foto de perfil</label>
                        <input type="file" name="Foto" id="Foto">
                    </div><!-- Foto -->

                    <div class="form-group">
                        <input type="hidden" id="Longitude" name="Longitude">
                        <input type="hidden" id="Latitude" name="Latitude">
                    </div>
                    <br>
                    <button class="btn btn-block btn-lg btn-primary">Criar conta</button><!-- submit -->

                <?PHP echo form_close(); ?><!-- formulario de usuário -->


            </div>
        </div><!-- coluna direita -->

<!-- 
=========================
===== PROFISSIONAL ======
=========================
 -->

    <?php elseif($template->item('container') == 'profissional'): ?>

    <div class="row">
        
        <div class="col-md-6 center">
            
            <div class="card panel panel-default">
                <div class="panel-heading center">
                    <img src="<?PHP echo base_url('assets/img/subscribe.png'); ?>" width="150" >
                </div>
                <h3 class="panel-body center">Inscreva-se</h3>
                <div class="center panel-footer">Se inscreva usando o formulário ao lado. É gratuito!</div>
            </div>

            <div class="card panel panel-default">
                <div class="panel-heading center">
                    <img src="<?PHP echo base_url('assets/img/loupe.png'); ?>" width="150" >
                </div>
                <h3 class="panel-body center">Crie um currículo</h3>
                <div class="center panel-footer">Encontre trabahos próximos a você!</div>
            </div>   

            <div class="card panel panel-default">
                <div class="panel-heading center">
                    <img src="<?PHP echo base_url('assets/img/bubble.png'); ?>" width="150" >
                </div>
                <h3 class="panel-body center">Contate</h3>
                <div class="center panel-footer">Entre em contato imediatamente!</div>
            </div>       

        </div><!-- coluna esquerda -->
        
        <div class="col-md-6">

            <div class="row">
                <?PHP echo form_open_multipart('signup/profissional', [ 'class' => 'col-md-12' ] ); ?>
                    
                    <?PHP if ( $template->item( 'errors' ) ): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <?PHP echo $template->item( 'errors' ); ?>
                            </div>
                        </div>
                    </div>
                    <?PHP endif; ?><!-- erros de validacao -->

                    <h4>Dados pessoais</h4>
<hr>
                    <div class="form-group">
                        <label for="Nome">Nome completo</label>
                        <input  type="text" 
                                value="<?php echo set_value('Nome')?>" 
                                class="form-control" 
                                id="Nome" 
                                name="Nome" 
                                placeholder="João Pereira da Silva">
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
                        <label for="Celular">Celular</label>
                        <input  type="text" 
                                value="<?php echo set_value('Celular')?>"  
                                class="form-control" 
                                id="Celular" 
                                name="Celular" 
                                placeholder="(XX) XXXXX-XXXX">
                    </div><!-- Celular -->

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
                        <label for="Senha">Senha</label>
                        <input  type="password" 
                                value="<?php echo set_value('Senha')?>"
                                class="form-control" 
                                id="Senha" 
                                name="Senha" 
                                placeholder="********">
                    </div><!-- senha -->


<br>
                    <h4>Dados de localização</h4>
<hr>
                    <div class="form-group">
                        <label for="Estado">País Atual</label>
                        <select class="form-control" name="paisAtual" id="paisAtual" readonly>
                            <option value="">BRASIL</option>
                            </option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="Estado">Estado Atual</label>
                        <select class="form-control" name="Estado" id="Estado" onchange="updateSelect('obter_cidades', '#Cidade', $(this) )">
                            <option value="">-- Selecione --</option>
                            <?php foreach( $template->item('estados') as $estado ): ?>
                            <option value="<?php echo $estado['CodEstado']; ?>">
                                <?php echo $estado['Estado']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div><!-- estado -->

                    <div class="form-group">
                        <label for="Cidade">Cidade Atual</label>
                        <select class="form-control" id="Cidade" name="Cidade" disabled>
                            <option value="">-- Selecione --</option>
                        </select>
                    </div><!-- cidade -->

                    <div class="form-group">
                        <label for="CEP">CEP Atual</label>
                        <input  type="text"
                                onchange="obterCEP( $( this ).val() )"
                                value="<?php echo set_value('CEP')?>"                              
                                class="form-control" 
                                id="CEP" 
                                name="CEP" 
                                placeholder="XXXXX-XX">
                    </div><!-- CEP -->

                    <div class="form-group">
                        <label for="endereco">Endereço Atual</label>
                        <input  type="text" 
                                value="<?php echo set_value('Endereco')?>"                                                             
                                class="form-control" 
                                id="endereco" 
                                name="Endereco" 
                                placeholder="">
                    </div><!-- Endereço -->
                    <p class="help-block">
                        Esse campo será preenchido automaticamente ao digitar o CEP
                    </p>
<br>
                    <div class="form-group">
                        <label for="Endereco">Foto de perfil</label>
                        <input type="file" name="Foto" id="Foto">
                    </div><!-- Foto -->

                    <div class="form-group">
                        <input type="hidden" id="Longitude" name="Longitude">
                        <input type="hidden" id="Latitude" name="Latitude">
                    </div>
                    <br>
                    <button class="btn btn-block btn-lg btn-primary">Criar conta</button><!-- submit -->

                <?PHP echo form_close(); ?><!-- formulario de usuário -->


            </div>
        </div><!-- coluna direita -->


    <?php endif; ?>
    </div>
    </div>
</div>
