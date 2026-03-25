<?php
declare(strict_types=1);

final class CookieManager
{
    private string $cookieNome;
    private int $duracao;

    public function __construct(string $cookieNome = 'visitante_nome', int $duracao = 604800)
    {
        $this->cookieNome = $cookieNome;
        $this->duracao = $duracao;
    }

    public function getVisitorName(): string
    {
        return trim((string)($_COOKIE[$this->cookieNome] ?? ''));
    }

    public function setVisitorName(string $nome): void
    {
        setcookie($this->cookieNome, $nome, [
            'expires' => time() + $this->duracao,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    public function clearVisitorName(): void
    {
        setcookie($this->cookieNome, '', [
            'expires' => time() - 3600,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }
}
