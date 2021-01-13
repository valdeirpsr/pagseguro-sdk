# Começando

## Requisitos

Para utilizar o SDK, é necessário possuir:

 - PHP 7.3 ou superior
 - PHP Ext Json
 - PHP Ext XML
 - Composer
 - Docker (para desenvolvimento)


## Instalação

Para começar, execute o passo a passo abaixo:

### Via Composer

**PHP 7.3 ou 7.4**

No seu terminal, execute o comando abaixo

```bash
composer require valdeirpsr/pagseguro-sdk
```

**PHP 8**

No seu terminal, execute o comando abaixo

```bash
composer require valdeirpsr/pagseguro-sdk --ignore-platform-req php
```

## Cartão de Crédito

Crie transações com o uso de cartões de crédito.
É necessário usar o [JavaScript](https://dev.pagseguro.uol.com.br/reference/checkout-transparente#transparente-biblioteca-javascript) do PagSeguro para obter o token do cartão de crédito. Isto porque os dados do cartão não são transferidos entre o *client-side* e o *server-side*

[Example with credit card](assets/examples/credit_card.php ':include')

# Boleto

Com este método de pagameneto, é necessário capturar a URL do boleto.

[Example with boleto](assets/examples/boleto.php ':include')

# Débito

É necessário redirecionar o usuário ao site do banco

[Example with debit](assets/examples/debit.php ':include')

# Habilitando *logs*

Para habilitar os *logs*, utilize a classe `Logger` logo após carregar o *autoload.php*.

```php
require_once 'vendor/autoload.php';

use ValdeirPsr\PagSeguro\Domains\Logger\Logger;

Logger::getInstance([
    'enabled' => true,
    'path' => '/path/to/dir'
]);

/** Code here */
```

Caso queira registrar *logs* particulares, use os métodos abaixo.

```php
Logger::debug('Mensagem', ['Context 1', 'Context 2']);
Logger::info('Mensagem', ['Context 1', 'Context 2']);
Logger::notice('Mensagem', ['Context 1', 'Context 2']);
Logger::warning('Mensagem', ['Context 1', 'Context 2']);
Logger::error('Mensagem', ['Context 1', 'Context 2']);
Logger::critical('Mensagem', ['Context 1', 'Context 2']);
Logger::alert('Mensagem', ['Context 1', 'Context 2']);
Logger::emergency('Mensagem', ['Context 1', 'Context 2']);
```
?> **Dica**<br>
A classe `Logger` utiliza o [Monolog](https://seldaek.github.io/monolog/) para registrar os arquivos.
