<?php 
/**
 * Plugin Name: Pegar valor do dólar e do euro
 * Description: Plugin para obter o valor das cotações do Dólar e Euro
 * Version: 1.0.0
 * Author: Giovane Ferreira
 * Author URI: https://github.com/giovanef16-sys
 * 
 */


add_shortcode("valor_moeda", function($atts) {
    $moeda = $atts["moeda"];
    // Iniciando conexão com o link que queremos acessar, enviando os parâmetros (get ?)
    $ch = curl_init("http://economia.awesomeapi.com.br/json/last/$moeda-BRL");
                    
    // Definindo configurações para a nossa conexão (Parâmetros: conexão, comando, valor)
    curl_setopt($ch, CURLOPT_HEADER, 0); // Desativa retorno das informações do cabeçalho do server
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Desativa verificação SSL
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Desativa verificação SSL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Ativamos para permitir receber os dados enviados pelo server
    
    $res_curl = curl_exec($ch); // Executamos a nossa conexão

    $resultado = json_decode($res_curl, true); // Convertendo a string JSON para Array
        
    curl_close($ch); // Fechando a conexão
    return $resultado["{$moeda}BRL"]["low"]; // Pegando o valor da chave low, que está dentro de dois arrays
});

?>
