# Atividade 4 - Controle de Acesso com Cookies

Este exercício salva o nome do visitante em um cookie por **7 dias**.

## Como funciona
1. No primeiro acesso, o sistema mostra um formulário pedindo o nome.
2. Após enviar, o nome é salvo em cookie.
3. Nos próximos acessos, o sistema exibe uma mensagem personalizada.
4. Se o cookie não existir (ou expirar), o formulário volta a aparecer.

## Como testar
1. Abra o arquivo `index.php` em um servidor local com PHP.
2. Digite seu nome e clique em **Salvar nome**.
3. Recarregue a página para ver a mensagem de boas-vindas.
4. Clique em **Esqueci meu nome (apagar cookie)** para remover o cookie e testar o primeiro acesso novamente.

## Arquivo principal
- `index.php`
