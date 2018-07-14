# 

Biblioteca que realiza integração com a API do [RDStation](http://www.rdstation.com)

[![StyleCI](https://styleci.io/repos/127529310/shield?branch=master)](https://styleci.io/repos/127529310)

## Instalação via composer

```bash
$ composer require bubbstore/rdstation-php-sdk
```

## Cadastrar um novo lead

```php
<?php

use bubbstore\RDStation\RD;
use bubbstore\RDStation\Exceptions\RDException;

try {
    $rd = new RD('TOKEN_PUBLICO');
    $lead = $rd->lead()->create([
        'email' => 'lucas@bubb.com.br',
        'name' => 'Lucas Colette',
        'cargo' => 'CEO',
        'empresa' => 'bubbstore',
        'tags' => 'a_nice_tag',
        'campo_customizado_1' => 'valor customizado',
        'campo_customizado_2' => 'valor customizado'
    ]);

    echo '<pre>' . var_dump($lead) . '</pre>';

} catch (RDException $e) {
    echo $e->getMessage();
}
```

Resultado esperado:

```
[
    'result' => 'success',
    'lead' => [
        'email' => 'lucas@bubb.com.br',
        'name' => 'Lucas Colette',
        'cargo' => 'CEO',
        'empresa' => 'bubbstore',
        'tags' => 'a_nice_tag',
        'campo_customizado_1' => 'valor customizado',
        'campo_customizado_2' => 'valor customizado'
    ],
]
```

## Testando

```bash
$ composer test
```

## Change log

Consulte [CHANGELOG](.github/CHANGELOG.md) para obter mais informações sobre o que mudou recentemente.

## Contribuindo

Consulte [CONTRIBUTING](.github/CONTRIBUTING.md) para obter mais detalhes.

## Segurança

Se você descobrir quaisquer problemas relacionados à segurança, envie um e-mail para contato@bubbstore.com.br em vez de usar as issues.