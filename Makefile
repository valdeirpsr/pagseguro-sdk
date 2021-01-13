help:
	@echo "Por favor, use \"make <comando>\" onde <comando> pode ser:"
	@echo "  test             para executar os testes com PHPUnit (Docker obrigatório)"
	@echo "  stan             para validar o código utilizando o PHPStan"
	@echo "  cs               para validar o código utilizando o PHP Code Sniffer"
	@echo "  fix              tenta corrigir os erros de padronização com PHP Code Sniffer"
	@echo "  reference        para exibir a documentação de referência"
	@echo "  docs             para exibir a documentação de uso (NPM obrigatório)"

changelog:
	npx conventional-changelog-cli -p angular -i CHANGELOG.md -s

test:
	vendor/bin/phpunit --config "$(shell pwd)/phpunit.xml"

stan:
	vendor/bin/phpstan analyze src

cs:
	vendor/bin/phpcs --colors -s --bootstrap=vendor/autoload.php --standard=PSR1,PSR12 -p --report=full src/

fix:
	vendor/bin/phpcbf --colors -s --bootstrap=vendor/autoload.php --standard=PSR1,PSR12 -p --report=full src/

reference:
	@echo "Coming soon"

docs:
	@echo "Coming soon"
