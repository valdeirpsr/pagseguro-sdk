help:
	@echo "Por favor, use \"make <comando>\" onde <comando> pode ser:"
	@echo "  test             para executar os testes com PHPUnit (Docker obrigatório)"
	@echo "  stan             para validar o código utilizando o PHPStan"
	@echo "  cs               para validar o código utilizando o PHP Code Sniffer"
	@echo "  reference        para exibir a documentação de referência"
	@echo "  docs             para exibir a documentação de uso (NPM obrigatório)"

changelog:
	npx conventional-changelog-cli -p angular -i CHANGELOG.md -s
