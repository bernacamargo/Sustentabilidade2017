/**
 * fillSelect
 * 
 * preenche um select com os dados passados
 * 
 * @param {string} selector o seletor do select a ser preenchido
 * @param {object} data os dados a serem colocados no select 
 */
function fillSelect(selector, data) {

    // remove todos os items anteriores do campo
    $(selector).html('');

    // adiciona a opcao padrao
    $(selector).append('<option value="" selected="selected">-- Selecione --</option>');

    //desabilita o campo
    $(selector).attr('disabled', 'disabled');

    // verifica se existem dados
    if (data['data'].length == 0) return;

    // percorre todos os dados
    for (var d in data['data']) {

        // pega o item atual
        var item = data['data'][d];

        // prepara o option
        var option = $('<option></option>').val(item['value']).html(item['label']);
        $(selector).append(option);
    }

    // habilita o campo
    $(selector).removeAttr('disabled');
}

/**
 * updateSelect
 * 
 * Pega os dados para preencher um select relacional
 * 
 * @param {string} url a url onde estao os dados 
 * @param {string} selector o seletor do select a ser preenchido
 * @param {element} obj o elemento select com os parametros do preenchimento
 */
function updateSelect(url, selector, obj) {

    // pega o valor a ser concatenado
    var param = obj.val();

    // verifica se o valor é nulo
    if (param == null || param.trim().length == 0) {
        fillSelect(selector, { 'data': '' });
        return;
    }

    // monta o ajax de request
    var ajaxUrl = SiteUrl + 'ajax/' + url + '/' + param;

    // busca os dados
    $.get(ajaxUrl, function (data) {
        fillSelect(selector, JSON.parse(data));
    });
}

/**
 * enviarMensagem
 * 
 * envia uma mensagem
 */
function enviarMensagem() {

    // pega os dados da mensagem
    var dados = {
        'CodUsuario': $('#conversaId').val(),
        'Texto': $('#texto').val()
    };
    
    $("#texto").val("");

    // chama o ajax
    var ajaxUrl = SiteUrl + 'conversas/enviar';

    // faz o post
    $.post(ajaxUrl, dados, function (data) {
        $("#texto").val("");

        var dados = JSON.parse(data);

        console.log(dados);
    }).done(function(){
        $('#texto').val("");
        $("#texto").focus();
    });

    ;
}

/**
 * obterNovasMensagens
 * 
 * obtem as novas mensagens
 */
function obterNovasMensagens() {

    // verifica se existe uma ultima mensagem
    if ( !UltimaMensagem ) UltimaMensagem = 1;

    // pega os dados para enviar o post
    var dados = {
        'CodUsuario': $('#conversaId').val(),
        'idMensagem': UltimaMensagem
    };

    // chama o ajax
    var ajaxUrl = SiteUrl + 'conversas/carrega_mensagens';

    // faz o post
    $.post(ajaxUrl, dados, function (data) {

        var dados = JSON.parse(data);

        if (dados.length > 0) {
            for (var i in dados) {
                adicionarMensagem(dados[i]);
                UltimaMensagem = dados[i]['CodMensagem'];
                console.log(dados[i]);
            }
        }
    });

}

/**
 * adicionarMensagem
 * 
 * adiciona uma mensagem na lista
 * 
 * @param {Object} mensagem
 */
function adicionarMensagem(mensagem) {

    if (!mensagem.NomeEnvio) return;

    var CodUsuario = $('#conversaId').val();

    // monta o html
    var row = $('<div class="row"></div>');
    var col = $('<div class="col-md-8 col-md-offset-4"></div>');
    var media = $('<div class="media"></div>');
    var mediaBody = $('<div class="media-body media-message-body"></div>');
    var mediaHeading = $('<h4 class="media-heading"></h4><br>');
    var mediaSide = $('<div></div>');
    var link = $('<a></a>');
    var img = $('<img class="img-circle media-object" width="70">');
    var line = $('<div class="col-md-12"><br></div>');

    // seta a classe
    if (CodUsuario != mensagem.CodUsuario) {

        // prepara o lado
        mediaSide.addClass('media-right');

        // prepara o cabecalho
        mediaHeading.html('Você <small class="pull-right"><i class="glyphicon glyphicon-time"></i>&ensp;Agora mesmo</small>');

        // prepara o corpo
        mediaBody.append(mediaHeading).append(mensagem.Mensagem);

        // prepara a imagem
        img.attr('src', BaseUrl + 'uploads/' + mensagem.FotoRecebeu);

        // prepara o link
        link.append(img);

        // adiciona o link
        mediaSide.append(link);

        // adiciona os filhos da media
        media.append(mediaBody).append(mediaSide);
    } else {

        // prepara o lado
        mediaSide.addClass('media-left');

        // prepara a coluna
        col.removeClass('col-md-offset-4');

        // adiciona o cabecalho         
        mediaHeading.html(mensagem.NomeRecebeu + '<small class="pull-right"><i class="glyphicon glyphicon-time"></i>&ensp;Agora mesmo</small>');

        // prepara o corpo
        mediaBody.append(mediaHeading).append(mensagem.Mensagem);

        // prepara a imagem
        img.attr('src', BaseUrl + 'uploads/' + mensagem.FotoEnvio);

        // prepara o link
        link.append(img);

        // adiciona o link
        mediaSide.append(link);

        // adiciona os filhos da media
        media.append(mediaSide).append(mediaBody);
    }

    // insere a coluna
    col.append(media);

    // insere a linha
    row.append(col);

    // adiciona a mensagem
    $('#conversaMensagem').append(row).append('<br>');

    // faz o scroll
    var container = document.getElementById('conversaMensagem');
    container.scrollTop = container.scrollHeight;
}

