# Aluno: João Paulo de Albuquerque Alves
# Professor Renato

# Questionário 1 - Atividade Prática PHP

# Como rodar os arquivos PHP (XAMPP)

Este projeto contem varios arquivos PHP (`questao01.php` ate `questao21.php`) e deve ser executado com servidor web.

## 1) Iniciar o Apache no XAMPP

1. Abra o **XAMPP Control Panel**.
2. Clique em **Start** no modulo **Apache**.
3. Verifique se ficou em verde (rodando).

## 2) Confirmar a pasta do projeto

A pasta do projeto deve estar em:

`C:\xampp\htdocs\programacaoweb1\questionario1_questoesphp`

Se ja esta nesse caminho, nao precisa mover nada.

## 3) Abrir no navegador

Com o Apache ligado, acesse:

- Projeto/pasta:  
  `http://localhost/programacaoweb1/questionario1_questoesphp/`
- Exemplo de arquivo:  
  `http://localhost/programacaoweb1/questionario1_questoesphp/questao01.php`

Troque o nome do arquivo para abrir as outras questoes:

- `questao02.php`
- `questao03.php`
- ...
- `questao21.php`

## 4) Problemas comuns

- **Erro 404 (pagina nao encontrada):**
  confira se o caminho da pasta esta correto dentro de `htdocs`.
- **Apache nao inicia:**
  pode haver conflito de porta (80/443). Feche outros programas que usam essas portas.
- **Arquivo abre como texto ou download:**
  voce pode estar abrindo o arquivo direto no disco. Use sempre a URL com `http://localhost/...`.

## 5) Dica rapida

Se quiser testar todos rapidamente, abra no navegador:

`http://localhost/programacaoweb1/questionario1_questoesphp/questao01.php`

E mude apenas o numero na barra de endereco (`01`, `02`, ..., `21`).
