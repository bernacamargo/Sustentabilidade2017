<?PHP 
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$template->print_component( 'header' ); 

?>


<div class="container has-header">
        
    <div class="row" style="padding-bottom: 50px;">
        <div id="dashboard-container" class="col-md-12">
            <?PHP $this->load->view( 'ajuda/'.$template->item( 'container' ) );?>

            <!-- <h4>Links Úteis</h4>

            <a href="#links-relacoes-exteriores" role="button" class="btn" data-toggle="collapse" aria-expanded="false" aria-controls="links-relacoes-exteriores">Links do Ministério das Relações Exteriores</a>

            <div class="collapse" id="links-relacoes-exteriores">
                <br>
                <li><a href="http://www.itamaraty.gov.br/ ">Portal oficial do Itamaraty</a></li>
                <li><a href="http://www.brasileirosnomundo.itamaraty.gov.br/">Brasileiros no Mundo</a></li>
                <li><a href="http://dc.itamaraty.gov.br/">Departamento Cultural</a></li>
                <li><a href="http://www.dce.mre.gov.br/">Divisão de Temas Educacionais</a></li>
                <li><a href="http://www.irbr.mre.gov.br/">Instituto Rio Branco (IRBr)</a></li>
                <li><a href="http://www.investexportbrasil.gov.br/">Invest & Export Brazil</a></li>
                <li><a href="http://retorno.itamaraty.gov.br/pt-br/">Portal do Retorno</a></li>
                <li><a href="http://redebrasilcultural.itamaraty.gov.br/">Rede Brasil Cultural</a></li>
            </div>
            <br>
            <a href="#links-governo-brasileiro" role="button" class="btn" data-toggle="collapse" aria-expanded="false" aria-controls="links-governo-brasileiro">Links oficiais do Governo brasileiro</a>
            <div class="collapse" id="links-governo-brasileiro">
                <br>
                <li><a href="http://www.brasil.gov.br/">Governo Brasileiro</a></li>
                <li><a href="http://www.presidencia.gov.br/"> Presidência da República</a></li>
                <li><a href="http://www.mpf.mp.br/pgr/"> Procuradoria Geral da República</a></li>
                <li><a href="http://www.mc.gov.br/">Ministério das Comunicações</a></li>
                <li><a href="http://www.cultura.gov.br/">Ministério da Cultura</a></li>
                <li><a href="http://portal.mec.gov.br/default.htm">Ministério da Educação</a></li>
                <li><a href="http://www.mma.gov.br/">Ministério do Meio Ambiente</a></li>
                <li><a href="http://www.mre.gov.br/">Ministério das Relações Exteriores</a></li>
                <li><a href="http://www.fazenda.gov.br/">Ministério da Fazenda</a></li>
                <li><a href="http://www.fazenda.gov.br/">Ministério da Fazenda</a></li>
            </div>

 -->
        </div><!-- conteudo principal -->

    </div>
</div>