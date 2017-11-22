<?php defined('BASEPATH') OR exit('No direct script access allowed');

// informa se um dia é util ou não
function util( $dia ) {

    // transforma o time stamp em dia 
    $day_of_week = date( 'w', $dia );

    // retorna se é util ou não
    return $day_of_week == 6 || $day_of_week == 0 ? false : true;
}

// acrecenta um dia a um timestamp
function next_day( $time ) {
    return $time + ( 3600 * 24 );
}
 
// informa se dois times stamps representam o mesmo dia
function same_day( $dayOne, $dayTwo ) {

    // pega o ano das duas datas
    $dateOne = date( 'Y-m-d', $dayOne );
    $dateTwo = date( 'Y-m-d', $dayTwo );

    // verifica se os anos são o mesmo
    return ( $dateOne === $dateTwo );
}

// pega o intervalo de dias uteis entre duas datas
function calcular_intervalo( $inicio, $final ) {

    // transforma duas datas em timestamp
    $ts_inicio = strtotime( $inicio );
    $ts_final  = strtotime( $final );

    // verifica se os dias são diferentes
    if ( $ts_final < $ts_inicio ) return false;

    // inicia o contador de dias uteis
    $cont = 0;
    
    // inicia o indicador de dias iguais
    $equal = false;

    // enquanto os dias não forem iguais, calcule
    while ( !$equal ) {

        // verifica se são o mesmo dia
        if ( !same_day( $ts_inicio, $ts_final ) ) {

            // pega o dia seguinte
            $next_day = next_day( $ts_inicio );

            // verifica se o dia seguinte já é o dia final
            if ( same_day( $next_day, $ts_final ) ) $equal = true;

            // incrementa o contador se for dia util
            if ( util( $next_day ) ) $cont++;

            // seta o inicio a partir do dia seguinte
            $ts_inicio = $next_day;
        
        // caso seja o mesmo dia
        } else $equal = true;

        // verifica se o contador ja deu mais de 365 dias uteis
        if ( $cont == 365 ) $equal = true;
    }

    // retorna os dias passados
    return $cont;
}

// acrescenta um determinado numero de dias a uma data
function calcular_data( $inicio, $intervalo ) {

    // verifica se o intervalo é maior que zero
    if ( $intervalo <= 0 ) return $inicio;

    // pega o timestamp do inicio
    $ts_inicio = strtotime( $inicio );

    // variavel de controle de iteracoes
    $cont = 0;

    // enquanto o intervalo não esgotar
    while( $intervalo > 0 ) {

        // pega o dia seguinte
        $next_day = next_day( $ts_inicio );

        // verifica se é util
        if ( util( $next_day ) ) {
            $intervalo--;
            $cont++;
        }

        // seta o inicio como o dia seguinte
        $ts_inicio = $next_day;

        // incrementa a varivael de controle
        $cont++;

        // verifca a variavel de controle
        if ( $cont == 100 ) break;
    }

    // retorna o contador
    return date( 'Y-m-d', $ts_inicio );
}