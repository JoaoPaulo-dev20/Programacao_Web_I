# Atividade 2 - Simulador de Cadastro
# Aluno: João Paulo de Albuquerque Alves
Este projeto mostra um formulario simples em PHP para cadastro de aluno com validacao de campos obrigatorios.

## Objetivo

Coletar os dados abaixo via metodo `POST`:
- Nome
- E-mail
- Curso
- Turno

Comportamento esperado:
- Se algum campo estiver vazio, o sistema exibe mensagem de erro.
- Se todos os campos estiverem preenchidos, o sistema exibe mensagem de sucesso e mostra os dados enviados.

## Como executar

1. Abra o terminal na pasta da atividade.
2. Execute:

```bash
php -S localhost:8000
```

3. No navegador, acesse:

```text
http://localhost:8000/index.php
```

## Testes rapidos

1. Envie o formulario com um campo vazio para validar o erro.
2. Preencha todos os campos para validar o sucesso.
3. Verifique se os dados aparecem organizados na tela apos o envio valido.
