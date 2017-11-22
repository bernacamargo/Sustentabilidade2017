<?PHP 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$template->print_component( 'header' ); 

?>


<div class="container has-header" style="padding-bottom: 50px;">
        
    <div class="row">
        
        <div class="col-md-3" style="padding-top: 50px; margin-left: -25px;">
            <?PHP $template->print_component( 'aside' ); ?>
        </div><!-- aside -->
        
        <div id="dashboard-container" class="col-md-9 " style="right: -25px;">
            <?PHP $this->load->view( 'minha_conta/'.$template->item( 'container' ) );?>
        </div><!-- conteudo principal -->
    </div>
</div>