<?php

namespace App;

class PhpConcepts
{
    private static function versions(): array
    {
        return [
             1 => 'PHP 4.1',  //  $_GET
             2 => 'PHP 4.1',  //  $_POST
             3 => 'PHP 4.1',  //  $_SERVER
             4 => 'PHP 4.1',  //  $_SESSION
             5 => 'PHP 4.1',  //  $_COOKIE
             6 => 'PHP 4.1',  //  $_FILES
             7 => 'PHP 4.1',  //  $_ENV
             8 => 'PHP 4.1',  //  $_REQUEST
             9 => 'PHP 3.0',  //  $GLOBALS
            10 => 'PHP 4.0',  //  array_map
            11 => 'PHP 4.0',  //  array_filter
            12 => 'PHP 4.0',  //  array_reduce
            13 => 'PHP 4.0',  //  array_merge
            14 => 'PHP 4.0',  //  array_slice
            15 => 'PHP 4.0',  //  array_search
            16 => 'PHP 4.0',  //  array_unique
            17 => 'PHP 4.0',  //  array_keys
            18 => 'PHP 4.0',  //  array_values
            19 => 'PHP 4.0',  //  usort
            20 => 'PHP 5.1',  //  PDO
            21 => 'PHP 5.4',  //  trait
            22 => 'PHP 5.0',  //  interface
            23 => 'PHP 5.0',  //  abstract
            24 => 'PHP 5.5',  //  yield / Generators
            25 => 'PHP 5.3',  //  Closure
            26 => 'PHP 5.0',  //  try/catch
            27 => 'PHP 5.3',  //  namespace
            28 => 'PHP 8.0',  //  match
            29 => 'PHP 8.1',  //  Fiber
            30 => 'PHP 8.1',  //  enum
            31 => 'PHP 8.1',  //  readonly
            32 => 'PHP 8.0',  //  #[Attribute]
            33 => 'PHP 7.0',  //  ?? operator
            34 => 'PHP 8.0',  //  ?-> nullsafe
            35 => 'PHP 5.6',  //  spread ...
            36 => 'PHP 8.0',  //  named arguments
            37 => 'PHP 8.0',  //  union types
            38 => 'PHP 8.0',  //  constructor promotion
            39 => 'PHP 8.0',  //  str_contains
            40 => 'PHP 8.0',  //  str_starts_with
            41 => 'PHP 8.0',  //  str_ends_with
            42 => 'PHP 3.0',  //  sprintf
            43 => 'PHP 3.0',  //  preg_match
            44 => 'PHP 5.2',  //  json_encode
            45 => 'PHP 5.2',  //  json_decode
            46 => 'PHP 3.0',  //  header
            47 => 'PHP 3.0',  //  date
            48 => 'PHP 3.0',  //  strtotime
            49 => 'PHP 5.0',  //  static
            50 => 'PHP 5.0',  //  Reflection API
            51 => 'PHP 4.0',  //  array_pop
            52 => 'PHP 4.0',  //  array_shift
            53 => 'PHP 4.0',  //  array_flip
            54 => 'PHP 4.2',  //  array_chunk
            55 => 'PHP 5.0',  //  array_combine
            56 => 'PHP 5.5',  //  array_column
            57 => 'PHP 4.0',  //  in_array
            58 => 'PHP 3.0',  //  count
            59 => 'PHP 4.0',  //  compact
            60 => 'PHP 3.0',  //  list / []
            61 => 'PHP 3.0',  //  strlen
            62 => 'PHP 3.0',  //  strpos
            63 => 'PHP 3.0',  //  str_replace
            64 => 'PHP 3.0',  //  substr
            65 => 'PHP 3.0',  //  strtolower
            66 => 'PHP 3.0',  //  trim
            67 => 'PHP 3.0',  //  explode
            68 => 'PHP 4.0',  //  htmlspecialchars
            69 => 'PHP 3.0',  //  number_format
            70 => 'PHP 3.0',  //  round
            71 => 'PHP 7.0',  //  random_int
            72 => 'PHP 5.1',  //  DateTime
            73 => 'PHP 4.3',  //  file_get_contents
            74 => 'PHP 3.0',  //  intval
            75 => 'PHP 3.0',  //  gettype
            76 => 'PHP 5.0',  //  final
            77 => 'PHP 5.0',  //  clone
            78 => 'PHP 5.0',  //  __toString
            79 => 'PHP 5.3',  //  __invoke
            80 => 'PHP 7.0',  //  anonymous class
            81 => 'PHP 8.1',  //  first-class callable
            82 => 'PHP 8.1',  //  never type
            83 => 'PHP 8.1',  //  intersection types
            84 => 'PHP 4.0',  //  ob_start
            85 => 'PHP 4.0',  //  mb_strlen
            86 => 'PHP 3.0',  //  base64_encode
            87 => 'PHP 7.0',  //  intdiv
            88 => 'PHP 4.0',  //  is_numeric
            89 => 'PHP 4.2',  //  array_fill
            90 => 'PHP 5.0',  //  str_split
            91 => 'PHP 4.0',  //  array_walk
            92 => 'PHP 4.0',  //  set_error_handler
            93 => 'PHP 4.0',  //  str_pad
            94 => 'PHP 4.0',  //  glob
            95 => 'PHP 4.0',  //  microtime
            96 => 'PHP 4.0',  //  array_diff
            97 => 'PHP 5.5',  //  password_hash
            98 => 'PHP 4.0',  //  array_map null zip
            99 => 'PHP 3.0',  //  preg_replace
           100 => 'PHP 3.0',  //  range
        ];
    }

    public static function getAll(): array
    {
        $versions = self::versions();
        $concepts = [
            [
                'id' => 1,
                'short' => '$_GET',
                'detail' => '$_GET is a PHP superglobal associative array that contains key-value pairs sent to the script via URL query parameters. It is populated automatically by PHP from the query string part of the URL (everything after the ?). Values are always strings. Never use $_GET data directly in SQL queries or HTML output without sanitization — use htmlspecialchars() for output and prepared statements for DB queries.',
                'code' => '// URL: https://example.com/search?query=php&page=2

$query = $_GET["query"] ?? "";       // "php"
$page  = (int)($_GET["page"] ?? 1);  // 2

// Safe output — always escape before printing
echo "Search: " . htmlspecialchars($query);
echo "Page: " . $page;

// Check if key exists first
if (isset($_GET["sort"])) {
    $sort = in_array($_GET["sort"], ["asc","desc"])
        ? $_GET["sort"]
        : "asc";
}',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.get.php',
            ],
            [
                'id' => 2,
                'short' => '$_POST',
                'detail' => '$_POST is a superglobal array containing data submitted via HTTP POST requests, typically from HTML forms with method="post". Unlike $_GET, POST data is not visible in the URL. It is still not inherently safe — always validate and sanitize input. Use filter_input() or htmlspecialchars() before output, and prepared statements before database use.',
                'code' => '// HTML: <form method="post" action="/login">
//   <input name="email"> <input name="password" type="password">
// </form>

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"] ?? "";

    if ($email === false || $email === null) {
        echo "Invalid email address";
    } else {
        // $email is now a validated email string
        echo "Welcome, " . htmlspecialchars($email);
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.post.php',
            ],
            [
                'id' => 3,
                'short' => '$_SERVER',
                'detail' => '$_SERVER is a superglobal array containing information about the server environment and the current HTTP request. It is populated by the web server (Apache, Nginx, etc.). Common keys include REQUEST_METHOD, HTTP_HOST, REQUEST_URI, REMOTE_ADDR, HTTP_USER_AGENT, SCRIPT_FILENAME, and many more. Some values can be spoofed by the client — treat HTTP_* keys with caution.',
                'code' => '// Request info
$method = $_SERVER["REQUEST_METHOD"];   // "GET" or "POST"
$uri    = $_SERVER["REQUEST_URI"];      // "/search?q=php"
$host   = $_SERVER["HTTP_HOST"];        // "example.com"
$ip     = $_SERVER["REMOTE_ADDR"];      // "192.168.1.1"
$agent  = $_SERVER["HTTP_USER_AGENT"];  // browser string

// Detect HTTPS
$isHttps = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off")
        || $_SERVER["SERVER_PORT"] == 443;

// Get current script directory
$dir = dirname($_SERVER["SCRIPT_FILENAME"]);

echo $isHttps ? "Secure connection" : "Insecure connection";',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.server.php',
            ],
            [
                'id' => 4,
                'short' => '$_SESSION',
                'detail' => '$_SESSION is a superglobal that stores user-specific data across multiple HTTP requests. PHP manages a session ID cookie on the client side and stores the actual data server-side. You must call session_start() before accessing $_SESSION on every page. Sessions expire after a configurable timeout. Always regenerate the session ID after login to prevent session fixation attacks.',
                'code' => '<?php
session_start(); // Must be called before any output

// Store data
$_SESSION["user_id"]   = 42;
$_SESSION["username"]  = "alice";
$_SESSION["logged_in"] = true;

// Read data
if ($_SESSION["logged_in"] ?? false) {
    echo "Hello, " . htmlspecialchars($_SESSION["username"]);
}

// Regenerate ID after login (prevent session fixation)
session_regenerate_id(true);

// Delete a single key
unset($_SESSION["temp_data"]);

// Destroy entire session on logout
session_unset();
session_destroy();',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.session.php',
            ],
            [
                'id' => 5,
                'short' => '$_COOKIE',
                'detail' => '$_COOKIE holds cookies sent by the browser in the current request. Cookies are set with the setcookie() function and persist across requests until they expire. Because cookies are sent by the client, they must never be trusted without validation. Use the HttpOnly and Secure flags for sensitive cookies. Cookie values are limited to strings.',
                'code' => '// Set a cookie (must be before any output)
setcookie(
    name:     "theme",
    value:    "dark",
    expires:  time() + (86400 * 30),  // 30 days
    path:     "/",
    domain:   "example.com",
    secure:   true,    // HTTPS only
    httponly: true     // Not accessible via JS
);

// Read a cookie (available on the NEXT request)
$theme = $_COOKIE["theme"] ?? "light";
echo "Current theme: " . htmlspecialchars($theme);

// Delete a cookie by setting past expiry
setcookie("theme", "", time() - 3600, "/");',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.cookies.php',
            ],
            [
                'id' => 6,
                'short' => '$_FILES',
                'detail' => '$_FILES is populated when a form with enctype="multipart/form-data" and a file input is submitted. Each file entry contains: name (original filename), type (MIME type claimed by browser — not reliable), size (in bytes), tmp_name (server temp path), and error (error code). Always validate file type by checking the actual content (finfo), check file size, and use move_uploaded_file() to move the file safely.',
                'code' => '// HTML: <form enctype="multipart/form-data" method="post">
//   <input type="file" name="avatar">
// </form>

if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] === UPLOAD_ERR_OK) {
    $file     = $_FILES["avatar"];
    $maxSize  = 2 * 1024 * 1024; // 2 MB

    // Validate size
    if ($file["size"] > $maxSize) {
        die("File too large");
    }

    // Validate MIME type using finfo (not the browser claim)
    $finfo    = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file["tmp_name"]);
    $allowed  = ["image/jpeg", "image/png", "image/gif"];

    if (!in_array($mimeType, $allowed)) {
        die("Invalid file type");
    }

    $dest = "/uploads/" . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $dest);
    echo "Uploaded successfully";
}',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.files.php',
            ],
            [
                'id' => 7,
                'short' => '$_ENV',
                'detail' => '$_ENV contains environment variables passed to the PHP process from the server OS or shell. It is commonly used to read configuration and secrets (database passwords, API keys) without hardcoding them in source code — a key principle of the 12-factor app methodology. Note: availability depends on php.ini variables_order setting. getenv() is a safer alternative that works regardless.',
                'code' => '// .env file (loaded by a library like vlucas/phpdotenv)
// DB_HOST=localhost
// DB_PASS=supersecret
// APP_ENV=production

// Read via $_ENV (requires "E" in variables_order)
$host = $_ENV["DB_HOST"] ?? "localhost";

// getenv() works even without $_ENV populated
$pass = getenv("DB_PASS") ?: throw new RuntimeException("DB_PASS not set");

// putenv() sets a variable for the current process
putenv("CACHE_TTL=3600");
$ttl = (int) getenv("CACHE_TTL"); // 3600

$env = $_ENV["APP_ENV"] ?? "development";
if ($env === "production") {
    ini_set("display_errors", "0");
}',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.environment.php',
            ],
            [
                'id' => 8,
                'short' => '$_REQUEST',
                'detail' => '$_REQUEST is a superglobal that merges $_GET, $_POST, and $_COOKIE into one array, based on the order defined in the php.ini "request_order" directive. It is convenient for scripts that accept parameters from multiple sources, but it is considered bad practice in modern code because it obscures the data source, making the code harder to reason about and audit for security.',
                'code' => '// Accepts "id" from GET, POST, or cookie
$id = (int)($_REQUEST["id"] ?? 0);

// The above is equivalent to:
$id = (int)($_POST["id"] ?? $_GET["id"] ?? $_COOKIE["id"] ?? 0);

// Why explicit is better — each source has different trust level:
$fromUrl    = $_GET["q"]    ?? "";  // Shared/bookmarkable
$fromForm   = $_POST["q"]  ?? "";  // User submitted
$fromCookie = $_COOKIE["q"] ?? ""; // Persisted preference

// Prefer explicit superglobals over $_REQUEST in new code
echo htmlspecialchars($fromUrl);',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.request.php',
            ],
            [
                'id' => 9,
                'short' => '$GLOBALS',
                'detail' => '$GLOBALS is a superglobal associative array that references all variables currently defined in the global scope. $GLOBALS["x"] is equivalent to using $x at the global level. It can be used inside functions to access global variables without the global keyword. Overuse leads to tight coupling and unpredictable state — prefer passing dependencies explicitly or using dependency injection.',
                'code' => '$counter = 0;
$config  = ["debug" => true];

function increment(): void {
    // Without $GLOBALS you would need: global $counter;
    $GLOBALS["counter"]++;
}

increment();
increment();
echo $GLOBALS["counter"]; // 2

// Reading nested global
function isDebug(): bool {
    return (bool)($GLOBALS["config"]["debug"] ?? false);
}

// Better alternative — pass as argument
function incrementBy(int &$counter, int $by = 1): void {
    $counter += $by;
}',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.globals.php',
            ],
            [
                'id' => 10,
                'short' => 'array_map()',
                'detail' => 'array_map() applies a callback function to each element of one or more arrays and returns a new array of results. The original array is not modified. When passed multiple arrays, the callback receives one element from each array per call. Passing null as the callback with multiple arrays zips them together. It is the functional-programming "map" operation in PHP.',
                'code' => '$numbers = [1, 2, 3, 4, 5];

// Double every element
$doubled = array_map(fn($n) => $n * 2, $numbers);
// [2, 4, 6, 8, 10]

// Convert to strings
$strings = array_map("strval", $numbers);
// ["1", "2", "3", "4", "5"]

// Multiple arrays — callback gets one item from each
$a = [1, 2, 3];
$b = [10, 20, 30];
$sums = array_map(fn($x, $y) => $x + $y, $a, $b);
// [11, 22, 33]

// Zip with null callback
$zipped = array_map(null, $a, $b);
// [[1,10], [2,20], [3,30]]

// Keys are NOT preserved for numeric arrays
$upper = array_map("strtoupper", ["hello", "world"]);
// ["HELLO", "WORLD"]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-map.php',
            ],
            [
                'id' => 11,
                'short' => 'array_filter()',
                'detail' => 'array_filter() iterates over an array and returns a new array containing only the elements for which the callback returns true. The array keys are preserved, which often means you need array_values() afterwards to re-index. Without a callback, it removes all "falsy" values (0, false, null, "", "0", []). The ARRAY_FILTER_USE_KEY and ARRAY_FILTER_USE_BOTH flags let the callback receive the key or both key and value.',
                'code' => '$numbers = [0, 1, 2, 3, 4, 5, 6];

// Keep only even numbers
$evens = array_filter($numbers, fn($n) => $n % 2 === 0);
// Keys preserved: [0=>0, 2=>2, 4=>4, 6=>6]

// Re-index after filtering
$evens = array_values($evens);
// [0, 2, 4, 6]

// Remove all falsy values (no callback)
$clean = array_filter([0, 1, false, "hello", null, "", []]);
// [1 => 1, 3 => "hello"]

// Filter by key
$data = ["id" => 1, "name" => "Ana", "_token" => "xyz"];
$public = array_filter(
    $data,
    fn($key) => !str_starts_with($key, "_"),
    ARRAY_FILTER_USE_KEY
);
// ["id" => 1, "name" => "Ana"]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-filter.php',
            ],
            [
                'id' => 12,
                'short' => 'array_reduce()',
                'detail' => 'array_reduce() iteratively reduces an array to a single value by applying a callback to a running "carry" (accumulator) and the current element. The third argument sets the initial value of the carry. It is the functional "fold/reduce" operation. Unlike array_map and array_filter, array_reduce can produce any type — int, string, array, or object.',
                'code' => '$numbers = [1, 2, 3, 4, 5];

// Sum
$sum = array_reduce($numbers, fn($carry, $item) => $carry + $item, 0);
// 15

// Product
$product = array_reduce($numbers, fn($carry, $item) => $carry * $item, 1);
// 120

// Build a string
$sentence = array_reduce(
    ["PHP", "is", "great"],
    fn($carry, $word) => $carry . " " . $word,
    ""
);
// " PHP is great"

// Group items into a new array
$words = ["apple","ant","banana","bear","cherry"];
$grouped = array_reduce($words, function($carry, $word) {
    $carry[$word[0]][] = $word;
    return $carry;
}, []);
// ["a"=>["apple","ant"], "b"=>["banana","bear"], "c"=>["cherry"]]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-reduce.php',
            ],
            [
                'id' => 13,
                'short' => 'array_merge()',
                'detail' => 'array_merge() merges one or more arrays into a single array. String keys from later arrays overwrite earlier ones. Numeric keys are always re-indexed starting from 0 regardless of original indices. To preserve numeric keys, use the union operator ($a + $b) instead. array_merge() with no arguments returns an empty array. The spread operator [...$a, ...$b] is a modern equivalent.',
                'code' => '$defaults = ["color" => "blue", "size" => "medium", "weight" => 1.0];
$custom   = ["color" => "red", "size" => "large"];

// String keys: later values win
$merged = array_merge($defaults, $custom);
// ["color"=>"red", "size"=>"large", "weight"=>1.0]

// Numeric keys are re-indexed
$a = [0 => "x", 5 => "y"];
$b = [0 => "z"];
$merged = array_merge($a, $b);
// [0=>"x", 1=>"y", 2=>"z"]  ← keys reset

// Union operator preserves numeric keys (first value wins)
$union = $a + $b;
// [0=>"x", 5=>"y"]  ← original keys kept, $b[0] ignored

// Spread — PHP 8.1+ supports string keys too
$result = [...$defaults, ...$custom];
// same as array_merge for string keys',
                'doc_url' => 'https://www.php.net/manual/en/function.array-merge.php',
            ],
            [
                'id' => 14,
                'short' => 'array_slice()',
                'detail' => 'array_slice() extracts a sub-section of an array without modifying the original. The offset can be negative (counts from the end). Length can also be negative (stops that many from the end). The fourth argument preserve_keys defaults to false for indexed arrays (re-indexes from 0) but always preserves string keys. Useful for pagination, chunking, and trimming arrays.',
                'code' => '$items = ["a", "b", "c", "d", "e"];

// Get 3 elements starting at index 1
$slice = array_slice($items, 1, 3);
// ["b", "c", "d"]

// Negative offset — from the end
$last2 = array_slice($items, -2);
// ["d", "e"]

// Negative length — stop 1 before the end
$inner = array_slice($items, 1, -1);
// ["b", "c", "d"]

// Preserve original keys
$withKeys = array_slice($items, 2, 2, true);
// [2=>"c", 3=>"d"]

// Pagination: page 2, 10 items per page
$page    = 2;
$perPage = 10;
$results = array_slice($allItems, ($page - 1) * $perPage, $perPage);',
                'doc_url' => 'https://www.php.net/manual/en/function.array-slice.php',
            ],
            [
                'id' => 15,
                'short' => 'array_search()',
                'detail' => 'array_search() searches for a given value in an array and returns its corresponding key on success, or false if not found. By default it uses loose (==) comparison; pass true as the third argument for strict (===) comparison. Because it can return 0 (a valid key), always use === false to check for failure — using == false would also match a key of 0.',
                'code' => '$fruits = ["apple", "banana", "cherry", "banana"];

// Find first occurrence, returns key
$key = array_search("banana", $fruits);
// 1

// Not found — returns false
$key = array_search("grape", $fruits);
// false

// IMPORTANT: check with === not ==
if ($key !== false) {
    echo "Found at index $key";
}

// Strict mode — types must match
$mixed = [0, "0", false, null, ""];
var_dump(array_search("0", $mixed));        // int(1) loose
var_dump(array_search("0", $mixed, true));  // int(1) strict

// Find key in assoc array
$roles = ["alice" => "admin", "bob" => "editor", "carol" => "admin"];
$adminUser = array_search("admin", $roles);
// "alice" (first match only)

// Find ALL occurrences — use array_keys with search value
$allAdmins = array_keys($roles, "admin");
// ["alice", "carol"]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-search.php',
            ],
            [
                'id' => 16,
                'short' => 'array_unique()',
                'detail' => 'array_unique() removes duplicate values from an array and returns a new array with unique values. Keys from the first occurrence are preserved; subsequent duplicates are discarded. By default uses string comparison (SORT_STRING); other flags: SORT_NUMERIC, SORT_REGULAR, SORT_LOCALE_STRING. Note: it only works on a single dimension — use a custom loop or array_map + serialize for multidimensional deduplication.',
                'code' => '$colors = ["red", "blue", "red", "green", "blue", "red"];

$unique = array_unique($colors);
// [0=>"red", 1=>"blue", 3=>"green"]  ← first occurrence keys kept

// Re-index after dedup
$unique = array_values(array_unique($colors));
// ["red", "blue", "green"]

// Works with mixed types (uses string comparison by default)
$mixed = [1, "1", true, 1.0, "1"];
$deduped = array_unique($mixed);
// [0 => 1]  ← all stringify to "1"

// SORT_REGULAR for type-aware comparison
$deduped = array_unique($mixed, SORT_REGULAR);
// [0 => 1, 1 => "1"]  ← int 1 and string "1" treated differently

// Deduplicate objects/arrays — serialize trick
$records = [["id"=>1],["id"=>2],["id"=>1]];
$unique  = array_unique(array_map("serialize", $records));
$unique  = array_map("unserialize", $unique);',
                'doc_url' => 'https://www.php.net/manual/en/function.array-unique.php',
            ],
            [
                'id' => 17,
                'short' => 'array_keys()',
                'detail' => 'array_keys() returns all the keys of an array as a new indexed array. It can also be used with a search value to return only the keys that hold that value — similar to array_search() but returns ALL matching keys, not just the first. An optional strict parameter controls loose vs strict comparison. Commonly used to get integer indices, verify key existence, or invert a lookup.',
                'code' => '$person = ["name" => "Ana", "age" => 30, "city" => "Prague"];

// All keys
$keys = array_keys($person);
// ["name", "age", "city"]

// Keys of a numeric array
$keys = array_keys(["a", "b", "c"]);
// [0, 1, 2]

// Search: get all keys holding a specific value
$grades = ["Alice"=>"A", "Bob"=>"B", "Carol"=>"A", "Dave"=>"B"];
$aStudents = array_keys($grades, "A");
// ["Alice", "Carol"]

// Strict search — types must match
$mixed = ["a"=>1, "b"=>"1", "c"=>true];
array_keys($mixed, 1);        // ["a","b","c"]  loose
array_keys($mixed, 1, true);  // ["a"]          strict

// Check if key exists (isset is faster, but array_key_exists handles null values)
$exists = in_array("age", array_keys($person)); // true
// Better:
$exists = array_key_exists("age", $person);     // true',
                'doc_url' => 'https://www.php.net/manual/en/function.array-keys.php',
            ],
            [
                'id' => 18,
                'short' => 'array_values()',
                'detail' => 'array_values() returns all values of an array re-indexed with consecutive integer keys starting at 0. It is most commonly used after array_filter() or array_slice() with preserve_keys to reset the index, or after unset() to compact a sparse array. It does NOT recurse into nested arrays. For associative arrays it effectively strips all keys.',
                'code' => '$data = ["first" => "apple", "second" => "banana", "third" => "cherry"];

// Strip keys — returns [0=>"apple", 1=>"banana", 2=>"cherry"]
$indexed = array_values($data);

// Reset index after filtering (filter preserves keys)
$numbers = [1, 2, 3, 4, 5, 6];
$evens   = array_filter($numbers, fn($n) => $n % 2 === 0);
// [1=>2, 3=>4, 5=>6]  ← gaps in index

$evens = array_values($evens);
// [0=>2, 1=>4, 2=>6]  ← clean index

// Reset index after unset
$items = ["a", "b", "c", "d"];
unset($items[1]);
// [0=>"a", 2=>"c", 3=>"d"]  ← sparse

$items = array_values($items);
// [0=>"a", 1=>"c", 2=>"d"]  ← compact

// Also useful after array_unique
$clean = array_values(array_unique($someArray));',
                'doc_url' => 'https://www.php.net/manual/en/function.array-values.php',
            ],
            [
                'id' => 19,
                'short' => 'usort()',
                'detail' => 'usort() sorts an array in-place using a user-supplied comparison function. The callback must return a negative integer, zero, or a positive integer depending on whether the first argument is less than, equal to, or greater than the second. PHP 7+ provides the spaceship operator (<=>) which is perfect for this. Related: uasort() preserves keys; uksort() sorts by keys.',
                'code' => '$people = [
    ["name" => "Charlie", "age" => 30],
    ["name" => "Alice",   "age" => 25],
    ["name" => "Bob",     "age" => 35],
];

