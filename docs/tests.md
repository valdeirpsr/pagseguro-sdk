# Testes

No SDK, você pode executar os testes unitários e fazer análise do código quanto à padronização.

## TDD

Há duas formas de realizar os testes:

 - Com Docker: Realiza todos os testes, inclusive das requisições (com *mock*)
 - Sem Docker: Realiza apenas os testes unitários das classes em _Domains_

### Testes o Docker

Levante o servidor para teste com o código abaixo:

```bash
docker-compose -f tests/server/docker-compose.yaml up -d
```

?> **Aviso**<br>O servidor rodará em http://localhost:3000

No seu terminal, execute o *phpunit*.

```bash
# Caso possua o PHPUnit instalado globalmente
phpunit

# Via Composer
composer tdd

# Via Makefile
make tdd

# Via PHPUnit instalado localmente
vendor/bin/phpunit
```

### Executando testes sem o Docker

No seu terminal, execute o *phpunit*.

```bash
# Caso possua o PHPUnit instalado globalmente
phpunit --testsuite no-docker

# Via Composer
composer tdd -- --testsuite no-docker

# Via PHPUnit instalado localmente
vendor/bin/phpunit --testsuite no-docker
```

## Sniffer

Para detectar violações dos padrões [PSR1](https://www.php-fig.org/psr/psr-1/) e [PSR12](https://www.php-fig.org/psr/psr-12/), execute o comando abaixo em seu terminal.

```bash
# Via Composer
composer phpcs

# Via Makefile
make cs

# Via PHPUnit instalado localmente
vendor/bin/phpcs --standard=PSR1,PSR12 src
```

?> **Atenção**<br> Você pode usar o [phpcbf](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Fixing-Errors-Automatically) para **tentar** corrigir os erros automaticamente.
