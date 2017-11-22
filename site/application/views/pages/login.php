<?PHP $template->print_component( 'header' ); ?>

<style>
    hr {
        color: rgba(255,255,255,.3);
    }
</style>

<div class="container has-header">
    <div class="row" style="padding: 50px;">
        <?PHP echo form_open('login/logar', [ 'class' => 'col-md-4 col-md-offset-4 bg-primary text-center', 'style' => 'background: #333; padding: 30px 15px; border: 1px solid rgba(51,51,51,.3); border-radius: 7px;' ] ); ?>
                
        <?php $template->print_component('login') ?>

        <?PHP echo form_close(); ?>
    </div>
</div>