// Sort by age ascending (spaceship operator)
usort($people, fn($a, $b) => $a["age"] <=> $b["age"]);
// Alice(25), Charlie(30), Bob(35)

// Sort by name alphabetically
usort($people, fn($a, $b) => strcmp($a["name"], $b["name"]));
// Alice, Bob, Charlie

// Sort descending — flip operands
usort($people, fn($a, $b) => $b["age"] <=> $a["age"]);
// Bob(35), Charlie(30), Alice(25)

// Multi-level sort: age, then name
usort($people, function($a, $b) {
    return $a["age"] <=> $b["age"]
        ?: strcmp($a["name"], $b["name"]);
});

// uasort — sorts but preserves keys
$scores = ["bob" => 80, "alice" => 95, "carol" => 80];
uasort($scores, fn($a, $b) => $b <=> $a);
// alice=>95, bob=>80, carol=>80  (keys preserved)',
                'doc_url' => 'https://www.php.net/manual/en/function.usort.php',
            ],
            [
                'id' => 20,
                'short' => 'PDO',
                'detail' => 'PDO (PHP Data Objects) is a database abstraction layer providing a consistent interface for multiple database engines (MySQL, PostgreSQL, SQLite, etc.). The most important feature is prepared statements, which separate SQL code from data, completely preventing SQL injection. Always set PDO::ATTR_ERRMODE to PDO::ERRMODE_EXCEPTION so errors throw catchable exceptions instead of silent failures.',
                'code' => '// Connect
$pdo = new PDO(
    "pgsql:host=localhost;dbname=myapp",
    "user",
    "password",
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
);

// Prepared statement — prevents SQL injection
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(["email" => $email]);
$user = $stmt->fetch();

// Insert with named placeholders
$stmt = $pdo->prepare(
    "INSERT INTO posts (title, body, author_id) VALUES (:title, :body, :author)"
);
$stmt->execute(["title" => $title, "body" => $body, "author" => $userId]);
$newId = $pdo->lastInsertId();

// Fetch all rows
$stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name");
$categories = $stmt->fetchAll();

// Transaction
$pdo->beginTransaction();
try {
    $pdo->exec("UPDATE accounts SET balance = balance - 100 WHERE id = 1");
    $pdo->exec("UPDATE accounts SET balance = balance + 100 WHERE id = 2");
    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    throw $e;
}',
                'doc_url' => 'https://www.php.net/manual/en/book.pdo.php',
            ],
            [
                'id' => 21,
                'short' => 'trait',
                'detail' => 'A trait is a mechanism for code reuse in single-inheritance languages. Traits let you include methods (and properties) into multiple unrelated classes without inheritance. A class can use multiple traits. Trait methods have lower precedence than the class itself but higher than parent class methods. Conflicts between traits must be resolved explicitly with insteadof and as operators.',
                'code' => 'trait Timestampable {
    private ?DateTime $createdAt = null;
    private ?DateTime $updatedAt = null;

    public function touch(): void {
        $now = new DateTime();
        if ($this->createdAt === null) {
            $this->createdAt = $now;
        }
        $this->updatedAt = $now;
    }

    public function getUpdatedAt(): ?DateTime {
        return $this->updatedAt;
    }
}

trait SoftDeletable {
    private ?DateTime $deletedAt = null;

    public function softDelete(): void {
        $this->deletedAt = new DateTime();
    }

    public function isDeleted(): bool {
        return $this->deletedAt !== null;
    }
}

class Post {
    use Timestampable, SoftDeletable; // Use multiple traits

    public function __construct(public string $title) {
        $this->touch();
    }
}

$post = new Post("Hello World");
$post->softDelete();
echo $post->isDeleted() ? "deleted" : "active"; // "deleted"',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.traits.php',
            ],
            [
                'id' => 22,
                'short' => 'interface',
                'detail' => 'An interface defines a contract — a set of method signatures that implementing classes must provide. Interfaces cannot contain implemented methods (except constants and, since PHP 8.0, abstract methods in interface). A class can implement multiple interfaces, unlike inheritance which is single. Interfaces enable polymorphism and are the foundation of dependency inversion (program to abstractions, not concretions).',
                'code' => 'interface Serializable {
    public function serialize(): string;
    public function unserialize(string $data): void;
}

interface Cacheable {
    public function getCacheKey(): string;
    public function getTtl(): int;
}

// A class can implement multiple interfaces
class UserProfile implements Serializable, Cacheable {
    public function __construct(
        private int $id,
        private string $name
    ) {}

    public function serialize(): string {
        return json_encode(["id" => $this->id, "name" => $this->name]);
    }

    public function unserialize(string $data): void {
        $obj = json_decode($data, true);
        $this->id   = $obj["id"];
        $this->name = $obj["name"];
    }

    public function getCacheKey(): string { return "user:{$this->id}"; }
    public function getTtl(): int         { return 3600; }
}

// Type hint against interface — accepts any implementing class
function saveToCache(Cacheable $item, string $data): void {
    $key = $item->getCacheKey(); // Works for any Cacheable
    $ttl = $item->getTtl();
    // cache_set($key, $data, $ttl);
}',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.interfaces.php',
            ],
            [
                'id' => 23,
                'short' => 'abstract',
                'detail' => 'An abstract class is a class that cannot be instantiated on its own. It can contain abstract methods — method signatures with no body — that all concrete subclasses must implement. Abstract classes can also contain fully implemented methods and properties. They are used to define a common template with shared behavior while enforcing specific methods in subclasses.',
                'code' => 'abstract class Shape {
    // Concrete method — shared implementation
    public function describe(): string {
        return sprintf(
            "I am a %s with area %.2f",
            static::class,
            $this->area()
        );
    }

    // Abstract method — subclasses MUST implement
    abstract public function area(): float;
    abstract public function perimeter(): float;
}

class Circle extends Shape {
    public function __construct(private float $radius) {}

    public function area(): float {
        return M_PI * $this->radius ** 2;
    }

    public function perimeter(): float {
        return 2 * M_PI * $this->radius;
    }
}

class Rectangle extends Shape {
    public function __construct(
        private float $width,
        private float $height
    ) {}

    public function area(): float      { return $this->width * $this->height; }
    public function perimeter(): float { return 2 * ($this->width + $this->height); }
}

