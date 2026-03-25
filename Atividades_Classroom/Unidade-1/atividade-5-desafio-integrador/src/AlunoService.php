<?php
declare(strict_types=1);

final class AlunoService
{
    private string $arquivo;

    public function __construct(string $arquivo)
    {
        $this->arquivo = $arquivo;
        if (!file_exists($this->arquivo)) {
            file_put_contents($this->arquivo, "[]\n");
        }
    }

    public function all(): array
    {
        $conteudo = file_get_contents($this->arquivo);
        if ($conteudo === false || trim($conteudo) === '') {
            return [];
        }

        $dados = json_decode($conteudo, true);
        if (!is_array($dados)) {
            return [];
        }

        return array_reverse($dados);
    }

    public function save(array $aluno): bool
    {
        $conteudo = file_get_contents($this->arquivo);
        $dados = [];

        if ($conteudo !== false && trim($conteudo) !== '') {
            $decodificado = json_decode($conteudo, true);
            if (is_array($decodificado)) {
                $dados = $decodificado;
            }
        }

        $dados[] = $aluno;

        $json = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($json === false) {
            return false;
        }

        return file_put_contents($this->arquivo, $json . "\n") !== false;
    }
}
