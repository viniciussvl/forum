<?php

// Função da Data e Hora atual
function dataAtual() {
    $data = getdate();
    $diaSemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
    $nomeMes = array(1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro');
    $dia = $data['mday'];
    $mes = $data['mon'];
    $ano = $data['year'];
    date_default_timezone_set('America/Sao_Paulo');
    $hora = date('H:i');

    if (strlen($dia) < 2) {
        $dataFormatada = 0 . $dia . "/" . $mes . "/" . $ano;
    } else {
        $dataFormatada = $dia . "/" . $mes . "/" . $ano;
    }
    $dataCompleta = $diaSemana[$data['wday']] . " " . $dataFormatada . " ás " . $hora;
    return $dataCompleta;
    //echo $nomeMes[$data['mon']];
}

?>