// new Shape();  // Fatal error — cannot instantiate abstract class
$c = new Circle(5);
echo $c->describe(); // "I am a Circle with area 78.54"',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.abstract.php',
            ],
            [
                'id' => 24,
                'short' => 'yield',
                'detail' => 'The yield keyword turns a function into a Generator — a form of lazy iterator. Instead of building and returning the whole collection at once, a generator produces one value at a time, suspending execution between yields. This makes generators highly memory-efficient for large datasets. yield can also send values back into the generator via $gen->send($value).',
                'code' => '// Without generator — loads ALL lines into memory
function readFileEager(string $path): array {
    return file($path); // Could be gigabytes!
}

// With generator — only one line in memory at a time
function readFileLines(string $path): Generator {
    $handle = fopen($path, "r");
    while (($line = fgets($handle)) !== false) {
        yield $line; // Pauses here, resumes on next iteration
    }
    fclose($handle);
}

foreach (readFileLines("huge.log") as $line) {
    process($line); // Memory stays constant regardless of file size
}

// Generator with key => value
function indexedRange(int $from, int $to): Generator {
    for ($i = $from; $i <= $to; $i++) {
        yield $i => $i * $i; // yields key => value
    }
}

foreach (indexedRange(1, 5) as $n => $square) {
    echo "$n => $square\n"; // 1=>1, 2=>4, 3=>9, 4=>16, 5=>25
}

// Infinite sequence — only compute what you use
function fibonacci(): Generator {
    [$a, $b] = [0, 1];
    while (true) {
        yield $a;
        [$a, $b] = [$b, $a + $b];
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/language.generators.php',
            ],
            [
                'id' => 25,
                'short' => 'Closure',
                'detail' => 'A Closure is an anonymous function that can capture variables from the surrounding scope. Use the "use" keyword to capture by value (snapshot), or "use (&$var)" to capture by reference. PHP 7.4 introduced arrow functions (fn) which auto-capture by value and have implicit return. Closures are first-class values — they can be stored in variables, passed as arguments, and returned from functions.',
                'code' => '// Basic closure
$greet = function(string $name): string {
    return "Hello, $name!";
};
echo $greet("World"); // "Hello, World!"

// Capture variable by value (snapshot at creation time)
$prefix = "Mr.";
$formal = function(string $name) use ($prefix): string {
    return "$prefix $name";
};
$prefix = "Dr."; // Changing $prefix does NOT affect $formal
echo $formal("Smith"); // "Mr. Smith"

// Capture by reference — reflects later changes
$counter = 0;
$increment = function() use (&$counter): void {
    $counter++;
};
$increment(); $increment();
echo $counter; // 2

// Arrow function — auto-captures outer scope by value
$multiplier = 3;
$triple = fn($x) => $x * $multiplier;
echo $triple(4); // 12

// Returning a closure (factory/partial application)
function makeAdder(int $n): Closure {
    return fn(int $x) => $x + $n;
}
$add5 = makeAdder(5);
echo $add5(10); // 15

// Binding a closure to a different object
$getName = Closure::bind(
    fn() => $this->name,
    $user,
    User::class
);',
                'doc_url' => 'https://www.php.net/manual/en/class.closure.php',
            ],
            [
                'id' => 26,
                'short' => 'try/catch',
                'detail' => 'PHP\'s exception handling uses try, catch, and finally blocks. Code that may throw is placed in try. One or more catch blocks handle specific exception types. finally always runs regardless of whether an exception was thrown — useful for cleanup (closing files, releasing locks). PHP 8.0 allows non-capturing catches (catch without a variable). Use custom exception classes to categorize errors.',
                'code' => 'class NotFoundException extends RuntimeException {}
class ValidationException extends RuntimeException {
    public function __construct(
        public readonly array $errors,
        string $message = "Validation failed"
    ) {
        parent::__construct($message);
    }
}

function findUser(int $id): array {
    $user = fetchFromDb($id);
    if ($user === null) {
        throw new NotFoundException("User $id not found", 404);
    }
    return $user;
}

// Multiple catch blocks — most specific first
try {
    $user = findUser($id);
    processUser($user);

} catch (NotFoundException $e) {
    http_response_code($e->getCode()); // 404
    echo "Not found: " . $e->getMessage();

} catch (ValidationException $e) {
    echo "Errors: " . implode(", ", $e->errors);

} catch (RuntimeException | LogicException $e) {
    // Catch multiple types with pipe (PHP 8.0+)
    logger()->error($e->getMessage(), ["trace" => $e->getTrace()]);

} finally {
    // Always runs — e.g. close DB connection, log timing
    releaseResources();
}',
                'doc_url' => 'https://www.php.net/manual/en/language.exceptions.php',
            ],
            [
                'id' => 27,
                'short' => 'namespace',
                'detail' => 'Namespaces organize PHP code into logical groups and prevent name collisions between classes, functions, and constants from different packages. A namespace is declared at the top of the file. Use the use keyword to import a class/function under an alias. Autoloaders (like Composer\'s PSR-4) map namespaces to directory structures, eliminating manual require statements.',
                'code' => '<?php
// File: src/Auth/UserRepository.php
namespace App\Auth;

use App\Database\Connection;      // import class
use App\Exceptions\NotFoundException;
use PDO;                           // import from global namespace
use function array_map;           // import function
use const PHP_EOL;                // import constant

class UserRepository {
    public function __construct(private Connection $db) {}

    public function findById(int $id): array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            throw new NotFoundException("User $id not found");
        }
        return $user;
    }
}

// File: src/Http/UserController.php
namespace App\Http;

use App\Auth\UserRepository;
use App\Auth\UserRepository as Repo; // alias

class UserController {
    public function __construct(private Repo $users) {}
}',
                'doc_url' => 'https://www.php.net/manual/en/language.namespaces.php',
            ],
            [
                'id' => 28,
                'short' => 'match',
                'detail' => 'The match expression (PHP 8.0) is an improved switch. Key differences: it uses strict comparison (===), it returns a value, there is no fall-through, each arm is a comma-separated list of conditions, and a non-exhaustive match without a default arm throws an UnhandledMatchError instead of silently doing nothing. Multiple conditions can be matched with a comma.',
                'code' => '$status = 404;

// match returns a value and uses strict ===
$label = match($status) {
    200, 201 => "Success",
    301, 302 => "Redirect",
    400      => "Bad Request",
    401, 403 => "Auth Error",
    404      => "Not Found",
    default  => "Unknown ($status)",
};
echo $label; // "Not Found"

// Compare with switch — switch uses loose == and falls through
switch (0) {
    case false: echo "matches!"; break; // "matches!" — loose comparison
}
match(0) {
    false   => "no match",   // Won\'t match — strict comparison
    0       => "matches",    // This matches
    default => "default",
};

// No-default match throws UnhandledMatchError
try {
    $result = match(999) { 1 => "one", 2 => "two" };
} catch (\UnhandledMatchError $e) {
    echo "No match found";
}

// Use with complex expressions
$response = match(true) {
    $score >= 90 => "A",
    $score >= 80 => "B",
    $score >= 70 => "C",
    default      => "F",
};',
                'doc_url' => 'https://www.php.net/manual/en/control-structures.match.php',
            ],
            [
                'id' => 29,
                'short' => 'Fiber',
                'detail' => 'Fibers (PHP 8.1) are lightweight cooperative concurrency primitives. A Fiber is a function that can pause itself with Fiber::suspend() and be resumed by the caller with $fiber->resume($value). Unlike threads, Fibers run in a single thread — they never run simultaneously. They are the building block for async/await-style coroutines used in frameworks like ReactPHP and Amp.',
                'code' => '// Create a fiber
$fiber = new Fiber(function(): void {
    echo "Fiber started\n";

    // Suspend and send a value OUT, receive a value IN
    $value = Fiber::suspend("first suspension");
    echo "Resumed with: $value\n";

    $value = Fiber::suspend("second suspension");
    echo "Resumed again with: $value\n";

    echo "Fiber finished\n";
});

// Start the fiber — runs until first suspend
$result = $fiber->start();
echo "Main got: $result\n"; // "first suspension"

// Resume and pass a value back in
$result = $fiber->resume("hello");
echo "Main got: $result\n"; // "second suspension"

$fiber->resume("world");
// Output order:
// Fiber started
// Main got: first suspension
// Resumed with: hello
// Main got: second suspension
// Resumed again with: world
// Fiber finished

// Check fiber state
$fiber->isStarted();    // true
$fiber->isSuspended();  // false
$fiber->isRunning();    // false
$fiber->isTerminated(); // true',
                'doc_url' => 'https://www.php.net/manual/en/class.fiber.php',
            ],
            [
                'id' => 30,
                'short' => 'enum',
                'detail' => 'Enumerations (PHP 8.1) define a type with a fixed set of named values. Pure enums have no associated value. Backed enums have a string or int backing value and can be created from a value with from() / tryFrom(). Enums can implement interfaces, have methods, and have constants. They cannot be instantiated with new and cannot have regular properties.',
                'code' => '// Pure enum
enum Direction {
    case North;
    case South;
    case East;
    case West;
}
$dir = Direction::North;

// Backed enum — each case has a scalar value
enum Status: string {
    case Active   = "active";
    case Inactive = "inactive";
    case Banned   = "banned";

    // Enums can have methods
    public function label(): string {
        return match($this) {
            Status::Active   => "Active User",
            Status::Inactive => "Inactive User",
            Status::Banned   => "Banned User",
        };
    }
}

$s = Status::Active;
echo $s->value;   // "active"
echo $s->name;    // "Active"
echo $s->label(); // "Active User"

// Create from raw value
$s = Status::from("banned");       // Status::Banned
$s = Status::tryFrom("unknown");   // null — safe, won\'t throw

// Get all cases
$all = Status::cases(); // [Status::Active, Status::Inactive, Status::Banned]

// Type-safe function parameter
function processUser(Status $status): void {
    if ($status === Status::Banned) {
        throw new RuntimeException("User is banned");
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/language.enumerations.php',
            ],
            [
                'id' => 31,
                'short' => 'readonly',
                'detail' => 'The readonly modifier (PHP 8.1) prevents a property from being written more than once. After initialization in the constructor (or its declaration), any subsequent write throws an Error. PHP 8.2 adds readonly classes, where all promoted and typed properties are implicitly readonly. Readonly properties cannot have a default value in their declaration (except null for nullable types).',
                'code' => 'class Point {
    public readonly float $x;
    public readonly float $y;

    public function __construct(float $x, float $y) {
        $this->x = $x; // First (and only) write — OK
        $this->y = $y;
    }
}

$p = new Point(1.5, 2.5);
echo $p->x; // 1.5

$p->x = 3.0; // Error: Cannot modify readonly property Point::$x

// Constructor promotion makes this concise
class Money {
    public function __construct(
        public readonly int    $amount,
        public readonly string $currency,
    ) {}
}

$m = new Money(100, "USD");

// PHP 8.2: readonly class — ALL typed properties are readonly
readonly class Coordinate {
    public function __construct(
        public float $lat,
        public float $lng,
    ) {}
}

// Useful for Value Objects — immutable by design
$coord = new Coordinate(50.08, 14.43);
// $coord->lat = 0; // Error',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties',
            ],
            [
                'id' => 32,
                'short' => '#[Attribute]',
                'detail' => 'PHP 8.0 introduced native attributes (annotations) as a structured way to add metadata to classes, methods, properties, parameters, and functions. They replace PHPDoc comments for machine-readable metadata. Attributes are read at runtime using the Reflection API. To declare a custom attribute class, mark it with #[Attribute]. Frameworks use attributes for routing, validation, DI bindings, and more.',
                'code' => '// Declare a custom attribute
#[Attribute(Attribute::TARGET_METHOD)]
class Route {
    public function __construct(
        public readonly string $path,
        public readonly string $method = "GET"
    ) {}
}

#[Attribute(Attribute::TARGET_PROPERTY)]
class Column {
    public function __construct(public readonly string $name) {}
}

// Use attributes
class UserController {
    #[Route("/users", "GET")]
    public function index(): array { return []; }

    #[Route("/users/{id}", "GET")]
    public function show(int $id): array { return []; }
}

class User {
    #[Column("user_id")]
    public int $id;

    #[Column("full_name")]
    public string $name;
}

// Read attributes with Reflection at runtime
$ref   = new ReflectionClass(UserController::class);
foreach ($ref->getMethods() as $method) {
    $attrs = $method->getAttributes(Route::class);
    foreach ($attrs as $attr) {
        $route = $attr->newInstance(); // Route object
        echo "{$route->method} {$route->path} => {$method->getName()}\n";
    }
}
// GET /users => index
// GET /users/{id} => show',
                'doc_url' => 'https://www.php.net/manual/en/language.attributes.php',
            ],
            [
                'id' => 33,
                'short' => '?? operator',
                'detail' => 'The null coalescing operator ?? (PHP 7.0) returns its left operand if it exists and is not null, otherwise it returns the right operand. It is a shorthand for isset() checks. It short-circuits — the right side is only evaluated if needed. The null coalescing assignment operator ??= (PHP 7.4) assigns the right value to the left variable only if the left is null or not set.',
                'code' => '// Basic usage — replaces isset() ternary
$name = $_GET["name"] ?? "Guest";
// equivalent to: $name = isset($_GET["name"]) ? $_GET["name"] : "Guest";

// Chaining — returns first non-null value
$locale = $_GET["lang"] ?? $_SESSION["lang"] ?? $user["lang"] ?? "en";

// Works with array access and methods
$city   = $user["address"]["city"] ?? "Unknown";
$label  = $object?->getLabel() ?? "Default";  // nullsafe + coalesce

// Null coalescing assignment (PHP 7.4)
// Assigns only if the variable is null/not set
$_SESSION["visits"] ??= 0;
$_SESSION["visits"]++;

$config["debug"] ??= false;

// Difference from ?: (Elvis operator)
$x = 0;
echo $x ?: "fallback";  // "fallback" — ?: checks truthiness (0 is falsy)
echo $x ?? "fallback";  // 0          — ?? only checks for null/unset

$y = null;
echo $y ?: "fallback";  // "fallback"
echo $y ?? "fallback";  // "fallback"',
                'doc_url' => 'https://www.php.net/manual/en/migration70.new-features.php#migration70.new-features.null-coalesce-op',
            ],
            [
                'id' => 34,
                'short' => '?-> operator',
                'detail' => 'The nullsafe operator ?-> (PHP 8.0) allows you to call a method or access a property on a value that might be null, without a null check. If the left-hand side is null, the entire chain short-circuits and returns null instead of throwing a TypeError or fatal error. It is chainable and can be combined with the null coalescing operator.',
                'code' => 'class User {
    public ?Address $address = null;
    public function getAddress(): ?Address { return $this->address; }
}

class Address {
    public ?City $city = null;
    public function getCity(): ?City { return $this->city; }
}

class City {
    public string $name = "Prague";
    public function getZip(): string { return "100 00"; }
}

$user = new User(); // $user->address is null

// Without nullsafe — verbose null checks
if ($user !== null
    && $user->getAddress() !== null
    && $user->getAddress()->getCity() !== null) {
    $city = $user->getAddress()->getCity()->name;
} else {
    $city = null;
}

// With nullsafe — short-circuits at first null
$city = $user?->getAddress()?->getCity()?->name; // null (no error)
$zip  = $user?->getAddress()?->getCity()?->getZip(); // null

// Combine with null coalescing
$cityName = $user?->getAddress()?->getCity()?->name ?? "Unknown";
// "Unknown"

// Works with array access too
$first = $collection?->first()?->getId() ?? 0;',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.basic.php#language.oop5.basic.nullsafe',
            ],
            [
                'id' => 35,
                'short' => 'spread ...',
                'detail' => 'The spread (splat) operator ... has two uses: unpacking an array/iterable into function arguments, and collecting variadic arguments in function signatures. PHP 8.1 extended it to support string-keyed arrays in function calls (named argument unpacking). It is also used in array literals to merge arrays.',
                'code' => '// 1. Variadic function — collect extra args into array
function sum(int ...$numbers): int {
    return array_sum($numbers);
}
echo sum(1, 2, 3, 4, 5); // 15

// 2. Unpack array into function call
$args = [2, 4];
echo max(...$args); // 4

$range = range(1, 10);
echo sum(...$range); // 55

// 3. Spread in array literals (PHP 7.4+)
$first  = [1, 2, 3];
$second = [4, 5, 6];
$merged = [...$first, ...$second, 7, 8];
// [1, 2, 3, 4, 5, 6, 7, 8]

// 4. Named argument unpacking (PHP 8.1)
function createUser(string $name, int $age, string $role = "user"): array {
    return compact("name", "age", "role");
}
$params = ["age" => 25, "name" => "Alice", "role" => "admin"];
$user = createUser(...$params); // Order-independent!

// 5. Combine with array functions
$matrix = [[1,2],[3,4],[5,6]];
$flat   = array_merge(...$matrix); // [1, 2, 3, 4, 5, 6]',
                'doc_url' => 'https://www.php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration.nullable',
            ],
            [
                'id' => 36,
                'short' => 'named args',
                'detail' => 'Named arguments (PHP 8.0) allow you to pass arguments to a function by their parameter name rather than by position. This means you can skip optional parameters, improve readability of calls with many arguments, and pass arguments in any order. Named arguments work with built-in functions too. You cannot use named arguments for positional-only parameters declared with / in the signature.',
                'code' => '// Traditional positional call — hard to read
$result = array_slice($array, 2, 5, true);

// Named arguments — self-documenting
$result = array_slice(
    array:          $array,
    offset:         2,
    length:         5,
    preserve_keys:  true
);

// Skip optional parameters you don\'t need
function createUser(
    string $name,
    int    $age     = 0,
    string $role    = "user",
    bool   $active  = true
): array {
    return compact("name", "age", "role", "active");
}

// Skip $age and $role, set only $active
$user = createUser(name: "Alice", active: false);
// ["name"=>"Alice", "age"=>0, "role"=>"user", "active"=>false]

// Mix positional and named (positional must come first)
$user = createUser("Bob", role: "admin");

// Named args with built-in functions
$arr = [3, 1, 4, 1, 5];
$padded = array_pad(array: $arr, length: 8, value: 0);

implode(separator: ", ", array: ["a","b","c"]);
str_contains(haystack: $str, needle: "php");',
                'doc_url' => 'https://www.php.net/manual/en/functions.named-arguments.php',
            ],
            [
                'id' => 37,
                'short' => 'union types',
                'detail' => 'Union types (PHP 8.0) allow a parameter, return type, or property to accept multiple types, separated by |. PHP 8.0 also added the mixed pseudo-type (any type), never (function never returns — throws or exits), and improved null handling. PHP 8.2 added Disjunctive Normal Form (DNF) types for combining union and intersection types.',
                'code' => '// Parameter accepting int or string
function processId(int|string $id): array|false {
    if (is_int($id)) {
        return findById($id);
    }
    return findBySlug($id);
}

// Nullable shorthand: ?Type === null|Type
function findUser(int $id): ?array {   // returns array or null
    return fetchFromDb($id) ?: null;
}

// Property union type (PHP 8.0+)
class Response {
    public int|string $code;
    public array|string $body;
}

// never — function never returns normally
function abort(int $code, string $msg): never {
    http_response_code($code);
    echo $msg;
    exit; // or throw
}

// mixed — explicitly any type
function dump(mixed $value): void {
    var_dump($value);
}

// PHP 8.2 DNF (Disjunctive Normal Form) types
// (Countable&Iterator)|array  — either implements both interfaces, or is array
function process((Countable&Iterator)|array $data): void {
    foreach ($data as $item) { /* ... */ }
}',
                'doc_url' => 'https://www.php.net/manual/en/language.types.declarations.php#language.types.declarations.union',
            ],
            [
                'id' => 38,
                'short' => 'constructor↑',
                'detail' => 'Constructor property promotion (PHP 8.0) allows you to declare and initialize class properties directly in the constructor\'s parameter list by adding a visibility modifier (public, protected, private) or readonly to the parameter. PHP automatically creates the property and assigns the value. This eliminates repetitive boilerplate and is fully compatible with readonly, type declarations, and default values.',
                'code' => '// Before PHP 8.0 — lots of repetition
class UserBefore {
    public string $name;
    public string $email;
    private int   $age;

    public function __construct(string $name, string $email, int $age) {
        $this->name  = $name;
        $this->email = $email;
        $this->age   = $age;
    }
}

// PHP 8.0+ — property promotion
class User {
    public function __construct(
        public readonly string $name,    // public + readonly
        public string          $email,   // mutable public
        private int            $age = 0, // with default value
    ) {
        // Body still runs — can add extra logic
        $this->email = strtolower($email);
    }

    public function getAge(): int { return $this->age; }
}

$user = new User("Alice", "ALICE@Example.COM", 30);
echo $user->name;      // "Alice"
echo $user->email;     // "alice@example.com" (lowercased in body)
echo $user->getAge();  // 30

// Mix promoted and non-promoted parameters
class Request {
    public readonly array $parsedBody;

    public function __construct(
        public readonly string $method,  // promoted
        public readonly string $uri,     // promoted
        array $body = []                 // NOT promoted
    ) {
        $this->parsedBody = $body;       // manual assignment
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor.promotion',
            ],
            [
                'id' => 39,
                'short' => 'str_contains()',
                'detail' => 'str_contains() (PHP 8.0) checks whether a string contains a given substring. It returns true if the needle is found anywhere in the haystack, false otherwise. An empty string needle always returns true. It is case-sensitive. Before PHP 8.0, developers used strpos() !== false, which was less readable. Related functions added in PHP 8.0: str_starts_with() and str_ends_with().',
                'code' => '// Basic usage
$text = "The quick brown fox jumps over the lazy dog";

var_dump(str_contains($text, "fox"));      // true
var_dump(str_contains($text, "cat"));      // false
var_dump(str_contains($text, "Fox"));      // false — case-sensitive
var_dump(str_contains($text, ""));         // true — empty needle always true

// Before PHP 8.0 — the old way (still works)
$found = strpos($text, "fox") !== false;   // true

// Case-insensitive search — use mb_strtolower or stripos
$term = "FOX";
$found = str_contains(strtolower($text), strtolower($term)); // true

// Practical use
function isSuspicious(string $input): bool {
    $patterns = ["<script", "DROP TABLE", "eval(", "../"];
    foreach ($patterns as $pattern) {
        if (str_contains(strtolower($input), strtolower($pattern))) {
            return true;
        }
    }
    return false;
}

// Chained checks
$url = "https://example.com/admin?debug=true";
if (str_contains($url, "admin") && str_contains($url, "debug")) {
    log("Suspicious admin URL accessed");
}',
                'doc_url' => 'https://www.php.net/manual/en/function.str-contains.php',
            ],
            [
                'id' => 40,
                'short' => 'str_starts_with',
                'detail' => 'str_starts_with() (PHP 8.0) returns true if the haystack string starts with the given prefix. It is case-sensitive. An empty prefix always returns true. Before PHP 8.0, developers used substr() === $prefix or strncmp() which were verbose and error-prone. It is faster than a regex for simple prefix checks.',
                'code' => '$url  = "https://example.com/dashboard";
$path = "/admin/users/42";

// Basic checks
var_dump(str_starts_with($url, "https://"));   // true
var_dump(str_starts_with($url, "http://"));    // false
var_dump(str_starts_with($path, "/admin"));    // true
var_dump(str_starts_with("", ""));             // true
var_dump(str_starts_with("abc", ""));          // true — empty prefix

// Old way (still valid)
$old = substr($url, 0, 8) === "https://"; // true

// Case-sensitive!
var_dump(str_starts_with("Hello World", "hello")); // false

// Case-insensitive variant
function startsWithi(string $haystack, string $needle): bool {
    return str_starts_with(strtolower($haystack), strtolower($needle));
}

// Route matching example
function routeIs(string $path, string $prefix): bool {
    return str_starts_with($path, $prefix);
}

if (routeIs($_SERVER["REQUEST_URI"], "/api/")) {
    header("Content-Type: application/json");
}

if (str_starts_with($username, "admin_")) {
    throw new RuntimeException("Reserved username prefix");
}',
                'doc_url' => 'https://www.php.net/manual/en/function.str-starts-with.php',
            ],
            [
                'id' => 41,
                'short' => 'str_ends_with()',
                'detail' => 'str_ends_with() (PHP 8.0) returns true if the haystack ends with the given suffix. It is case-sensitive, and an empty suffix always returns true. Common uses include checking file extensions, URL endings, and string suffixes. Before PHP 8.0, the typical approach was substr($str, -strlen($suffix)) === $suffix, which is easy to get wrong with edge cases like empty strings.',
                'code' => '$filename = "report_2024.pdf";
$email    = "alice@example.com";
$route    = "/api/users/42/posts";

// Basic checks
var_dump(str_ends_with($filename, ".pdf"));    // true
var_dump(str_ends_with($filename, ".docx"));   // false
var_dump(str_ends_with($email, ".com"));        // true
var_dump(str_ends_with($route, "/posts"));      // true
var_dump(str_ends_with("", ""));               // true
var_dump(str_ends_with("abc", ""));            // true — empty suffix

// Old approach (error-prone with empty strings)
$old = substr($filename, -4) === ".pdf"; // true

// File type validation
function isAllowedFile(string $filename): bool {
    $allowed = [".jpg", ".jpeg", ".png", ".gif", ".webp"];
    foreach ($allowed as $ext) {
        if (str_ends_with(strtolower($filename), $ext)) {
            return true;
        }
    }
    return false;
}

isAllowedFile("photo.JPG");  // true (strtolower handles case)
isAllowedFile("virus.exe");  // false

// API versioning
if (str_ends_with($_SERVER["REQUEST_URI"], ".json")) {
    header("Content-Type: application/json");
}',
                'doc_url' => 'https://www.php.net/manual/en/function.str-ends-with.php',
            ],
            [
                'id' => 42,
                'short' => 'sprintf()',
                'detail' => 'sprintf() returns a formatted string using a format string with conversion specifiers. Each % specifier is replaced with a corresponding argument. It is used for number formatting, padding, and building structured strings without concatenation. printf() works the same way but prints directly. vsprintf() accepts an array of arguments. Common format specifiers: %s (string), %d (integer), %f (float), %x (hex).',
                'code' => '// Basic substitution
$name = "Alice";
$age  = 30;
$msg  = sprintf("Hello, %s! You are %d years old.", $name, $age);
// "Hello, Alice! You are 30 years old."

// Float precision
$price = 9.9;
echo sprintf("Price: $%.2f", $price);  // "Price: $9.90"

// Padding
echo sprintf("%05d", 42);    // "00042" — zero-pad to width 5
echo sprintf("%-10s|", "hi"); // "hi        |" — left-align, 10 wide
echo sprintf("%10s|", "hi");  // "        hi|" — right-align

// Number formatting
echo sprintf("%+d", 42);   // "+42" — force sign
echo sprintf("%+d", -42);  // "-42"
echo sprintf("%e", 123456789.0); // "1.234568e+8" — scientific
echo sprintf("%x", 255);         // "ff" — hex
echo sprintf("%X", 255);         // "FF" — uppercase hex
echo sprintf("%b", 10);          // "1010" — binary
echo sprintf("%o", 8);           // "10" — octal

// Argument swapping with %n$
echo sprintf("%2\$s loves %1\$s", "PHP", "Alice"); // "Alice loves PHP"

// Build SQL-safe string representation (still use PDO for real queries!)
$table = sprintf("SELECT * FROM %s LIMIT %d", "users", 10);',
                'doc_url' => 'https://www.php.net/manual/en/function.sprintf.php',
            ],
            [
                'id' => 43,
                'short' => 'preg_match()',
                'detail' => 'preg_match() performs a Perl-compatible regular expression match and returns 1 if the pattern matches, 0 if not, or false on error. The optional third argument $matches is filled with the full match and captured groups. preg_match_all() finds all matches. preg_replace() performs find-and-replace. Always use delimiters (usually /) and the u flag for Unicode. Compile complex patterns once with preg_quote().',
                'code' => '$email = "user@example.com";
$text  = "Call us at +420 123 456 789 or 555-0100";

// Basic match — returns 1 (true) or 0 (false)
if (preg_match("/^[\w.+-]+@[\w-]+\.[a-z]{2,}$/i", $email)) {
    echo "Valid email";
}

// Capture groups — $matches[0] = full match, $matches[1] = first group
preg_match("/(\d{4})-(\d{2})-(\d{2})/", "Today is 2024-01-15", $matches);
// $matches[0] = "2024-01-15"
// $matches[1] = "2024"
// $matches[2] = "01"
// $matches[3] = "15"

// Named capture groups
preg_match(
    "/(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2})/",
    "2024-01-15",
    $m
);
echo $m["year"]; // "2024"

// Find ALL matches
$count = preg_match_all("/\d+/", $text, $matches);
// $matches[0] = ["420","123","456","789","555","0100"]

// Replace with callback
$result = preg_replace_callback("/\b\w+\b/", function($m) {
    return ucfirst(strtolower($m[0]));
}, "hELLO wORLD");
// "Hello World"

// Split by pattern
$parts = preg_split("/[\s,]+/", "one, two,  three four");
// ["one", "two", "three", "four"]',
                'doc_url' => 'https://www.php.net/manual/en/function.preg-match.php',
            ],
            [
                'id' => 44,
                'short' => 'json_encode()',
                'detail' => 'json_encode() converts a PHP value (array, object, scalar) to a JSON string. It returns false on failure. Use flags to control output: JSON_PRETTY_PRINT for human-readable formatting, JSON_UNESCAPED_UNICODE to keep non-ASCII characters, JSON_UNESCAPED_SLASHES to not escape /, JSON_THROW_ON_ERROR (PHP 7.3) to throw JsonException instead of returning false.',
                'code' => '$data = [
    "name"   => "Ján Novák",
    "age"    => 30,
    "scores" => [98, 87, 92],
    "active" => true,
    "notes"  => null,
    "url"    => "https://example.com/path",
];

// Basic encoding
$json = json_encode($data);
// {"name":"Ján Novák","age":30,...}

// Pretty print + unicode + no slash escaping
$json = json_encode($data,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
);
// {
//   "name": "Ján Novák",
//   "url": "https://example.com/path",
//   ...
// }

// Throw exception on error (PHP 7.3+) — recommended
try {
    $json = json_encode($data, JSON_THROW_ON_ERROR);
} catch (\JsonException $e) {
    // handle invalid data (e.g. non-UTF-8 strings, INF/NAN floats)
    echo $e->getMessage();
}

// Force object even for empty or sequential array
echo json_encode([]);         // "[]" — array
echo json_encode((object)[]); // "{}" — object
echo json_encode($data, JSON_FORCE_OBJECT); // all arrays as objects

// Encoding objects — public properties are serialized
class Point { public function __construct(public int $x, public int $y) {} }
echo json_encode(new Point(1, 2)); // {"x":1,"y":2}',
                'doc_url' => 'https://www.php.net/manual/en/function.json-encode.php',
            ],
            [
                'id' => 45,
                'short' => 'json_decode()',
                'detail' => 'json_decode() parses a JSON string and returns a PHP value. By default, JSON objects become stdClass instances. Pass true as the second argument to get associative arrays instead. Returns null on failure or if the JSON literal is "null". Always use JSON_THROW_ON_ERROR (PHP 7.3+) to catch malformed JSON as an exception rather than silently returning null.',
                'code' => '$json = \'{"name":"Alice","age":30,"scores":[98,87,92],"address":{"city":"Prague"}}\';

// Default: JSON objects become stdClass
$obj = json_decode($json);
echo $obj->name;             // "Alice"
echo $obj->address->city;    // "Prague"
echo $obj->scores[0];        // 98

// Second arg true: objects become associative arrays
$arr = json_decode($json, true);
echo $arr["name"];               // "Alice"
echo $arr["address"]["city"];    // "Prague"
echo $arr["scores"][0];          // 98

// Failure handling — the old way
$bad  = json_decode("invalid json");
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Parse error: " . json_last_error_msg();
}

// Better: JSON_THROW_ON_ERROR (PHP 7.3+)
try {
    $data = json_decode("invalid", true, flags: JSON_THROW_ON_ERROR);
} catch (\JsonException $e) {
    echo "JSON error: " . $e->getMessage(); // Syntax error
}

// Decode API response
$response = file_get_contents("https://api.example.com/data");
$payload  = json_decode($response, true, flags: JSON_THROW_ON_ERROR);
foreach ($payload["items"] as $item) {
    echo $item["id"] . ": " . $item["title"] . "\n";
}',
                'doc_url' => 'https://www.php.net/manual/en/function.json-decode.php',
            ],
            [
                'id' => 46,
                'short' => 'header()',
                'detail' => 'header() sends a raw HTTP response header. It must be called before any output is sent (including whitespace before <?php). Common uses: redirects with Location, setting Content-Type, controlling caching with Cache-Control, and setting HTTP status codes. Use http_response_code() to set just the status. The replace parameter controls whether to replace a previous similar header.',
                'code' => '<?php
// MUST be called before any output!

// Redirect
header("Location: /login");
exit; // Always exit after redirect!

// Redirect with status
header("Location: https://example.com", true, 301); // Permanent
header("Location: /new-url",            true, 302); // Temporary

// Set content type
header("Content-Type: application/json; charset=utf-8");
header("Content-Type: text/csv");
header("Content-Type: application/pdf");

// Status code only
http_response_code(404);
http_response_code(201); // Created

// Download file
header("Content-Disposition: attachment; filename=\"export.csv\"");
header("Content-Type: text/csv");
readfile("/path/to/file.csv");

// No-cache headers
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// CORS headers
header("Access-Control-Allow-Origin: https://trusted.com");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Security headers
header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("Strict-Transport-Security: max-age=31536000");

// Check if headers already sent
if (!headers_sent()) {
    header("X-Custom: value");
}',
                'doc_url' => 'https://www.php.net/manual/en/function.header.php',
            ],
            [
                'id' => 47,
                'short' => 'date()',
                'detail' => 'date() formats a Unix timestamp (seconds since 1970-01-01 00:00:00 UTC) as a string using a format string. Without a second argument it uses the current time (time()). Always set the timezone with date_default_timezone_set() or in php.ini. For date arithmetic and timezone-aware operations, prefer the DateTime / DateTimeImmutable OOP API.',
                'code' => 'date_default_timezone_set("Europe/Prague");

// Current date and time
echo date("Y-m-d");         // "2024-01-15"
echo date("d.m.Y");         // "15.01.2024"
echo date("Y-m-d H:i:s");   // "2024-01-15 14:30:00"
echo date("D, d M Y");       // "Mon, 15 Jan 2024"
echo date("l");              // "Monday"
echo date("U");              // Unix timestamp (same as time())

// From a specific timestamp
$ts = mktime(12, 0, 0, 6, 15, 2024); // June 15 2024 noon
echo date("Y-m-d H:i", $ts); // "2024-06-15 12:00"

// Format specifiers
// Y = 4-digit year    y = 2-digit year
// m = month (01-12)   n = month (1-12)    M = "Jan"
// d = day (01-31)     j = day (1-31)      D = "Mon"
// H = hour 24h        h = hour 12h        g = hour 12h no pad
// i = minutes         s = seconds
// A = AM/PM           a = am/pm
// N = day of week (1=Mon, 7=Sun)
// t = days in month   W = ISO week number

// OOP alternative — recommended
$dt = new DateTimeImmutable("now", new DateTimeZone("UTC"));
echo $dt->format("Y-m-d H:i:s");

$future = $dt->modify("+7 days")->format("Y-m-d");
$diff   = $dt->diff(new DateTimeImmutable("2025-01-01"));
echo $diff->days . " days until 2025";',
                'doc_url' => 'https://www.php.net/manual/en/function.date.php',
            ],
            [
                'id' => 48,
                'short' => 'strtotime()',
                'detail' => 'strtotime() parses a human-readable English date/time string into a Unix timestamp. It understands relative expressions like "next Monday", "+2 weeks", "last month", and absolute dates like "2024-01-15". Returns false on failure. An optional second argument sets the base timestamp for relative calculations. For timezone-aware or complex parsing, prefer DateTimeImmutable::createFromFormat().',
                'code' => '// Absolute dates
$ts = strtotime("2024-06-15");       // June 15, 2024
$ts = strtotime("15 June 2024");     // same
$ts = strtotime("2024-06-15 14:30"); // with time

// Relative expressions
$ts = strtotime("now");              // current time
$ts = strtotime("+1 day");           // tomorrow
$ts = strtotime("+2 weeks");
$ts = strtotime("+1 month");
$ts = strtotime("+1 year");
$ts = strtotime("-30 days");
$ts = strtotime("next Monday");
$ts = strtotime("last Friday");
$ts = strtotime("first day of next month");
$ts = strtotime("last day of this month");

// Relative to a base timestamp
$base = strtotime("2024-01-31");
$next = strtotime("+1 month", $base); // 2024-02-29 (leap year)

// Error handling
$ts = strtotime("not a date");
if ($ts === false) {
    echo "Invalid date string";
}

// Format after parsing
echo date("Y-m-d", strtotime("next Monday"));

// Better alternative — DateTimeImmutable
$dt   = new DateTimeImmutable("+1 month");
$dt   = DateTimeImmutable::createFromFormat("d/m/Y", "15/06/2024");
echo $dt->format("Y-m-d"); // "2024-06-15"',
                'doc_url' => 'https://www.php.net/manual/en/function.strtotime.php',
            ],
            [
                'id' => 49,
                'short' => 'static',
                'detail' => 'The static keyword in PHP has two uses: (1) static class members — properties and methods belonging to the class itself rather than an instance, accessed with ClassName:: or self::/static::; (2) static local variables inside a function, which retain their value between calls. Late static binding (LSB) via static:: resolves to the class that was called at runtime, while self:: always refers to the class where the method is defined.',
                'code' => '// Static property — shared across all instances
class Counter {
    private static int $count = 0;

    public function __construct() {
        self::$count++;
    }

    public static function getCount(): int {
        return self::$count;
    }
}

new Counter(); new Counter(); new Counter();
echo Counter::getCount(); // 3

// Late static binding — static:: vs self::
class Base {
    public static function create(): static {
        return new static(); // new static() creates the CALLED class
    }

    public static function className(): string {
        return static::class; // resolves at call time
    }
}

class Child extends Base {}

$obj = Child::create(); // Returns Child, not Base
echo Child::className(); // "Child"

// Singleton pattern using LSB
class Db {
    private static ?self $instance = null;

    public static function getInstance(): static {
        return static::$instance ??= new static();
    }
}

// Static local variable — persists between calls
function generateId(): int {
    static $id = 0; // Initialized ONCE
    return ++$id;
}
echo generateId(); // 1
echo generateId(); // 2
echo generateId(); // 3',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.static.php',
            ],
            [
                'id' => 50,
                'short' => 'Reflection API',
                'detail' => 'The Reflection API allows PHP programs to introspect classes, methods, properties, parameters, and functions at runtime. It is used heavily by frameworks for dependency injection containers, ORM mapping, test runners, and attribute-based routing. Key classes: ReflectionClass, ReflectionMethod, ReflectionProperty, ReflectionParameter, ReflectionFunction.',
                'code' => 'class UserService {
    public function __construct(
        private readonly UserRepository $repo,
        private readonly Logger         $logger,
    ) {}

    #[Route("/users/{id}", methods: ["GET"])]
    public function getUser(int $id): ?array {
        return $this->repo->find($id);
    }
}

