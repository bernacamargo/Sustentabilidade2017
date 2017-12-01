
<!-- VISÃO PROFISSIONAL -->

<?php if($profissional = $template->guard->profissional): 

$avaliacoes = $template->item('avaliacoes');

if($avaliacoes){
    $total = count($avaliacoes);
    $soma = 0;    
    foreach ($avaliacoes as $avaliacao) {
        $soma += $avaliacao['Avaliacao'];
    }

    $avaliacao = $soma / $total;
}
else
    $avaliacao = 0;
?>

<div class="row" style="padding-top: 30px;">
    <div class="col-md-2">
        <img class="img-responsive center-block" 
            onerror="broken( this )"
            src="<?php echo $template->guard->user['Foto'] ? base_url( 'uploads/'.$template->guard->user['Foto'] ) : base_url( 'uploads/avatar.jpg' ); ?>
        ">    
    </div>
    <div class="col-md-5">
        <h4 class="text-primary">
            <b><?php echo $profissional['Nome']; ?></b><span class="text-normal"><small>/Cod. <?php echo $profissional['CodUsuario']?></small></span> <br>
            <small>
                <?php echo $profissional['Idade'] ?> anos - <?php echo $profissional['Experiencia'] ?> anos de experiência <br>
                País de origem: <b><?php echo $profissional['Pais_origem'] ?></b> <br>
            <?PHP 
                $CodProfissional = [
                    'CodProfissional' => $profissional['CodProfissional']
                ];

                $template->print_component( 'avaliacao', $CodProfissional ); 
            ?>

<br>

            </small>
        </h4>
    </div>
    <div class="col-md-5 text-right">
        <a type="button" class="btn btn-default" href="<?php echo site_url('meus_dados/editar_perfil/')?>"><i class="fa fa-pencil"></i>&ensp;Editar Dados</a>
    </div>    
</div>

<hr>

<div class="row">

    <div class="col-md-12">
    
        <h3 class="text-bold">Sobre mim</h3>

        <p><?php echo $profissional['Sobre'] ?></p>
    </div>

</div>

<div class="row" style="margin-top: 30px;" hidden>

    <div class="col-md-12">
        
        <h3 class="text-bold">Treinamentos</h3>
        
        <button class="btn btn-primary"><i class="fa fa-plus"></i>&ensp;Preencher</button>

    </div>
</div>

<div class="row" style="margin-top: 30px;" hidden>
    <div class="col-md-12">
        <h3 class="text-bold">Referências</h3>
    
        <button class="btn btn-primary"><i class="fa fa-plus"></i>&ensp;Adicionar</button>
    </div>        
</div>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-12">
        <h3 class="text-bold">Avaliações</h3>

        <h2>
            
            <?PHP 
                $CodProfissional = [
                    'CodProfissional' => $profissional['CodProfissional']
                ];

                $template->print_component( 'avaliacao', $CodProfissional ); 
            ?>

        </h2>
    </div>
</div>


<div class="row" style="margin-top: 30px;">
    
    <div class="col-md-12">
        <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>

        <h3 class="text-bold">Localização <br> <small><i class="fa fa-map-marker"></i>&ensp;<?php echo $profissional['Endereco'] ?></small></h3>
        <div id="map"></div>

    <script>
      function initMap() {
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin = '<?php echo $template->guard->item("Endereco")?>';
        var destination = '<?php echo $profissional["Endereco"] ?>';

        var destinationIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=D|FF0000|000000';
        var originIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=O|FFFF00|000000';

        var latlng = new google.maps.LatLng(-34.397, 150.644);
        var map = new google.maps.Map(document.getElementById('map'), {
          center: latlng,
          zoom: 13
        });
        var geocoder = new google.maps.Geocoder;

        geocoder.geocode( { 'address': '<?php echo $profissional["Endereco"] ?>'}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
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
            geocoder.geocode( { 'address': '<?php echo $profissional["Endereco"] ?>'}, function(results, status) {
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
    </div>
</div>

<!-- VISAO EMPREGADOR -->

<?php else: 
$dados = $template->guard->user;
?>

<div class="row" style="margin-top: 30px;">

    <div class="col-md-8 left">
        <h3 class="text-bold text-primary">
            <b><?php echo $template->guard->user['Nome'] ?></b><small>/Cod <?php echo $template->guard->user['CodUsuario'] ?></small> <br>
            <small>
                <b>CPF</b> <?php echo $template->guard->user['CPF'] ?> <br>
                <b><i class="fa fa-mobile"></i></b>&ensp;<?php echo $template->guard->user['Celular'] ?> &ensp;|&ensp; <i class="fa fa-envelope"></i>&ensp;<?php echo $template->guard->user['Email'] ?>
            </small>
        </h3>
    </div>
    <div class="col-md-4 text-right">
        <a type="button" class="btn btn-default" href="<?php echo site_url('meus_dados/editar_perfil/')?>"><i class="fa fa-pencil"></i>&ensp;Editar Dados</a>
    </div>
</div>
<hr>
<div class="row">
        <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>

    <div class="col-md-12">
        <h2>Localização</h2>
        <?php if(!empty($dados['Endereco'])): ?>        
        <p><i class="fa fa-map-marker"></i> <?php echo $this->guard->user['Endereco'] ?></p>
        <div id="map"></div>
    <script>
      function initMap() {
     
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var origin = '<?php echo $template->guard->item("Endereco")?>';
        var destination = '<?php echo $this->guard->user["Endereco"] ?>';

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

        geocoder.geocode( { 'address': '<?php echo $this->guard->user["Endereco"] ?>'}, function(results, status) {
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
            geocoder.geocode( { 'address': '<?php echo $this->guard->user["Endereco"] ?>'}, function(results, status) {
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





<?php endif; ?>
