<?php 


$dados = $template->item('Dados');
$plano = $template->item('Planos');
$profissionais = $template->item('profissionais_relacionados');

?>


<div class="row" style="padding-top: 50px;">
    <div class="col-md-2">
        <img class="img-responsive center-block" 
            onerror="broken( this )"
            src="<?php echo $dados['Foto'] ? base_url( 'uploads/'.$dados['Foto'] ) : base_url( 'uploads/avatar.jpg' ); ?>
        ">    
    </div>
    <div class="col-md-5">
        <h4 class="text-primary">
        <div id="litResultado"></div>
            <b><?php echo $dados['Nome']; ?></b><span class="text-normal">/Cod. <?php echo $dados['CodUsuario']?></span> <br>
            
            <?PHP 
                $CodProfissional = [
                    'CodProfissional' => $dados['CodProfissional']
                ];

                $template->print_component( 'avaliacao', $CodProfissional ); 
            ?>

<br>
            <small><?php echo $dados['Categoria'] ?>&ensp;|&ensp;<?php echo $dados['Idade']; ?> anos&ensp;|&ensp;<?php echo $dados['Experiencia']; ?> anos de experiência</small> <br>
            <small>R$ <?php echo number_format($dados['Valor'], 2, ',', '.'); ?></small> <br>
            <small>País de origem: <b><?php echo $dados['Pais_origem'] ?></b></small>

        </h4>
    </div>

    <?php if($plano['CodPlano'] == 4): ?>

    <div class="col-md-5 text-right">
        <button type="button" class="btn btn-info" onclick="location.href='<?php echo site_url('meu_plano') ?>'">Ver contatos</button> 
        <br><br>
        <p>
            Para visualizar o contato desse profissional, 
            <a href="<?php echo site_url('meu_plano') ?>" class="text-info">contrate um de nossos planos.</a>
        </p> <br><br>

        <p>
        </p>
    </div>

    <?php else: ?>
    
    <div class="col-md-5 text-right">
        <?php if($dados['CodUsuario'] != $template->guard->item('CodUsuario')): ?>
        <a class="btn btn-primary " href="<?php echo site_url('conversas/conversa/'.$dados['CodUsuario']); ?>">Enviar Mensagem</a>
        <?php endif; ?>
        
        <h4>
            <small style="color: #999!important;">
                <i class="fa fa-phone"></i>&ensp;<?php echo $dados['Celular'] ?>        
                <br>
                <a style="color: #999;" href="mail:<?php echo $dados['Email'] ?>"><i class="fa fa-envelope"></i>&ensp;<?php echo $dados['Email'] ?></a>  
                <br>
                <b>CPF</b>&ensp;<?php echo $dados['CPF'] ?>                    
            </small>
        </h4>
    </div>



    <?php endif; ?>
</div>

<hr>

<div class="row" >
    <div class="col-md-12">
        <h2 class="">Sobre mim</h2> <br>

        <p>
            <?php echo $dados['Sobre']; ?>
            
            <?php

            // ERRO DE SSL
            // $return = Maps::getLocal("Rua General Osorio, 1150, Caceres, MT");
            // print_r($return);

            ?>
        </p>
    </div>
</div>