// Inspect a class
$rc = new ReflectionClass(UserService::class);
echo $rc->getName();        // "UserService"
echo $rc->getFileName();    // "/src/UserService.php"

// Constructor parameters — used by DI containers
$ctor    = $rc->getConstructor();
$params  = $ctor->getParameters();
foreach ($params as $param) {
    $type = $param->getType()->getName();
    echo "{$param->getName()}: $type\n";
    // repo: UserRepository
    // logger: Logger
}

// Read attributes (PHP 8.0+)
foreach ($rc->getMethods() as $method) {
    $attrs = $method->getAttributes(Route::class);
    foreach ($attrs as $attr) {
        $route = $attr->newInstance();
        echo $route->path; // "/users/{id}"
    }
}

// Instantiate without calling constructor
$obj = $rc->newInstanceWithoutConstructor();

// Access private property (for testing/serialization)
$prop = new ReflectionProperty(UserService::class, "repo");
$prop->setAccessible(true); // PHP < 8.1 only
$value = $prop->getValue($obj);',
                'doc_url' => 'https://www.php.net/manual/en/book.reflection.php',
            ],
            // ── 51-100: additional concepts ──────────────────────────────────
            [
                'id' => 51,
                'short' => 'array_pop()',
                'detail' => 'array_pop() removes and returns the last element of an array, shortening it by one. It modifies the array in place and resets the internal array pointer. Use array_shift() to remove the first element instead. Returns null if the array is empty.',
                'code' => '$stack = ["apple", "banana", "cherry"];

$last = array_pop($stack);
echo $last;           // "cherry"
print_r($stack);      // ["apple", "banana"]

// Simulate a stack (LIFO)
$stack = [];
array_push($stack, "first");
array_push($stack, "second");
array_push($stack, "third");

while ($item = array_pop($stack)) {
    echo $item . "\n"; // third, second, first
}

// Returns null on empty array
$empty = [];
var_dump(array_pop($empty)); // NULL',
                'doc_url' => 'https://www.php.net/manual/en/function.array-pop.php',
            ],
            [
                'id' => 52,
                'short' => 'array_shift()',
                'detail' => 'array_shift() removes and returns the first element of an array, re-indexing all numeric keys starting from zero. String keys are unaffected. Use array_unshift() to prepend elements. It is slower than array_pop() on large arrays because it must re-index.',
                'code' => '$queue = ["first", "second", "third"];

$front = array_shift($queue);
echo $front;           // "first"
print_r($queue);       // [0=>"second", 1=>"third"]  (re-indexed)

// Simulate a queue (FIFO)
$jobs = [];
array_push($jobs, "job-1");
array_push($jobs, "job-2");
array_push($jobs, "job-3");

while ($job = array_shift($jobs)) {
    echo "Processing $job\n"; // job-1, job-2, job-3
}

// array_unshift — prepend one or more elements
$arr = [3, 4, 5];
array_unshift($arr, 1, 2);
// [1, 2, 3, 4, 5]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-shift.php',
            ],
            [
                'id' => 53,
                'short' => 'array_flip()',
                'detail' => 'array_flip() exchanges keys and values in an array. Original values become keys and original keys become values. Values must be valid key types (string or int). If values are duplicated, later entries overwrite earlier ones. Useful for creating lookup tables from value lists.',
                'code' => '$roles = ["alice" => "admin", "bob" => "editor", "carol" => "viewer"];

$byRole = array_flip($roles);
// ["admin"=>"alice", "editor"=>"bob", "viewer"=>"carol"]

// Fast lookup: is "bob" an editor?
$flipped = array_flip($roles);
echo isset($flipped["editor"]) ? "yes" : "no"; // "yes"

// Create a "set" for O(1) lookup (instead of in_array which is O(n))
$allowed = ["GET", "POST", "PUT", "DELETE"];
$lookup  = array_flip($allowed);

if (isset($lookup[$_SERVER["REQUEST_METHOD"]])) {
    echo "Method allowed";
}

// Duplicates — last wins
$arr = ["a", "b", "a", "c"];
print_r(array_flip($arr));
// [0=>"a" overwritten by 2=>"a", 1=>"b", 3=>"c"]
// ["a"=>2, "b"=>1, "c"=>3]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-flip.php',
            ],
            [
                'id' => 54,
                'short' => 'array_chunk()',
                'detail' => 'array_chunk() splits an array into chunks of a given size. The last chunk may contain fewer elements. The second argument preserve_keys defaults to false (numeric arrays are re-indexed in each chunk). Useful for pagination, batch processing, and splitting work.',
                'code' => '$items = range(1, 10); // [1, 2, 3, ..., 10]

$chunks = array_chunk($items, 3);
// [[1,2,3], [4,5,6], [7,8,9], [10]]

// Preserve original keys
$assoc = ["a"=>1, "b"=>2, "c"=>3, "d"=>4];
$chunks = array_chunk($assoc, 2, true);
// [["a"=>1,"b"=>2], ["c"=>3,"d"=>4]]

// Batch DB inserts — insert 100 rows at a time
$rows = generateRows(1000);
foreach (array_chunk($rows, 100) as $batch) {
    $placeholders = implode(",", array_fill(0, count($batch), "(?,?,?)"));
    $stmt = $pdo->prepare("INSERT INTO t (a,b,c) VALUES $placeholders");
    $stmt->execute(array_merge(...array_map("array_values", $batch)));
}

// Pagination
$page    = 2;
$perPage = 5;
$pages   = array_chunk($items, $perPage);
$current = $pages[$page - 1] ?? [];',
                'doc_url' => 'https://www.php.net/manual/en/function.array-chunk.php',
            ],
            [
                'id' => 55,
                'short' => 'array_combine()',
                'detail' => 'array_combine() creates an associative array by using one array as keys and another as values. Both arrays must have the same number of elements — a ValueError is thrown otherwise. Useful for zipping separate keys and values arrays, for example after reading a CSV.',
                'code' => '$keys   = ["name", "age", "city"];
$values = ["Alice", 30, "Prague"];

$person = array_combine($keys, $values);
// ["name"=>"Alice", "age"=>30, "city"=>"Prague"]

// CSV parsing — first row as headers
$csv = [
    ["name", "age", "city"],
    ["Alice", "30", "Prague"],
    ["Bob",   "25", "Brno"],
];
$headers = array_shift($csv);
$records = array_map(fn($row) => array_combine($headers, $row), $csv);
// [
//   ["name"=>"Alice", "age"=>"30", "city"=>"Prague"],
//   ["name"=>"Bob",   "age"=>"25", "city"=>"Brno"],
// ]

// Different lengths throw ValueError (PHP 8)
try {
    array_combine(["a","b"], [1,2,3]); // ValueError!
} catch (\ValueError $e) {
    echo $e->getMessage();
}',
                'doc_url' => 'https://www.php.net/manual/en/function.array-combine.php',
            ],
            [
                'id' => 56,
                'short' => 'array_column()',
                'detail' => 'array_column() extracts a single column from a multidimensional array or array of objects. The optional third argument specifies which column to use as the result keys. Extremely useful for plucking IDs or names out of a database result set.',
                'code' => '$users = [
    ["id" => 1, "name" => "Alice", "role" => "admin"],
    ["id" => 2, "name" => "Bob",   "role" => "editor"],
    ["id" => 3, "name" => "Carol", "role" => "admin"],
];

