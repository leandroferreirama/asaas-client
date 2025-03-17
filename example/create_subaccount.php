<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Asaas\AsaasConfig;
use Asaas\Config\VariavelAmbiente;
use Asaas\HttpClient;
use Asaas\Endpoints\SubaccountEndpoint;
use Asaas\Models\Subaccount;

try {
    //token de acesso
    VariavelAmbiente::load(__DIR__.'/../');
    $token = getenv('ASAAS_TOKEN');
    
    // Configuração
    $config = new AsaasConfig(AsaasConfig::ENV_SANDBOX);
    $httpClient = new HttpClient(
        $token,
        $config
    );

    $subaccountEndpoint = new SubaccountEndpoint($httpClient);

    // Criar subconta
    $subaccount = new Subaccount(
        'Minha Subconta',
        'email@email.com',
        '00000000000000',
        '41000000000',
        5000.00,
        '000',
        '00000000',
        companyType: 'LIMITED'
    );

    $response = $subaccountEndpoint->create($subaccount);

    var_dump($response);
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}

/*
 * array(2) { ["status_code"]=> int(200) ["response"]=> array(25) { ["object"]=> string(7) "account"
 * ["id"]=> string(36) "304c54b3-7e59-4d6b-98c1-6e4b070fafbd"
 * ["name"]=> string(14) "Minha Subconta"
 * ["email"]=> string(21) "tecsol@formaturas.com"
 * ["loginEmail"]=> string(21) "tecsol@formaturas.com"
 * ["phone"]=> NULL
 * ["mobilePhone"]=> string(11) "11997780000"
 * ["address"]=> string(24) "Rua Teofilo Soares Gomes"
 * ["addressNumber"]=> string(3) "947"
 * ["complement"]=> NULL
 * ["province"]=> string(13) "Jardim Social"
 * ["postalCode"]=> string(8) "82530090"
 * ["cpfCnpj"]=> string(14) "46024228000112"
 * ["birthDate"]=> NULL
 * ["personType"]=> string(8) "JURIDICA"
 * ["companyType"]=> string(7) "LIMITED"
 * ["city"]=> int(13405)
 * ["state"]=> string(2) "PR"
 * ["country"]=> string(6) "Brasil"
 * ["site"]=> NULL
 * ["walletId"]=> string(36) "59fc6d1e-8b85-4c8f-92b9-2fecc7e43939"
 * ["apiKey"]=> string(158) "$aact_MzkwODA2MWY2OGM3MWRlMDU2NWM3MzJlNzZmNGZhZGY6OjEwMTAxOThhLWUyMGEtNGFkMS1iZTlmLTBlZjI3OTI5MjA1Nzo6JGFhY2hfYTczYzIyN2QtZjAwOS00YjM1LWE0ODUtODU2ZDE2MGY4MjY2"
 * ["accountNumber"]=> array(3) { ["agency"]=> string(4) "0001" ["account"]=> string(6) "158343" ["accountDigit"]=> string(1) "2" }
 * ["incomeValue"]=> int(5000)
 * ["commercialInfoExpiration"]=> NULL } }
 *
 *
 */
