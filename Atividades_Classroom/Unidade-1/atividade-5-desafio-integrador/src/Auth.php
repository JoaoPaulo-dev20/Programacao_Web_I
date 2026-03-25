<?php
declare(strict_types=1);

final class Auth
{
    private string $usuarioValido = 'admin';
    private string $senhaValida = '1234';

    public function attemptLogin(string $usuario, string $senha): bool
    {
        if ($usuario === $this->usuarioValido && $senha === $this->senhaValida) {
            $_SESSION['autenticado'] = true;
            $_SESSION['usuario'] = $usuario;
            return true;
        }

        return false;
    }

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['autenticado']) && $_SESSION['autenticado'] === true;
    }

    public function getUsername(): string
    {
        return (string)($_SESSION['usuario'] ?? '');
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}