// Extract one column
$names = array_column($users, "name");
// ["Alice", "Bob", "Carol"]

// Use a column as keys
$byId = array_column($users, "name", "id");
// [1=>"Alice", 2=>"Bob", 3=>"Carol"]

// Index the whole rows by a key
$indexed = array_column($users, null, "id");
// [1=>["id"=>1,"name"=>"Alice",...], ...]

// Works with objects too
$objects = array_map(fn($u) => (object)$u, $users);
$names   = array_column($objects, "name"); // ["Alice","Bob","Carol"]

// Practical: get all IDs for a WHERE IN query
$ids  = array_column($users, "id");
$sql  = "SELECT * FROM posts WHERE user_id IN (" . implode(",", $ids) . ")";',
                'doc_url' => 'https://www.php.net/manual/en/function.array-column.php',
            ],
            [
                'id' => 57,
                'short' => 'in_array()',
                'detail' => 'in_array() checks whether a value exists in an array. By default it uses loose (==) comparison. Pass true as the third argument for strict (===) comparison — always preferred to avoid false positives with "0", null, false, and empty string. For repeated lookups use isset(array_flip($arr)[$val]) which is O(1).',
                'code' => '$fruits = ["apple", "banana", "cherry"];

var_dump(in_array("banana", $fruits));       // true
var_dump(in_array("grape", $fruits));        // false

// Strict mode — ALWAYS use this
$numbers = [1, 2, 3, "4", false];

var_dump(in_array(0, $numbers));             // true  (loose: false==0)
var_dump(in_array(0, $numbers, true));       // false (strict)

var_dump(in_array("1", $numbers));           // true  (loose: 1=="1")
var_dump(in_array("1", $numbers, true));     // false (strict: int 1 !== string "1")

// Checking allowed values
$allowed = ["GET", "POST", "PUT", "PATCH", "DELETE"];
$method  = $_SERVER["REQUEST_METHOD"];

if (!in_array($method, $allowed, true)) {
    http_response_code(405);
    exit;
}

// For many lookups, flip to a hash for O(1)
$set = array_flip($fruits);
isset($set["banana"]); // true — much faster for large arrays',
                'doc_url' => 'https://www.php.net/manual/en/function.in-array.php',
            ],
            [
                'id' => 58,
                'short' => 'count()',
                'detail' => 'count() returns the number of elements in an array or a Countable object. On a scalar (string, int, etc.) it returns 1 (deprecated in PHP 7.2 — use is_array check). sizeof() is an alias. For nested arrays, pass COUNT_RECURSIVE as the second argument to count all elements at all depths.',
                'code' => '$fruits = ["apple", "banana", "cherry"];
echo count($fruits); // 3

// Empty array
echo count([]); // 0

// Countable object
class Collection implements Countable {
    private array $items = [];
    public function add(mixed $item): void { $this->items[] = $item; }
    public function count(): int { return count($this->items); }
}
$col = new Collection();
$col->add("a"); $col->add("b");
echo count($col); // 2

// Recursive count — all elements at all levels
$nested = [[1,2,3], [4,5], [6]];
echo count($nested);             // 3  (top-level elements)
echo count($nested, COUNT_RECURSIVE); // 6 (all elements)

// Check before accessing
$items = fetchItems();
if (count($items) === 0) {
    echo "No items found";
}

// Performance note: count() is O(1) for arrays in PHP
// (PHP stores the count internally)',
                'doc_url' => 'https://www.php.net/manual/en/function.count.php',
            ],
            [
                'id' => 59,
                'short' => 'compact()',
                'detail' => 'compact() creates an array from existing variables by name. It is the inverse of extract(). Each argument is a variable name (string) or an array of variable names. If a named variable does not exist, it is skipped with a notice. Commonly used to pass local variables to views or build response arrays concisely.',
                'code' => '$name  = "Alice";
$age   = 30;
$email = "alice@example.com";

// compact() builds an associative array from named variables
$data = compact("name", "age", "email");
// ["name"=>"Alice", "age"=>30, "email"=>"alice@example.com"]

// Equivalent to:
$data = ["name" => $name, "age" => $age, "email" => $email];

// Useful in controllers/views
function register(string $name, string $email, string $role): array {
    $token = generateToken();
    $createdAt = date("Y-m-d");
    return compact("name", "email", "role", "token", "createdAt");
}

// extract() — inverse: turns array keys into variables
$config = ["host" => "localhost", "port" => 5432, "dbname" => "app"];
extract($config); // Creates $host, $port, $dbname
echo $host;       // "localhost"
// WARNING: never use extract() on user input — creates arbitrary variables',
                'doc_url' => 'https://www.php.net/manual/en/function.compact.php',
            ],
            [
                'id' => 60,
                'short' => 'list() / []',
                'detail' => 'list() (and its short syntax []) assigns array elements to variables in one operation. PHP 7.1+ added key-based destructuring for associative arrays. Useful for unpacking function return values, loop variables, and swap operations without a temp variable.',
                'code' => '// Indexed destructuring
[$first, $second, $third] = ["apple", "banana", "cherry"];
echo $first;  // "apple"

// Skip elements with empty slot
[, $second, , $fourth] = [1, 2, 3, 4];
echo $second; // 2
echo $fourth; // 4

// Named (associative) destructuring — PHP 7.1+
$user = ["name" => "Alice", "age" => 30, "city" => "Prague"];
["name" => $name, "age" => $age] = $user;
echo "$name is $age"; // "Alice is 30"

// Swap variables without temp
[$a, $b] = [1, 2];
[$a, $b] = [$b, $a];
echo "$a $b"; // "2 1"

// In foreach loops
$points = [[1, 2], [3, 4], [5, 6]];
foreach ($points as [$x, $y]) {
    echo "($x, $y)\n"; // (1, 2), (3, 4), (5, 6)
}

// Unpack function return
function minMax(array $arr): array {
    return [min($arr), max($arr)];
}
[$min, $max] = minMax([3, 1, 4, 1, 5, 9]);
echo "min=$min max=$max"; // min=1 max=9',
                'doc_url' => 'https://www.php.net/manual/en/function.list.php',
            ],
            [
                'id' => 61,
                'short' => 'strlen()',
                'detail' => 'strlen() returns the number of bytes in a string, not the number of characters. For multibyte strings (UTF-8, etc.) use mb_strlen() with the appropriate encoding. strlen() counts the null byte as a character and is safe for binary strings. It is one of the most fundamental string functions.',
                'code' => 'echo strlen("Hello");          // 5
echo strlen("Hello World");    // 11
echo strlen("");               // 0
echo strlen("  hi  ");         // 6 — spaces count

// Bytes vs characters — important for multibyte strings
$str = "Héllo"; // é is 2 bytes in UTF-8
echo strlen($str);             // 6 — byte count
echo mb_strlen($str, "UTF-8"); // 5 — character count

$emoji = "Hello 🌍";
echo strlen($emoji);           // 10 (emoji = 4 bytes)
echo mb_strlen($emoji, "UTF-8"); // 7

// Practical uses
function truncate(string $str, int $maxLen): string {
    if (mb_strlen($str, "UTF-8") <= $maxLen) return $str;
    return mb_substr($str, 0, $maxLen - 3, "UTF-8") . "...";
}

// Validate password length
$password = $_POST["password"] ?? "";
if (strlen($password) < 8 || strlen($password) > 72) {
    throw new InvalidArgumentException("Password must be 8-72 chars");
}',
                'doc_url' => 'https://www.php.net/manual/en/function.strlen.php',
            ],
            [
                'id' => 62,
                'short' => 'strpos()',
                'detail' => 'strpos() finds the position (zero-based byte offset) of the first occurrence of a needle in a haystack. Returns false if not found. Because it can return 0 (found at position 0), always use strict comparison !== false. strrpos() finds the last occurrence. The third argument sets the search start offset. For case-insensitive search use stripos().',
                'code' => '$str = "Hello, World! Hello, PHP!";

// Basic search
$pos = strpos($str, "Hello");
var_dump($pos); // int(0)

// CRITICAL: strict comparison — avoid == false which treats 0 as false
if (strpos($str, "Hello") !== false) {
    echo "Found!";
}

// Start offset — search from position 5
$pos = strpos($str, "Hello", 5);
echo $pos; // 14

// Not found
var_dump(strpos($str, "Python")); // bool(false)

// Case-insensitive
$pos = stripos($str, "hello"); // 0

// Last occurrence
$pos = strrpos($str, "Hello"); // 14

// Practical: extract after a delimiter
$url  = "https://example.com/path?query=value";
$pos  = strpos($url, "?");
$path = $pos !== false ? substr($url, 0, $pos) : $url;
// "https://example.com/path"

// Modern alternative (PHP 8.0)
if (str_contains($str, "PHP")) {
    echo "Found PHP";
}',
                'doc_url' => 'https://www.php.net/manual/en/function.strpos.php',
            ],
            [
                'id' => 63,
                'short' => 'str_replace()',
                'detail' => 'str_replace() replaces all occurrences of a search string with a replacement in a subject string (or array). All three arguments can be arrays — if search and replace are arrays, they are paired by index. Case-insensitive variant: str_ireplace(). For pattern-based replacement use preg_replace().',
                'code' => '$str = "Hello, World! I love the World.";

// Simple replacement
$new = str_replace("World", "PHP", $str);
// "Hello, PHP! I love the PHP."

// Case-insensitive
$new = str_ireplace("world", "PHP", $str);

// Replace multiple — arrays
$search  = ["apple", "banana", "cherry"];
$replace = ["🍎", "🍌", "🍒"];
$text    = str_replace($search, $replace, "I like apple and banana");
// "I like 🍎 and 🍌"

// Replace with same replacement (sanitize list)
$clean = str_replace(
    ["<script>", "</script>", "javascript:"],
    "",
    $userInput
);

// Count replacements with 4th argument
$count = 0;
str_replace("the", "THE", "the cat sat on the mat", $count);
echo $count; // 2

// Subject can be an array
$lines = ["Hello World", "World Cup"];
$new   = str_replace("World", "PHP", $lines);
// ["Hello PHP", "PHP Cup"]',
                'doc_url' => 'https://www.php.net/manual/en/function.str-replace.php',
            ],
            [
                'id' => 64,
                'short' => 'substr()',
                'detail' => 'substr() returns a part of a string. The offset can be negative (counts from end). Length can be negative (excludes that many characters from the end). Returns false if offset is beyond string length in PHP < 8, empty string in PHP 8+. For multibyte strings use mb_substr().',
                'code' => '$str = "Hello, World!";

// From offset to end
echo substr($str, 7);       // "World!"

// With length
echo substr($str, 7, 5);    // "World"

// Negative offset — from end
echo substr($str, -6);      // "World!"
echo substr($str, -6, 5);   // "World"

// Negative length — exclude from end
echo substr($str, 0, -1);   // "Hello, World"
echo substr($str, 7, -1);   // "World"

// PHP 8: returns "" instead of false when out of range
echo substr("abc", 10);     // ""

// Multibyte — ALWAYS use mb_substr for non-ASCII
$utf = "Héllo Wörld";
echo substr($utf, 0, 5);    // "H\xc3" (broken bytes!)
echo mb_substr($utf, 0, 5, "UTF-8"); // "Héllo" (correct)

// Extract file extension
$file = "document.pdf";
$ext  = substr($file, strrpos($file, ".") + 1); // "pdf"
// Better: pathinfo($file, PATHINFO_EXTENSION)

// Trim specific number of chars from start/end
$trimmed = substr($str, 2, -2); // removes 2 from each end',
                'doc_url' => 'https://www.php.net/manual/en/function.substr.php',
            ],
            [
                'id' => 65,
                'short' => 'strtolower()',
                'detail' => 'strtolower() converts a string to lowercase. strtoupper() converts to uppercase. Both operate on bytes and only affect ASCII letters (A-Z). For proper multibyte/Unicode case conversion use mb_strtolower() and mb_strtoupper() with the appropriate encoding.',
                'code' => 'echo strtolower("Hello WORLD 123!"); // "hello world 123!"
echo strtoupper("Hello World");      // "HELLO WORLD"

// Only ASCII is affected
$czech = "Žluté auto"; // UTF-8 multibyte
echo strtolower($czech);              // "Žluté auto" — Ž unchanged!
echo mb_strtolower($czech, "UTF-8"); // "žluté auto"  — correct

// ucfirst — uppercase first char only
echo ucfirst("hello world"); // "Hello world"

// ucwords — uppercase first char of each word
echo ucwords("hello world foo"); // "Hello World Foo"

// Case-insensitive comparison
$a = "Admin";
$b = "admin";
echo ($a === $b) ? "same" : "different";                    // different
echo (strtolower($a) === strtolower($b)) ? "same" : "diff"; // same

// Normalize user input
$email = strtolower(trim($_POST["email"] ?? ""));
// "USER@EXAMPLE.COM" → "user@example.com"

// Practical: case-insensitive route matching
$route = strtolower($_SERVER["REQUEST_URI"]);',
                'doc_url' => 'https://www.php.net/manual/en/function.strtolower.php',
            ],
            [
                'id' => 66,
                'short' => 'trim()',
                'detail' => 'trim() removes whitespace (or specified characters) from both ends of a string. ltrim() removes from the left; rtrim() (alias chop()) from the right. The second argument specifies a list of characters to strip — defaults to space, tab, newline, carriage return, null byte, and vertical tab.',
                'code' => '// Default — strips whitespace from both ends
echo trim("  Hello World  ");  // "Hello World"
echo trim("\t\n hello \r\n"); // "hello"

// ltrim and rtrim
echo ltrim("   hello");   // "hello"
echo rtrim("hello   ");   // "hello"

// Custom character list — strip specific chars
echo trim("/path/to/dir/", "/");    // "path/to/dir"
echo trim("...hello...", ".");       // "hello"
echo ltrim("000123", "0");          // "123"

// IMPORTANT: does not strip arbitrary Unicode whitespace
// Use preg_replace for full Unicode whitespace trimming:
$clean = preg_replace("/^\s+|\s+$/u", "", $str);

// Practical: sanitize user input
function sanitizeInput(string $value): string {
    return trim(htmlspecialchars($value, ENT_QUOTES, "UTF-8"));
}

// Process CSV rows where values may have spaces
$csv  = " Alice , 30 , Prague ";
$data = array_map("trim", explode(",", $csv));
// ["Alice", "30", "Prague"]',
                'doc_url' => 'https://www.php.net/manual/en/function.trim.php',
            ],
            [
                'id' => 67,
                'short' => 'explode()',
                'detail' => 'explode() splits a string into an array by a delimiter. The optional limit argument controls the maximum number of pieces — if negative, all but the last |limit| pieces are returned. The inverse is implode(). If the delimiter is not found, an array with the original string is returned.',
                'code' => '$csv  = "apple,banana,cherry,date";
$tags = "php, javascript, python"; // with spaces

// Basic split
$fruits = explode(",", $csv);
// ["apple", "banana", "cherry", "date"]

// Trim each element
$tagList = array_map("trim", explode(",", $tags));
// ["php", "javascript", "python"]

// Limit — max 3 pieces, last one gets the rest
$parts = explode(",", $csv, 3);
// ["apple", "banana", "cherry,date"]

// Negative limit — omit last N pieces
$parts = explode(",", $csv, -1);
// ["apple", "banana", "cherry"] (last omitted)

// Split lines
$lines = explode("\n", $text);

// Split by multiple chars — use preg_split
$tokens = preg_split("/[\s,;]+/", "one, two; three four");
// ["one", "two", "three", "four"]

// Delimiter not found — returns full string in array
$result = explode("|", "no-pipe-here");
// ["no-pipe-here"]

// implode — join array into string
echo implode(" | ", $fruits); // "apple | banana | cherry | date"',
                'doc_url' => 'https://www.php.net/manual/en/function.explode.php',
            ],
            [
                'id' => 68,
                'short' => 'htmlspecialchars()',
                'detail' => 'htmlspecialchars() converts special HTML characters (<, >, &, ", \') into their HTML entities, preventing XSS (Cross-Site Scripting) attacks. Always use it before outputting user-provided data in HTML. Use ENT_QUOTES to encode both single and double quotes. htmlspecialchars_decode() reverses it. htmlentities() encodes all applicable characters.',
                'code' => '$userInput = \'<script>alert("XSS")</script> & "quotes" \'test\'\';

// Never output user input raw:
// echo $userInput; // XSS vulnerability!

// Safe output:
echo htmlspecialchars($userInput, ENT_QUOTES, "UTF-8");
// &lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt; &amp; &quot;quotes&quot; &#039;test&#039;

// ENT_QUOTES encodes both single and double quotes
// Always specify charset (UTF-8 recommended)

// HTML attributes — MUST escape
echo "<input value=\"" . htmlspecialchars($value, ENT_QUOTES, "UTF-8") . "\">";

// Reverse — entity to character
$html    = "&lt;p&gt;Hello&lt;/p&gt;";
$decoded = htmlspecialchars_decode($html, ENT_QUOTES);
// "<p>Hello</p>"

// htmlentities — encodes everything (accented chars too)
echo htmlentities("Héllo", ENT_QUOTES, "UTF-8");
// "H&eacute;llo"

// Practical helper
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
echo "<h1>" . e($title) . "</h1>";',
                'doc_url' => 'https://www.php.net/manual/en/function.htmlspecialchars.php',
            ],
            [
                'id' => 69,
                'short' => 'number_format()',
                'detail' => 'number_format() formats a number with grouped thousands and decimal places. It always returns a string. Arguments: number, decimals (default 0), decimal separator (default "."), thousands separator (default ","). Use it for display only — it rounds the number.',
                'code' => '$price   = 1234567.891;
$balance = -9876.5;

// Basic — rounds to 0 decimals
echo number_format($price);         // "1,234,568"

// Two decimal places
echo number_format($price, 2);      // "1,234,567.89"

// European format: decimal comma, space thousands
echo number_format($price, 2, ",", " "); // "1 234 567,89"

// Czech format
echo number_format($price, 2, ",", "."); // "1.234.567,89"

// No thousands separator
echo number_format($price, 2, ".", ""); // "1234567.89"

// Currency formatting
function formatMoney(float $amount, string $currency = "USD"): string {
    return $currency . " " . number_format(abs($amount), 2);
}
echo formatMoney($price);       // "USD 1,234,567.89"
echo formatMoney($balance);     // "USD 9,876.50"

// Percentage
$ratio = 0.12345;
echo number_format($ratio * 100, 1) . "%"; // "12.3%"

// NOTE: use bcmath or intl for precise monetary arithmetic
$precise = number_format(round($amount * 100) / 100, 2);',
                'doc_url' => 'https://www.php.net/manual/en/function.number-format.php',
            ],
            [
                'id' => 70,
                'short' => 'round()',
                'detail' => 'round() rounds a float to a given number of decimal places (default 0). The mode argument controls rounding behavior: PHP_ROUND_HALF_UP (default), PHP_ROUND_HALF_DOWN, PHP_ROUND_HALF_EVEN (banker\'s rounding), PHP_ROUND_HALF_ODD. ceil() always rounds up; floor() always rounds down.',
                'code' => '// Basic rounding
echo round(4.5);     // 5
echo round(4.4);     // 4
echo round(-4.5);    // -5  (rounds away from zero)

// Decimal places
echo round(3.14159, 2); // 3.14
echo round(3.145,   2); // 3.15

// Negative precision — round to nearest 10, 100, etc.
echo round(1234, -2); // 1200
echo round(1250, -2); // 1300

// Rounding modes
echo round(2.5, 0, PHP_ROUND_HALF_UP);   // 3 (default)
echo round(2.5, 0, PHP_ROUND_HALF_DOWN); // 2
echo round(2.5, 0, PHP_ROUND_HALF_EVEN); // 2 (banker\'s rounding)
echo round(3.5, 0, PHP_ROUND_HALF_EVEN); // 4

// ceil and floor
echo ceil(4.1);   // 5  — always up
echo ceil(4.9);   // 5
echo floor(4.9);  // 4  — always down
echo floor(4.1);  // 4

// Financial rounding — avoid floats, use integer cents
$price  = 9.995; // float imprecision
echo round($price, 2);  // might be 9.99 or 10.00

// Better: work in cents
$cents = (int)round($price * 100); // 1000 cents = $10.00',
                'doc_url' => 'https://www.php.net/manual/en/function.round.php',
            ],
            [
                'id' => 71,
                'short' => 'random_int()',
                'detail' => 'random_int() (PHP 7.0) generates a cryptographically secure pseudo-random integer between min and max (inclusive). Unlike rand() and mt_rand() which use predictable PRNGs, random_int() uses the OS\'s CSPRNG (getrandom, /dev/urandom, CryptGenRandom). Always use it for security-sensitive contexts like tokens, passwords, and CSRF values.',
                'code' => '// Cryptographically secure random integer
$n = random_int(1, 100);     // Random between 1 and 100 inclusive
$n = random_int(0, PHP_INT_MAX);

// Dice roll simulator
function rollDice(int $sides = 6): int {
    return random_int(1, $sides);
}
echo rollDice();    // 1-6
echo rollDice(20);  // 1-20

// Secure token generation
function generateToken(int $length = 32): string {
    $bytes = random_bytes($length);
    return bin2hex($bytes); // 64 hex chars for 32 bytes
}
$token = generateToken(); // "a3f8c2..."

// Random array element (secure)
function randomElement(array $arr): mixed {
    $index = random_int(0, count($arr) - 1);
    return $arr[$index];
}

// Shuffle securely using Fisher-Yates
function secureShufle(array $arr): array {
    for ($i = count($arr) - 1; $i > 0; $i--) {
        $j = random_int(0, $i);
        [$arr[$i], $arr[$j]] = [$arr[$j], $arr[$i]];
    }
    return $arr;
}

// NOT suitable for security (predictable):
// rand(), mt_rand(), array_rand(), shuffle()',
                'doc_url' => 'https://www.php.net/manual/en/function.random-int.php',
            ],
            [
                'id' => 72,
                'short' => 'DateTime',
                'detail' => 'DateTime is an OOP class for date and time manipulation. DateTimeImmutable (preferred) never modifies itself — modify() and other methods return a new instance. Supports timezone handling via DateTimeZone, date arithmetic via DateInterval, and precise parsing via createFromFormat().',
                'code' => '// Mutable — modifies itself (avoid)
$dt = new DateTime("now");
$dt->modify("+1 day");

// Immutable — PREFERRED — returns new instance
$now  = new DateTimeImmutable("now");
$then = $now->modify("+7 days");
echo $now->format("Y-m-d");  // unchanged
echo $then->format("Y-m-d"); // +7 days

// Timezone
$utc    = new DateTimeImmutable("now", new DateTimeZone("UTC"));
$prague = $utc->setTimezone(new DateTimeZone("Europe/Prague"));
echo $prague->format("Y-m-d H:i:s P"); // local time with offset

// Parse custom format
$dt = DateTimeImmutable::createFromFormat("d/m/Y H:i", "25/12/2024 08:30");
echo $dt->format("Y-m-d H:i:s"); // "2024-12-25 08:30:00"

// Date arithmetic with DateInterval
$start = new DateTimeImmutable("2024-01-01");
$end   = new DateTimeImmutable("2024-06-15");
$diff  = $start->diff($end);
echo $diff->days;    // 166
echo $diff->months;  // 5

// Add/sub intervals
$dt = new DateTimeImmutable("2024-01-31");
echo $dt->add(new DateInterval("P1M"))->format("Y-m-d"); // 2024-03-02
echo $dt->modify("+1 month")->format("Y-m-d");           // 2024-03-02',
                'doc_url' => 'https://www.php.net/manual/en/class.datetime.php',
            ],
            [
                'id' => 73,
                'short' => 'file_get_contents()',
                'detail' => 'file_get_contents() reads an entire file into a string. It can also fetch URLs via HTTP when allow_url_fopen is enabled (use cURL for production HTTP requests). The optional context argument allows setting headers, timeouts, and SSL options. Use file() to get lines as an array, or SplFileObject for large files.',
                'code' => '// Read a local file
$content = file_get_contents("/var/www/config.json");
$config  = json_decode($content, true);

// Error handling — returns false on failure
$data = file_get_contents("/path/to/file.txt");
if ($data === false) {
    throw new RuntimeException("Could not read file");
}

// Read with stream context (timeout, headers)
$context = stream_context_create([
    "http" => [
        "timeout" => 5,
        "header"  => "Accept: application/json\r\n",
    ]
]);

// HTTP request (use cURL in production — more control)
$json = file_get_contents("https://api.example.com/data", false, $context);

// Write a file (inverse)
file_put_contents("/tmp/output.txt", "Hello World");

// Atomic write — write to temp, then rename
$tmp = "/tmp/config." . uniqid();
file_put_contents($tmp, json_encode($config));
rename($tmp, "/etc/app/config.json"); // atomic swap

// Append to file
file_put_contents("/var/log/app.log", $line . "\n", FILE_APPEND | LOCK_EX);',
                'doc_url' => 'https://www.php.net/manual/en/function.file-get-contents.php',
            ],
            [
                'id' => 74,
                'short' => 'intval()',
                'detail' => 'intval() converts a value to an integer. The second argument specifies the base (default 10). It returns 0 for non-numeric strings. The casting (int) and (integer) are faster alternatives and should be preferred. intval() is useful when you need base conversion or want an explicit function call.',
                'code' => '// Basic conversion
var_dump(intval("42"));        // int(42)
var_dump(intval("42.7"));      // int(42)
var_dump(intval("0x1A", 16));  // int(26) — hex
var_dump(intval("0b1010", 2)); // int(10) — binary
var_dump(intval("010", 8));    // int(8)  — octal
var_dump(intval("42abc"));     // int(42) — stops at non-numeric
var_dump(intval("abc"));       // int(0)
var_dump(intval(true));        // int(1)
var_dump(intval(null));        // int(0)

// Cast (preferred — faster)
$id = (int)$_GET["id"];        // same as intval($_GET["id"])

// Safe ID extraction
function getId(mixed $val): int {
    $id = (int)$val;
    if ($id <= 0) throw new InvalidArgumentException("Invalid ID");
    return $id;
}

// Type juggling awareness
var_dump((int)"0");   // 0
var_dump((int)"");    // 0
var_dump((int)false); // 0
var_dump((int)true);  // 1
var_dump((int)null);  // 0

// floatval/doubleval — same idea for floats
$price = floatval("9.99 USD"); // 9.99',
                'doc_url' => 'https://www.php.net/manual/en/function.intval.php',
            ],
            [
                'id' => 75,
                'short' => 'gettype()',
                'detail' => 'gettype() returns the type of a variable as a string: "boolean", "integer", "double", "string", "array", "object", "resource", "NULL", "unknown type". For type checking in code, the is_*() family of functions (is_int, is_string, etc.) is preferred — they are faster, more readable, and work well in conditionals.',
                'code' => '$values = [42, 3.14, "hello", true, null, [], new stdClass()];

foreach ($values as $v) {
    echo gettype($v) . "\n";
}
// integer, double, string, boolean, NULL, array, object

// is_*() functions — preferred for checks
var_dump(is_int(42));          // true
var_dump(is_float(3.14));      // true
var_dump(is_string("hi"));     // true
var_dump(is_bool(false));      // true
var_dump(is_null(null));       // true
var_dump(is_array([]));        // true
var_dump(is_object(new stdClass())); // true
var_dump(is_numeric("42"));    // true (numeric string)
var_dump(is_numeric("42.5"));  // true
var_dump(is_numeric("42abc")); // false
var_dump(is_callable("strlen")); // true

// get_debug_type (PHP 8.0) — more precise for objects
$dt = new DateTime();
echo gettype($dt);          // "object" — not very useful
echo get_debug_type($dt);   // "DateTime" — full class name

// instanceof — check object type
if ($dt instanceof DateTimeInterface) {
    echo "it\'s a date";
}',
                'doc_url' => 'https://www.php.net/manual/en/function.gettype.php',
            ],
            [
                'id' => 76,
                'short' => 'final',
                'detail' => 'The final keyword on a class prevents it from being extended (subclassed). On a method, it prevents it from being overridden in subclasses. It is useful for enforcing design contracts, protecting security-critical code, and enabling certain performance optimizations. PHP 8.2 added final class constants.',
                'code' => '// Final class — cannot be extended
final class Singleton {
    private static ?self $instance = null;

    private function __construct(private string $config) {}

    public static function getInstance(string $config = ""): self {
        return self::$instance ??= new self($config);
    }
}

// class ExtendedSingleton extends Singleton {} // Fatal error

// Final method — can extend class, but not override method
class BaseController {
    final public function dispatch(Request $req): Response {
        // Security-critical routing — must not be overrideable
        $this->authenticate($req);
        return $this->handle($req);
    }

    protected function handle(Request $req): Response {
        return new Response("ok"); // Override this, not dispatch
    }
}

class UserController extends BaseController {
    protected function handle(Request $req): Response {
        return new Response("user data");
    }
    // Cannot override dispatch() — final
}

// PHP 8.2: final class constant
class Config {
    final const VERSION = "1.0.0"; // Cannot be overridden in subclasses
}',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.final.php',
            ],
            [
                'id' => 77,
                'short' => 'clone',
                'detail' => 'The clone keyword creates a shallow copy of an object. Primitive properties are copied by value; object properties are copied by reference (both copies point to the same object). Override __clone() to implement deep cloning. Immutable value objects should be cloned with modified properties rather than mutating the original.',
                'code' => 'class Config {
    public array  $settings = [];
    public Logger $logger;

    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    // Deep clone — called automatically after clone
    public function __clone() {
        // Primitive values (settings array) are already deep copied.
        // Objects need explicit cloning:
        $this->logger = clone $this->logger;
    }
}

