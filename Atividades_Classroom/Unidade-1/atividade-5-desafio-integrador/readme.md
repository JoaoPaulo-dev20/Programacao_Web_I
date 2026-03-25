# Atividade 5 - Desafio Integrador
# Aluno: Joao Paulo de Albuquerque Alves

## Descricao
Este projeto integra os conceitos das atividades anteriores da unidade:
- Login com sessao
- Personalizacao com cookie
- Formulario de cadastro com validacao
- Classificacao academica por nota
- Persistencia local em JSON

## Funcionalidades
1. Login com usuario fixo `admin` e senha `1234`
2. Painel restrito para usuarios autenticados
3. Cadastro de aluno (nome, e-mail, curso, turno e nota)
4. Classificacao automatica:
   - Aprovado (nota >= 7)
   - Recuperacao (nota >= 5 e < 7)
   - Reprovado (nota < 5)
5. Registro dos cadastros em `storage/alunos.json`
6. Cookie com o nome do ultimo aluno salvo
7. Logout e limpeza de cookie

## Estrutura
- `index.php`: fluxo principal da aplicacao
- `src/Auth.php`: controle de autenticacao
- `src/CookieManager.php`: gerenciamento de cookie
- `src/Validator.php`: validacoes e regra de classificacao
- `src/AlunoService.php`: leitura e escrita do JSON
- `storage/alunos.json`: persistencia local

## Como executar
1. Abra o terminal na pasta `atividade-5-desafio-integrador`
2. Execute:

```bash
php -S localhost:8000
```

3. Acesse no navegador:

```text
http://localhost:8000/index.php
```

## Observacao
Projeto didatico, sem banco de dados e sem criptografia de senha. O foco e consolidar conceitos de Programacao Web I.
