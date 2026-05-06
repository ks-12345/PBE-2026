# Pokédex TCG

Sistema web desenvolvido em Laravel para cadastrar, editar, listar e excluir cartas de Pokémon em estilo TCG. O projeto também possui uma tela de booster pack, que sorteia cartas cadastradas de acordo com a raridade.

## Sumário

- [Sobre o projeto](#sobre-o-projeto)
- [Tecnologias utilizadas](#tecnologias-utilizadas)
- [Funcionalidades](#funcionalidades)
- [Como executar](#como-executar)
- [Configuração do banco de dados](#configuração-do-banco-de-dados)
- [Rotas da aplicação](#rotas-da-aplicação)
- [Estrutura principal](#estrutura-principal)
- [Modelo de dados](#modelo-de-dados)
- [Fluxo das telas](#fluxo-das-telas)
- [Booster pack](#booster-pack)
- [Upload de imagens](#upload-de-imagens)
- [Comandos úteis](#comandos-úteis)
- [Possíveis melhorias](#possíveis-melhorias)

## Sobre o projeto

A Pokédex TCG é uma aplicação CRUD para gerenciamento de cartas de Pokémon. Cada Pokémon cadastrado representa uma carta com informações de identidade, tipo, estágio, HP, imagem, ataques, fraqueza, resistência, recuo, raridade, ilustrador e habilidade especial.

A tela principal exibe as cartas em formato visual inspirado em Pokémon TCG, com cores diferentes por tipo e efeitos visuais por raridade.

## Tecnologias utilizadas

- PHP 8.3 ou superior
- Laravel 13
- Blade
- Eloquent ORM
- Tailwind CSS via CDN nas views
- Vite
- Banco de dados configurável pelo arquivo `.env`
- Storage público do Laravel para imagens

## Funcionalidades

- Listagem de cartas Pokémon.
- Cadastro de nova carta.
- Edição de carta existente.
- Exclusão de carta.
- Upload de imagem da carta.
- Visual de card baseado no tipo do Pokémon.
- Efeitos visuais baseados na raridade.
- Abertura de booster pack com sorteio de cartas.
- Fallback de imagem quando a carta não possui imagem cadastrada.

## Como executar

1. Instale as dependências PHP:

```bash
composer install
```

2. Instale as dependências JavaScript:

```bash
npm install
```

3. Crie o arquivo `.env`:

```bash
copy .env.example .env
```

No Linux/macOS:

```bash
cp .env.example .env
```

4. Gere a chave da aplicação:

```bash
php artisan key:generate
```

5. Configure o banco de dados no `.env`.

6. Execute as migrations:

```bash
php artisan migrate
```

7. Crie o link simbólico para exibir imagens salvas em `storage/app/public`:

```bash
php artisan storage:link
```

8. Inicie o servidor:

```bash
php artisan serve
```

9. Acesse:

```txt
http://127.0.0.1:8000/pokemons
```

## Configuração do banco de dados

As configurações ficam no arquivo `.env`. Exemplo usando MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pokedex
DB_USERNAME=root
DB_PASSWORD=
```

Depois de configurar, rode:

```bash
php artisan migrate
```

## Rotas da aplicação

As rotas principais estão em `routes/web.php`.

| Método | Rota | Ação | Descrição |
| --- | --- | --- | --- |
| GET | `/` | view `welcome` | Página inicial padrão |
| GET | `/pokemons` | `PokemonController@index` | Lista todas as cartas |
| GET | `/pokemons/create` | `PokemonController@create` | Mostra formulário de cadastro |
| POST | `/pokemons` | `PokemonController@store` | Salva uma nova carta |
| GET | `/pokemons/{pokemon}/edit` | `PokemonController@edit` | Mostra formulário de edição |
| PUT/PATCH | `/pokemons/{pokemon}` | `PokemonController@update` | Atualiza uma carta |
| DELETE | `/pokemons/{pokemon}` | `PokemonController@destroy` | Exclui uma carta |
| GET | `/booster` | `PokemonController@booster` | Abre a tela de booster pack |

## Estrutura principal

```txt
app/
├── Http/
│   └── Controllers/
│       └── PokemonController.php
└── Models/
    └── Pokemon.php

database/
└── migrations/
    └── 2026_05_05_173501_create_pokemon_table.php

public/
└── img/
    └── pack.png

resources/
└── views/
    ├── booster.blade.php
    └── pokemons/
        ├── create.blade.php
        ├── edit.blade.php
        └── index.blade.php

routes/
└── web.php
```

## Modelo de dados

O model principal é `App\Models\Pokemon`.

Tabela usada:

```php
protected $table = 'pokemons';
```

Campos liberados para cadastro e atualização em massa:

```php
protected $fillable = [
    'nome',
    'tipo',
    'nivel',
    'estagio',
    'evolui_de',
    'hp',
    'imagem',
    'ataque1_nome',
    'ataque1_dano',
    'ataque1_descricao',
    'ataque2_nome',
    'ataque2_dano',
    'ataque2_descricao',
    'fraqueza',
    'resistencia',
    'recuo',
    'ilustrador',
    'numero_card',
    'raridade',
    'habilidade_especial',
];
```

## Campos da tabela `pokemons`

| Campo | Tipo | Descrição |
| --- | --- | --- |
| `id` | integer | Identificador da carta |
| `nome` | string | Nome do Pokémon |
| `tipo` | string | Tipo do Pokémon, como Fogo, Água, Grama etc. |
| `nivel` | integer | Nível do Pokémon |
| `estagio` | string | Básico, Estágio 1, Estágio 2, EX, GX, V ou VMAX |
| `evolui_de` | string nullable | Nome da pré-evolução |
| `hp` | integer | Pontos de vida |
| `imagem` | string nullable | Caminho da imagem salva no storage |
| `ataque1_nome` | string nullable | Nome do primeiro ataque |
| `ataque1_dano` | string nullable | Dano do primeiro ataque |
| `ataque1_descricao` | text nullable | Descrição do primeiro ataque |
| `ataque2_nome` | string nullable | Nome do segundo ataque |
| `ataque2_dano` | string nullable | Dano do segundo ataque |
| `ataque2_descricao` | text nullable | Descrição do segundo ataque |
| `fraqueza` | string nullable | Fraqueza da carta |
| `resistencia` | string nullable | Resistência da carta |
| `recuo` | string nullable | Custo de recuo |
| `ilustrador` | string nullable | Nome do ilustrador |
| `numero_card` | string nullable | Número da carta |
| `raridade` | string | Raridade da carta |
| `habilidade_especial` | text nullable | Habilidade ou regra especial |
| `created_at` | timestamp | Data de criação |
| `updated_at` | timestamp | Data da última atualização |

## Fluxo das telas

### Listagem

Arquivo:

```txt
resources/views/pokemons/index.blade.php
```

Responsável por mostrar todas as cartas cadastradas. A tela usa classes CSS personalizadas para montar cards com:

- Borda dourada.
- Gradiente baseado no tipo.
- Imagem centralizada.
- Nome, estágio e HP.
- Habilidade especial.
- Dois ataques.
- Fraqueza, resistência e recuo.
- Raridade e informações do card.
- Botões de editar e excluir.

Tipos reconhecidos na listagem:

- `fogo`
- `água` ou `agua`
- `grama`
- `elétrico` ou `eletrico`
- `psíquico` ou `psiquico`

Caso o tipo não seja reconhecido, a carta usa a classe visual `default`.

Raridades reconhecidas:

- `comum`
- `incomum`
- `rara`
- `rara holo`
- `ultra rara`
- `secreta`

### Cadastro

Arquivo:

```txt
resources/views/pokemons/create.blade.php
```

Tela com formulário para criar uma nova carta. O formulário envia os dados para:

```txt
POST /pokemons
```

O formulário possui os grupos:

- Identidade
- Ataques
- Estatísticas de batalha
- Informações do card
- Habilidade ou regra especial

### Edição

Arquivo:

```txt
resources/views/pokemons/edit.blade.php
```

Tela parecida com o cadastro, mas preenchida com os dados da carta selecionada. O formulário envia os dados para:

```txt
PUT /pokemons/{id}
```

### Booster

Arquivo:

```txt
resources/views/booster.blade.php
```

Tela visual para abrir um pacote de cartas. Ao clicar no pacote, uma animação esconde o booster e revela as cartas sorteadas.

## Controller

Arquivo:

```txt
app/Http/Controllers/PokemonController.php
```

Responsabilidades:

- `index()`: busca todos os Pokémon e envia para a listagem.
- `create()`: exibe o formulário de cadastro.
- `store(Request $request)`: salva uma nova carta e faz upload da imagem quando enviada.
- `edit(Pokemon $pokemon)`: exibe o formulário de edição.
- `update(Request $request, Pokemon $pokemon)`: atualiza os dados da carta e troca a imagem quando enviada.
- `destroy(Pokemon $pokemon)`: exclui a carta.
- `booster()`: sorteia cartas para montar um booster pack.

## Booster pack

O método `booster()` monta um pacote com até 5 cartas:

- 3 cartas comuns.
- 1 carta incomum.
- 1 carta rara ou melhor.

Raridades consideradas raras ou melhores:

```php
[
    'rara',
    'rara holo',
    'ultra rara',
    'secreta',
]
```

Se não houver carta incomum ou rara cadastrada, o sistema usa uma carta aleatória como fallback. O método também remove valores nulos antes de enviar o pacote para a view.

## Upload de imagens

No cadastro e na edição, se uma imagem for enviada, ela é salva em:

```txt
storage/app/public/pokemons
```

O caminho salvo no banco fica no campo:

```txt
imagem
```

Na exibição, a imagem é carregada com:

```php
asset('storage/'.$pokemon->imagem)
```

Para isso funcionar no navegador, rode:

```bash
php artisan storage:link
```

## Comandos úteis

Rodar o servidor local:

```bash
php artisan serve
```

Executar migrations:

```bash
php artisan migrate
```

Recriar o banco do zero:

```bash
php artisan migrate:fresh
```

Rodar testes:

```bash
php artisan test
```

Compilar assets:

```bash
npm run build
```

Rodar Vite em desenvolvimento:

```bash
npm run dev
```

## Observações importantes

- Algumas views usam Tailwind CSS por CDN.
- O projeto tem estilos CSS diretamente dentro dos arquivos Blade.
- As raridades são convertidas para minúsculas no `store()` e no `update()`.
- A aplicação ainda não possui validação formal dos campos no controller.
- A exclusão da carta não remove automaticamente a imagem antiga do storage.
- O booster depende das cartas já cadastradas no banco.

## Possíveis melhorias

- Criar validações com `$request->validate()`.
- Criar seeders com cartas iniciais.
- Padronizar a codificação dos textos em UTF-8.
- Remover imagens antigas do storage ao atualizar ou excluir cartas.
- Separar CSS em arquivos próprios dentro de `resources/css`.
- Criar componentes Blade reutilizáveis para card, botões e campos de formulário.
- Melhorar responsividade dos formulários de cadastro e edição.
- Adicionar mensagens de sucesso e erro.
- Criar testes para CRUD e booster.
- Adicionar autenticação para proteger cadastro, edição e exclusão.

## Licença

Projeto acadêmico/educacional desenvolvido com Laravel.
