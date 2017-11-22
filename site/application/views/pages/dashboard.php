<?PHP 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$template->print_component( 'header' ); 

?>


<div class="container has-header">
        
    <div class="row" style="padding-bottom: 50px;">
        <div id="dashboard-container" class="col-md-12">
            <?PHP $this->load->view( 'dashboard/'.$template->item( 'container' ) );?>
        </div><!-- conteudo principal -->
    </div>
</div>