/**
 * broken
 * 
 * caso a imagem esteja quebrada
 * 
 * @param {Element} container a imagem a ser substituida
 */
function broken( container ) {

    // seta o erro como false
    container.onerror = "";

    // seta a imagem para imagens quebradas
    container.src = "http://www.fuxicodemulher.com.br/wp-content/uploads/2016/02/sem-foto_800.jpg";
    
    // volta true
    return true;
}

/**
 * obterCEP
 * 
 * obtém os dados de endereço a partir de um cep
 * 
 * 
 * @param {number} cep o cep que deseja obter informações
 */
function obterCEP( cep ) {

    // pega o cep
    var cep = cep.replace(/\D/g, '');

    // verifica o tamanho
    if ( cep == "" ) return false;

    // mostra o loading
    $( '#loading' ).removeClass( 'hidden' );

    // monta a url do ajax
    var ajaxURL = 'https://maps.googleapis.com/maps/api/geocode/json?address='+cep;

    // faz a requisicao
    $.get( ajaxURL, function( data, textStatus, xhr) {

        // verifica o status
        if ( data.status == 'OK' ) {

            // pega o resultado
            var result = data.results[0];

            // seta o endereco obtido
            $( '#endereco' ).val( result.formatted_address );

            // pega as geocordenadas
            var geo = result.geometry.location;

            // seta as coordenadas
            $( '#Latitude' ).val( geo.lat );
            $( '#Longitude' ).val( geo.lng );
        }

        // esconde o loading
        $( '#loading' ).addClass( 'hidden' );
    });
}



$(document).ready(function () {

    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });

    $('#dropdown_menu_ajuda, .btn-ajuda').hover(function(){
        // alert("teste");
        setTimeout(function(){
            if($('.btn-ajuda').hasClass('open'))
                $('.btn-ajuda').addClass('active');
            else
                $('.btn-ajuda').removeClass('active');
        }, 100);
    });
    
    $('.btn-ajuda').hover(function(){ 
        $('.dropdown-toggle', this).trigger('click');
    });

    $('#Celular').inputmask("(99) 99999-9999");
    $('#CPF').inputmask("999.999.999-99");
    $('#CEP').inputmask("99999-999");

    var container = document.getElementById('conversaMensagem');
    if (container) {
        container.scrollTop = container.scrollHeight;
        setInterval(function () {
            obterNovasMensagens();
        }, 2000);
    }

    $('#descricao_anuncio').keyup(function(event) {

        $valor = 150 - $(this).val().length;

        if($valor <= 0){
            $('#descricao_anuncio_cont_container').css("font-weight", "bold");
            $valor = 0;
        }
        else {
            $('#descricao_anuncio_cont_container').css("font-weight", "normal");  
        }
        $('#descricao_anuncio_cont').html($valor);


    });

    $('#texto').keypress(function(event) {
        if(event.which == 13){

            event.preventDefault();

            $("#texto").text("");
            enviarMensagem();
        }
    });

    $('.st-ff-count').countTo();

    $('#top').click(function() {
        $("body, html").stop().animate({scrollTop: 0}, 1000, 'swing', function() {
            // alert("subiu");
        });
    });


    $('#alterar_senha_submit').click(function(event) {        
        // $('#alterar_senha').submit();

        // event.preventDefault();

        // $('#alterar_senha').submit();

        var data = {
            'Senha_antiga': $('#senha_antiga').val(),
            'Senha_nova': $('#senha_nova').val(),
            'Senha_nova_confirm': $('#senha_nova_confirm').val()
        }

        $.ajax({
            url: '../alterar_senha',
            type: 'POST',
            data: data
        })
        .done(function(data) {
            $('#alertt').html(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    });
    
});