<div class="row" style="margin-top: 50px;">
        <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>

    <div class="col-md-12">
        <h2>Localização</h2>
        <?php if(!empty($dados['Endereco'])): ?>
        <p><i class="fa fa-map-marker"></i> <?php echo $dados['Endereco'] ?></p>
        <div id="map"></div>
    <script>
      function initMap() {
     
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin = '<?php echo $template->guard->item("Endereco")?>';
        var destination = '<?php echo $dados["Endereco"] ?>';

        var destinationIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=D|FF0000|000000';
        var originIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=O|FFFF00|000000';

        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var map = new google.maps.Map(document.getElementById('map'), {
            center: latlng,
            zoom: 13
        });

        // Add the circle for this city to the map.
        var geocoder = new google.maps.Geocoder;

        geocoder.geocode( { 'address': '<?php echo $dados["Endereco"] ?>'}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                // var marker = new google.maps.Marker({
                //     map: map,
                //     position: results[0].geometry.location
                // });
                var cityCircle = new google.maps.Circle({
                    strokeColor: 'transparent',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    map: map,
                    center: map.getCenter(),
                    radius: 700
                });      
       

            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
         
    
      }

        function codeAddress() {
            geocoder.geocode( { 'address': '<?php echo $dados["Endereco"] ?>'}, function(results, status) {
                if (status == 'OK') {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }


      function deleteMarkers(markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
          markersArray[i].setMap(null);
        }
        markersArray = [];
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAilryqB0kQndDIgbYuNo2oXFU826PUh8I&callback=initMap">
    </script>
    <?php else: ?>
    <p>
        <i class="fa fa-map-marker"></i> Acrescente o campo <b>endereço</b> ao seu cadastro. <a href="<?php echo site_url('meus_dados/editar_perfil') ?>">Clique aqui</a> para editar seus dados.
    </p>
        
    <?php endif; ?>
    </div>


</div>


<div class="row" style="padding: 20px; margin-top: 50px; text-align: center; background: #fff; border-radius: 5px;">
    <h2>Veja mais <?php echo $dados['Categoria'] ?>s que se aproximam do seu perfil</h2><br>
    <?php if ( !$template->item( 'profissionais_relacionados' ) ): ?>
        <div class="col-md-12">
            <br>
            Nenhum profissional encontrado
        </div>
    <?php else: $cont=1;?>
        <?php foreach( $template->item( 'profissionais_relacionados' ) as $profissional ): 

            if($cont == 1)
                echo '<div class="row">';

        ?>

            <div class="conversas col-md-4">
                <div class="media" style="background: #fff; padding: 20px 10px;">
                    <div class="media-center">
                        <a href="#">
                            <img    class="media-object center-block" 
                                    width="150"
                                    onerror="broken( this )"
                                    src="<?php echo $profissional['Foto'] ? base_url( 'uploads/'.$profissional['Foto'] ) : base_url( 'uploads/avatar.jpg' ); ?>"><br>
                        </a>
                    </div>
                    <div class="media-body" title="Clique aqui para visualizar a página de perfil do(a) profissional <?php echo $profissional['Nome']?>" onclick="location.href = '<?php echo site_url('profissionais/ver/'.$profissional['CodUsuario']); ?>'">
                        <h4 class="media-heading"><?php echo $profissional['Nome']; ?></h4>
                        <div class="tags row">
                            <div class="col-md-12">
                                <strong>
                                    <?php echo $profissional['Categoria']; ?>
                                </strong>
                            </div>
                            <div class="col-md-12">
                                <strong><?php echo $profissional['Experiencia']; ?> anos de experiencia</strong>
                            </div>
                            <div class="col-md-12">
                                <?php if( !$profissional['Login'] ): ?>
                                Agora mesmo
                                <?php else: ?>
                                <?php echo $profissional['Login']; ?> 
                                <?php echo $profissional['Tipo']; ?> atrás
                                <?php endif; ?>
                            </div> 
                            <div class="col-md-12">
                                <strong>R$ <?php echo $profissional['Valor']; ?></strong>
                            </div>
                        </div><!-- descrição -->
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-block btn-primary" onclick="location.href = '<?php echo site_url('conversas/conversa/'.$profissional['CodUsuario']); ?>'">
                                <span class="glyphicon glyphicon-envelope"></span>
                                Entrar em contato
                            </button>
                        </div>
                    </div><!-- botão -->
                </div>
            </div>
        <?php 
        if($cont == 3){
            echo '</div>';
            $cont = 1;
        }
        else
            $cont++;
        endforeach; ?>
    <?php endif; ?>
</div>



