<?php
declare(strict_types=1);

final class Validator
{
    public function validateAluno(array $dados): array
    {
        $erros = [];

        if (($dados['nome'] ?? '') === '') {
            $erros[] = 'Informe o nome do aluno.';
        }

        if (($dados['email'] ?? '') === '') {
            $erros[] = 'Informe o e-mail do aluno.';
        } elseif (filter_var($dados['email'], FILTER_VALIDATE_EMAIL) === false) {
            $erros[] = 'Informe um e-mail valido.';
        }

        if (($dados['curso'] ?? '') === '') {
            $erros[] = 'Informe o curso.';
        }

        if (($dados['turno'] ?? '') === '') {
            $erros[] = 'Selecione um turno.';
        }

        if (($dados['nota'] ?? '') === '') {
            $erros[] = 'Informe a nota.';
        } elseif (!is_numeric($dados['nota'])) {
            $erros[] = 'A nota precisa ser numerica.';
        } else {
            $nota = (float)$dados['nota'];
            if ($nota < 0 || $nota > 10) {
                $erros[] = 'A nota deve estar entre 0 e 10.';
            }
        }

        return $erros;
    }

    public function classify(float $nota): string
    {
        if ($nota >= 7.0) {
            return 'Aprovado';
        }

        if ($nota >= 5.0) {
            return 'Recuperacao';
        }

        return 'Reprovado';
    }
}
