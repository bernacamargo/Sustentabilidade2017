<?PHP 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$template->print_component( 'header' ); 

?>

<div class="container has-header padding-bottom-70" style="min-height: 700px;">
        
    <div class="row">
        
        <div class="col-md-3" style="padding-top: 50px; margin-left: -25px;">
            <?PHP $template->print_component( 'aside' ); ?>
        </div><!-- aside -->

        <div class="col-md-3">
            <?PHP $template->print_component( 'chat_contatos' ); ?>
        </div><!-- aside -->
        
        <div class="col-md-6" style="right: -30px; height: 300px;">
        	<div id="chat-container">
            	<?PHP $this->load->view( 'chat/'.$template->item( 'container' ) );?>
        	</div>
        </div><!-- conteudo principal -->
    </div>
</div>