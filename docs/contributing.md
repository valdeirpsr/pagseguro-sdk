# Contribuições

Para contribuir com o código, recomendados que siga o passo a passo abaixo:

1. Faça o clone do repositório

```bash
git clone https://github.com/valdeirpsr/pagseguro-sdk.git
```

2. Crie um *branch* para realizar suas modificações

```bash
git switch -c <type>/sua-modificacao
```

Onde `<type>` pode ser:

 - *feat*: Novas funcionalidades
 - *fix*: Correção de *bugs*
 - *docs*: Alteração na documentação
 - *style*: Correção de formatação (identação, linhas em branco, quebra de linhas etc)
 - *refactor*: Refatoração
 - *test*: Adiciona ou refatora testes
 - *chore*: Alterações que não afetam o código (Atualização do `composer.json` ou `.gitignore`, por exemplo)

3. Após alteração, realize seu *commit* (de preferência assinada) e faça um *push*.

```bash
git commit -sS && git push origin <type>/sua-modificacao
```

4. Feito isso, basta enviar sua [*pull request*](https://docs.github.com/pt/free-pro-team@latest/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request)