$original = new Config(new Logger());
$original->settings = ["debug" => true];

$copy = clone $original;
$copy->settings["debug"] = false;

echo $original->settings["debug"] ? "true" : "false"; // true — unaffected
echo ($original->logger === $copy->logger) ? "same" : "different"; // different

// Immutable value object pattern
class Money {
    public function __construct(
        public readonly int    $amount,
        public readonly string $currency,
    ) {}

    public function withAmount(int $amount): self {
        $clone = clone $this;
        // Cannot set readonly directly; use reflection or a workaround:
        return new self($amount, $this->currency);
    }
}

$price    = new Money(100, "USD");
$discount = new Money($price->amount - 10, $price->currency);',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.cloning.php',
            ],
            [
                'id' => 78,
                'short' => '__toString()',
                'detail' => 'The __toString() magic method defines how an object is converted to a string, for example when echo\'d or concatenated. It must return a string. PHP 8.0 also casts objects to strings in most string contexts automatically if __toString() is defined. The Stringable interface (PHP 8.0) is automatically implemented by any class with __toString().',
                'code' => 'class Money {
    public function __construct(
        private int    $cents,
        private string $currency = "USD"
    ) {}

    public function __toString(): string {
        return sprintf("%s %.2f", $this->currency, $this->cents / 100);
    }
}

