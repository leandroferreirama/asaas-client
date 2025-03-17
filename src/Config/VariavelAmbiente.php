<?php

namespace Asaas\Config;

class VariavelAmbiente
{
    public static function load(string $dir): void
    {
        //Verifica se o arquivo existe
        if(!file_exists($dir.'/.env')){
            return;
        }

        //Define as variáveis
        $linhas = file($dir.'/.env');
        foreach($linhas as $linha){
            putenv(trim($linha));
        }
    }
}