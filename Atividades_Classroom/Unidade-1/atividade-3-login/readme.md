# Atividade 3 - Sistema de Login com Area Restrita
# Aluno: João Paulo de Albuquerque Alves 
## Objetivo
Implementar um sistema simples de autenticacao em PHP usando sessao para controlar acesso a uma area restrita.

## Regras da atividade
- Usuario fixo: `admin`
- Senha fixa: `1234`
- Criar sessao ao autenticar
- Proteger a area restrita
- Implementar logout

## Requisitos tecnicos utilizados
- `session_start()` para iniciar sessao
- `$_SESSION` para armazenar estado de autenticacao
- `header()` para redirecionamentos
- Controle de acesso baseado em sessao

## Estrutura
- `index.php`: contem login, exibicao do painel restrito e logout no mesmo arquivo

## Fluxo de funcionamento
1. Usuario acessa `index.php` e visualiza o formulario de login.
2. Se credenciais estiverem corretas, o sistema salva dados em `$_SESSION` e redireciona com `header()`.
3. Com sessao ativa, a mesma pagina exibe o painel restrito.
4. Ao clicar em logout (`?acao=logout`), a sessao e destruida e o usuario volta para a tela de login.

## Como testar
1. Execute o servidor PHP na pasta da atividade.
2. Acesse `index.php` no navegador.
3. Tente login invalido para validar mensagem de erro.
4. Entre com `admin` / `1234` para acessar o painel.
5. Clique em logout e confirme retorno para a tela de login.

## Observacao
Este exemplo e didatico (credenciais fixas em codigo) e atende ao modelo incremental da disciplina.