$price = new Money(1999, "USD");
echo $price;                      // "USD 19.99"
echo "Total: " . $price;          // "Total: USD 19.99"
$str = (string) $price;           // "USD 19.99"

// PHP 8.0: Stringable interface (auto-implemented)
function printLabel(Stringable|string $label): void {
    echo (string) $label;
}
printLabel($price);       // "USD 19.99"
printLabel("raw string"); // "raw string"

// Common use cases
class Route {
    public function __construct(
        private string $method,
        private string $path
    ) {}

    public function __toString(): string {
        return "{$this->method} {$this->path}";
    }
}

class Collection {
    private array $items;
    public function __toString(): string {
        return "[" . implode(", ", $this->items) . "]";
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.magic.php#object.tostring',
            ],
            [
                'id' => 79,
                'short' => '__invoke()',
                'detail' => 'The __invoke() magic method allows an object to be called as a function. When you call $obj($args), PHP calls $obj->__invoke($args). Objects with __invoke() are callable — is_callable() returns true for them. They are useful as single-action classes, middleware handlers, and stateful callables that retain configuration.',
                'code' => 'class Multiplier {
    public function __construct(private int $factor) {}

    public function __invoke(int $value): int {
        return $value * $this->factor;
    }
}

$double = new Multiplier(2);
$triple = new Multiplier(3);

echo $double(5);  // 10
echo $triple(5);  // 15

// Is callable
var_dump(is_callable($double)); // true

// Use as array_map callback
$numbers = [1, 2, 3, 4, 5];
$doubled = array_map($double, $numbers);
// [2, 4, 6, 8, 10]

// Middleware pipeline pattern
class AuthMiddleware {
    public function __invoke(Request $req, callable $next): Response {
        if (!$req->hasHeader("Authorization")) {
            return new Response(401, "Unauthorized");
        }
        return $next($req);
    }
}

// Single-action controller pattern (Laravel/Slim)
class ShowDashboard {
    public function __invoke(Request $req, Response $res): Response {
        $res->getBody()->write("<h1>Dashboard</h1>");
        return $res;
    }
}
$app->get("/dashboard", new ShowDashboard());',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.magic.php#object.invoke',
            ],
            [
                'id' => 80,
                'short' => 'anonymous class',
                'detail' => 'Anonymous classes (PHP 7.0) are classes without a name, created inline with new class { }. They can extend classes, implement interfaces, and use traits. They are useful for one-off objects, test mocks, and implementing interfaces without creating a full named class. PHP generates an internal name for them at runtime.',
                'code' => 'interface Logger {
    public function log(string $message): void;
}

// Named class approach — requires a separate definition
class EchoLogger implements Logger {
    public function log(string $message): void { echo $message; }
}

// Anonymous class — defined and instantiated inline
$logger = new class implements Logger {
    public function log(string $message): void {
        echo "[" . date("H:i:s") . "] " . $message . "\n";
    }
};

$logger->log("Application started"); // [09:30:00] Application started

// Extend + implement
$service = new class(new PDO("sqlite::memory:")) extends BaseService implements Cacheable {
    public function getCacheKey(): string { return "anon"; }
    public function getTtl(): int        { return 60; }
};

// Useful in tests
function testWithMock(): void {
    $mailer = new class {
        public array $sent = [];
        public function send(string $to, string $subject): void {
            $this->sent[] = compact("to", "subject");
        }
    };

    $userService = new UserService($mailer);
    $userService->register("alice@example.com");

    assert(count($mailer->sent) === 1);
    assert($mailer->sent[0]["to"] === "alice@example.com");
}',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.anonymous.php',
            ],
            [
                'id' => 81,
                'short' => 'first-class callable',
                'detail' => 'First-class callable syntax (PHP 8.1) creates a Closure from any callable using the ... syntax: strlen(...). It replaces verbose Closure::fromCallable() and string function references. The resulting closure is properly typed, IDE-friendly, and refactoring-safe.',
                'code' => '// Before PHP 8.1
$fn = Closure::fromCallable("strlen");
$fn = fn($s) => strlen($s); // arrow function workaround

// PHP 8.1: first-class callable syntax
$fn = strlen(...);
echo $fn("hello"); // 5

// Works with any callable
$fn     = strtoupper(...);         // built-in function
$fn     = $obj->method(...);       // instance method
$fn     = MyClass::staticMethod(...); // static method
$fn     = [$obj, "method"](...);   // callable array

// Type-safe and IDE-friendly
$names  = ["charlie", "alice", "bob"];
$upper  = array_map(strtoupper(...), $names);
// ["CHARLIE", "ALICE", "BOB"]

$lengths = array_map(strlen(...), $names);
// [7, 5, 3]

usort($names, strcmp(...));
// ["alice", "bob", "charlie"]

// Compose functions
function compose(callable ...$fns): Closure {
    return function($x) use ($fns) {
        return array_reduce(
            array_reverse($fns),
            fn($carry, $fn) => $fn($carry),
            $x
        );
    };
}

$process = compose(strtoupper(...), trim(...));
echo $process("  hello  "); // "HELLO"',
                'doc_url' => 'https://www.php.net/manual/en/functions.first_class_callable_syntax.php',
            ],
            [
                'id' => 82,
                'short' => 'never type',
                'detail' => 'The never return type (PHP 8.1) declares that a function never returns normally — it either throws an exception, calls exit/die, or contains an infinite loop. It is the bottom type in the type hierarchy. A function returning never is a subtype of every other return type. Useful for abort helpers, redirect functions, and documenting that execution stops.',
                'code' => '// never — function NEVER returns to the caller
function abort(int $code, string $message = ""): never {
    http_response_code($code);
    echo $message;
    exit; // or throw — must terminate execution
}

function redirectTo(string $url): never {
    header("Location: $url");
    exit;
}

function throwNotFound(string $msg = "Not found"): never {
    throw new NotFoundException($msg);
}

// Using never-typed helpers
function findOrFail(int $id): array {
    $row = $db->find($id);
    if ($row === null) {
        throwNotFound("Item $id not found"); // never — control stops here
    }
    return $row; // PHP knows this is always reached if no exception
}

// never is a subtype of all types — useful with generics/templates
function alwaysThrows(): never {
    throw new LogicException("This should not be called");
}

// Static analysis: PhpStan/Psalm understand never
function process(?User $user): string {
    if ($user === null) {
        abort(401, "Not authenticated"); // never — so no return needed
    }
    return $user->name; // always reached (static analysis knows this)
}',
                'doc_url' => 'https://www.php.net/manual/en/language.types.never.php',
            ],
            [
                'id' => 83,
                'short' => 'intersection types',
                'detail' => 'Intersection types (PHP 8.1) require a value to satisfy ALL of the specified types simultaneously, using the & operator. This is useful when a parameter must implement multiple interfaces. Unlike union types (|) which accept one of many types, intersection types demand all. DNF types (PHP 8.2) combine both: (A&B)|C.',
                'code' => 'interface Countable {
    public function count(): int;
}

interface Iterable_ {
    public function toArray(): array;
}

interface Serializable_ {
    public function serialize(): string;
}

// Intersection type — MUST implement ALL interfaces
function process(Countable&Iterable_ $collection): void {
    echo "Count: " . $collection->count();
    foreach ($collection->toArray() as $item) {
        echo $item;
    }
}

class MyCollection implements Countable, Iterable_ {
    private array $items;
    public function count(): int       { return count($this->items); }
    public function toArray(): array   { return $this->items; }
}

process(new MyCollection()); // OK
// process(new stdClass()); // TypeError — doesn\'t implement both

// PHP 8.2 DNF (Disjunctive Normal Form) types
// Accept: (Countable AND Iterable_) OR plain array
function processAny((Countable&Iterable_)|array $data): void {
    $items = is_array($data) ? $data : $data->toArray();
    foreach ($items as $item) { /* ... */ }
}

// Intersection type property
class Repository {
    public function __construct(
        private Countable&Iterable_ $collection
    ) {}
}',
                'doc_url' => 'https://www.php.net/manual/en/language.types.declarations.php#language.types.declarations.intersection',
            ],
            [
                'id' => 84,
                'short' => 'ob_start()',
                'detail' => 'Output buffering functions capture PHP output instead of sending it to the browser. ob_start() begins buffering; ob_get_clean() retrieves and clears the buffer; ob_end_clean() discards; ob_flush() sends the buffer. They are used in templating, testing output, manipulating headers after output, and performance (sending gzipped responses).',
                'code' => '// Capture output into a variable
ob_start();
echo "Hello, World!";
echo " More content.";
$output = ob_get_clean(); // "Hello, World! More content."
// Nothing was sent to the browser

// Use case: template rendering
function renderTemplate(string $file, array $data): string {
    extract($data);
    ob_start();
    include $file;
    return ob_get_clean();
}

$html = renderTemplate("views/user.php", [
    "name" => "Alice",
    "age"  => 30,
]);
// $html contains the rendered template as a string

// Nested buffering
ob_start();             // Level 1
    ob_start();         // Level 2
    echo "inner";
    $inner = ob_get_clean(); // "inner"
echo "outer: $inner";
$outer = ob_get_clean(); // "outer: inner"

// Set a header AFTER output has started (by buffering from the start)
ob_start();
// ... lots of output ...
if ($shouldRedirect) {
    ob_end_clean();           // Discard all output
    header("Location: /new");
    exit;
}
ob_end_flush(); // Send buffer to browser',
                'doc_url' => 'https://www.php.net/manual/en/function.ob-start.php',
            ],
            [
                'id' => 85,
                'short' => 'mb_strlen()',
                'detail' => 'The mbstring (multibyte string) extension provides string functions that are aware of character encoding. mb_strlen() counts characters, not bytes. mb_substr(), mb_strpos(), mb_strtolower(), mb_strtoupper() all work character-by-character. Always use mb_* functions when dealing with UTF-8 or any non-ASCII text.',
                'code' => '// strlen counts bytes; mb_strlen counts characters
$str = "Héllo Wörld"; // UTF-8: é=2 bytes, ö=2 bytes

echo strlen($str);             // 13 (bytes)
echo mb_strlen($str, "UTF-8"); // 11 (characters)

$emoji = "Hello 🌍";          // 🌍 = 4 bytes
echo strlen($emoji);            // 10
echo mb_strlen($emoji, "UTF-8"); // 7

// mb_substr — character-based
echo substr($str, 0, 5);              // "H\xc3\xa9ll" (broken)
echo mb_substr($str, 0, 5, "UTF-8"); // "Héllo" (correct)

// mb_strpos
echo strpos($str, "ö");              // 8 (byte position, wrong context)
echo mb_strpos($str, "ö", 0, "UTF-8"); // 7 (character position)

// mb_strtolower / mb_strtoupper
$czech = "Žluté Auto";
echo strtolower($czech);              // "Žluté auto" (Ž not lowercased)
echo mb_strtolower($czech, "UTF-8"); // "žluté auto" (correct)

// Set default encoding once
mb_internal_encoding("UTF-8");
// Then can omit encoding argument:
echo mb_strlen($str); // 11

// mb_str_split (PHP 7.4) — split into character array
$chars = mb_str_split("Héllo", 1, "UTF-8");
// ["H", "é", "l", "l", "o"]',
                'doc_url' => 'https://www.php.net/manual/en/book.mbstring.php',
            ],
            [
                'id' => 86,
                'short' => 'base64_encode()',
                'detail' => 'base64_encode() encodes binary data using the Base64 alphabet (A-Z, a-z, 0-9, +, /), making it safe for transmission in contexts that only support ASCII text (email, JSON, URLs, CSS). base64_decode() reverses it. For URLs use strtr($encoded, \'+/\', \'-_\') to get URL-safe Base64, or use the sodium_bin2base64() function.',
                'code' => '// Encode binary data as ASCII-safe string
$binary  = file_get_contents("/path/to/image.png");
$encoded = base64_encode($binary);
// "iVBORw0KGgoAAAANSUhEUgAA..."

// Embed image in HTML
echo "<img src=\"data:image/png;base64,$encoded\">";

// Encode a JSON payload for a JWT-like token (simplified)
$header  = base64_encode(json_encode(["alg"=>"HS256","typ"=>"JWT"]));
$payload = base64_encode(json_encode(["sub"=>42,"exp"=>time()+3600]));

// Decode
$decoded = base64_decode($encoded);
var_dump($decoded === $binary); // true

// Strict mode — returns false for invalid input
$result = base64_decode("not valid base64!!", true);
var_dump($result); // false

// URL-safe Base64 (no +, /, = chars)
function base64UrlEncode(string $data): string {
    return rtrim(strtr(base64_encode($data), "+/", "-_"), "=");
}

function base64UrlDecode(string $data): string {
    return base64_decode(strtr($data, "-_", "+/")
        . str_repeat("=", 3 - (strlen($data) + 3) % 4));
}',
                'doc_url' => 'https://www.php.net/manual/en/function.base64-encode.php',
            ],
            [
                'id' => 87,
                'short' => 'intdiv()',
                'detail' => 'intdiv() (PHP 7.0) performs integer division and always returns an integer. It is equivalent to (int)($a / $b) but throws DivisionByZeroError if the divisor is zero, and ArithmeticError if the result overflows int range (PHP_INT_MIN / -1). Use fmod() for floating-point modulo.',
                'code' => '// Integer division — no floating point
echo intdiv(10, 3);   // 3  (not 3.333...)
echo intdiv(7, 2);    // 3
echo intdiv(-7, 2);   // -3 (truncated towards zero)
echo intdiv(7, -2);   // -3

// Equivalent to:
echo (int)(7 / 2);    // 3

// Division by zero throws error (PHP 8)
try {
    echo intdiv(10, 0);
} catch (\DivisionByZeroError $e) {
    echo "Cannot divide by zero";
}

// Modulo operator % for remainder
echo 10 % 3; // 1
echo -7 % 2; // -1 (sign follows dividend)

// fmod() for floating-point modulo
echo fmod(10.5, 3.2); // 0.9

// Practical: distribute items into pages
function paginate(int $total, int $perPage): array {
    $pages    = intdiv($total, $perPage);
    $leftover = $total % $perPage;
    if ($leftover > 0) $pages++;
    return ["pages" => $pages, "remainder" => $leftover];
}

echo intdiv(7, 2);    // 3 pages of 2 = 3 (with 1 leftover)

// Time conversion
$seconds = 3723;
$hours   = intdiv($seconds, 3600);   // 1
$minutes = intdiv($seconds % 3600, 60); // 2
$secs    = $seconds % 60;             // 3',
                'doc_url' => 'https://www.php.net/manual/en/function.intdiv.php',
            ],
            [
                'id' => 88,
                'short' => 'is_numeric()',
                'detail' => 'is_numeric() returns true if the variable is a number or a numeric string (allows leading whitespace, +/- signs, decimal points, and scientific notation). It does NOT ensure integer range or format. Use filter_var($v, FILTER_VALIDATE_INT) for strict integer validation or ctype_digit() for digit-only strings.',
                'code' => '// Returns true for numbers and numeric strings
var_dump(is_numeric(42));       // true
var_dump(is_numeric(3.14));     // true
var_dump(is_numeric("42"));     // true
var_dump(is_numeric("42.5"));   // true
var_dump(is_numeric("1e5"));    // true  (scientific notation)
var_dump(is_numeric("+42"));    // true
var_dump(is_numeric("-42"));    // true
var_dump(is_numeric("  42 ")); // true  (leading/trailing spaces)

var_dump(is_numeric("42abc")); // false
var_dump(is_numeric("abc"));   // false
var_dump(is_numeric("0x1A"));  // false (hex — PHP no longer accepts)
var_dump(is_numeric(""));      // false
var_dump(is_numeric(null));    // false

// Alternatives for stricter validation
$v = "042";
var_dump(is_numeric($v));                              // true
var_dump(ctype_digit($v));                             // true (digits only, no sign/decimal)
var_dump(filter_var($v, FILTER_VALIDATE_INT) !== false); // true (strict int)

// Practical: safe numeric input handling
function safeNumeric(mixed $v): int|float|null {
    if (!is_numeric($v)) return null;
    return $v + 0; // cast to int or float
}',
                'doc_url' => 'https://www.php.net/manual/en/function.is-numeric.php',
            ],
            [
                'id' => 89,
                'short' => 'array_fill()',
                'detail' => 'array_fill() creates an array filled with a given value, starting at a specified index. array_fill_keys() creates an array using supplied keys and fills each with the same value. Both are useful for initialising arrays, creating lookup tables, and generating test data.',
                'code' => '// Fill with value, starting at index 0
$zeros = array_fill(0, 5, 0);
// [0, 0, 0, 0, 0]

// Fill starting at a different index
$arr = array_fill(3, 4, "x");
// [3=>"x", 4=>"x", 5=>"x", 6=>"x"]

// Fill with complex value
$matrix = array_fill(0, 3, array_fill(0, 3, 0));
// 3×3 grid of zeros (careful: all rows share the same array reference)
// Use a loop for true independence:
$matrix = array_map(fn() => array_fill(0, 3, 0), range(0, 2));

// array_fill_keys — use provided keys
$keys    = ["name", "age", "email"];
$default = array_fill_keys($keys, null);
// ["name"=>null, "age"=>null, "email"=>null]

// Merge with actual data — defaults pattern
$data    = ["name" => "Alice"];
$record  = array_merge($default, $data);
// ["name"=>"Alice", "age"=>null, "email"=>null]

// Initialize counters for each day of the week
$days    = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
$visits  = array_fill_keys($days, 0);
// ["Mon"=>0, "Tue"=>0, ..., "Sun"=>0]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-fill.php',
            ],
            [
                'id' => 90,
                'short' => 'str_split()',
                'detail' => 'str_split() splits a string into an array of chunks of a given byte length (default 1). For Unicode/multibyte strings use mb_str_split() (PHP 7.4) which splits by character count. Useful for processing strings character by character, checksum algorithms, and formatting.',
                'code' => '// Split into individual characters (bytes)
$chars = str_split("Hello");
// ["H", "e", "l", "l", "o"]

// Split into chunks of 3
$chunks = str_split("HelloWorld", 3);
// ["Hel", "loW", "orl", "d"]

// Credit card number formatting
$cc      = "4111111111111111";
$groups  = str_split($cc, 4);
echo implode(" ", $groups); // "4111 1111 1111 1111"

// Iterate over characters
foreach (str_split($str) as $char) {
    echo ord($char) . " "; // ASCII code of each char
}

// IMPORTANT: works on bytes, not characters
$utf = "Héllo";
$chars = str_split($utf);
// Breaks multibyte characters!

// Use mb_str_split for Unicode (PHP 7.4+)
$chars = mb_str_split($utf, 1, "UTF-8");
// ["H", "é", "l", "l", "o"] — correct

// Count character frequencies
$freq = array_count_values(mb_str_split(strtolower($word)));
arsort($freq); // most frequent first',
                'doc_url' => 'https://www.php.net/manual/en/function.str-split.php',
            ],
            [
                'id' => 91,
                'short' => 'array_walk()',
                'detail' => 'array_walk() applies a user-defined callback to each element of an array in place, passing the element by reference along with its key. Unlike array_map(), it modifies the array directly and also passes the key. It returns true on success. For recursive traversal use array_walk_recursive().',
                'code' => '$prices = [
    "apple"  => 1.50,
    "banana" => 0.75,
    "cherry" => 2.00,
];

