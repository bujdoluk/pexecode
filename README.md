# PeXECode

A browser-based memory game (pexeso) where every card reveals a PHP language construct. Match pairs to learn the PHP standard library, OOP features, modern syntax, and more — one flip at a time.

![PHP 8.x](https://img.shields.io/badge/PHP-8.3-blue)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED)
![Slim Framework](https://img.shields.io/badge/Slim-4-74c365)

---

## How it works

- A **10 × 10 grid** (100 cards, 50 pairs) is generated from a pool of **200 PHP constructs** sourced from the official PHP documentation.
- Each new game randomly selects **50 constructs**, so no two games are the same.
- Flip two cards — if they show the same construct the pair stays revealed; otherwise they flip back.
- Click the **i** button on any revealed card to open a modal with a detailed explanation, a syntax-highlighted code example you can copy, the PHP version the construct was introduced in, and a link to the official PHP documentation.
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

1. **Flip a card** — click any face-down card (PHP logo side) to reveal the construct name.
2. **Find the pair** — click a second card. If both show the same construct they turn **green** and stay revealed, and your **PHP Constructs Found** counter increments.
3. **Miss** — if the two cards differ they flip back after a short pause. Try to remember where each construct was.
4. **Learn** — click the **i** button on any revealed card to open a detail modal with:
   - The PHP version the construct was introduced in
   - A detailed explanation
   - A syntax-highlighted code example with a **Copy** button
   - A direct link to the official PHP documentation
5. **New Game** — click the **New Game** button in the header to start fresh with a new random selection of 50 constructs from the full pool of 200.

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
│   └── default.conf              # Slim front-controller routing
├── php/
│   └── Dockerfile                # php:8.3-fpm + pdo_pgsql + Composer
├── postgres/
│   └── init.sql                  # games table schema
└── app/
    ├── composer.json
    ├── public/
    │   ├── index.php              # Slim 4 routes
    │   └── php-logo.svg           # Card back face
    └── src/
        ├── Database.php           # PDO singleton
        ├── GameService.php        # Board generation, flip & match logic
        ├── PhpConcepts.php        # Core pool: 100 constructs (IDs 1–100)
        ├── PhpConceptsExtended.php # Extended pool: 100 constructs (IDs 101–200)
        └── views/
            └── game.php           # Server-rendered board + JS game loop
```

---

## PHP constructs covered

The pool of **200 constructs** is sourced from the official PHP documentation and spans:

- **Superglobals** — `$_GET`, `$_POST`, `$_SERVER`, `$_SESSION`, `$_COOKIE`, `$_FILES`, `$_ENV`, `$_REQUEST`, `$GLOBALS`, `$argc`, `$argv`
- **Control structures** — `if/else`, `for`, `foreach`, `while/do-while`, `switch`, `break/continue`, `return`, `declare`, `require/include`
- **OOP** — `class`, `extends`, `instanceof`, visibility modifiers, `__construct`, `__get/__set`, `__call`, `__clone`, `__sleep/__wakeup`, `__toString`, `__invoke`, `__debugInfo`, late static binding, `trait`, `interface`, `abstract`, `final`, `clone`, `static`, `readonly`, `enum`, `Fiber`, anonymous classes, `#[Attribute]`, Reflection API
- **Array functions** — `array_map`, `array_filter`, `array_reduce`, `array_merge`, `array_slice`, `array_column`, `array_chunk`, `array_flip`, `array_combine`, `array_walk`, `array_diff`, `array_push`, `array_splice`, `array_reverse`, `array_sum`, `array_count_values`, `array_key_exists`, `sort/usort`, and more
- **String functions** — `strlen`, `strpos`, `str_replace`, `substr`, `explode`, `implode`, `trim`, `strtolower/upper`, `ucfirst/ucwords`, `str_contains`, `str_starts_with`, `str_ends_with`, `str_repeat`, `strrev`, `strcmp`, `strip_tags`, `nl2br`, `wordwrap`, `htmlspecialchars`, `htmlentities`, `strtr`, `stripos`, `strtok`, `sprintf`, `printf`, `str_rot13`, `chunk_split`, `levenshtein`, and more
- **Regex** — `preg_match`, `preg_match_all`, `preg_replace`, `preg_replace_callback`, `preg_split`, `preg_quote`
- **Math** — `abs`, `round`, `ceil`, `floor`, `min`, `max`, `pow`, `sqrt`, `log`, `pi`, `sin/cos/tan`, `fmod`, `fdiv`, `intdiv`, `random_int`, `base_convert`, `dechex`, and more
- **Date & time** — `date`, `strtotime`, `time`, `mktime`, `checkdate`, `DateTime`, `DateTimeImmutable`
- **File system** — `file_get_contents`, `file_put_contents`, `file`, `fopen/fread/fwrite/fclose`, `fgetcsv/fputcsv`, `fseek/ftell/rewind`, `flock`, `copy`, `rename`, `unlink`, `mkdir`, `rmdir`, `realpath`, `glob`, `move_uploaded_file`, `filesize`, `filemtime`, `dirname`, `basename`, `pathinfo`, `parse_ini_file`, and more
- **Modern PHP 8.x** — `match`, `??`, `?->`, named arguments, union types, intersection types, constructor promotion, `never`, first-class callables, `json_validate` (8.3)
- **Security** — `password_hash`, `password_verify`, `hash`, `hash_hmac`, `hash_equals`, `random_bytes`, `random_int`
- **Sessions** — `session_start`, `session_destroy`, `session_regenerate_id`, `session_id`, `session_write_close`
- **Error handling** — `set_error_handler`, `set_exception_handler`, `error_reporting`, `error_log`, `trigger_error`, `debug_backtrace`
- **Type & variable** — `isset`, `unset`, `empty`, `var_dump`, `serialize/unserialize`, `is_array/string/int/…`, `gettype`, `get_debug_type`, `settype`
- **Encoding** — `json_encode`, `json_decode`, `base64_encode`, `urlencode`, `http_build_query`, `parse_url`, `parse_str`, `bin2hex`, `ord/chr`, `crc32`, `md5`, `sha1`

---

## Tech stack

- **[Slim 4](https://www.slimframework.com/)** — lightweight PHP router
- **[PostgreSQL 16](https://www.postgresql.org/)** — game state storage (board layout, score, attempts)
- **[highlight.js](https://highlightjs.org/)** — client-side syntax highlighting in the detail modal
- **PHP sessions** — tie the browser to its game row without requiring login

---

## Claude Code

This project was built with [Claude Code](https://claude.ai/code). The `.claude/settings.json` file is committed so all contributors share the same Claude Code configuration. The `.claude/settings.local.json` file is gitignored — use it for personal overrides.
