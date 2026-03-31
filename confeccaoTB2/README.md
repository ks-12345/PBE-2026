## confecaoTB2

Projeto em **Laravel 13 + PHP 8.3** com **Filament** (painel admin) e front com **Vite + Tailwind**.

### Requisitos

- PHP 8.3+
- Composer
- Node.js (LTS recomendado)
- Banco de dados configurado no `.env`

### Setup rápido

O projeto já tem um script de setup no `composer.json`.

```bash
composer run setup
```

### Desenvolvimento

Sobe servidor + Vite (e serviços auxiliares, se aplicável):

```bash
composer run dev
```

### Migrations e testes

```bash
php artisan migrate
php artisan test
```

### Observações

- **Não versionar `.env`**: o repositório deve manter apenas `.env.example` (o `.env` contém segredos).