// Modify in place — callback receives (&$value, $key, $extra)
array_walk($prices, function(&$price, string $item): void {
    $price = round($price * 1.1, 2); // apply 10% tax
});
// ["apple"=>1.65, "banana"=>0.83, "cherry"=>2.20]

// Third argument passed to callback
$currency = "USD";
array_walk($prices, function(&$price, $key, $curr): void {
    $price = "$curr " . number_format($price, 2);
}, $currency);
// ["apple"=>"USD 1.65", ...]

// array_walk vs array_map
// array_map: returns new array, no key access, functional style
// array_walk: modifies in place, has key access, returns bool

// array_walk_recursive — applies to leaf elements only
$nested = ["a" => [1, 2], "b" => [3, [4, 5]]];
array_walk_recursive($nested, function(&$val): void {
    $val *= 10;
});
// ["a"=>[10,20], "b"=>[30,[40,50]]]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-walk.php',
            ],
            [
                'id' => 92,
                'short' => 'set_error_handler()',
                'detail' => 'set_error_handler() registers a custom callback to handle PHP errors (E_WARNING, E_NOTICE, etc.) instead of the default behaviour. It does not catch fatal errors — use register_shutdown_function() for those. The callback receives error level, message, file, and line. Return false to trigger the normal PHP error handler.',
                'code' => '// Convert all errors to exceptions (common pattern)
set_error_handler(function(
    int    $level,
    string $message,
    string $file,
    int    $line
): bool {
    // Only handle errors that match error_reporting level
    if (!(error_reporting() & $level)) {
        return false; // let PHP handle it
    }
    throw new ErrorException($message, 0, $level, $file, $line);
});

// Now warnings etc. throw exceptions
try {
    $result = file_get_contents("/nonexistent.txt");
} catch (ErrorException $e) {
    echo "Caught: " . $e->getMessage();
}

// Custom logging handler
set_error_handler(function(int $level, string $msg, string $file, int $line): bool {
    $map = [E_WARNING => "WARNING", E_NOTICE => "NOTICE", E_DEPRECATED => "DEPRECATED"];
    $label = $map[$level] ?? "ERROR($level)";
    error_log("[$label] $msg in $file:$line");
    return true; // suppress PHP default output
});

// Restore default handler
restore_error_handler();

// error_reporting — control which errors are reported
error_reporting(E_ALL);          // all errors (dev)
error_reporting(E_ALL & ~E_NOTICE); // all except notices',
                'doc_url' => 'https://www.php.net/manual/en/function.set-error-handler.php',
            ],
            [
                'id' => 93,
                'short' => 'str_pad()',
                'detail' => 'str_pad() pads a string to a given length with another string. The third argument is the padding string (default space). The fourth argument controls direction: STR_PAD_RIGHT (default), STR_PAD_LEFT, or STR_PAD_BOTH. Useful for formatting fixed-width text output, number formatting, and alignment.',
                'code' => 'echo str_pad("42", 5);               // "42   " — right pad (default)
echo str_pad("42", 5, "0", STR_PAD_LEFT);  // "00042" — zero-pad left
echo str_pad("hi", 10, "-", STR_PAD_BOTH); // "----hi----" — both sides

// Fixed-width table
$rows = [
    ["Alice", 30, "Admin"],
    ["Bob",   25, "Editor"],
    ["Carol", 28, "Viewer"],
];
foreach ($rows as [$name, $age, $role]) {
    echo str_pad($name, 10)
       . str_pad((string)$age, 5, " ", STR_PAD_LEFT)
       . str_pad($role, 10)
       . "\n";
}
// "Alice         30Admin     "
// "Bob           25Editor    "

// Invoice number formatting
$id = 42;
echo "INV-" . str_pad($id, 6, "0", STR_PAD_LEFT); // "INV-000042"

// Progress bar
function progressBar(int $done, int $total, int $width = 30): string {
    $pct   = $done / $total;
    $filled = (int)round($pct * $width);
    $bar   = str_repeat("█", $filled) . str_repeat("░", $width - $filled);
    return sprintf("[%s] %3d%%", $bar, $pct * 100);
}',
                'doc_url' => 'https://www.php.net/manual/en/function.str-pad.php',
            ],
            [
                'id' => 94,
                'short' => 'glob()',
                'detail' => 'glob() finds pathnames matching a pattern using shell wildcards (* any chars, ? any one char, [seq] a character class, {a,b} brace expansion). Returns an array of matching paths or false on error. GLOB_BRACE enables {a,b} syntax; GLOB_ONLYDIR returns only directories.',
                'code' => '// Find all PHP files in a directory
$files = glob("/var/www/src/*.php");
foreach ($files as $file) {
    echo basename($file) . "\n";
}

// Recursive — match in all subdirectories
$files = glob("/var/www/**/*.php", GLOB_BRACE);

// Multiple extensions with GLOB_BRACE
$images = glob("/uploads/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);

// Only directories
$dirs = glob("/var/www/src/*", GLOB_ONLYDIR);

// Find config files
$configs = glob("/etc/app/*.{json,yaml,yml}", GLOB_BRACE);

// Autoloader example
foreach (glob(__DIR__ . "/src/*.php") as $file) {
    require_once $file;
}

// Count files by extension
$counts = [];
foreach (glob("/uploads/*.*") as $file) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $counts[$ext] = ($counts[$ext] ?? 0) + 1;
}
// ["jpg"=>5, "png"=>2, "pdf"=>1]

// Delete old temp files
foreach (glob("/tmp/cache_*") as $file) {
    if (filemtime($file) < time() - 3600) {
        unlink($file);
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/function.glob.php',
            ],
            [
                'id' => 95,
                'short' => 'microtime()',
                'detail' => 'microtime() returns the current Unix timestamp with microseconds. With true as argument it returns a float (seconds + microseconds). Use it for benchmarking and measuring execution time. For higher-resolution profiling use hrtime(true) which returns nanoseconds using a monotonic clock not affected by system clock changes.',
                'code' => '// Benchmark execution time
$start = microtime(true);

// ... code to measure ...
$data = array_map(fn($n) => $n * $n, range(1, 100000));

$elapsed = microtime(true) - $start;
printf("Executed in %.4f seconds\n", $elapsed);

// Simple Benchmark class
class Benchmark {
    private float $start;

    public function start(): void {
        $this->start = microtime(true);
    }

    public function stop(string $label = ""): float {
        $elapsed = microtime(true) - $this->start;
        if ($label) {
            echo sprintf("%s: %.4fs\n", $label, $elapsed);
        }
        return $elapsed;
    }
}

$bench = new Benchmark();
$bench->start();
someExpensiveOperation();
$bench->stop("Operation A");

// hrtime — monotonic clock, immune to NTP adjustments (PHP 7.3)
$start = hrtime(true);          // nanoseconds
doSomething();
$ns = hrtime(true) - $start;
printf("%.3f ms\n", $ns / 1e6); // convert to milliseconds

// Cache-busting timestamp
$version = (int)(microtime(true) * 1000); // milliseconds
echo "<script src=\"app.js?v=$version\"></script>";',
                'doc_url' => 'https://www.php.net/manual/en/function.microtime.php',
            ],
            [
                'id' => 96,
                'short' => 'array_diff()',
                'detail' => 'array_diff() computes the difference of arrays — it returns the values from the first array that are not present in any of the other arrays. Keys are preserved. array_diff_key() compares by keys; array_diff_assoc() compares both keys and values. array_intersect() returns the values present in ALL arrays.',
                'code' => '$all     = ["apple", "banana", "cherry", "date", "elderberry"];
$exclude = ["banana", "date"];

// Values in $all but NOT in $exclude
$diff = array_diff($all, $exclude);
// [0=>"apple", 2=>"cherry", 4=>"elderberry"]

// Re-index
$diff = array_values($diff);
// ["apple", "cherry", "elderberry"]

// Multiple arrays
$a = [1, 2, 3, 4, 5];
$b = [2, 4];
$c = [3];
$diff = array_diff($a, $b, $c); // [0=>1, 4=>5]

// array_diff_key — compare by keys
$full    = ["id"=>1, "name"=>"Alice", "password"=>"secret", "token"=>"abc"];
$public  = array_diff_key($full, array_flip(["password", "token"]));
// ["id"=>1, "name"=>"Alice"]

// array_intersect — values in ALL arrays
$a = ["apple", "banana", "cherry"];
$b = ["banana", "cherry", "date"];
$common = array_intersect($a, $b);
// [1=>"banana", 2=>"cherry"]

// Practical: find new/removed tags
$old = ["php", "mysql", "nginx"];
$new = ["php", "postgres", "docker"];
$added   = array_diff($new, $old); // ["postgres", "docker"]
$removed = array_diff($old, $new); // ["mysql", "nginx"]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-diff.php',
            ],
            [
                'id' => 97,
                'short' => 'password_hash()',
                'detail' => 'password_hash() creates a secure password hash using bcrypt (default), Argon2i, or Argon2id. It automatically generates a salt and embeds the algorithm, cost, and salt into the hash string. password_verify() checks a password against a hash. Never use md5() or sha1() for passwords.',
                'code' => '// Hash a password — NEVER store plaintext
$password = $_POST["password"];
$hash     = password_hash($password, PASSWORD_DEFAULT);
// "$2y$10$..." (bcrypt by default, ~60 chars)

// PASSWORD_DEFAULT uses bcrypt with cost 10
// Increases cost over time as hardware gets faster

// Verify
if (password_verify($password, $hash)) {
    echo "Password correct!";
} else {
    echo "Invalid password";
}

// Use Argon2id (PHP 7.3+, recommended for new projects)
$hash = password_hash($password, PASSWORD_ARGON2ID, [
    "memory_cost" => 65536, // 64 MB
    "time_cost"   => 4,     // 4 iterations
    "threads"      => 2,
]);

// Check if rehash needed (algorithm or cost changed)
if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // Update stored hash in database
}

// Complete login flow
function login(string $email, string $password): bool {
    $user = findUserByEmail($email);
    if (!$user) return false;

    if (!password_verify($password, $user["password_hash"])) {
        return false;
    }

    if (password_needs_rehash($user["password_hash"], PASSWORD_DEFAULT)) {
        updateHash($user["id"], password_hash($password, PASSWORD_DEFAULT));
    }

    session_regenerate_id(true);
    $_SESSION["user_id"] = $user["id"];
    return true;
}',
                'doc_url' => 'https://www.php.net/manual/en/function.password-hash.php',
            ],
            [
                'id' => 98,
                'short' => 'array_map() + null',
                'detail' => 'When array_map() receives null as the callback alongside multiple arrays, it zips the arrays together into a single array of sub-arrays (transposition for one-level arrays). This is the PHP equivalent of Python\'s zip() function. Each sub-array contains the corresponding elements from all input arrays.',
                'code' => '// Zip two arrays together
$names  = ["Alice", "Bob", "Carol"];
$scores = [95, 87, 92];

$combined = array_map(null, $names, $scores);
// [["Alice", 95], ["Bob", 87], ["Carol", 92]]

// Three arrays
$first  = [1, 2, 3];
$second = ["a", "b", "c"];
$third  = [true, false, true];

$zipped = array_map(null, $first, $second, $third);
// [[1,"a",true], [2,"b",false], [3,"c",true]]

// Combine into assoc arrays (zip + combine)
$headers = ["name", "score"];
$data    = array_map(
    fn($row) => array_combine($headers, $row),
    array_map(null, $names, $scores)
);
// [["name"=>"Alice","score"=>95], ...]

// Transpose a matrix (rows <-> columns)
$matrix = [[1,2,3],[4,5,6],[7,8,9]];
$transposed = array_map(null, ...$matrix);
// [[1,4,7],[2,5,8],[3,6,9]]

// If arrays have different lengths, shorter ones are padded with null
$a = [1, 2, 3];
$b = ["x", "y"];
$zipped = array_map(null, $a, $b);
// [[1,"x"], [2,"y"], [3,null]]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-map.php',
            ],
            [
                'id' => 99,
                'short' => 'preg_replace()',
                'detail' => 'preg_replace() performs a search-and-replace using a PCRE regular expression. The replacement can contain backreferences ($1 or \\1). preg_replace_callback() is more powerful — it runs a function for each match. preg_replace_callback_array() maps patterns to callbacks.',
                'code' => '$text = "Hello, World! The date is 2024-01-15.";

// Simple replacement
$result = preg_replace("/World/", "PHP", $text);
// "Hello, PHP! The date is 2024-01-15."

// Backreferences in replacement
$date = "2024-01-15";
$formatted = preg_replace(
    "/(\d{4})-(\d{2})-(\d{2})/",
    "$3.$2.$1",       // $1=year, $2=month, $3=day
    $date
);
// "15.01.2024"

// Remove all HTML tags
$clean = preg_replace("/<[^>]+>/", "", $html);

// Collapse multiple spaces
$clean = preg_replace("/\s+/", " ", trim($text));

// preg_replace_callback — function per match
$result = preg_replace_callback(
    "/\b(\w)/",                        // first letter of each word
    fn($m) => strtoupper($m[1]),       // capitalize it
    "hello world foo"
);
// "Hello World Foo"

// Replace multiple patterns at once
$result = preg_replace(
    ["/foo/", "/bar/", "/baz/"],
    ["FOO",   "BAR",   "BAZ"],
    "foo bar baz"
);
// "FOO BAR BAZ"

// Limit replacements with 4th argument
$result = preg_replace("/a/", "X", "banana", 2);
// "bXnXna" (only first 2 replaced)',
                'doc_url' => 'https://www.php.net/manual/en/function.preg-replace.php',
            ],
            [
                'id' => 100,
                'short' => 'range()',
                'detail' => 'range() creates an array of elements from start to end, optionally with a step. It works with integers, floats, and single characters. A negative step produces a descending range. Combined with array functions like array_map and array_filter, it is a convenient way to generate sequences.',
                'code' => '// Integer range
$nums = range(1, 5);        // [1, 2, 3, 4, 5]
$even = range(0, 10, 2);    // [0, 2, 4, 6, 8, 10]

// Descending
$countdown = range(5, 1);   // [5, 4, 3, 2, 1]
$descEven  = range(10, 0, -2); // [10, 8, 6, 4, 2, 0]

// Characters
$alpha = range("a", "z");   // ["a","b",...,"z"]
$upper = range("A", "Z");
$hex   = range("a", "f");   // ["a","b","c","d","e","f"]

// Float step
$fracs = range(0, 1, 0.25); // [0, 0.25, 0.5, 0.75, 1.0]

// Common combinations
// First N squares
$squares = array_map(fn($n) => $n ** 2, range(1, 10));
// [1, 4, 9, 16, 25, 36, 49, 64, 81, 100]

// Generate test data
$ids = range(1, 100);
$mocks = array_map(fn($id) => ["id"=>$id, "name"=>"User $id"], $ids);

// Pagination page numbers
$pages     = 8;
$current   = 3;
$pageLinks = range(max(1, $current-2), min($pages, $current+2));
// [1, 2, 3, 4, 5]',
                'doc_url' => 'https://www.php.net/manual/en/function.range.php',
            ],
        ];

        $allVersions = array_merge(
            $versions,
            PhpConceptsExtended::versions()
        );

        $allConcepts = array_merge(
            $concepts,
            PhpConceptsExtended::get()
        );

        return array_map(
            fn($c) => $c + ['version' => $allVersions[$c['id']] ?? 'PHP 4.0'],
            $allConcepts
        );
    }
}
