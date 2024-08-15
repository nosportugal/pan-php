# Pacote Palo Alto Networks API em PHP

## SINOPSE

```php
<?php
use PAN\PaloAltoNetworks;

$pan = new PaloAltoNetworks([
    'clientId'     => 'email@domain.com',
    'clientSecret' => 'c51bd264-1943-4be8-8125-320f92bb5587',
    'tsgId'        => 123456789,
    'redis'        => [
        'schema' => 'tcp',
        'host'   => '127.0.0.1'
    ]''
]);

$search = [
    'limit'    => 50,
    'offset'   => 0,
    'position' => 'pre',
    'folder'   => 'Shared'
];

$securityRules = $pan->securityRules($search);

$list = $securityRules->list();

$success = $list->success(); // it is bool, return true or false
$code = $list->code(); // it is number, return 200, 400, 401 and ...
$body = $list->body(); // it is object with the body of message
```

## DESCRIÇÃO

Esse pacote PHP tem o propósito de facilitar o acesso a API do Palo Alto Networks, atualmente conta com funcionalidades para manipular os endpoints: Addresses, SecurityRules, Services e Tags.

## VERSÃO
1.1.2

## INSTALAÇÃO

### Composer

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/nosportugal/pan-php.git"
        }
    ],
    "require": {
        "nosportugal/pan-php": "1.1.2"
    }
}
```
