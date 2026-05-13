# PeXECode

A browser-based memory game (pexeso) where every card reveals a PHP language construct. Match pairs to learn the PHP standard library, OOP features, modern syntax, and more — one flip at a time.

![PHP 8.x](https://img.shields.io/badge/PHP-8.3-blue)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED)
![Slim Framework](https://img.shields.io/badge/Slim-4-74c365)

---

## How it works

- A **10 × 10 grid** (100 cards, 50 pairs) is generated from a pool of **100 PHP constructs**.
- Each new game randomly selects **50 constructs**, so no two games are the same.
- Flip two cards — if they show the same construct the pair stays revealed; otherwise they flip back.
- Click the **ⓘ** button on any revealed card to read a detailed explanation, a code example with syntax highlighting, and a link to the official PHP documentation.
- The session is persisted in PostgreSQL, so refreshing the page resumes your game.

---

## Prerequisites

- [Docker](https://docs.docker.com/get-docker/) 24+
- [Docker Compose](https://docs.docker.com/compose/) v2 (included with Docker Desktop)

No local PHP or Node installation is required.

---

## Running the app

```bash
# 1. Clone the repository
git clone https://github.com/your-username/pexecode.git
cd pexecode

# 2. Build and start the three containers
docker compose up -d --build

# 3. Install PHP dependencies (first run only)
docker exec pexecode-php-1 sh -c "cd /var/www/html && composer install"

# 4. Open the game
open http://localhost:8080
```

The stack starts three containers:

| Container | Image | Role |
|---|---|---|
| `pexecode-nginx-1` | nginx:alpine | Reverse proxy / static files |
| `pexecode-php-1` | php:8.3-fpm-alpine | Application (Slim 4) |
| `pexecode-postgres-1` | postgres:16-alpine | Game state persistence |

### Stopping

```bash
docker compose down          # stop containers, keep DB volume
docker compose down -v       # stop containers and delete DB volume
```

---

## How to play

1. **Flip a card** — click any face-down card to reveal the PHP construct name.
2. **Find the pair** — click a second card. If both show the same construct they turn **green** and stay revealed, and your **PHP Constructs Found** counter increments.
3. **Miss** — if the two cards differ they flip back after a short pause. Try to remember where each construct was.
4. **Learn** — click the small **i** button on any revealed card to open a modal with:
   - The PHP version the construct was introduced in
   - A detailed explanation
   - A syntax-highlighted code example you can copy
   - A direct link to the official PHP documentation
5. **New Game** — click the **New Game** button in the header to start fresh with a new random selection of 50 constructs.

### Scoring

| Stat | Meaning |
|---|---|
| PHP Constructs Found | Matched pairs in the current game (max 50) |
| Attempts | Number of two-card flip attempts made |
| Constructs in Game | Unique PHP constructs in this session (always 50) |

---

## Project structure

```
pexecode/
├── docker-compose.yml
├── nginx/
│   └── default.conf          # Slim front-controller routing
├── php/
│   └── Dockerfile            # php:8.3-fpm + pdo_pgsql + Composer
├── postgres/
│   └── init.sql              # games table schema
└── app/
    ├── composer.json
    ├── public/
    │   ├── index.php          # Slim 4 routes
    │   └── php-logo.svg       # Card back face
    └── src/
        ├── Database.php       # PDO singleton
        ├── GameService.php    # Board generation, flip & match logic
        ├── PhpConcepts.php    # Pool of 100 PHP constructs with examples
        └── views/
            └── game.php       # Server-rendered board + JS game loop
```

---

## PHP constructs covered

The pool of 100 constructs spans:

- **Superglobals** — `$_GET`, `$_POST`, `$_SERVER`, `$_SESSION`, `$_COOKIE`, `$_FILES`, `$_ENV`, `$_REQUEST`, `$GLOBALS`
- **Array functions** — `array_map`, `array_filter`, `array_reduce`, `array_merge`, `array_slice`, `array_column`, `array_chunk`, `array_flip`, `array_combine`, `array_walk`, `array_diff`, `usort`, and more
- **String functions** — `str_contains`, `str_starts_with`, `str_ends_with`, `strpos`, `str_replace`, `substr`, `explode`, `htmlspecialchars`, `sprintf`, `preg_match`, `preg_replace`, `mb_strlen`, and more
- **OOP** — `trait`, `interface`, `abstract`, `final`, `clone`, `static`, `readonly`, `enum`, `Fiber`, anonymous classes, `__toString`, `__invoke`, Reflection API
- **Modern PHP 8.x** — `match`, `#[Attribute]`, `??`, `?->`, named arguments, union types, intersection types, constructor promotion, `never`, first-class callables
- **Utilities** — `PDO`, `DateTime`, `json_encode`, `json_decode`, `password_hash`, `random_int`, `file_get_contents`, `ob_start`, `set_error_handler`, `glob`, `range`, and more

---

## Tech stack

- **[Slim 4](https://www.slimframework.com/)** — lightweight PHP router
- **[PostgreSQL 16](https://www.postgresql.org/)** — game state storage (board layout, score, attempts)
- **[highlight.js](https://highlightjs.org/)** — client-side syntax highlighting in the detail modal
- **PHP sessions** — tie the browser to its game row without requiring login
