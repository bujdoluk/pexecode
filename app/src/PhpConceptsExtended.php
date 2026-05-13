<?php

namespace App;

class PhpConceptsExtended
{
    public static function get(): array
    {
        return [
            [
                'id'      => 101,
                'short'   => 'if / else',
                'detail'  => 'The if statement executes a block when a condition is true. else handles the false branch. elseif chains additional conditions. PHP evaluates conditions left-to-right with short-circuit logic.',
                'code'    => '$age = 20;

if ($age >= 18) {
    echo "Adult";
} elseif ($age >= 13) {
    echo "Teen";
} else {
    echo "Child";
}

// Ternary shorthand
$label = $age >= 18 ? "Adult" : "Minor";

// Null coalescing with else-like behaviour
$name = $_GET["name"] ?? "Guest";',
                'doc_url' => 'https://www.php.net/manual/en/control-structures.if.php',
            ],
            [
                'id'      => 102,
                'short'   => 'for',
                'detail'  => 'The for loop provides explicit control over initialization, condition, and increment. All three expressions are optional. Ideal when the iteration count is known. break exits the loop; continue skips to the next iteration.',
                'code'    => '// Classic counted loop
for ($i = 0; $i < 5; $i++) {
    echo $i; // 0 1 2 3 4
}

// Count down
for ($i = 10; $i > 0; $i -= 2) {
    echo $i . " "; // 10 8 6 4 2
}

// Multiple expressions
for ($i = 0, $j = 10; $i < $j; $i++, $j--) {
    echo "$i/$j ";
}

// All expressions optional (infinite loop with break)
for (;;) {
    if (condition()) break;
}',
                'doc_url' => 'https://www.php.net/manual/en/control-structures.for.php',
            ],
            [
                'id'      => 103,
                'short'   => 'foreach',
                'detail'  => 'foreach iterates over arrays and objects. Use "as $value" for indexed arrays and "as $key => $value" for associative arrays. Modify values in-place with "&$value". Works with any Traversable object.',
                'code'    => '$fruits = ["apple", "banana", "cherry"];

// Values only
foreach ($fruits as $fruit) {
    echo $fruit . "\\n";
}

// Key and value
$prices = ["apple" => 1.50, "banana" => 0.75];
foreach ($prices as $item => $price) {
    echo "$item: $$price\\n";
}

// Modify in-place via reference
foreach ($prices as &$price) {
    $price *= 1.1; // 10% increase
}
unset($price); // IMPORTANT: unset reference after loop

// Nested
foreach ($matrix as $row) {
    foreach ($row as $cell) {
        echo "$cell ";
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/control-structures.foreach.php',
            ],
            [
                'id'      => 104,
                'short'   => 'while / do-while',
                'detail'  => 'while tests the condition before each iteration — the body may never execute. do-while tests after, guaranteeing at least one execution. Use while for condition-driven loops and do-while for "run once then check" patterns like menu prompts.',
                'code'    => '// while — condition checked first
$i = 0;
while ($i < 5) {
    echo $i++;
}

// Reading lines from a file
$handle = fopen("file.txt", "r");
while (($line = fgets($handle)) !== false) {
    process(trim($line));
}
fclose($handle);

// do-while — body runs at least once
$attempts = 0;
do {
    $result = tryConnect();
    $attempts++;
} while ($result === false && $attempts < 3);

// Practical: consume queue
do {
    $job = $queue->pop();
    if ($job) process($job);
} while ($job !== null);',
                'doc_url' => 'https://www.php.net/manual/en/control-structures.while.php',
            ],
            [
                'id'      => 105,
                'short'   => 'switch',
                'detail'  => 'switch compares a single value against multiple cases using loose (==) comparison. Execution falls through to subsequent cases unless broken. A default case handles unmatched values. For strict comparison and a return value, prefer match.',
                'code'    => '$status = "active";

switch ($status) {
    case "active":
        echo "User is active";
        break;
    case "suspended":
    case "banned":          // fall-through: both reach same code
        echo "Access denied";
        break;
    default:
        echo "Unknown status";
}

// Switch with return inside a function
function httpLabel(int $code): string {
    switch ($code) {
        case 200: return "OK";
        case 301: return "Moved Permanently";
        case 404: return "Not Found";
        case 500: return "Server Error";
        default:  return "Unknown";
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/control-structures.switch.php',
            ],
            [
                'id'      => 106,
                'short'   => 'break / continue',
                'detail'  => 'break exits a loop or switch. continue skips the rest of the current iteration. Both accept an optional numeric argument specifying how many levels of nested loops to affect. Overuse of break/continue in deeply nested code is a code smell — consider extracting functions.',
                'code'    => '// break exits the loop entirely
for ($i = 0; $i < 10; $i++) {
    if ($i === 5) break;
    echo $i; // 0 1 2 3 4
}

// continue skips current iteration
for ($i = 0; $i < 10; $i++) {
    if ($i % 2 === 0) continue;
    echo $i; // 1 3 5 7 9
}

// Numeric argument — break 2 levels
foreach ($matrix as $row) {
    foreach ($row as $cell) {
        if ($cell === "target") {
            break 2; // exits both foreach loops
        }
    }
}

// continue 2 — skip outer iteration from inner loop
foreach ($users as $user) {
    foreach ($user["roles"] as $role) {
        if ($role === "banned") continue 2; // skip this $user
    }
    processUser($user);
}',
                'doc_url' => 'https://www.php.net/manual/en/control-structures.break.php',
            ],
            [
                'id'      => 107,
                'short'   => 'declare',
                'detail'  => 'declare sets execution directives for a block of code. The most important directive is strict_types=1, which enforces strict type checking for scalar type declarations. ticks runs a function every N low-level statements. encoding sets the source file encoding.',
                'code'    => '<?php
// strict_types must be the FIRST statement in the file
declare(strict_types=1);

function add(int $a, int $b): int {
    return $a + $b;
}

// With strict_types=1:
add(1, 2);       // OK
add(1.5, 2);     // TypeError — float not coerced to int
add("1", 2);     // TypeError — string not coerced

// Without strict_types (default):
// add(1.5, 2) would silently truncate to add(1, 2)

// Apply to a block (not just the whole file)
declare(strict_types=1) {
    // strict types apply here only
}

// ticks — call a function every N statements
function tickHandler(): void { /* monitor execution */ }
register_tick_function("tickHandler");
declare(ticks=1) {
    $a = 1; // tick fires
    $b = 2; // tick fires
}',
                'doc_url' => 'https://www.php.net/manual/en/control-structures.declare.php',
            ],
            [
                'id'      => 108,
                'short'   => 'return',
                'detail'  => 'return terminates the current function and optionally passes a value back to the caller. In a script included with include/require, return ends file execution and passes a value back to the including script. A function with no return statement implicitly returns null.',
                'code'    => '// Basic return
function double(int $n): int {
    return $n * 2;
}
echo double(5); // 10

// Early return — guard clauses (preferred over nested if)
function processOrder(array $order): string {
    if (empty($order)) return "Empty order";
    if (!isset($order["total"])) return "Missing total";
    if ($order["total"] <= 0) return "Invalid total";

    // Main logic only reached when all guards pass
    return "Processed: $" . $order["total"];
}

// Return multiple values via array/object
function minMax(array $nums): array {
    return ["min" => min($nums), "max" => max($nums)];
}
["min" => $min, "max" => $max] = minMax([3, 1, 4, 1, 5]);

// Return from included file
// config.php: return ["db" => "localhost"];
$config = include "config.php"; // $config is the array',
                'doc_url' => 'https://www.php.net/manual/en/function.return.php',
            ],
            [
                'id'      => 109,
                'short'   => 'require / include',
                'detail'  => 'require and include both execute another PHP file in-place. require halts with a fatal error if the file is missing; include only emits a warning. require_once and include_once prevent duplicate inclusion. Composer\'s autoloader replaces most manual include/require usage.',
                'code'    => '// require — fatal error if file missing (use for critical files)
require __DIR__ . "/config.php";
require_once __DIR__ . "/vendor/autoload.php";

// include — warning only if missing (use for optional partials)
include __DIR__ . "/templates/header.php";

// Return value from included file
// settings.php:  return ["debug" => true, "db" => "localhost"];
$settings = require __DIR__ . "/settings.php";
echo $settings["db"]; // "localhost"

// include with variable scope — included file sees local vars
$title = "My Page";
include "header.php"; // header.php can use $title

// Autoloading with Composer (replaces most manual includes)
// composer.json: {"autoload": {"psr-4": {"App\\": "src/"}}}
// Then: new App\\Services\\UserService() loads automatically',
                'doc_url' => 'https://www.php.net/manual/en/function.require.php',
            ],
            [
                'id'      => 110,
                'short'   => 'class',
                'detail'  => 'class defines a blueprint for objects with properties and methods. PHP supports single inheritance (extends), multiple interface implementation (implements), and code reuse via traits. Classes can be abstract (not instantiable), final (not extendable), or readonly (PHP 8.2).',
                'code'    => 'class Animal {
    public string $name;
    protected int $age;
    private string $dna;

    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age  = $age;
    }

    public function speak(): string {
        return "{$this->name} says something";
    }
}

class Dog extends Animal {
    public function __construct(string $name, int $age, public string $breed) {
        parent::__construct($name, $age);
    }

    public function speak(): string {
        return "{$this->name} barks!";
    }
}

$dog = new Dog("Rex", 3, "Labrador");
echo $dog->speak();       // "Rex barks!"
echo $dog->name;          // "Rex"
echo $dog instanceof Animal ? "yes" : "no"; // "yes"

get_class($dog);          // "Dog"
get_parent_class($dog);   // "Animal"',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.basic.php',
            ],
            [
                'id'      => 111,
                'short'   => 'extends',
                'detail'  => 'extends lets a class inherit all public and protected properties and methods from a parent class. PHP is single-inheritance — a class can extend only one parent. The child can override parent methods. Use parent:: to call the parent\'s version. Abstract parent methods must be implemented.',
                'code'    => 'class Vehicle {
    public function __construct(
        protected string $make,
        protected int    $year
    ) {}

    public function describe(): string {
        return "{$this->year} {$this->make}";
    }

    public function fuelType(): string {
        return "petrol";
    }
}

class ElectricCar extends Vehicle {
    public function __construct(string $make, int $year, private int $range) {
        parent::__construct($make, $year); // call parent constructor
    }

    // Override parent method
    public function fuelType(): string {
        return "electric";
    }

    // Extend parent method
    public function describe(): string {
        return parent::describe() . " (EV, {$this->range}km range)";
    }
}

$car = new ElectricCar("Tesla", 2024, 560);
echo $car->describe();   // "2024 Tesla (EV, 560km range)"
echo $car->fuelType();   // "electric"',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.inheritance.php',
            ],
            [
                'id'      => 112,
                'short'   => 'instanceof',
                'detail'  => 'instanceof tests whether an object is an instance of a class, a subclass of it, or an implementor of an interface. It returns false for non-objects without an error. Used in type-narrowing after accepting mixed/union-typed values and in polymorphic dispatch.',
                'code'    => 'interface Loggable {}
class User implements Loggable {}
class AdminUser extends User {}

$admin = new AdminUser();

var_dump($admin instanceof AdminUser);  // true
var_dump($admin instanceof User);       // true  — is a subclass
var_dump($admin instanceof Loggable);   // true  — implements interface
var_dump($admin instanceof stdClass);   // false

// Non-object never throws
$val = "string";
var_dump($val instanceof User); // false — no error

// Type narrowing in practice
function process(mixed $item): void {
    if ($item instanceof User) {
        echo "User: {$item->name}";
    } elseif ($item instanceof Order) {
        echo "Order: {$item->id}";
    }
}

// With variable classname (PHP 5.3+)
$class = "User";
var_dump($admin instanceof $class); // true',
                'doc_url' => 'https://www.php.net/manual/en/language.operators.type.php',
            ],
            [
                'id'      => 113,
                'short'   => 'visibility',
                'detail'  => 'PHP has three visibility modifiers: public (accessible everywhere), protected (accessible in the class and subclasses), and private (only the declaring class). PHP 8.1 added asymmetric visibility for getters/setters in a single declaration. PHP 8.4 will add property hooks.',
                'code'    => 'class BankAccount {
    public string   $owner;      // anyone can read and write
    protected float $balance;    // only this class and subclasses
    private string  $secretPin;  // only this class

    public function __construct(string $owner, float $initial, string $pin) {
        $this->owner     = $owner;
        $this->balance   = $initial;
        $this->secretPin = $pin;
    }

    public function deposit(float $amount): void {
        $this->validateAmount($amount); // private method call is fine here
        $this->balance += $amount;
    }

    public function getBalance(): float {
        return $this->balance; // public getter for protected property
    }

    private function validateAmount(float $amount): void {
        if ($amount <= 0) throw new InvalidArgumentException("Invalid amount");
    }
}

$acc = new BankAccount("Alice", 100.0, "1234");
echo $acc->owner;         // "Alice"   — public OK
echo $acc->getBalance();  // 100.0
// $acc->balance;         // Error — protected
// $acc->secretPin;       // Error — private',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.visibility.php',
            ],
            [
                'id'      => 114,
                'short'   => '__construct()',
                'detail'  => '__construct() is the magic method called automatically when a new object is created. PHP 8.0 added constructor property promotion. If a child class defines __construct(), it must call parent::__construct() explicitly if needed. __destruct() runs when the object is destroyed.',
                'code'    => 'class Config {
    private array $data;

    public function __construct(string $file) {
        if (!file_exists($file)) {
            throw new RuntimeException("Config file not found: $file");
        }
        $this->data = json_decode(file_get_contents($file), true);
    }

    public function get(string $key, mixed $default = null): mixed {
        return $this->data[$key] ?? $default;
    }

    // Destructor — called when object goes out of scope
    public function __destruct() {
        // cleanup: close handles, flush buffers, etc.
    }
}

// PHP 8.0 promoted constructor (short form)
class Point {
    public function __construct(
        public readonly float $x,
        public readonly float $y,
        public readonly float $z = 0.0,
    ) {} // No body needed — properties are auto-assigned
}

$p = new Point(1.0, 2.0);
echo $p->x; // 1.0',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.decon.php',
            ],
            [
                'id'      => 115,
                'short'   => '__get() / __set()',
                'detail'  => '__get($name) is called when reading an inaccessible or non-existent property. __set($name, $value) is called when writing to one. Together they implement dynamic properties and the proxy pattern. __isset() intercepts isset() calls; __unset() intercepts unset() calls.',
                'code'    => 'class MagicContainer {
    private array $data = [];

    // Called when $obj->unknownProp is read
    public function __get(string $name): mixed {
        return $this->data[$name] ?? null;
    }

    // Called when $obj->unknownProp = $value is written
    public function __set(string $name, mixed $value): void {
        $this->data[$name] = $value;
    }

    // Called when isset($obj->prop)
    public function __isset(string $name): bool {
        return isset($this->data[$name]);
    }

    // Called when unset($obj->prop)
    public function __unset(string $name): void {
        unset($this->data[$name]);
    }
}

$bag = new MagicContainer();
$bag->color = "red";     // __set called
echo $bag->color;        // "red" — __get called
echo $bag->size;         // null  — __get returns null for missing key
isset($bag->color);      // true  — __isset called
unset($bag->color);      // __unset called',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.overloading.php',
            ],
            [
                'id'      => 116,
                'short'   => '__call()',
                'detail'  => '__call($name, $args) intercepts calls to inaccessible or undefined instance methods. __callStatic($name, $args) does the same for static calls. Used heavily in frameworks for magic finders, fluent builders, and proxies.',
                'code'    => 'class QueryBuilder {
    private array $conditions = [];
    private ?string $table = null;

    // Intercepts any undefined method call
    public function __call(string $method, array $args): static {
        // Magic "findByXxx" methods
        if (str_starts_with($method, "findBy")) {
            $field = lcfirst(substr($method, 6));
            $this->conditions[] = "$field = ?";
            $this->bindings[]   = $args[0];
            return $this;
        }
        throw new BadMethodCallException("Method $method not found");
    }

    public static function __callStatic(string $method, array $args): static {
        $instance = new static();
        return $instance->$method(...$args);
    }
}

$qb = new QueryBuilder();
$qb->findByEmail("alice@example.com")
   ->findByActive(true);

// Static magic
QueryBuilder::findByEmail("alice@example.com");',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.overloading.php',
            ],
            [
                'id'      => 117,
                'short'   => '__sleep() / __wakeup()',
                'detail'  => '__sleep() is called by serialize() — return an array of property names to include. __wakeup() is called by unserialize() to restore object state. In PHP 7.4+, __serialize() and __unserialize() provide full control and are preferred.',
                'code'    => 'class DatabaseConnection {
    private \\PDO $pdo;
    private string $dsn;
    private string $user;

    public function __construct(string $dsn, string $user, string $pass) {
        $this->dsn  = $dsn;
        $this->user = $user;
        $this->pdo  = new \\PDO($dsn, $user, $pass);
    }

    // Tell serialize() which properties to store
    public function __sleep(): array {
        return ["dsn", "user"]; // skip $pdo — not serializable
    }

    // Restore connection after unserialize
    public function __wakeup(): void {
        $this->pdo = new \\PDO($this->dsn, $this->user, "");
    }
}

// PHP 7.4+ preferred — full array control
class Token {
    public function __serialize(): array {
        return ["value" => base64_encode($this->raw), "exp" => $this->expiry];
    }

    public function __unserialize(array $data): void {
        $this->raw    = base64_decode($data["value"]);
        $this->expiry = $data["exp"];
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.magic.php',
            ],
            [
                'id'      => 118,
                'short'   => '__clone()',
                'detail'  => '__clone() is called on the new copy immediately after a clone operation. PHP\'s default clone is shallow — object properties are NOT deep-copied. Override __clone() to deep-copy any contained objects, preventing shared state between the original and the clone.',
                'code'    => 'class Cart {
    private array $items;
    private CustomerInfo $customer;

    public function __construct(CustomerInfo $customer) {
        $this->customer = $customer;
        $this->items    = [];
    }

    // Without __clone: $this->customer would point to the SAME object
    public function __clone() {
        // Deep copy the contained object
        $this->customer = clone $this->customer;
        // Arrays of scalars are already deep-copied by PHP
        // Arrays of objects need manual cloning:
        $this->items = array_map(fn($i) => clone $i, $this->items);
    }

    public function addItem(CartItem $item): void {
        $this->items[] = $item;
    }
}

$original = new Cart(new CustomerInfo("Alice"));
$copy     = clone $original;

// Modifying copy\'s customer does NOT affect original
$copy->customer->name = "Bob";
echo $original->customer->name; // "Alice" — unaffected',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.cloning.php',
            ],
            [
                'id'      => 119,
                'short'   => '__debugInfo()',
                'detail'  => '__debugInfo() lets an object control what var_dump() and print_r() show about it. Return an associative array of the data you want displayed. Useful for hiding sensitive fields (passwords, tokens) and simplifying debug output of complex objects.',
                'code'    => 'class User {
    public function __construct(
        public string $name,
        public string $email,
        private string $passwordHash,
        private string $apiToken,
    ) {}

    // Without __debugInfo, var_dump would expose $passwordHash and $apiToken
    public function __debugInfo(): array {
        return [
            "name"        => $this->name,
            "email"       => $this->email,
            "password"    => "*** HIDDEN ***",
            "apiToken"    => substr($this->apiToken, 0, 4) . "...",
        ];
    }
}

$user = new User("Alice", "alice@example.com", "hashed123", "secret-token-xyz");

var_dump($user);
// object(User)#1 (4) {
//   ["name"]     => string(5) "Alice"
//   ["email"]    => string(17) "alice@example.com"
//   ["password"] => string(12) "*** HIDDEN ***"
//   ["apiToken"] => string(7) "secr..."
// }',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.magic.php#object.debuginfo',
            ],
            [
                'id'      => 120,
                'short'   => 'late static binding',
                'detail'  => 'Late static binding (LSB) via static:: resolves to the class on which a method was actually called at runtime, not the class where it is defined. self:: always refers to the defining class. LSB enables correct inheritance of factory methods, singletons, and static constructors.',
                'code'    => 'class Base {
    protected static string $type = "base";

    // self:: always refers to Base, regardless of caller
    public static function createSelf(): static {
        return new self(); // Always Base
    }

    // static:: resolves to the actual called class at runtime
    public static function createStatic(): static {
        return new static(); // Child when called as Child::createStatic()
    }

    public static function getType(): string {
        return static::$type; // LSB — reads Child::$type if called on Child
    }
}

class Child extends Base {
    protected static string $type = "child";
}

$b = Base::createStatic();   // Base object
$c = Child::createStatic();  // Child object — LSB!

echo Base::getType();  // "base"
echo Child::getType(); // "child" — LSB reads Child::$type

// Classic Singleton with LSB
class Singleton {
    private static array $instances = [];

    public static function getInstance(): static {
        $class = static::class;
        return static::$instances[$class] ??= new static();
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/language.oop5.late-static-bindings.php',
            ],
            [
                'id'      => 121,
                'short'   => '$argc / $argv',
                'detail'  => '$argc holds the number of command-line arguments passed to a PHP CLI script (including the script name). $argv is an array of those arguments as strings, with $argv[0] being the script name. Available only in CLI context or when register_argc_argv is enabled.',
                'code'    => '// Run: php script.php Alice 30 --verbose

// $argc = 4
// $argv = ["script.php", "Alice", "30", "--verbose"]

echo $argc;        // 4
echo $argv[0];     // "script.php"
echo $argv[1];     // "Alice"
echo $argv[2];     // "30"

// Simple CLI argument parser
$name    = $argv[1] ?? "World";
$age     = isset($argv[2]) ? (int)$argv[2] : 0;
$verbose = in_array("--verbose", $argv);

echo "Hello, $name!\\n";
if ($verbose) echo "Age: $age\\n";

// Using getopt() for robust option parsing
$options = getopt("u:p:", ["user:", "password:", "verbose"]);
$user     = $options["user"]    ?? $options["u"]    ?? null;
$password = $options["password"] ?? $options["p"]   ?? null;
$verbose  = isset($options["verbose"]);',
                'doc_url' => 'https://www.php.net/manual/en/reserved.variables.argv.php',
            ],
            [
                'id'      => 122,
                'short'   => 'array_push()',
                'detail'  => 'array_push() appends one or more elements to the end of an array. For a single element, $arr[] = $value is faster and preferred since array_push() has function-call overhead. array_unshift() prepends to the front.',
                'code'    => '$stack = ["a", "b"];

// Append multiple elements at once
array_push($stack, "c", "d", "e");
// ["a", "b", "c", "d", "e"]

// Equivalent short syntax — PREFERRED for single element
$stack[] = "f";
// ["a", "b", "c", "d", "e", "f"]

// array_unshift — prepend
array_unshift($stack, "z");
// ["z", "a", "b", "c", "d", "e", "f"]

// Build a stack
$history = [];
function navigate(string $url, array &$history): void {
    array_push($history, $url);
}
navigate("/home",    $history);
navigate("/about",   $history);
navigate("/contact", $history);

// LIFO — pop most recent
$last = array_pop($history); // "/contact"

// array_push returns new count
$count = array_push($stack, "x"); // count of elements',
                'doc_url' => 'https://www.php.net/manual/en/function.array-push.php',
            ],
            [
                'id'      => 123,
                'short'   => 'array_splice()',
                'detail'  => 'array_splice() removes a portion of an array and optionally replaces it with something else, modifying the original array in-place. It returns the removed elements. Use it to insert, delete, or replace in the middle of an array.',
                'code'    => '$colors = ["red", "green", "blue", "yellow"];

// Remove 2 elements starting at index 1
$removed = array_splice($colors, 1, 2);
// $colors  = ["red", "yellow"]
// $removed = ["green", "blue"]

// Insert without removing (length = 0)
array_splice($colors, 1, 0, ["orange", "purple"]);
// ["red", "orange", "purple", "yellow"]

// Replace 1 element
array_splice($colors, 0, 1, ["crimson"]);
// ["crimson", "orange", "purple", "yellow"]

// Negative offset — from end
array_splice($colors, -1, 1);
// removes last element

// Remove and insert at same position (replace)
$items = ["a", "b", "c", "d"];
array_splice($items, 1, 2, ["X", "Y", "Z"]);
// ["a", "X", "Y", "Z", "d"]',
                'doc_url' => 'https://www.php.net/manual/en/function.array-splice.php',
            ],
            [
                'id'      => 124,
                'short'   => 'array_reverse()',
                'detail'  => 'array_reverse() returns a copy of the array with elements in reversed order. Numeric keys are re-indexed by default; pass true to preserve all keys. The original array is unchanged.',
                'code'    => '$nums = [1, 2, 3, 4, 5];

$reversed = array_reverse($nums);
// [5, 4, 3, 2, 1]  — keys reset to 0-4

// Preserve keys
$assoc = ["a" => 1, "b" => 2, "c" => 3];
$rev   = array_reverse($assoc, true);
// ["c" => 3, "b" => 2, "a" => 1]  — keys preserved

// Reversing a string character by character
$chars     = mb_str_split("Hello", 1, "UTF-8");
$backwards = implode("", array_reverse($chars));
// "olleH"

// Reverse processing order
$events = getEvents(); // [oldest, ..., newest]
foreach (array_reverse($events) as $event) {
    echo $event["date"] . ": " . $event["name"] . "\\n"; // newest first
}

// Note: for large arrays, consider iterating backwards with a for loop
// rather than creating a reversed copy',
                'doc_url' => 'https://www.php.net/manual/en/function.array-reverse.php',
            ],
            [
                'id'      => 125,
                'short'   => 'array_sum()',
                'detail'  => 'array_sum() returns the sum of all values in an array as an integer or float. array_product() returns the product. Both ignore string values (treating them as 0). For more complex aggregations use array_reduce().',
                'code'    => '$nums = [1, 2, 3, 4, 5];

echo array_sum($nums);        // 15
echo array_product($nums);    // 120  (1×2×3×4×5)

// With floats
$prices = [9.99, 4.50, 14.99, 0.01];
$total  = array_sum($prices); // 29.49

// Strings are treated as 0
$mixed = [1, "foo", 2, "3", 4];
echo array_sum($mixed);       // 10  (1+0+2+3+4 — "3" is coerced)

// Summing a specific column
$orders = [
    ["id" => 1, "total" => 49.99],
    ["id" => 2, "total" => 12.50],
    ["id" => 3, "total" => 99.00],
];
$revenue = array_sum(array_column($orders, "total"));
// 161.49

// Count only matching elements
$scores  = [85, 92, 70, 88, 95, 60];
$passing = array_sum(array_map(fn($s) => $s >= 70 ? 1 : 0, $scores));
// 5 (five scores >= 70)',
                'doc_url' => 'https://www.php.net/manual/en/function.array-sum.php',
            ],
            [
                'id'      => 126,
                'short'   => 'array_count_values()',
                'detail'  => 'array_count_values() counts how many times each value appears in an array and returns an associative array of value => count pairs. Values must be strings or integers. Useful for frequency analysis, tag clouds, and histograms.',
                'code'    => '$colors = ["red", "blue", "red", "green", "blue", "red"];

$counts = array_count_values($colors);
// ["red" => 3, "blue" => 2, "green" => 1]

// Find most common value
arsort($counts);
$mostCommon = array_key_first($counts);
echo "$mostCommon: {$counts[$mostCommon]}"; // "red: 3"

// Tag cloud: count tag occurrences
$tags = ["php", "laravel", "php", "mysql", "php", "laravel"];
$freq = array_count_values($tags);
arsort($freq);
foreach ($freq as $tag => $count) {
    $size = min(2.0, 0.8 + $count * 0.2);
    echo "<span style=\\"font-size:{$size}em\\">$tag ($count)</span> ";
}

// Count character frequencies
$chars = mb_str_split(strtolower("Hello World"), 1, "UTF-8");
$freq  = array_count_values(array_filter($chars, fn($c) => $c !== " "));
arsort($freq);',
                'doc_url' => 'https://www.php.net/manual/en/function.array-count-values.php',
            ],
            [
                'id'      => 127,
                'short'   => 'array_key_exists()',
                'detail'  => 'array_key_exists() returns true if a key exists in an array, even if its value is null. This is the key difference from isset() — isset() returns false for null values. Use array_key_exists() when null is a valid value and you need to distinguish "key absent" from "key present with null value".',
                'code'    => '$data = ["name" => "Alice", "age" => null, "score" => 0];

// array_key_exists — checks for key presence only
var_dump(array_key_exists("age",   $data)); // true  — key exists, value null
var_dump(array_key_exists("email", $data)); // false — key doesn\'t exist

// isset — returns false for null values
var_dump(isset($data["age"]));   // false — null value
var_dump(isset($data["score"])); // true  — 0 is not null

// When to use each
function hasField(array $row, string $field): bool {
    // Use array_key_exists when null means "field was explicitly set to null"
    return array_key_exists($field, $row);
}

// isset is fine when you treat null the same as missing
if (isset($config["timeout"])) {
    $timeout = $config["timeout"];
}

// key_exists() is an alias
var_dump(key_exists("name", $data)); // true

// Check nested key safely
function hasNested(array $arr, string ...$keys): bool {
    foreach ($keys as $key) {
        if (!array_key_exists($key, $arr)) return false;
        $arr = $arr[$key];
    }
    return true;
}',
                'doc_url' => 'https://www.php.net/manual/en/function.array-key-exists.php',
            ],
            [
                'id'      => 128,
                'short'   => 'sort() / rsort()',
                'detail'  => 'sort() sorts an array in ascending order and re-indexes numeric keys (string keys are lost — use asort() to preserve them). rsort() sorts descending. Both modify the array in place. Sorting uses a natural comparison by default; use SORT_* flags for type control.',
                'code'    => '$nums  = [3, 1, 4, 1, 5, 9, 2, 6];
$words = ["banana", "apple", "cherry"];

// Ascending
sort($nums);
// [1, 1, 2, 3, 4, 5, 6, 9]

// Descending
rsort($nums);
// [9, 6, 5, 4, 3, 2, 1, 1]

// Sort strings
sort($words);
// ["apple", "banana", "cherry"]

// SORT_FLAGS control comparison type
$mixed = ["10", "9", "100", "2"];
sort($mixed);                    // ["10","100","2","9"]  — string sort
sort($mixed, SORT_NUMERIC);      // ["2","9","10","100"]  — numeric sort
sort($mixed, SORT_NATURAL);      // ["2","9","10","100"]  — natural sort

// asort — sort values, PRESERVE keys
$scores = ["alice" => 85, "bob" => 92, "carol" => 78];
asort($scores);
// ["carol"=>78, "alice"=>85, "bob"=>92]  keys intact

// ksort / krsort — sort by keys
ksort($scores);
// ["alice"=>85, "bob"=>92, "carol"=>78]',
                'doc_url' => 'https://www.php.net/manual/en/function.sort.php',
            ],
            [
                'id'      => 129,
                'short'   => 'implode()',
                'detail'  => 'implode() joins array elements into a single string with a separator between each element. join() is an alias. The separator can be empty to concatenate without delimiter. The inverse is explode(). Works only on flat arrays — nested arrays cause a notice.',
                'code'    => '$words  = ["Hello", "World", "PHP"];
$fruits = ["apple", "banana", "cherry"];

echo implode(" ", $words);   // "Hello World PHP"
echo implode(", ", $fruits); // "apple, banana, cherry"
echo implode("", $words);    // "HelloWorldPHP"

// Build SQL IN clause safely (after validating IDs are integers)
$ids = [1, 2, 3, 4, 5];
$in  = implode(",", $ids);
$sql = "SELECT * FROM users WHERE id IN ($in)";

// Build HTML list
$items = ["<li>One</li>", "<li>Two</li>", "<li>Three</li>"];
echo "<ul>" . implode("\\n", $items) . "</ul>";

// CSV row
$row    = ["Alice", "30", "Prague", "admin"];
$csvRow = implode(",", array_map(fn($v) => "\\"" . addslashes($v) . "\\"", $row));

// Join with different separators
$path = ["usr", "local", "bin"];
echo implode(DIRECTORY_SEPARATOR, $path); // "usr/local/bin" or "usr\\local\\bin"',
                'doc_url' => 'https://www.php.net/manual/en/function.implode.php',
            ],
            [
                'id'      => 130,
                'short'   => 'strtoupper()',
                'detail'  => 'strtoupper() converts all ASCII letters to uppercase. For multibyte strings (UTF-8, etc.) use mb_strtoupper(). ucfirst() uppercases only the first character; ucwords() uppercases the first character of each word.',
                'code'    => 'echo strtoupper("hello world"); // "HELLO WORLD"
echo strtoupper("Hello 123!");  // "HELLO 123!"

// ucfirst — capitalize first letter only
echo ucfirst("hello world");   // "Hello world"
echo ucfirst("HELLO");         // "HELLO" (only first char affected)

// ucwords — capitalize each word
echo ucwords("hello world foo"); // "Hello World Foo"
echo ucwords("hello-world", "-"); // "Hello-World" (custom delimiter)

// Multibyte — REQUIRED for non-ASCII
$czech = "žluté auto";
echo strtoupper($czech);              // "žLUTé AUTO" — ž and é not converted!
echo mb_strtoupper($czech, "UTF-8"); // "ŽLUTÉ AUTO"  — correct

// Normalize for case-insensitive comparison
function equalsIgnoreCase(string $a, string $b): bool {
    return mb_strtolower($a, "UTF-8") === mb_strtolower($b, "UTF-8");
}

// Slug generation
$title = "Hello World: PHP is Great!";
$slug  = strtolower(preg_replace("/[^a-z0-9]+/i", "-", $title));
// "Hello-World-PHP-is-Great-" → needs trim',
                'doc_url' => 'https://www.php.net/manual/en/function.strtoupper.php',
            ],
            [
                'id'      => 131,
                'short'   => 'str_repeat()',
                'detail'  => 'str_repeat() returns a string repeated a given number of times. Multiplier 0 returns an empty string. Useful for padding, separators, ASCII art, and generating test data.',
                'code'    => 'echo str_repeat("ab", 3);   // "ababab"
echo str_repeat("-", 40);  // "----------------------------------------"
echo str_repeat(" ", 4);   // four spaces (indent)
echo str_repeat("*", 0);   // "" — zero times returns empty string

// Visual progress bar
function progressBar(int $done, int $total, int $width = 20): string {
    $filled = (int)round($done / $total * $width);
    $empty  = $width - $filled;
    return "[" . str_repeat("█", $filled) . str_repeat("░", $empty) . "]"
         . " " . round($done / $total * 100) . "%";
}
echo progressBar(7, 10); // "[██████████████░░░░░░] 70%"

// Generate placeholder data
$placeholder = str_repeat("x", 100); // 100-char test string

// Indented output
function indent(string $text, int $level = 1): string {
    return str_repeat("  ", $level) . $text;
}',
                'doc_url' => 'https://www.php.net/manual/en/function.str-repeat.php',
            ],
            [
                'id'      => 132,
                'short'   => 'strrev()',
                'detail'  => 'strrev() reverses a string byte by byte. It works correctly for single-byte encodings but will corrupt multi-byte characters (UTF-8, etc.). For Unicode-safe reversal, split with mb_str_split() and reverse the array.',
                'code'    => 'echo strrev("Hello");      // "olleH"
echo strrev("12345");      // "54321"
echo strrev("");           // "" — empty string OK
echo strrev("a");          // "a" — single char OK

// Simple palindrome check (ASCII only)
function isPalindrome(string $s): bool {
    $s = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $s));
    return $s === strrev($s);
}
var_dump(isPalindrome("racecar"));          // true
var_dump(isPalindrome("A man a plan a canal Panama")); // true

// CAUTION: breaks multibyte strings
$utf = "Héllo";
echo strrev($utf);  // Garbled — bytes of é reversed incorrectly

// Unicode-safe reversal
function mb_strrev(string $str): string {
    return implode("", array_reverse(mb_str_split($str, 1, "UTF-8")));
}
echo mb_strrev("Héllo"); // "olléH"',
                'doc_url' => 'https://www.php.net/manual/en/function.strrev.php',
            ],
            [
                'id'      => 133,
                'short'   => 'strcmp()',
                'detail'  => 'strcmp() performs a binary-safe string comparison, returning 0 if equal, negative if $str1 < $str2, or positive if $str1 > $str2. strcasecmp() ignores case. strncmp() and strncasecmp() compare only the first N characters. Use === for simple equality; strcmp is useful for sorting callbacks.',
                'code'    => 'echo strcmp("apple", "apple");   //  0 — equal
echo strcmp("apple", "banana");  // negative — "apple" < "banana"
echo strcmp("banana", "apple");  // positive — "banana" > "apple"
echo strcmp("Apple", "apple");   // negative — uppercase < lowercase (ASCII)

// Case-insensitive
echo strcasecmp("Hello", "HELLO");  // 0
echo strcasecmp("Apple", "apple");  // 0

// Compare only first N characters
echo strncmp("foobar", "foobaz", 5);    // 0 — first 5 chars match
echo strncasecmp("FooBar", "foobaz", 4); // 0

// Use strcmp in usort for locale-aware sorting
$names = ["Charlie", "alice", "Bob"];
usort($names, "strcasecmp");
// ["alice", "Bob", "Charlie"]

// Use strncmp for prefix matching
function hasPrefix(string $str, string $prefix): bool {
    return strncmp($str, $prefix, strlen($prefix)) === 0;
}

// For locale-aware comparison, use strcoll()
setlocale(LC_COLLATE, "cs_CZ.UTF-8");
echo strcoll("čeština", "datum"); // locale-aware',
                'doc_url' => 'https://www.php.net/manual/en/function.strcmp.php',
            ],
            [
                'id'      => 134,
                'short'   => 'strip_tags()',
                'detail'  => 'strip_tags() removes HTML and PHP tags from a string. An allowlist of permitted tags can be specified. It does NOT sanitize attributes within allowed tags, so it alone cannot prevent XSS — use htmlspecialchars() for output escaping or a dedicated HTML purifier library.',
                'code'    => '$html = "<p>Hello <strong>World</strong>!</p><script>alert(1)</script>";

// Remove all tags
echo strip_tags($html); // "Hello World!"

// Allow specific tags — keep <p> and <strong>
echo strip_tags($html, "<p><strong>");
// "<p>Hello <strong>World</strong>!</p>"

// PHP 7.4+: array of allowed tags
echo strip_tags($html, ["p", "strong", "em", "a"]);

// IMPORTANT: attributes in allowed tags are NOT stripped
$malicious = \'<a href="javascript:alert(1)">click</a>\';
echo strip_tags($malicious, ["a"]);
// <a href="javascript:alert(1)">click</a> — XSS still present!

// Safe approach: use HTMLPurifier library for user-submitted HTML
// Or: strip_tags then htmlspecialchars for plain text output
function safeText(string $input): string {
    return htmlspecialchars(strip_tags($input), ENT_QUOTES, "UTF-8");
}

// Convert block tags to newlines before stripping
$text = preg_replace("/<(br|p|div|h[1-6])\\s*\\/?>/i", "\\n", $html);
$text = strip_tags($text);',
                'doc_url' => 'https://www.php.net/manual/en/function.strip-tags.php',
            ],
            [
                'id'      => 135,
                'short'   => 'ucfirst() / ucwords()',
                'detail'  => 'ucfirst() uppercases only the first character of a string (leaving the rest unchanged). ucwords() uppercases the first character of every word, with an optional delimiter argument. Both work on bytes, not characters — use mb_convert_case() for multibyte strings.',
                'code'    => 'echo ucfirst("hello world");   // "Hello world"
echo ucfirst("HELLO WORLD");   // "HELLO WORLD" — only first char
echo ucfirst("hello");         // "Hello"

echo ucwords("hello world foo"); // "Hello World Foo"
echo ucwords("hello-world-php", "-"); // "Hello-World-Php"
echo ucwords("hello world", " \\t\\n"); // custom delimiters

// Title case helper (lowercase first, then ucwords)
function titleCase(string $str): string {
    return ucwords(strtolower($str));
}
echo titleCase("THE QUICK BROWN FOX"); // "The Quick Brown Fox"

// Multibyte alternative
$czech = "žluté auto";
echo ucfirst($czech);                               // "žluté auto" — ž not uppercased!
echo mb_convert_case($czech, MB_CASE_TITLE, "UTF-8"); // "Žluté Auto"

// PascalCase from snake_case
function toPascalCase(string $snake): string {
    return str_replace("_", "", ucwords($snake, "_"));
}
echo toPascalCase("my_class_name"); // "MyClassName"',
                'doc_url' => 'https://www.php.net/manual/en/function.ucfirst.php',
            ],
            [
                'id'      => 136,
                'short'   => 'nl2br()',
                'detail'  => 'nl2br() inserts HTML <br> tags before all newlines (\\n, \\r\\n, \\r, \\0x0b). It does NOT strip the original newline — the line break remains after the <br>. Useful for displaying plain text that was stored with newlines in an HTML context.',
                'code'    => '$text = "Line one\\nLine two\\r\\nLine three";

echo nl2br($text);
// "Line one<br />\\nLine two<br />\\r\\nLine three"

// XHTML output (default)
echo nl2br("a\\nb");  // "a<br />\\nb"

// HTML output (PHP 5.3+)
echo nl2br("a\\nb", false); // "a<br>\\nb"

// Common use: display user-submitted text safely
function displayComment(string $text): string {
    return nl2br(htmlspecialchars($text, ENT_QUOTES, "UTF-8"));
}

// Order matters — htmlspecialchars FIRST, then nl2br
$user = "Hello <World>\\nSecond line";
echo nl2br(htmlspecialchars($user)); // Safe AND line breaks work

// Reverse: br to newline (for email sending)
function htmlToPlainText(string $html): string {
    $text = preg_replace("/<br\\s*\\/?>/i", "\\n", $html);
    return strip_tags($text);
}',
                'doc_url' => 'https://www.php.net/manual/en/function.nl2br.php',
            ],
            [
                'id'      => 137,
                'short'   => 'substr_count()',
                'detail'  => 'substr_count() counts how many non-overlapping times a substring appears in a string. An offset and length can limit the search range. Case-sensitive. For case-insensitive counting, use substr_count(strtolower($str), strtolower($needle)).',
                'code'    => '$str = "hello world hello php hello";

echo substr_count($str, "hello");  // 3
echo substr_count($str, "HELLO");  // 0 — case-sensitive
echo substr_count($str, "l");      // 5

// Limit search range with offset and length
echo substr_count($str, "hello", 6);      // 2 — start after first "hello"
echo substr_count($str, "hello", 6, 15);  // 1 — search only 15 chars from offset 6

// Case-insensitive
echo substr_count(strtolower($str), "hello"); // 3

// Non-overlapping — important for patterns like "aa" in "aaa"
echo substr_count("aaaa", "aa"); // 2 (not 3 — non-overlapping)

// Count words (rough)
$words   = substr_count(trim($text), " ") + 1;

// Count sentences
$sentences = substr_count($text, ".") + substr_count($text, "!") + substr_count($text, "?");

// Validate that a string has balanced brackets
$opens  = substr_count($code, "{");
$closes = substr_count($code, "}");
if ($opens !== $closes) echo "Unbalanced braces";',
                'doc_url' => 'https://www.php.net/manual/en/function.substr-count.php',
            ],
            [
                'id'      => 138,
                'short'   => 'wordwrap()',
                'detail'  => 'wordwrap() wraps a string to a given number of characters per line, inserting a break string (default \\n) between lines. By default it will not break words that exceed the width; pass true as the 4th argument to force-break long words. Useful for email body formatting and terminal output.',
                'code'    => '$text = "The quick brown fox jumped over the lazy dog.";

echo wordwrap($text, 15, "\\n");
// "The quick brown"
// "fox jumped over"
// "the lazy dog."

// Custom break string
echo wordwrap($text, 20, "<br>\\n");

// Force-break long words (4th arg = true)
$url = "https://www.example.com/very/long/url/that/breaks/layout";
echo wordwrap($url, 30, "\\n", true);
// Breaks at exactly 30 chars regardless of word boundaries

// Email formatting (RFC 2822 recommends 76 chars per line)
function formatEmailBody(string $text): string {
    return wordwrap($text, 76, "\\r\\n");
}

// HTML — replace break with <br>
function htmlWordwrap(string $text, int $width = 80): string {
    return nl2br(wordwrap(htmlspecialchars($text), $width, "\\n", true));
}',
                'doc_url' => 'https://www.php.net/manual/en/function.wordwrap.php',
            ],
            [
                'id'      => 139,
                'short'   => 'abs() / pow() / sqrt()',
                'detail'  => 'abs() returns the absolute value of a number. pow($base, $exp) raises a number to a power (equivalent to ** operator). sqrt() returns the square root. All work with both integers and floats.',
                'code'    => '// abs — absolute value
echo abs(-42);    // 42
echo abs(42);     // 42
echo abs(-3.14);  // 3.14

// pow — exponentiation (same as ** operator)
echo pow(2, 10);  // 1024
echo 2 ** 10;     // 1024 — preferred modern syntax
echo pow(4, 0.5); // 2.0  — square root via fractional exponent
echo pow(-8, 1/3); // -2.0 — cube root

// sqrt — square root
echo sqrt(16);    // 4.0
echo sqrt(2);     // 1.4142135623731
echo sqrt(-1);    // NAN — use complex number library for negatives

// Practical: Euclidean distance
function distance(float $x1, float $y1, float $x2, float $y2): float {
    return sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
}
echo distance(0, 0, 3, 4); // 5.0

// Hypotenuse
echo hypot(3, 4); // 5.0 — built-in, more numerically stable

// Compound interest
$principal = 1000;
$rate      = 0.05;
$years     = 10;
$result    = $principal * pow(1 + $rate, $years);',
                'doc_url' => 'https://www.php.net/manual/en/function.abs.php',
            ],
            [
                'id'      => 140,
                'short'   => 'min() / max()',
                'detail'  => 'min() returns the lowest value and max() returns the highest from either a list of arguments or an array. They use standard PHP comparison rules. For an empty array, both throw a ValueError (PHP 8) or return false (PHP 7). Useful for clamping values, range validation, and aggregation.',
                'code'    => '// With individual arguments
echo min(3, 1, 4, 1, 5, 9); // 1
echo max(3, 1, 4, 1, 5, 9); // 9

// With an array
echo min([3, 1, 4, 1, 5, 9]); // 1
echo max([3, 1, 4, 1, 5, 9]); // 9

// Works with strings (lexicographic)
echo min("apple", "banana", "cherry"); // "apple"
echo max("apple", "banana", "cherry"); // "cherry"

// Clamp a value to a range
function clamp(int $val, int $lo, int $hi): int {
    return max($lo, min($hi, $val));
}
echo clamp(150, 0, 100); // 100
echo clamp(-5,  0, 100); // 0
echo clamp(42,  0, 100); // 42

// PHP 8.1+ native clamp
// No built-in clamp yet, but min/max combo works perfectly

// Avoid empty array — throws ValueError in PHP 8
$scores = [];
$best = empty($scores) ? 0 : max($scores);',
                'doc_url' => 'https://www.php.net/manual/en/function.min.php',
            ],
            [
                'id'      => 141,
                'short'   => 'base_convert() / dechex()',
                'detail'  => 'base_convert() converts a number string between any two bases from 2 to 36. dechex(), hexdec(), decbin(), bindec(), decoct(), octdec() are convenient shortcuts for common decimal conversions.',
                'code'    => '// dechex — decimal to hexadecimal
echo dechex(255);    // "ff"
echo dechex(16);     // "10"
echo strtoupper(dechex(255)); // "FF"

// hexdec — hex to decimal
echo hexdec("ff");   // 255
echo hexdec("1a");   // 26

// decbin — decimal to binary
echo decbin(10);     // "1010"
echo decbin(255);    // "11111111"

// bindec — binary to decimal
echo bindec("1010"); // 10
echo bindec("11111111"); // 255

// decoct/octdec — decimal/octal conversion
echo decoct(8);      // "10"
echo octdec("10");   // 8

// base_convert — arbitrary base conversion
echo base_convert("ff",  16, 10); // "255" — hex to decimal
echo base_convert("255", 10, 16); // "ff"  — decimal to hex
echo base_convert("1010", 2, 10); // "10"  — binary to decimal
echo base_convert("z",   36, 10); // "35"  — base36 to decimal

// Color hex to RGB
$hex = "ff5733";
$r   = hexdec(substr($hex, 0, 2)); // 255
$g   = hexdec(substr($hex, 2, 2)); // 87
$b   = hexdec(substr($hex, 4, 2)); // 51',
                'doc_url' => 'https://www.php.net/manual/en/function.base-convert.php',
            ],
            [
                'id'      => 142,
                'short'   => 'time() / mktime()',
                'detail'  => 'time() returns the current Unix timestamp (integer seconds since 1970-01-01 00:00:00 UTC). mktime() creates a timestamp from hour, minute, second, month, day, year. Both are foundational for date arithmetic, cache expiry, and JWT token timestamps.',
                'code'    => '$now = time(); // e.g. 1705312800

// Format as date
echo date("Y-m-d H:i:s", $now); // "2024-01-15 10:00:00"

// Arithmetic
$tomorrow   = $now + 86400;       // +1 day in seconds
$nextWeek   = $now + (7 * 86400);
$in30days   = $now + (30 * 86400);
$oneHourAgo = $now - 3600;

// mktime — create timestamp from components
$christmas = mktime(0, 0, 0, 12, 25, 2024); // Dec 25 2024 midnight
echo date("D, d M Y", $christmas);

// Check if something is expired
function isExpired(int $createdAt, int $ttlSeconds): bool {
    return time() > ($createdAt + $ttlSeconds);
}

$tokenCreatedAt = 1705309200;
if (isExpired($tokenCreatedAt, 3600)) {
    echo "Token expired";
}

// Days until an event
$event = mktime(0, 0, 0, 6, 15, 2024);
$days  = (int)(($event - time()) / 86400);

// For precision, use DateTimeImmutable instead
$dt = new DateTimeImmutable("@" . time()); // from timestamp',
                'doc_url' => 'https://www.php.net/manual/en/function.time.php',
            ],
            [
                'id'      => 143,
                'short'   => 'checkdate()',
                'detail'  => 'checkdate() validates a Gregorian calendar date by checking that the month is 1-12, the day is valid for the given month/year (including leap years), and the year is non-zero. Returns true for valid dates, false for invalid ones. Useful for validating user-submitted date inputs.',
                'code'    => '// Valid dates
var_dump(checkdate(2, 29, 2024)); // true  — 2024 is a leap year
var_dump(checkdate(1, 31, 2024)); // true
var_dump(checkdate(12, 31, 2024)); // true

// Invalid dates
var_dump(checkdate(2, 29, 2023)); // false — 2023 is NOT a leap year
var_dump(checkdate(2, 30, 2024)); // false — Feb never has 30 days
var_dump(checkdate(13, 1, 2024)); // false — month 13 doesn\'t exist
var_dump(checkdate(0,  1, 2024)); // false — month 0 invalid
var_dump(checkdate(1,  0, 2024)); // false — day 0 invalid

// Practical: validate a date string from user input
function validateDate(string $dateStr, string $format = "Y-m-d"): bool {
    $dt = DateTime::createFromFormat($format, $dateStr);
    if ($dt === false) return false;

    // Also check for overflow (e.g. month 13 silently wraps)
    [$y, $m, $d] = explode("-", $dateStr);
    return checkdate((int)$m, (int)$d, (int)$y);
}

var_dump(validateDate("2024-02-29")); // true
var_dump(validateDate("2023-02-29")); // false',
                'doc_url' => 'https://www.php.net/manual/en/function.checkdate.php',
            ],
            [
                'id'      => 144,
                'short'   => 'file_put_contents()',
                'detail'  => 'file_put_contents() writes a string to a file, returning the number of bytes written or false on failure. By default it overwrites the file. Use FILE_APPEND to append and LOCK_EX to acquire an exclusive lock. It is the inverse of file_get_contents() and a convenient alternative to fopen/fwrite/fclose.',
                'code'    => '// Write (overwrite)
$bytes = file_put_contents("/tmp/output.txt", "Hello, World!");
echo $bytes; // 13

// Append mode
file_put_contents("/var/log/app.log", date("[Y-m-d H:i:s] ") . "Event\\n", FILE_APPEND);

// Exclusive lock prevents concurrent writes corrupting the file
file_put_contents("/tmp/data.txt", $content, LOCK_EX);

// Append + lock (most common for log files)
file_put_contents("/tmp/app.log", $line . "\\n", FILE_APPEND | LOCK_EX);

// Write array of lines (json_encode or implode first)
$lines = ["line 1", "line 2", "line 3"];
file_put_contents("/tmp/lines.txt", implode("\\n", $lines));

// Atomic write — write to temp file then rename
function atomicWrite(string $path, string $content): void {
    $tmp = $path . ".tmp." . uniqid();
    if (file_put_contents($tmp, $content, LOCK_EX) === false) {
        throw new RuntimeException("Write failed");
    }
    rename($tmp, $path); // atomic on most filesystems
}

// Error handling
if (file_put_contents($path, $data) === false) {
    throw new RuntimeException("Cannot write to $path");
}',
                'doc_url' => 'https://www.php.net/manual/en/function.file-put-contents.php',
            ],
            [
                'id'      => 145,
                'short'   => 'file()',
                'detail'  => 'file() reads an entire file into an indexed array, with each element being a line including its newline character. Use FILE_IGNORE_NEW_LINES and FILE_SKIP_EMPTY_LINES flags to clean up lines. For large files, use a generator with fgets() instead to avoid loading everything into memory.',
                'code'    => '// Read all lines (includes "\\n" at end of each line)
$lines = file("/etc/hosts");

// Clean — strip newlines and skip empty lines
$lines = file("/etc/hosts",
    FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES
);

foreach ($lines as $lineNum => $line) {
    if (str_starts_with($line, "#")) continue; // skip comments
    echo ($lineNum + 1) . ": $line\\n";
}

// Parse a CSV file
$csvLines = file("data.csv", FILE_IGNORE_NEW_LINES);
$header   = str_getcsv(array_shift($csvLines));
$rows     = array_map("str_getcsv", $csvLines);
$records  = array_map(fn($r) => array_combine($header, $r), $rows);

// Count lines without loading content
$lineCount = count(file("large.log"));

// For large files, use a generator instead
function readLines(string $path): Generator {
    $fh = fopen($path, "r");
    while (($line = fgets($fh)) !== false) {
        yield rtrim($line, "\\r\\n");
    }
    fclose($fh);
}',
                'doc_url' => 'https://www.php.net/manual/en/function.file.php',
            ],
            [
                'id'      => 146,
                'short'   => 'copy() / rename() / unlink()',
                'detail'  => 'copy() duplicates a file. rename() renames or moves a file or directory (atomic move on same filesystem). unlink() deletes a file. All return bool. They work on local paths and many stream wrappers.',
                'code'    => '// copy — duplicate a file
if (!copy("/src/image.jpg", "/backup/image.jpg")) {
    throw new RuntimeException("Copy failed");
}

// copy also works over wrappers
copy("https://example.com/logo.png", "/tmp/logo.png"); // requires allow_url_fopen

// rename — move/rename (atomic on same filesystem)
rename("/tmp/upload_xyz.jpg", "/uploads/profile_42.jpg");
rename("/old/path/",          "/new/path/");   // also renames directories

// unlink — delete a file
if (file_exists($path)) {
    unlink($path);
}

// Safe delete with error handling
function deleteFile(string $path): void {
    if (!file_exists($path)) return;
    if (!unlink($path)) {
        throw new RuntimeException("Cannot delete: $path");
    }
}

// Rotate log files
function rotateLogs(string $base): void {
    for ($i = 4; $i > 0; $i--) {
        $old = "$base." . ($i - 1);
        $new = "$base.$i";
        if (file_exists($old)) rename($old, $new);
    }
    copy($base, "$base.0");
    file_put_contents($base, ""); // truncate current log
}',
                'doc_url' => 'https://www.php.net/manual/en/function.copy.php',
            ],
            [
                'id'      => 147,
                'short'   => 'is_file() / is_dir()',
                'detail'  => 'is_file() returns true if the path exists and is a regular file (not a directory or special file). is_dir() returns true if the path is a directory. Related: is_readable(), is_writable(), is_executable(). PHP caches stat calls — use clearstatcache() after creating/deleting files.',
                'code'    => '$path = "/var/www/html/index.php";

var_dump(is_file($path));      // true  — it\'s a regular file
var_dump(is_dir($path));       // false — it\'s a file, not dir
var_dump(is_file("/var/www")); // false — that\'s a directory

var_dump(is_dir("/var/www"));  // true

// Access checks
var_dump(is_readable($path));     // true/false
var_dump(is_writable("/tmp"));    // true (usually)
var_dump(is_executable("/usr/bin/php")); // true

// Practical: safe file load
function safeLoad(string $path): string {
    if (!is_file($path)) {
        throw new RuntimeException("Not a file: $path");
    }
    if (!is_readable($path)) {
        throw new RuntimeException("Cannot read: $path");
    }
    return file_get_contents($path);
}

// Create directory if missing
function ensureDir(string $dir): void {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true); // recursive
    }
}

// Clear stat cache after file operations
touch("/tmp/newfile.txt");
clearstatcache();
var_dump(is_file("/tmp/newfile.txt")); // now returns true',
                'doc_url' => 'https://www.php.net/manual/en/function.is-file.php',
            ],
            [
                'id'      => 148,
                'short'   => 'fopen() / fread() / fclose()',
                'detail'  => 'fopen() opens a file or URL and returns a resource handle. fread() reads a number of bytes; fgets() reads a line; fwrite() writes. Always close with fclose(). Modes: r (read), w (write/truncate), a (append), x (create new, fail if exists), b (binary). PHP 8 deprecated most resource types in favor of objects.',
                'code'    => '// Open for reading
$fh = fopen("/path/to/file.txt", "r");
if ($fh === false) throw new RuntimeException("Cannot open file");

// Read entire file (small files only)
$content = fread($fh, filesize("/path/to/file.txt"));
fclose($fh);

// Read line by line (memory-efficient for large files)
$fh = fopen("large.log", "r");
while (!feof($fh)) {
    $line = fgets($fh); // reads one line including newline
    if ($line !== false) process(rtrim($line));
}
fclose($fh);

// Write a file
$fh = fopen("/tmp/output.txt", "w");
fwrite($fh, "Hello, World!\\n");
fwrite($fh, "Second line\\n");
fclose($fh);

// Append
$fh = fopen("/var/log/app.log", "a");
fwrite($fh, date("[Y-m-d H:i:s] ") . "Event logged\\n");
fclose($fh);

// fgetcsv — parse CSV line
$fh = fopen("data.csv", "r");
$header = fgetcsv($fh); // first line is header
while (($row = fgetcsv($fh)) !== false) {
    $record = array_combine($header, $row);
}
fclose($fh);',
                'doc_url' => 'https://www.php.net/manual/en/function.fopen.php',
            ],
            [
                'id'      => 149,
                'short'   => 'fgetcsv() / fputcsv()',
                'detail'  => 'fgetcsv() reads a line from an open file handle and parses it as CSV, returning an array of fields. fputcsv() formats an array as a CSV line and writes it. Both handle quoted fields, escaped characters, and custom delimiters/enclosures correctly.',
                'code'    => '// Read CSV file
$fh      = fopen("users.csv", "r");
$headers = fgetcsv($fh);          // ["name","email","age"]

$records = [];
while (($row = fgetcsv($fh)) !== false) {
    $records[] = array_combine($headers, $row);
}
fclose($fh);
// [["name"=>"Alice","email"=>"alice@...","age"=>"30"], ...]

// Custom delimiter (semicolons, common in European locale)
$fh  = fopen("eu_data.csv", "r");
$row = fgetcsv($fh, 0, ";", "\\"", "\\");
fclose($fh);

// Write CSV file
$fh   = fopen("export.csv", "w");
fputcsv($fh, ["name", "email", "score"]); // header
foreach ($users as $user) {
    fputcsv($fh, [$user["name"], $user["email"], $user["score"]]);
}
fclose($fh);

// Stream CSV directly to browser (download)
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=\\"export.csv\\"");
$fh = fopen("php://output", "w");
fputcsv($fh, ["ID", "Name", "Email"]);
foreach ($users as $u) {
    fputcsv($fh, [$u["id"], $u["name"], $u["email"]]);
}
fclose($fh);',
                'doc_url' => 'https://www.php.net/manual/en/function.fgetcsv.php',
            ],
            [
                'id'      => 150,
                'short'   => 'dirname() / basename() / pathinfo()',
                'detail'  => 'dirname() returns the directory part of a path. basename() returns the filename component (with or without extension). pathinfo() returns all components at once as an array. These are essential for safe file path manipulation.',
                'code'    => '$path = "/var/www/html/uploads/photo.jpg";

echo dirname($path);   // "/var/www/html/uploads"
echo basename($path);  // "photo.jpg"
echo basename($path, ".jpg"); // "photo" — strip extension

// dirname levels (PHP 7.0+)
echo dirname($path, 2); // "/var/www/html" — 2 levels up

// pathinfo — all components at once
$info = pathinfo($path);
// [
//   "dirname"   => "/var/www/html/uploads",
//   "basename"  => "photo.jpg",
//   "extension" => "jpg",
//   "filename"  => "photo",
// ]

// Get specific component
$ext  = pathinfo($path, PATHINFO_EXTENSION); // "jpg"
$name = pathinfo($path, PATHINFO_FILENAME);  // "photo"

// Safe upload path
function safeUploadPath(string $filename, string $uploadDir): string {
    $ext  = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $safe = uniqid("upload_") . "." . $ext;
    return rtrim($uploadDir, "/") . "/" . $safe;
}

// Relative path navigation
echo dirname(__FILE__);        // current file\'s directory
echo dirname(__FILE__) . "/../config.php"; // parent dir\'s config',
                'doc_url' => 'https://www.php.net/manual/en/function.pathinfo.php',
            ],
            [
                'id'      => 151,
                'short'   => 'preg_match_all()',
                'detail'  => 'preg_match_all() finds ALL non-overlapping matches of a pattern in a string, populating $matches with results. Returns the total match count. Flags PREG_SET_ORDER and PREG_OFFSET_CAPTURE control the shape of $matches.',
                'code'    => '$html  = "<a href=\\"/foo\\">Foo</a> <a href=\\"/bar\\">Bar</a>";
$count = preg_match_all("/<a href=\\"([^\\"]+)\\">([^<]+)<\\/a>/", $html, $m);
// $count = 2
// $m[0] = ["<a href=\\"/foo\\">Foo</a>", "<a href=\\"/bar\\">Bar</a>"]
// $m[1] = ["/foo", "/bar"]   ← group 1
// $m[2] = ["Foo", "Bar"]     ← group 2

// Named groups
preg_match_all("/(?P<year>\\d{4})-(?P<month>\\d{2})/", "2024-01 and 2025-06", $m);
// $m["year"]  = ["2024", "2025"]
// $m["month"] = ["01",   "06"]

// PREG_OFFSET_CAPTURE — include byte offset of each match
preg_match_all("/\\d+/", "abc 123 def 456", $m, PREG_OFFSET_CAPTURE);
// $m[0] = [["123", 4], ["456", 12]]  ← [value, offset]

// Count hashtags in a tweet
preg_match_all("/#\\w+/", $tweet, $tags);
$hashtags = array_unique($tags[0]);',
                'doc_url' => 'https://www.php.net/manual/en/function.preg-match-all.php',
            ],
            [
                'id'      => 152,
                'short'   => 'preg_replace_callback()',
                'detail'  => 'preg_replace_callback() replaces regex matches using the return value of a callback, giving you full PHP logic per match. preg_replace_callback_array() maps multiple patterns to different callbacks.',
                'code'    => '// Uppercase every word
$result = preg_replace_callback(
    "/\\b\\w+\\b/",
    fn($m) => ucfirst(strtolower($m[0])),
    "hELLO wORLD"
);
// "Hello World"

// Replace numbers with their squares
$result = preg_replace_callback(
    "/\\d+/",
    fn($m) => (int)$m[0] ** 2,
    "2 plus 3 equals 5"
);
// "4 plus 9 equals 25"

// Template engine — replace {{var}}
$template = "Hello {{name}}, you have {{count}} messages.";
$data     = ["name" => "Alice", "count" => 5];
$output   = preg_replace_callback(
    "/\\{\\{(\\w+)\\}\\}/",
    fn($m) => htmlspecialchars($data[$m[1]] ?? ""),
    $template
);
// "Hello Alice, you have 5 messages."

// Multiple patterns with preg_replace_callback_array (PHP 7.0+)
$result = preg_replace_callback_array([
    "/\\*\\*(.+?)\\*\\*/" => fn($m) => "<strong>{$m[1]}</strong>",
    "/_(.+?)_/"       => fn($m) => "<em>{$m[1]}</em>",
], $markdown);',
                'doc_url' => 'https://www.php.net/manual/en/function.preg-replace-callback.php',
            ],
            [
                'id'      => 153,
                'short'   => 'preg_split()',
                'detail'  => 'preg_split() splits a string by a regular expression pattern, unlike explode() which only splits on a literal string. Useful for splitting on variable whitespace, multiple delimiters, or complex patterns.',
                'code'    => '// Split on any whitespace (one or more spaces/tabs/newlines)
$words = preg_split("/\\s+/", "  hello   world  ");
// ["", "hello", "world", ""]

// Skip empty pieces with PREG_SPLIT_NO_EMPTY
$words = preg_split("/\\s+/", "  hello   world  ", -1, PREG_SPLIT_NO_EMPTY);
// ["hello", "world"]

// Split on multiple delimiters
$parts = preg_split("/[,;\\s]+/", "one, two;  three four");
// ["one", "two", "three", "four"]

// Keep the delimiters in results (PREG_SPLIT_DELIM_CAPTURE)
$parts = preg_split("/([\\s,;]+)/", "one, two;three", -1,
    PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
// ["one", ", ", "two", ";", "three"]

// Split camelCase into words
$words = preg_split("/(?=[A-Z])/", "myVariableName", -1, PREG_SPLIT_NO_EMPTY);
// ["my", "Variable", "Name"]

// Compare with explode — only handles fixed strings
explode(" ", "a  b"); // ["a", "", "b"] — extra empty string
preg_split("/\\s+/", "a  b", -1, PREG_SPLIT_NO_EMPTY); // ["a", "b"]',
                'doc_url' => 'https://www.php.net/manual/en/function.preg-split.php',
            ],
            [
                'id'      => 154,
                'short'   => 'preg_quote()',
                'detail'  => 'preg_quote() escapes all special regex metacharacters in a string so it can be safely used as a literal pattern. Essential when building dynamic patterns from user input.',
                'code'    => '$userInput = "user+name@example.com";

// WITHOUT preg_quote — + and . are regex metacharacters → bug
$pattern = "/" . $userInput . "/";

// WITH preg_quote — safely escaped
$safe    = preg_quote($userInput, "/"); // "user\\+name\\@example\\.com"
$pattern = "/" . $safe . "/";

// Highlight search term in text
function highlight(string $text, string $term): string {
    $escaped = preg_quote($term, "/");
    return preg_replace(
        "/($escaped)/i",
        "<mark>$1</mark>",
        htmlspecialchars($text)
    );
}
echo highlight("Hello World", "world");
// "Hello <mark>World</mark>"

// Metacharacters escaped: . \\ + * ? [ ] ^ $ ( ) { } = ! < > | : # -
$special = "1+1=2 (really!)";
echo preg_quote($special, "/"); // "1\\+1\\=2 \\(really\\!\\)"',
                'doc_url' => 'https://www.php.net/manual/en/function.preg-quote.php',
            ],
            [
                'id'      => 155,
                'short'   => 'parse_url()',
                'detail'  => 'parse_url() breaks a URL into its component parts: scheme, host, port, user, pass, path, query, fragment. Returns an associative array. Does NOT validate the URL. To extract query parameters, pass the query component to parse_str().',
                'code'    => '$url  = "https://alice:pass@example.com:8080/path/to/page?q=php&page=2#section";
$parts = parse_url($url);
// [
//   "scheme"   => "https",
//   "host"     => "example.com",
//   "port"     => 8080,
//   "user"     => "alice",
//   "pass"     => "pass",
//   "path"     => "/path/to/page",
//   "query"    => "q=php&page=2",
//   "fragment" => "section"
// ]

// Get a single component
$host  = parse_url($url, PHP_URL_HOST);   // "example.com"
$path  = parse_url($url, PHP_URL_PATH);   // "/path/to/page"
$query = parse_url($url, PHP_URL_QUERY);  // "q=php&page=2"

// Parse query string into array
parse_str($query, $params);
// $params = ["q" => "php", "page" => "2"]

// Rebuild URL after modifying components
$parts["host"]  = "newhost.com";
$parts["query"] = http_build_query(["q" => "laravel", "page" => "1"]);
// Then reassemble manually or use http_build_url() (from PECL)',
                'doc_url' => 'https://www.php.net/manual/en/function.parse-url.php',
            ],
            [
                'id'      => 156,
                'short'   => 'urlencode()',
                'detail'  => 'urlencode() encodes a string for use as a URL query string value, replacing special characters with % sequences and spaces with +. urldecode() reverses it. rawurlencode() follows RFC 3986 (spaces become %20, not +) — use it for path segments.',
                'code'    => '$name  = "Alice & Bob";
$query = "search term with spaces";

// urlencode — for query string values (space → +)
echo urlencode($name);   // "Alice+%26+Bob"
echo urlencode($query);  // "search+term+with+spaces"

// urldecode — reverse
echo urldecode("Alice+%26+Bob"); // "Alice & Bob"

// rawurlencode — RFC 3986, for path segments (space → %20)
echo rawurlencode($name);  // "Alice%20%26%20Bob"
echo rawurlencode($query); // "search%20term%20with%20spaces"

// Build a URL safely
$base   = "https://example.com/search";
$url    = $base . "?" . "q=" . urlencode($query) . "&lang=" . urlencode("c++");
// "https://example.com/search?q=search+term+with+spaces&lang=c%2B%2B"

// For path segments, use rawurlencode
$file = "my file (v2).pdf";
$path = "/files/" . rawurlencode($file);
// "/files/my%20file%20%28v2%29.pdf"

// http_build_query handles all encoding automatically
$url = "https://example.com?" . http_build_query(["q" => $query, "lang" => "c++"]);',
                'doc_url' => 'https://www.php.net/manual/en/function.urlencode.php',
            ],
            [
                'id'      => 157,
                'short'   => 'http_build_query()',
                'detail'  => 'http_build_query() generates a URL-encoded query string from an array or object, handling nested arrays recursively. Much safer and cleaner than manually concatenating urlencode() calls.',
                'code'    => '$params = [
    "q"      => "php arrays",
    "page"   => 2,
    "sort"   => "newest",
    "filter" => ["active", "verified"],
];

echo http_build_query($params);
// "q=php+arrays&page=2&sort=newest&filter%5B0%5D=active&filter%5B1%5D=verified"

// Custom separator (& is default, but & for HTML)
$qs = http_build_query($params, "", "&amp;");

// Append to URL
$url = "https://api.example.com/search?" . http_build_query($params);

// Nested arrays — keys use bracket notation
$nested = ["user" => ["name" => "Alice", "age" => 30]];
echo http_build_query($nested);
// "user%5Bname%5D=Alice&user%5Bage%5D=30"
// decoded: user[name]=Alice&user[age]=30

// Build API request
$endpoint = "https://api.example.com/v1/users";
$token    = "Bearer abc123";
$filters  = http_build_query(["status" => "active", "role" => "admin"]);
$fullUrl  = "$endpoint?$filters";

// parse_str reverses it
parse_str(http_build_query($params), $decoded);
// $decoded === $params (mostly)',
                'doc_url' => 'https://www.php.net/manual/en/function.http-build-query.php',
            ],
            [
                'id'      => 158,
                'short'   => 'session_start()',
                'detail'  => 'session_start() initialises a new session or resumes an existing one based on the session cookie. Must be called before any output. Always regenerate the session ID after login to prevent session fixation. Use session_set_cookie_params() to configure cookie security.',
                'code'    => '<?php
// Must come before any output
session_start();

// Store session data
$_SESSION["user_id"]   = 42;
$_SESSION["username"]  = "alice";
$_SESSION["logged_in"] = true;

// Read on subsequent requests
if (session_status() === PHP_SESSION_ACTIVE && ($_SESSION["logged_in"] ?? false)) {
    echo "Welcome, " . htmlspecialchars($_SESSION["username"]);
} else {
    header("Location: /login");
    exit;
}

// Configure secure cookie BEFORE session_start()
session_set_cookie_params([
    "lifetime" => 0,       // until browser closes
    "path"     => "/",
    "secure"   => true,    // HTTPS only
    "httponly" => true,    // no JS access
    "samesite" => "Lax",
]);
session_start();

// After login — prevent session fixation
session_regenerate_id(true); // true = delete old session file
$_SESSION["user_id"] = $authenticatedUserId;

// Logout — destroy completely
session_unset();
session_destroy();
setcookie(session_name(), "", time() - 3600, "/");',
                'doc_url' => 'https://www.php.net/manual/en/function.session-start.php',
            ],
            [
                'id'      => 159,
                'short'   => 'session_regenerate_id()',
                'detail'  => 'session_regenerate_id() replaces the current session ID with a newly generated one, optionally deleting the old session data. Call it immediately after successful authentication to prevent session fixation attacks.',
                'code'    => '// Login flow — MUST regenerate after authentication
function login(string $email, string $pass): bool {
    session_start();

    $user = findUserByEmail($email);
    if (!$user || !password_verify($pass, $user["password_hash"])) {
        return false;
    }

    // Critical: regenerate BEFORE writing sensitive session data
    session_regenerate_id(true); // true deletes the old session file

    $_SESSION["user_id"]   = $user["id"];
    $_SESSION["user_role"] = $user["role"];
    $_SESSION["logged_in"] = true;
    $_SESSION["login_at"]  = time();

    return true;
}

// Also rotate periodically for long sessions
function checkSessionRotation(): void {
    $rotateEvery = 900; // 15 minutes
    if (!isset($_SESSION["last_rotation"])) {
        $_SESSION["last_rotation"] = time();
    }
    if (time() - $_SESSION["last_rotation"] > $rotateEvery) {
        session_regenerate_id(true);
        $_SESSION["last_rotation"] = time();
    }
}

// session_id() — get/set the current ID
echo session_id(); // e.g. "abc123def456..."
session_id("custom-id"); // set before session_start()',
                'doc_url' => 'https://www.php.net/manual/en/function.session-regenerate-id.php',
            ],
            [
                'id'      => 160,
                'short'   => 'error_reporting()',
                'detail'  => 'error_reporting() sets or gets the active error reporting level as a bitmask. Use E_ALL in development, suppress notices/warnings in production. Combine with ini_set("display_errors", "0") and log errors instead.',
                'code'    => '// Show all errors (development)
error_reporting(E_ALL);
ini_set("display_errors", "1");

// Production — hide from users, log instead
error_reporting(E_ALL);           // still REPORT all
ini_set("display_errors", "0");   // just don\'t DISPLAY them
ini_set("log_errors", "1");
ini_set("error_log", "/var/log/php_errors.log");

// Suppress specific types
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

// Common bitmasks
error_reporting(E_ERROR | E_WARNING | E_PARSE); // only fatal/warnings/parse
error_reporting(0);   // suppress everything (use sparingly)

// Check current level
$level = error_reporting();   // returns current bitmask

// Temporarily suppress for a known noisy call
$old = error_reporting(0);
$fh  = @fopen("/might/not/exist", "r"); // @ also suppresses per-call
error_reporting($old);

// Constants
// E_ERROR        = 1    (fatal)
// E_WARNING      = 2    (non-fatal)
// E_NOTICE       = 8    (info)
// E_DEPRECATED   = 8192 (deprecated)
// E_ALL          = all of the above',
                'doc_url' => 'https://www.php.net/manual/en/function.error-reporting.php',
            ],
            [
                'id'      => 161,
                'short'   => 'error_log()',
                'detail'  => 'error_log() sends an error message to PHP\'s error log, an email, or a file. The most common use is type 0 (system log) or type 3 (append to a file). Essential for production debugging without exposing errors to users.',
                'code'    => '// Type 0 — send to PHP error log (default)
error_log("Something went wrong in processOrder()");
error_log("User ID: " . $userId . " failed validation");

// Type 3 — append to a specific file
error_log("[ERROR] " . $message . "\\n", 3, "/var/log/app.log");
error_log(date("[Y-m-d H:i:s] ") . $msg . "\\n", 3, "/var/log/app.log");

// Type 1 — send by email
error_log("Critical: database connection lost", 1, "admin@example.com");

// In exception handlers
set_exception_handler(function(\\Throwable $e): void {
    error_log(sprintf(
        "[EXCEPTION] %s: %s in %s:%d\\n%s",
        get_class($e),
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        $e->getTraceAsString()
    ));
    http_response_code(500);
    echo "An error occurred";
});

// Better: use a PSR-3 logger like Monolog in real apps
// error_log is fine for scripts and simple apps',
                'doc_url' => 'https://www.php.net/manual/en/function.error-log.php',
            ],
            [
                'id'      => 162,
                'short'   => 'set_exception_handler()',
                'detail'  => 'set_exception_handler() registers a global callback for uncaught exceptions, preventing a raw stack trace from being shown to users. Works alongside try/catch — it only fires for exceptions that escape all catch blocks.',
                'code'    => '// Register before any other code
set_exception_handler(function(\\Throwable $e): void {
    // Log the full details
    error_log(sprintf(
        "Uncaught %s: %s in %s:%d",
        get_class($e), $e->getMessage(), $e->getFile(), $e->getLine()
    ));

    // Show users a friendly message
    if (php_sapi_name() === "cli") {
        echo "Error: " . $e->getMessage() . "\\n";
    } else {
        http_response_code(500);
        include __DIR__ . "/views/500.php";
    }
    exit(1);
});

// Catches Exceptions AND Errors (PHP 7+)
// TypeError, ParseError, DivisionByZeroError etc.
set_exception_handler(function(\\Throwable $e): void { /* ... */ });

// Restore previous handler
restore_exception_handler();

// Combine with set_error_handler to catch everything
set_error_handler(function(int $code, string $msg, string $file, int $line) {
    throw new \\ErrorException($msg, 0, $code, $file, $line);
});
// Now even warnings/notices become catchable exceptions',
                'doc_url' => 'https://www.php.net/manual/en/function.set-exception-handler.php',
            ],
            [
                'id'      => 163,
                'short'   => 'debug_backtrace()',
                'detail'  => 'debug_backtrace() returns an array representing the current call stack, with each frame containing file, line, function, class, and args. Useful for custom loggers, profilers, and debugging utilities.',
                'code'    => 'function inner(): void {
    $trace = debug_backtrace();
    foreach ($trace as $frame) {
        $loc = ($frame["file"] ?? "?") . ":" . ($frame["line"] ?? "?");
        $fn  = ($frame["class"] ?? "") . ($frame["type"] ?? "") . $frame["function"];
        echo "$fn called from $loc\\n";
    }
}

function middle(): void { inner(); }
function outer(): void  { middle(); }
outer();

// Limit depth and skip args for performance
$trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5);

// Practical: custom logger with caller info
function logWithContext(string $message): void {
    $frame  = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? [];
    $caller = ($frame["file"] ?? "unknown") . ":" . ($frame["line"] ?? 0);
    error_log("[$caller] $message");
}

// debug_print_backtrace() prints directly
function crashHere(): void {
    debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
}',
                'doc_url' => 'https://www.php.net/manual/en/function.debug-backtrace.php',
            ],
            [
                'id'      => 164,
                'short'   => 'hash()',
                'detail'  => 'hash() computes a message digest using one of the many algorithms available (sha256, sha3-256, blake2b, etc.). Returns a lowercase hex string by default, or raw binary with $binary=true. For password hashing always use password_hash(); use hash() for file integrity, API signatures, and data fingerprinting.',
                'code'    => '// Basic hashing
echo hash("sha256", "Hello World");
// "a591a6d40bf420404a011733cfb7b190d62c65bf0bcda32b57b277d9ad9f146e"

// Available algorithms
print_r(hash_algos()); // sha256, sha3-256, blake2b512, md5, etc.

// File integrity check
$checksum = hash_file("sha256", "/path/to/download.zip");
file_put_contents("download.zip.sha256", $checksum);

// Verify later
if (hash_file("sha256", $file) !== $expected) {
    throw new RuntimeException("File integrity check failed");
}

// Timing-safe comparison (prevents timing attacks)
$expected = hash("sha256", $secretValue);
$actual   = hash("sha256", $userValue);
if (!hash_equals($expected, $actual)) {
    throw new RuntimeException("Hash mismatch");
}

// Raw binary output (e.g. for HMAC computation)
$raw = hash("sha256", $data, true); // 32 bytes of binary

// Content-based cache key
$cacheKey = "query:" . hash("xxh3", serialize($queryParams));',
                'doc_url' => 'https://www.php.net/manual/en/function.hash.php',
            ],
            [
                'id'      => 165,
                'short'   => 'hash_hmac()',
                'detail'  => 'hash_hmac() generates a keyed-hash MAC (HMAC) — a hash that incorporates a secret key. Used to verify both data integrity AND authenticity. Essential for API request signing, webhook verification, and token generation.',
                'code'    => '$secret  = "my-secret-key";
$payload = json_encode(["user_id" => 42, "action" => "delete"]);

// Generate HMAC
$sig = hash_hmac("sha256", $payload, $secret);
// "3c7f9d..."

// Verify — use hash_equals to prevent timing attacks
$incoming = $_SERVER["HTTP_X_SIGNATURE"] ?? "";
$expected = hash_hmac("sha256", $payload, $secret);

if (!hash_equals($expected, $incoming)) {
    http_response_code(401);
    exit("Invalid signature");
}

// Webhook verification (GitHub/Stripe pattern)
function verifyWebhook(string $payload, string $sig, string $secret): bool {
    $expected = "sha256=" . hash_hmac("sha256", $payload, $secret);
    return hash_equals($expected, $sig);
}

$body = file_get_contents("php://input");
$sig  = $_SERVER["HTTP_X_HUB_SIGNATURE_256"] ?? "";
if (!verifyWebhook($body, $sig, $_ENV["WEBHOOK_SECRET"])) {
    http_response_code(403); exit;
}

// HMAC-based token (stateless, no DB needed)
function makeToken(int $userId, int $expiry): string {
    $data = "$userId.$expiry";
    $sig  = hash_hmac("sha256", $data, $_ENV["APP_KEY"]);
    return base64_encode("$data.$sig");
}',
                'doc_url' => 'https://www.php.net/manual/en/function.hash-hmac.php',
            ],
            [
                'id'      => 166,
                'short'   => 'hash_equals()',
                'detail'  => 'hash_equals() compares two strings in constant time, regardless of where they differ. This prevents timing attacks where an attacker could deduce a secret by measuring how long a comparison takes. Always use it when comparing secret values like tokens, HMAC signatures, or password reset codes.',
                'code'    => '$expectedToken = hash_hmac("sha256", $data, $secret);
$userToken     = $_POST["token"] ?? "";

// WRONG — regular === leaks timing information
if ($expectedToken === $userToken) { /* ... */ }

// CORRECT — constant-time comparison
if (hash_equals($expectedToken, $userToken)) {
    echo "Token valid";
} else {
    echo "Token invalid";
}

// Why timing attacks matter:
// === stops at the first differing character.
// An attacker can measure response time to learn how many
// leading characters of their guess match the real secret.
// hash_equals() always takes the same time regardless.

// Verify CSRF token
function verifyCsrf(string $submitted): bool {
    $stored = $_SESSION["csrf_token"] ?? "";
    return hash_equals($stored, $submitted);
}

// Verify signed URL
function verifySignedUrl(string $url, string $sig): bool {
    $expected = hash_hmac("sha256", $url, $_ENV["URL_SIGN_KEY"]);
    return hash_equals($expected, $sig);
}',
                'doc_url' => 'https://www.php.net/manual/en/function.hash-equals.php',
            ],
            [
                'id'      => 167,
                'short'   => 'md5() / sha1()',
                'detail'  => 'md5() produces a 32-character hex digest; sha1() produces 40 characters. Both are fast and widely supported but cryptographically broken — never use them for password hashing. Safe uses: cache keys, ETags, non-security checksums, and legacy systems.',
                'code'    => '// md5 — 32 hex chars
echo md5("Hello World");
// "b10a8db164e0754105b7a99be72e3fe5"

// sha1 — 40 hex chars
echo sha1("Hello World");
// "0a4d55a8d778e5022fab701977c5d840bbc486d0"

// md5_file / sha1_file — hash file contents
echo md5_file("/path/to/file.zip");  // integrity check
echo sha1_file("/path/to/file.zip");

// Raw binary output
$raw = md5("data", true);  // 16 bytes instead of 32 hex chars

// SAFE uses of md5/sha1
$cacheKey  = "user:" . md5(serialize($queryParams)); // cache key
$etag      = md5($fileContent);                       // HTTP ETag
$gravatar  = md5(strtolower(trim($email)));           // Gravatar URL

// NEVER for passwords — use password_hash() instead
$wrong = md5($password);     // broken — don\'t do this
$right = password_hash($password, PASSWORD_DEFAULT); // correct

// For security-critical hashing always use:
hash("sha256", $data);            // one-way hash
hash_hmac("sha256", $data, $key); // authenticated hash',
                'doc_url' => 'https://www.php.net/manual/en/function.md5.php',
            ],
            [
                'id'      => 168,
                'short'   => 'define() / defined()',
                'detail'  => 'define() creates a named constant at runtime. Constants are global, cannot be changed once set, and need no $ prefix. class constants with const are preferred in OOP code. defined() checks whether a constant exists.',
                'code'    => '// Define a constant (global, no $ prefix)
define("MAX_LOGIN_ATTEMPTS", 5);
define("APP_ENV", "production");
define("DB_HOST", "localhost");

// Access anywhere without $
echo MAX_LOGIN_ATTEMPTS; // 5
echo APP_ENV;            // "production"

// Check existence
if (defined("DEBUG_MODE")) {
    var_dump(DEBUG_MODE);
}

// Class constants (preferred in OOP)
class Status {
    const ACTIVE   = "active";
    const INACTIVE = "inactive";
    const BANNED   = "banned";
}
echo Status::ACTIVE; // "active"

// const at file level (evaluated at compile time, unlike define())
const VERSION = "1.0.0";  // cannot use expressions

// define() allows expressions and is runtime
define("UPLOAD_MAX", 1024 * 1024 * 10); // 10MB
define("EXPIRY_TS", time() + 3600);     // computed at runtime

// Conditional definition (include guard pattern)
if (!defined("MY_LIBRARY_LOADED")) {
    define("MY_LIBRARY_LOADED", true);
    // ... rest of library
}',
                'doc_url' => 'https://www.php.net/manual/en/function.define.php',
            ],
            [
                'id'      => 169,
                'short'   => 'isset() / unset()',
                'detail'  => 'isset() returns true if a variable is declared AND is not null. Unlike array_key_exists(), it returns false for null values. It accepts multiple arguments — returns true only if ALL are set. unset() destroys variables or removes array keys.',
                'code'    => '$a = "hello";
$b = null;

var_dump(isset($a)); // true
var_dump(isset($b)); // false — null counts as "not set"
var_dump(isset($c)); // false — undeclared variable (no notice)

// Multiple arguments — ALL must be set
$x = 1; $y = 2;
var_dump(isset($x, $y, $z)); // false — $z not set

// Array keys
$arr = ["key" => null, "val" => "hello"];
var_dump(isset($arr["key"]));              // false — null value
var_dump(array_key_exists("key", $arr));  // true  — key exists

// Nested (safe, no warnings if middle key is missing)
var_dump(isset($config["db"]["host"])); // false, not "undefined index"

// unset a variable
$name = "Alice";
unset($name);
// $name no longer exists

// Remove array key
$data = ["id" => 1, "pass" => "secret", "name" => "Alice"];
unset($data["pass"]);
// ["id" => 1, "name" => "Alice"]

// unset multiple
unset($a, $b, $arr["key"]);',
                'doc_url' => 'https://www.php.net/manual/en/function.isset.php',
            ],
            [
                'id'      => 170,
                'short'   => 'empty()',
                'detail'  => 'empty() returns true if a variable does not exist OR its value is falsy: null, false, 0, 0.0, "0", "", []. No warning for undeclared variables. It is a language construct, not a function, so it cannot be used as a callback.',
                'code'    => '// Returns true for all these:
empty(null);    // true
empty(false);   // true
empty(0);       // true
empty(0.0);     // true
empty("");      // true
empty("0");     // true
empty([]);      // true
empty($undef);  // true — no notice for undeclared var

// Returns false for:
empty(" ");     // false — space is truthy
empty("0.0");   // false — string "0.0" is truthy
empty(1);       // false
empty("hello"); // false
empty([0]);     // false — non-empty array
empty(new stdClass()); // false

// Common pattern — form validation
$name = trim($_POST["name"] ?? "");
if (empty($name)) {
    $errors[] = "Name is required";
}

// !empty() as a truthy guard
if (!empty($config["debug"])) {
    // show debug output
}

// Difference from isset():
$x = 0;
var_dump(isset($x));  // true  — 0 is declared
var_dump(empty($x));  // true  — 0 is falsy',
                'doc_url' => 'https://www.php.net/manual/en/function.empty.php',
            ],
            [
                'id'      => 171,
                'short'   => 'var_dump()',
                'detail'  => 'var_dump() outputs detailed type and value information for one or more variables. Unlike print_r(), it shows types and lengths, making it invaluable for debugging type-related bugs. var_export() outputs valid PHP syntax that can be used as code.',
                'code'    => '$data = [
    "name"   => "Alice",
    "age"    => 30,
    "active" => true,
    "score"  => 9.5,
    "tags"   => ["php", "mysql"],
    "extra"  => null,
];

var_dump($data);
// array(6) {
//   ["name"]   => string(5) "Alice"
//   ["age"]    => int(30)
//   ["active"] => bool(true)
//   ["score"]  => float(9.5)
//   ["tags"]   => array(2) { [0]=>string(3)"php" [1]=>string(5)"mysql" }
//   ["extra"]  => NULL
// }

// Multiple arguments
var_dump($a, $b, $c);

// Capture output
ob_start();
var_dump($data);
$output = ob_get_clean();

// var_export — outputs valid PHP
var_export($data);
// array ( "name" => "Alice", "age" => 30, ... )

// Capture var_export
$code = var_export($data, true); // true = return instead of print

// print_r — simpler, no types
print_r($data);
$str = print_r($data, true); // capture',
                'doc_url' => 'https://www.php.net/manual/en/function.var-dump.php',
            ],
            [
                'id'      => 172,
                'short'   => 'serialize()',
                'detail'  => 'serialize() converts any PHP value to a storable string representation. unserialize() reconstructs it. Commonly used to store complex data in sessions, cache, or databases. PHP 7.4+ magic methods __serialize() and __unserialize() give objects fine-grained control.',
                'code'    => '$data = ["user" => "Alice", "prefs" => ["theme" => "dark", "lang" => "en"]];

$str = serialize($data);
// a:2:{s:4:"user";s:5:"Alice";s:5:"prefs";a:2:{...}}

$restored = unserialize($str);
// identical to original $data

// Store in session
$_SESSION["cart"] = serialize($cartItems);
$cart             = unserialize($_SESSION["cart"]);

// SECURITY: never unserialize untrusted input — use allowed_classes
$safe = unserialize($input, ["allowed_classes" => false]); // no objects
$safe = unserialize($input, ["allowed_classes" => [User::class, Cart::class]]);

// Object serialization — __serialize / __unserialize (PHP 7.4+)
class Token {
    public function __serialize(): array {
        return ["value" => base64_encode($this->raw), "exp" => $this->expiry];
    }
    public function __unserialize(array $data): void {
        $this->raw    = base64_decode($data["value"]);
        $this->expiry = $data["exp"];
    }
}

// For simple data storage prefer json_encode — safer and portable
$json = json_encode($data);   // safe for untrusted restore
$back = json_decode($json, true);',
                'doc_url' => 'https://www.php.net/manual/en/function.serialize.php',
            ],
            [
                'id'      => 173,
                'short'   => 'is_array() / is_string()',
                'detail'  => 'The is_*() family of type-checking functions returns a boolean for each PHP type. They are faster and more explicit than gettype() string comparisons. PHP 7.1 added is_iterable(); PHP 7.3 added is_countable().',
                'code'    => '$tests = [42, 3.14, "hello", true, null, [], new stdClass()];

foreach ($tests as $v) {
    var_dump([
        "is_int"    => is_int($v),
        "is_float"  => is_float($v),
        "is_string" => is_string($v),
        "is_bool"   => is_bool($v),
        "is_null"   => is_null($v),
        "is_array"  => is_array($v),
        "is_object" => is_object($v),
    ]);
}

// Practical: type guard
function sumInts(array $items): int {
    return array_sum(array_filter($items, "is_int"));
}
echo sumInts([1, "two", 3, true, 5]); // 9  (1+3+5)

// is_callable — verify before calling
$fn = $_POST["callback"] ?? null;
if (is_callable($fn)) { $fn(); } // only safe builtins

// is_iterable — works for both arrays and Traversable objects
function processItems(mixed $data): void {
    if (!is_iterable($data)) throw new TypeError("Expected iterable");
    foreach ($data as $item) { process($item); }
}

// is_numeric — includes numeric strings
var_dump(is_numeric("42"));    // true
var_dump(is_numeric("3.14"));  // true
var_dump(is_numeric("0x1A"));  // false (PHP 7+)',
                'doc_url' => 'https://www.php.net/manual/en/function.is-array.php',
            ],
            [
                'id'      => 174,
                'short'   => 'settype() / get_debug_type()',
                'detail'  => 'settype() changes the type of a variable in place. Cast operators (int), (string) etc. do the same without modifying the original. get_debug_type() (PHP 8.0) returns a precise type name — for objects it returns the class name, unlike gettype() which always returns "object".',
                'code'    => '// settype — modifies variable in place
$var = "42";
settype($var, "integer"); // $var is now int(42)

$var = 3.14;
settype($var, "string");  // $var is now string "3.14"

// Cast operators (preferred — cleaner, returns new value)
$n   = (int)"42";       // 42
$f   = (float)"3.14";   // 3.14
$s   = (string)100;     // "100"
$b   = (bool)"";        // false
$arr = (array)"hello";  // ["hello"]

// get_debug_type (PHP 8.0) — precise type information
echo get_debug_type(42);              // "int"
echo get_debug_type(3.14);            // "float"
echo get_debug_type("hello");         // "string"
echo get_debug_type(null);            // "null"
echo get_debug_type([]);              // "array"
echo get_debug_type(new DateTime());  // "DateTime"  (class name!)
echo get_debug_type(new class {});    // "class@anonymous"

// Compare with gettype()
echo gettype(new DateTime());         // "object"  (not the class name)
echo get_debug_type(new DateTime());  // "DateTime" (much more useful)

// Useful in error messages
function assertString(mixed $v): void {
    if (!is_string($v)) {
        throw new TypeError("Expected string, got " . get_debug_type($v));
    }
}',
                'doc_url' => 'https://www.php.net/manual/en/function.get-debug-type.php',
            ],
            [
                'id'      => 175,
                'short'   => 'log() / pi() / fmod()',
                'detail'  => 'log() computes the natural logarithm (or any base with the second argument). pi() returns π. fmod() returns the floating-point remainder. fdiv() (PHP 8.0) performs IEEE 754 division returning INF or NAN instead of errors.',
                'code'    => '// log — natural logarithm (base e)
echo log(M_E);   // 1.0
echo log(1);     // 0.0
echo log(100);   // 4.605...

// log with custom base
echo log(8, 2);      // 3.0  (log base 2 of 8)
echo log(1000, 10);  // 3.0  (same as log10(1000))
echo log10(1000);    // 3.0  (shorthand)

// pi
echo pi();    // 3.14159265358979...
echo M_PI;    // same — built-in constant

// Circle area
$r    = 5;
$area = M_PI * pow($r, 2); // 78.539...

// fmod — floating point remainder
echo fmod(10.5, 3.2); // 0.9  (10.5 - 3*3.2 = 0.9)
echo fmod(7.0, 2.5);  // 2.0
echo 10 % 3;          // 1 (integer modulo)

// fdiv — IEEE 754 division (PHP 8.0)
echo fdiv(10, 0);  // INF   (not an error)
echo fdiv(-1, 0);  // -INF
echo fdiv(0, 0);   // NAN
echo fdiv(10, 3);  // 3.333... (same as 10 / 3)

// Check float state
is_nan(fdiv(0, 0));     // true
is_infinite(fdiv(1,0)); // true
is_finite(3.14);        // true',
                'doc_url' => 'https://www.php.net/manual/en/function.log.php',
            ],
            [
                'id'      => 176,
                'short'   => 'sin() / cos() / tan()',
                'detail'  => 'PHP provides a full set of trigonometric functions: sin, cos, tan, asin, acos, atan, atan2 and their hyperbolic variants. All angles are in radians. Use deg2rad() to convert from degrees.',
                'code'    => '// All angles in radians
echo sin(M_PI / 2);  // 1.0   (sin 90°)
echo cos(M_PI);      // -1.0  (cos 180°)
echo tan(M_PI / 4);  // 1.0   (tan 45°)

// Convert degrees to radians
echo sin(deg2rad(90));  // 1.0
echo cos(deg2rad(0));   // 1.0
echo rad2deg(M_PI);     // 180.0

// Inverse trig
echo asin(1.0);          // M_PI/2 (1.5708...)
echo acos(1.0);          // 0.0
echo atan(1.0);          // M_PI/4 (0.7854...)
echo rad2deg(atan(1.0)); // 45.0

// atan2 — angle from origin to point (handles all quadrants)
echo atan2(1, 1);  // 0.7854 (45°)
echo atan2(1, -1); // 2.3562 (135°)

// Practical: rotate a point around origin
function rotatePoint(float $x, float $y, float $angleDeg): array {
    $rad = deg2rad($angleDeg);
    return [
        "x" => $x * cos($rad) - $y * sin($rad),
        "y" => $x * sin($rad) + $y * cos($rad),
    ];
}

// Hyperbolic functions
echo sinh(1.0); // 1.1752
echo cosh(0);   // 1.0
echo tanh(0);   // 0.0',
                'doc_url' => 'https://www.php.net/manual/en/function.sin.php',
            ],
            [
                'id'      => 177,
                'short'   => 'filesize() / filemtime()',
                'detail'  => 'filesize() returns the size of a file in bytes. filemtime() returns the last modification time as a Unix timestamp. PHP caches stat results — call clearstatcache() after modifying files. Related: filectime() (inode change), fileatime() (last access).',
                'code'    => '$path = "/var/www/html/uploads/photo.jpg";

// File size
$bytes = filesize($path); // e.g. 204800
$kb    = $bytes / 1024;
$mb    = $bytes / (1024 * 1024);
echo number_format($mb, 2) . " MB"; // "0.20 MB"

// Human-readable size
function humanFilesize(int $bytes): string {
    $units  = ["B", "KB", "MB", "GB", "TB"];
    $i      = 0;
    while ($bytes >= 1024 && $i < 4) { $bytes /= 1024; $i++; }
    return round($bytes, 2) . " " . $units[$i];
}
echo humanFilesize(204800); // "200 KB"

// Modification time
$mtime   = filemtime($path);           // Unix timestamp
$age     = time() - $mtime;
$daysOld = floor($age / 86400);
echo "Modified " . date("Y-m-d H:i", $mtime);

// ETag from modification time + size
$etag = md5(filemtime($path) . filesize($path));

// Clear stat cache after file operations
file_put_contents($path, $newContent);
clearstatcache(true, $path); // clear just for this path
echo filesize($path);        // now reads fresh value',
                'doc_url' => 'https://www.php.net/manual/en/function.filesize.php',
            ],
            [
                'id'      => 178,
                'short'   => 'mkdir() / rmdir()',
                'detail'  => 'mkdir() creates a directory. With recursive=true it creates all missing parent directories. rmdir() removes an empty directory. To remove non-empty directories use a recursive function.',
                'code'    => '// Create a directory (mode is octal)
mkdir("/tmp/mydir", 0755);

// Create nested directories (recursive)
mkdir("/var/www/uploads/2024/01/15", 0755, true);

// Check before creating
function ensureDir(string $path): void {
    if (!is_dir($path)) {
        if (!mkdir($path, 0755, true) && !is_dir($path)) {
            throw new RuntimeException("Failed to create directory: $path");
        }
    }
}

// Remove empty directory
rmdir("/tmp/mydir"); // fails if not empty

// Recursively remove a directory (custom function)
function removeDir(string $path): void {
    if (!is_dir($path)) return;
    $items = array_diff(scandir($path), [".", ".."]);
    foreach ($items as $item) {
        $full = $path . DIRECTORY_SEPARATOR . $item;
        is_dir($full) ? removeDir($full) : unlink($full);
    }
    rmdir($path);
}

// Create upload directory structure
$uploadDir = "/var/www/uploads/" . date("Y/m");
ensureDir($uploadDir);
$dest = $uploadDir . "/" . uniqid() . ".jpg";
move_uploaded_file($_FILES["photo"]["tmp_name"], $dest);',
                'doc_url' => 'https://www.php.net/manual/en/function.mkdir.php',
            ],
            [
                'id'      => 179,
                'short'   => 'realpath()',
                'detail'  => 'realpath() resolves a path to its canonical absolute form, resolving symlinks, ., and .. components. Returns false if the path does not exist. Use it to prevent directory traversal attacks by ensuring a file path stays within an allowed directory.',
                'code'    => 'echo realpath("/var/www/../www/html"); // "/var/www/html"
echo realpath("./src/../src/App.php");  // "/absolute/path/to/src/App.php"
echo realpath("/nonexistent");          // false

// Prevent directory traversal attacks
function safeReadFile(string $userFilename, string $baseDir): string {
    $baseDir  = realpath($baseDir);
    $fullPath = realpath($baseDir . "/" . $userFilename);

    // Check that the resolved path is INSIDE the base directory
    if ($fullPath === false || !str_starts_with($fullPath, $baseDir . DIRECTORY_SEPARATOR)) {
        throw new RuntimeException("Access denied: path traversal detected");
    }

    return file_get_contents($fullPath);
}

// Safe: "uploads/photo.jpg"   → /var/www/uploads/photo.jpg
// Blocked: "../../etc/passwd" → /etc/passwd (outside baseDir)

// Get current script directory reliably
$dir = realpath(__DIR__);

// Resolve symlinks
$real = realpath("/var/www/current"); // follows symlink to real path',
                'doc_url' => 'https://www.php.net/manual/en/function.realpath.php',
            ],
            [
                'id'      => 180,
                'short'   => 'move_uploaded_file()',
                'detail'  => 'move_uploaded_file() moves a file uploaded via HTTP POST to a new location. It validates that the file was genuinely uploaded (not a local path trick) and performs the move atomically. Always use it instead of rename() or copy() for uploaded files.',
                'code'    => '// HTML: <form enctype="multipart/form-data" method="post">
//         <input type="file" name="avatar">
//       </form>

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["avatar"])) {
    $file = $_FILES["avatar"];

    // 1. Check for upload errors
    if ($file["error"] !== UPLOAD_ERR_OK) {
        throw new RuntimeException("Upload error: " . $file["error"]);
    }

    // 2. Validate file size
    $maxSize = 2 * 1024 * 1024; // 2 MB
    if ($file["size"] > $maxSize) {
        throw new RuntimeException("File too large");
    }

    // 3. Validate MIME type using finfo (not $_FILES["type"] — spoofable)
    $finfo    = new finfo(FILEINFO_MIME_TYPE);
    $mimeType = $finfo->file($file["tmp_name"]);
    $allowed  = ["image/jpeg", "image/png", "image/gif", "image/webp"];
    if (!in_array($mimeType, $allowed, true)) {
        throw new RuntimeException("Invalid file type: $mimeType");
    }

    // 4. Generate safe filename and move
    $ext  = pathinfo($file["name"], PATHINFO_EXTENSION);
    $name = bin2hex(random_bytes(16)) . "." . strtolower($ext);
    $dest = "/var/www/uploads/" . $name;

    if (!move_uploaded_file($file["tmp_name"], $dest)) {
        throw new RuntimeException("Failed to move uploaded file");
    }

    echo "Uploaded: $name";
}',
                'doc_url' => 'https://www.php.net/manual/en/function.move-uploaded-file.php',
            ],
            [
                'id'      => 181,
                'short'   => 'sleep() / hrtime()',
                'detail'  => 'sleep() pauses execution for N seconds; usleep() for microseconds. hrtime() (PHP 7.3) returns a high-resolution monotonic timestamp in nanoseconds — ideal for benchmarking as it is immune to NTP clock adjustments.',
                'code'    => '// sleep — pause for whole seconds
sleep(2);  // pause 2 seconds

// usleep — microseconds (1 sec = 1,000,000 µs)
usleep(500000); // 0.5 seconds
usleep(100000); // 100ms

// Retry with backoff
function withRetry(callable $fn, int $maxAttempts = 3): mixed {
    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
        try {
            return $fn();
        } catch (\\Exception $e) {
            if ($attempt === $maxAttempts) throw $e;
            usleep(100000 * $attempt); // 100ms, 200ms, 300ms
        }
    }
}

// hrtime — monotonic high-resolution timer (PHP 7.3)
$start = hrtime(true);        // nanoseconds since arbitrary point
doExpensiveWork();
$ns    = hrtime(true) - $start;
printf("%.3f ms\\n", $ns / 1e6); // nanoseconds to milliseconds

// hrtime(false) returns [seconds, nanoseconds] array
[$sec, $ns] = hrtime(false);

// Compare with microtime
$t0 = microtime(true);
doWork();
$ms = (microtime(true) - $t0) * 1000;
// microtime can drift if system clock changes; hrtime cannot',
                'doc_url' => 'https://www.php.net/manual/en/function.sleep.php',
            ],
            [
                'id'      => 182,
                'short'   => 'uniqid()',
                'detail'  => 'uniqid() generates a time-based unique identifier using the current time in microseconds. It is NOT cryptographically secure — for tokens and secrets use random_bytes() or random_int(). The optional more_entropy flag adds extra randomness.',
                'code'    => '// Basic — based on microtime (predictable, not secure)
echo uniqid();         // "65a3f8c2d1e4b" (13 hex chars)
echo uniqid("user_"); // "user_65a3f8c2d1e4b"

// more_entropy — appends floating point jitter
echo uniqid("", true); // "65a3f8c2d1e4b9.12345678" (23 chars)

// Common uses (non-security)
$tempFile    = sys_get_temp_dir() . "/cache_" . uniqid() . ".tmp";
$uploadName  = uniqid("img_") . ".jpg";
$requestId   = uniqid("req_", true);

// SECURE alternatives for tokens
$token   = bin2hex(random_bytes(32));     // 64 hex chars, cryptographically secure
$token   = base64_encode(random_bytes(24)); // URL-safe if stripped of +/=

// UUID v4 — random, proper format
function uuid4(): string {
    $data    = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // version 4
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // variant
    return vsprintf("%s%s-%s-%s-%s-%s%s%s", str_split(bin2hex($data), 4));
}
echo uuid4(); // "a1b2c3d4-e5f6-4a7b-8c9d-e0f1a2b3c4d5"',
                'doc_url' => 'https://www.php.net/manual/en/function.uniqid.php',
            ],
            [
                'id'      => 183,
                'short'   => 'ord() / chr()',
                'detail'  => 'ord() returns the byte value (0-255) of the first character of a string. chr() converts a byte value back to a single-character string. Both work on bytes, not Unicode code points — use mb_ord() / mb_chr() (PHP 7.2) for full Unicode.',
                'code'    => '// ord — byte value of first character
echo ord("A");   // 65
echo ord("a");   // 97
echo ord("0");   // 48
echo ord(" ");   // 32
echo ord("\\n");  // 10
echo ord("€");   // 226 (first byte of UTF-8 encoding)

// chr — byte value to character
echo chr(65);    // "A"
echo chr(97);    // "a"
echo chr(10);    // "\\n" (newline)

// Check if character is uppercase letter
function isUpperAlpha(string $c): bool {
    $v = ord($c);
    return $v >= 65 && $v <= 90; // A-Z
}

// Simple Caesar cipher
function caesarCipher(string $text, int $shift): string {
    return implode("", array_map(function(string $c) use ($shift): string {
        $v = ord($c);
        if ($v >= 65 && $v <= 90) return chr(($v - 65 + $shift) % 26 + 65);
        if ($v >= 97 && $v <= 122) return chr(($v - 97 + $shift) % 26 + 97);
        return $c;
    }, mb_str_split($text)));
}

// PHP 7.2+ Unicode support
echo mb_ord("€", "UTF-8");   // 8364
echo mb_chr(8364, "UTF-8");  // "€"',
                'doc_url' => 'https://www.php.net/manual/en/function.ord.php',
            ],
            [
                'id'      => 184,
                'short'   => 'bin2hex() / hex2bin()',
                'detail'  => 'bin2hex() converts binary data to a hexadecimal representation (2 hex chars per byte). hex2bin() reverses it. Used for displaying binary data, generating hex tokens, and encoding arbitrary bytes as printable strings.',
                'code'    => '// bin2hex — binary to hex string
$binary = random_bytes(16);       // 16 random bytes
$hex    = bin2hex($binary);       // 32 hex chars
echo $hex; // "3a7f9c2e1b4d..."

// hex2bin — hex string back to binary
$back = hex2bin($hex);
var_dump($back === $binary); // true

// Generate a secure hex token
$token = bin2hex(random_bytes(32)); // 64 hex chars

// Encode arbitrary bytes for display
$data = "\\x00\\x01\\xFF\\xFE binary data";
echo bin2hex($data); // "0001fffe2062696e61727920646174"

// Practical: HMAC signature as hex
$sig = bin2hex(hash_hmac("sha256", $data, $key, true));

// Compare with base64
// bin2hex: 2 chars per byte (100% overhead) — but URL/filename safe
// base64:  ~1.33 chars per byte — more compact but needs padding

// Detect binary content
function isBinary(string $str): bool {
    return strlen($str) !== strlen(bin2hex($str)) / 2; // always true
    // Better: check for non-printable bytes
    return preg_match("/[^\\x09\\x0A\\x0D\\x20-\\x7E]/", $str) === 1;
}',
                'doc_url' => 'https://www.php.net/manual/en/function.bin2hex.php',
            ],
            [
                'id'      => 185,
                'short'   => 'htmlentities()',
                'detail'  => 'htmlentities() converts all applicable characters to HTML entities — more aggressive than htmlspecialchars(). It encodes accented characters like é → &eacute;. Use htmlspecialchars() for UTF-8 content (preferred); use htmlentities() when your output encoding is not UTF-8.',
                'code'    => '$text = "< Héllo & \\"World\\" >";

// htmlspecialchars — only converts: < > & " \'
echo htmlspecialchars($text, ENT_QUOTES, "UTF-8");
// "&lt; Héllo &amp; &quot;World&quot; &gt;"
// Note: é is NOT converted — fine for UTF-8 output

// htmlentities — converts ALL applicable characters
echo htmlentities($text, ENT_QUOTES, "UTF-8");
// "&lt; H&eacute;llo &amp; &quot;World&quot; &gt;"
// Note: é is converted to &eacute;

// Decode
echo html_entity_decode("&lt;p&gt;Hello &amp; World&lt;/p&gt;");
// "<p>Hello & World</p>"

echo htmlspecialchars_decode("&lt;b&gt;bold&lt;/b&gt;");
// "<b>bold</b>"

// For UTF-8 content, htmlspecialchars() is preferred:
// - Smaller output (accented chars stay as-is)
// - Faster (fewer conversions)
// - Browser renders them correctly anyway

// Use htmlentities() when outputting to a non-UTF-8 encoded page
// (e.g., ISO-8859-1) to ensure accented chars are safely represented',
                'doc_url' => 'https://www.php.net/manual/en/function.htmlentities.php',
            ],
            [
                'id'      => 186,
                'short'   => 'strtr()',
                'detail'  => 'strtr() translates characters or replaces substrings. With two strings it maps each character in the first to the corresponding character in the second. With an array it replaces substrings from longest to shortest match — useful for template substitution and character transliteration.',
                'code'    => '// Character-by-character mapping (two strings)
echo strtr("Hello World", "lo", "LO"); // "HeLLO WOrLd"
// Each char in "lo" → corresponding char in "LO"

// Array of replacements — longer keys take priority
$trans = [
    "Hello" => "Hi",
    "World" => "PHP",
    "!"     => ".",
];
echo strtr("Hello World!", $trans); // "Hi PHP."

// ROT13 manually
echo strtr(
    "Hello",
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz",
    "NOPQRSTUVWXYZABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm"
); // "Uryyb"

// Transliterate accented chars for slug generation
$chars = ["á"=>"a","č"=>"c","é"=>"e","í"=>"i","ó"=>"o","ú"=>"u",
          "ý"=>"y","ž"=>"z","š"=>"s","ř"=>"r","ň"=>"n","ď"=>"d","ť"=>"t"];
$slug = strtr(mb_strtolower($title), $chars);
$slug = preg_replace("/[^a-z0-9]+/", "-", $slug);
$slug = trim($slug, "-");

// Template substitution
$template = "Dear {name}, your order #{id} is ready.";
echo strtr($template, ["{name}" => "Alice", "{id}" => "1234"]);
// "Dear Alice, your order #1234 is ready."',
                'doc_url' => 'https://www.php.net/manual/en/function.strtr.php',
            ],
            [
                'id'      => 187,
                'short'   => 'levenshtein()',
                'detail'  => 'levenshtein() calculates the minimum number of single-character edits (insertions, deletions, substitutions) needed to transform one string into another. similar_text() computes similarity as a percentage. soundex() and metaphone() return phonetic keys for fuzzy name matching.',
                'code'    => '// Levenshtein distance — edit distance
echo levenshtein("kitten", "sitting"); // 3
echo levenshtein("saturday", "sunday"); // 3
echo levenshtein("", "hello");          // 5
echo levenshtein("identical", "identical"); // 0

// Spell-checker / did-you-mean
$dictionary = ["colour", "color", "collar", "cooler", "corner"];
$typo       = "collor";

$best = null;
$minDist = PHP_INT_MAX;
foreach ($dictionary as $word) {
    $dist = levenshtein($typo, $word);
    if ($dist < $minDist) {
        $minDist = $dist;
        $best    = $word;
    }
}
echo "Did you mean: $best?"; // "Did you mean: colour?"

// similar_text — similarity percentage
similar_text("World", "Word", $percent);
echo round($percent, 1) . "% similar"; // "88.9% similar"

// soundex — phonetic hash (English)
echo soundex("Robert"); // "R163"
echo soundex("Rupert"); // "R163" — same soundex!

// metaphone — more accurate phonetic key
echo metaphone("Smith");   // "SM0"
echo metaphone("Smythe");  // "SM0" — same',
                'doc_url' => 'https://www.php.net/manual/en/function.levenshtein.php',
            ],
            [
                'id'      => 188,
                'short'   => 'stripos() / strrpos()',
                'detail'  => 'stripos() is a case-insensitive version of strpos(). strrpos() finds the LAST occurrence. strstr() returns everything from the needle to the end; stristr() is case-insensitive. All accept a negative offset to search from the end.',
                'code'    => '$str = "Hello World Hello PHP";

// Case-insensitive position search
echo stripos($str, "HELLO"); // 0 — case ignored
echo stripos($str, "hello"); // 0

// Last occurrence
echo strrpos($str, "Hello");  // 12
echo strripos($str, "hello"); // 12 — last, case-insensitive

// strstr — returns from needle to end
echo strstr($str, "World");   // "World Hello PHP"
echo strstr($str, "World", true); // "Hello " — before needle

// stristr — case-insensitive strstr
echo stristr($str, "WORLD");  // "World Hello PHP"

// Check for substring (positions)
$email = "user@example.com";
if (stripos($email, "@example.com") !== false) {
    echo "Company email";
}

// Not found returns false — MUST use !== false
$pos = stripos($str, "java");
if ($pos === false) echo "Not found";

// Negative offset — search from end
$pos = strrpos("abcabc", "a", -3); // 3 (search backwards from -3)

// strrchr — last occurrence, returns to end
echo strrchr("/path/to/file.php", "/"); // "/file.php"',
                'doc_url' => 'https://www.php.net/manual/en/function.stripos.php',
            ],
            [
                'id'      => 189,
                'short'   => 'strtok()',
                'detail'  => 'strtok() splits a string into tokens using one or more delimiter characters. Unlike explode(), it handles multiple consecutive delimiters as one and is stateful — subsequent calls pass only the delimiter. Useful for parsing structured text.',
                'code'    => '// Split a string by whitespace/commas
$str   = "Hello, World! PHP is great";
$token = strtok($str, " ,!"); // first call — provide string + delimiter

while ($token !== false) {
    echo $token . "\\n"; // Hello, World, PHP, is, great
    $token = strtok(" ,!"); // subsequent calls — delimiter only
}

// Difference from explode: multiple delimiters as one (no empty tokens)
// explode(" ", "a  b") → ["a", "", "b"]  (empty string in middle)
// strtok("a  b", " ")  → "a", "b"        (double space treated as one)

// Parse a simple key=value config file
$config = "name=Alice age=30 city=Prague";
$token  = strtok($config, " ");
$data   = [];
while ($token !== false) {
    [$key, $val] = explode("=", $token, 2);
    $data[$key]  = $val;
    $token       = strtok(" ");
}
// ["name"=>"Alice", "age"=>"30", "city"=>"Prague"]

// NOTE: strtok uses internal static state — not re-entrant!
// Two simultaneous strtok loops on different strings will conflict.
// Use preg_split() or explode() for complex cases.',
                'doc_url' => 'https://www.php.net/manual/en/function.strtok.php',
            ],
            [
                'id'      => 190,
                'short'   => 'parse_str() / str_getcsv()',
                'detail'  => 'parse_str() parses a URL-encoded query string into variables or an array. str_getcsv() (PHP 5.3) parses a CSV-formatted string into an array — useful for single lines without needing a file handle.',
                'code'    => '// parse_str — URL query string to array
parse_str("name=Alice&age=30&tags[]=php&tags[]=mysql", $params);
// $params = ["name"=>"Alice", "age"=>"30", "tags"=>["php","mysql"]]

// The second argument is REQUIRED — without it, variables are injected
// into current scope (security risk, deprecated behaviour)
parse_str($_SERVER["QUERY_STRING"], $get); // safe alternative to $_GET

// str_getcsv — parse a CSV line/string
$row = str_getcsv("Alice,30,\\"Prague, CZ\\",admin");
// ["Alice", "30", "Prague, CZ", "admin"]

// Custom delimiter
$row = str_getcsv("Alice;30;Prague", ";");
// ["Alice", "30", "Prague"]

// Parse a multi-line CSV string (without a file)
$csv     = "name,age\\nAlice,30\\nBob,25";
$lines   = explode("\\n", $csv);
$headers = str_getcsv(array_shift($lines));
$records = array_map(fn($l) => array_combine($headers, str_getcsv($l)), $lines);
// [["name"=>"Alice","age"=>"30"],["name"=>"Bob","age"=>"25"]]

// Rebuild query string
$params["page"] = 2;
$qs = http_build_query($params); // "name=Alice&age=30&tags[0]=php..."',
                'doc_url' => 'https://www.php.net/manual/en/function.parse-str.php',
            ],
            [
                'id'      => 191,
                'short'   => 'printf() / fprintf()',
                'detail'  => 'printf() outputs a formatted string directly. fprintf() writes it to a file handle. Both support the same format specifiers as sprintf(). vprintf() and vsprintf() accept an array of arguments instead of variadic ones.',
                'code'    => '// printf — print formatted string
printf("Hello, %s! You are %d years old.\\n", "Alice", 30);

// Padding and alignment
printf("%-20s %5.2f\\n", "Apple",  1.50);  // "Apple                1.50"
printf("%-20s %5.2f\\n", "Banana", 0.75);  // "Banana               0.75"

// Table output
$items = [["Apple", 1.5], ["Banana", 0.75], ["Cherry", 2.0]];
printf("%-12s %8s\\n", "Item", "Price");
printf("%-12s %8s\\n", str_repeat("-",12), str_repeat("-",8));
foreach ($items as [$name, $price]) {
    printf("%-12s %8.2f\\n", $name, $price);
}

// fprintf — write to file handle
$fh = fopen("report.txt", "w");
fprintf($fh, "Report generated: %s\\n", date("Y-m-d H:i:s"));
foreach ($data as $row) {
    fprintf($fh, "%-20s %10.2f\\n", $row["name"], $row["total"]);
}
fclose($fh);

// vprintf — array of arguments
$values = ["Alice", 30, "Prague"];
vprintf("Name: %s, Age: %d, City: %s\\n", $values);

// Return string (not print) — use sprintf() or vsprintf()
$str = vsprintf("%s is %d years old", ["Alice", 30]);',
                'doc_url' => 'https://www.php.net/manual/en/function.printf.php',
            ],
            [
                'id'      => 192,
                'short'   => 'lcfirst() / str_rot13()',
                'detail'  => 'lcfirst() lowercases the first character of a string. str_rot13() applies ROT-13 encoding — each letter is shifted 13 places, and applying it twice returns the original (symmetric). Calling str_rot13() twice decodes the string.',
                'code'    => '// lcfirst — lowercase first character only
echo lcfirst("Hello World");  // "hello World"
echo lcfirst("PHP is Great"); // "pHP is Great"

// Convert PascalCase to camelCase
function toCamelCase(string $pascal): string {
    return lcfirst($pascal);
}
echo toCamelCase("MyVariableName"); // "myVariableName"
echo toCamelCase("UserRepository"); // "userRepository"

// ucfirst vs lcfirst
echo ucfirst("hello world"); // "Hello world"
echo lcfirst("Hello World"); // "hello World"

// str_rot13 — ROT-13 encoding (symmetric cipher)
echo str_rot13("Hello World"); // "Uryyb Jbeyq"
echo str_rot13("Uryyb Jbeyq"); // "Hello World" — applying twice decodes

// Only rotates letters, leaves other chars unchanged
echo str_rot13("Hello, World! 123"); // "Uryyb, Jbeyq! 123"

// Historical use: hide spoilers in newsgroups
$spoiler = str_rot13("Darth Vader is Luke\'s father");
echo "ROT13: $spoiler\\n";                  // hidden
echo "Decoded: " . str_rot13($spoiler);    // revealed

// str_shuffle — randomly shuffle characters
echo str_shuffle("Hello"); // e.g. "lloHe" (different each time)',
                'doc_url' => 'https://www.php.net/manual/en/function.lcfirst.php',
            ],
            [
                'id'      => 193,
                'short'   => 'crc32()',
                'detail'  => 'crc32() calculates the 32-bit CRC (Cyclic Redundancy Check) of a string as a signed integer. Fast but NOT cryptographically secure — use hash() for security. Common uses: quick data integrity checks, hash table distribution, and sharding keys.',
                'code'    => 'echo crc32("Hello World"); // 222957957 (signed int)

// Can be negative on 64-bit PHP (use sprintf for hex)
echo sprintf("%u", crc32("Hello World")); // unsigned: 222957957
echo sprintf("%08x", crc32("data"));       // hex: "748c5b2c"

// Quick integrity check (non-security)
$data     = file_get_contents("file.dat");
$checksum = crc32($data);
// ... transfer file ...
if (crc32($received) !== $checksum) {
    echo "Data corrupted";
}

// Consistent sharding (route keys to one of N buckets)
function shardId(string $key, int $buckets): int {
    return abs(crc32($key)) % $buckets;
}
echo shardId("user_42", 8);    // always same bucket for this key
echo shardId("user_43", 8);    // different bucket

// Cache key distribution
$bucket  = shardId($cacheKey, 16);
$cacheServer = $servers[$bucket];

// For security-critical checksums use hash():
echo hash("sha256", $data); // cryptographically secure',
                'doc_url' => 'https://www.php.net/manual/en/function.crc32.php',
            ],
            [
                'id'      => 194,
                'short'   => 'json_validate()',
                'detail'  => 'json_validate() (PHP 8.3) checks whether a string is valid JSON without fully decoding it. Much more efficient than json_decode() when you only need to validate, as it does not build a PHP value from the data.',
                'code'    => '// PHP 8.3+
var_dump(json_validate(\'{"name":"Alice","age":30}\')); // true
var_dump(json_validate("[1, 2, 3]"));                  // true
var_dump(json_validate("null"));                       // true
var_dump(json_validate("true"));                       // true

var_dump(json_validate("{invalid}"));        // false
var_dump(json_validate(""));                 // false
var_dump(json_validate("undefined"));        // false
var_dump(json_validate("{\\"a\\":,}"));        // false

// Much faster than json_decode() for validation-only
function isValidJson(string $input): bool {
    if (PHP_VERSION_ID >= 80300) {
        return json_validate($input);
    }
    // Fallback for older PHP
    json_decode($input);
    return json_last_error() === JSON_ERROR_NONE;
}

// API request body validation
$body = file_get_contents("php://input");
if (!json_validate($body)) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON body"]);
    exit;
}
$data = json_decode($body, true);',
                'doc_url' => 'https://www.php.net/manual/en/function.json-validate.php',
            ],
            [
                'id'      => 195,
                'short'   => 'flock()',
                'detail'  => 'flock() provides advisory file locking to prevent concurrent writes corrupting a file. LOCK_EX acquires an exclusive write lock; LOCK_SH a shared read lock; LOCK_UN releases it. file_put_contents() with LOCK_EX is a convenient shorthand.',
                'code'    => '// Exclusive lock for writing
$fh = fopen("/var/data/counter.txt", "c+");

if (flock($fh, LOCK_EX)) {
    // Critical section — no other process can write while we hold lock
    $count = (int)fread($fh, 20);
    $count++;
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, $count);
    fflush($fh);

    flock($fh, LOCK_UN); // release lock
} else {
    echo "Could not acquire lock";
}
fclose($fh);

// Non-blocking attempt
if (flock($fh, LOCK_EX | LOCK_NB)) {
    // Got lock immediately
    // ...
    flock($fh, LOCK_UN);
} else {
    echo "File is locked, skipping";
}

// file_put_contents shorthand
file_put_contents("/tmp/data.txt", $content, LOCK_EX);

// Shared read lock (multiple readers allowed)
$fh = fopen("/var/data/config.json", "r");
flock($fh, LOCK_SH);
$data = fread($fh, filesize("/var/data/config.json"));
flock($fh, LOCK_UN);
fclose($fh);',
                'doc_url' => 'https://www.php.net/manual/en/function.flock.php',
            ],
            [
                'id'      => 196,
                'short'   => 'chunk_split()',
                'detail'  => 'chunk_split() splits a string into chunks of a given length and inserts a separator after each chunk. Defaults to 76-character chunks with \\r\\n separators — the standard for base64-encoded MIME email content.',
                'code'    => '// Default: 76 chars + CRLF (base64 email encoding)
$encoded = base64_encode($binaryData);
$mime    = chunk_split($encoded); // 76-char lines with CRLF

// Custom chunk size and separator
echo chunk_split("0123456789", 3, "-"); // "012-345-678-9-"
echo chunk_split("ABCDEFGH",   4, " "); // "ABCD EFGH "

// Format a credit card number
echo chunk_split("4111111111111111", 4, " "); // "4111 1111 1111 1111 "
// (trim trailing space)

// Build a MIME email part with base64 encoded attachment
$content   = file_get_contents("document.pdf");
$encoded   = base64_encode($content);
$formatted = chunk_split($encoded, 76, "\\r\\n");

$email  = "Content-Type: application/pdf\\r\\n";
$email .= "Content-Transfer-Encoding: base64\\r\\n\\r\\n";
$email .= $formatted;

// Compare with wordwrap()
// chunk_split — always splits at exact length (may break words/bytes)
// wordwrap    — splits on word boundaries (safer for text)',
                'doc_url' => 'https://www.php.net/manual/en/function.chunk-split.php',
            ],
            [
                'id'      => 197,
                'short'   => 'disk_free_space()',
                'detail'  => 'disk_free_space() returns available bytes on the filesystem containing the given path. disk_total_space() returns total capacity. Essential for upload handlers and backup scripts to avoid filling the disk.',
                'code'    => '$path = "/var/www/uploads";

$free  = disk_free_space($path);    // bytes available
$total = disk_total_space($path);   // total capacity
$used  = $total - $free;
$pct   = round($used / $total * 100, 1);

echo "Free:  " . humanBytes($free)  . "\\n";
echo "Total: " . humanBytes($total) . "\\n";
echo "Used:  $pct%\\n";

function humanBytes(float $bytes): string {
    $units = ["B","KB","MB","GB","TB"];
    $i = 0;
    while ($bytes >= 1024 && $i < 4) { $bytes /= 1024; $i++; }
    return round($bytes, 2) . " " . $units[$i];
}

// Before accepting a file upload
function checkDiskSpace(string $dir, int $requiredBytes): void {
    if (disk_free_space($dir) < $requiredBytes * 1.1) { // 10% buffer
        throw new RuntimeException("Insufficient disk space");
    }
}

$fileSize = $_FILES["upload"]["size"];
checkDiskSpace("/var/uploads", $fileSize);
move_uploaded_file($_FILES["upload"]["tmp_name"], "/var/uploads/file");

// Alert if disk is > 90% full
if ($pct > 90) {
    error_log("WARNING: disk at {$pct}% on $path");
}',
                'doc_url' => 'https://www.php.net/manual/en/function.disk-free-space.php',
            ],
            [
                'id'      => 198,
                'short'   => 'parse_ini_file()',
                'detail'  => 'parse_ini_file() parses a .ini configuration file into an associative array. With process_sections=true it returns a nested array keyed by section name. parse_ini_string() parses an INI-formatted string directly.',
                'code'    => '// config.ini:
// [database]
// host = localhost
// port = 5432
// name = myapp
//
// [cache]
// driver = redis
// ttl = 3600

// Without sections
$config = parse_ini_file("config.ini");
echo $config["host"];   // "localhost"
echo $config["driver"]; // "redis"

// With sections
$config = parse_ini_file("config.ini", true);
echo $config["database"]["host"];  // "localhost"
echo $config["database"]["port"];  // "5432"
echo $config["cache"]["driver"];   // "redis"

// Supported value types
// key = value       → string "value"
// key = 42          → int 42 (INI_SCANNER_TYPED mode)
// key = true/false  → bool
// key = null        → null

// INI_SCANNER_TYPED — preserve native types (PHP 5.6+)
$config = parse_ini_file("config.ini", true, INI_SCANNER_TYPED);
var_dump($config["database"]["port"]); // int(5432)

// parse_ini_string — parse from a string variable
$ini = "[db]\\nhost=localhost\\nport=5432";
$cfg = parse_ini_string($ini, true);
echo $cfg["db"]["host"]; // "localhost"',
                'doc_url' => 'https://www.php.net/manual/en/function.parse-ini-file.php',
            ],
            [
                'id'      => 199,
                'short'   => 'addslashes() / stripslashes()',
                'detail'  => 'addslashes() escapes single quotes, double quotes, backslashes, and NUL bytes with a backslash. stripslashes() removes those escapes. These are NOT a replacement for parameterized queries or htmlspecialchars() — use them only for specific legacy contexts.',
                'code'    => '$str = "It\'s a \\"test\\" with \\backslash";

// addslashes — add escaping backslashes
$escaped = addslashes($str);
// "It\'s a \\"test\\" with \\backslash"

// stripslashes — remove them
$original = stripslashes($escaped);
// "It\'s a \\"test\\" with \\backslash"

// Historical context — Magic Quotes (removed in PHP 5.4)
// Older PHP auto-escaped $_GET/$_POST with addslashes.
// Code may need stripslashes() for legacy compatibility:
function cleanInput(string $value): string {
    return get_magic_quotes_gpc() ? stripslashes($value) : $value;
}

// NEVER use addslashes for SQL — use PDO prepared statements
// WRONG (vulnerable):
$sql = "SELECT * FROM users WHERE name = \'" . addslashes($name) . "\'";
// RIGHT (safe):
$stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
$stmt->execute([$name]);

// NEVER use addslashes for HTML output — use htmlspecialchars
// WRONG:
echo addslashes($userInput); // XSS still possible
// RIGHT:
echo htmlspecialchars($userInput, ENT_QUOTES, "UTF-8");',
                'doc_url' => 'https://www.php.net/manual/en/function.addslashes.php',
            ],
            [
                'id'      => 200,
                'short'   => 'fseek() / ftell() / rewind()',
                'detail'  => 'fseek() moves the file pointer to a specific byte position. ftell() returns the current position. rewind() resets to the start (same as fseek($fh, 0)). Essential for reading a file multiple times or writing to specific positions.',
                'code'    => '$fh = fopen("data.bin", "r+");

// ftell — current position
echo ftell($fh); // 0 (at start)

// Read 10 bytes
$data = fread($fh, 10);
echo ftell($fh); // 10

// fseek — move to byte 50 from start (SEEK_SET)
fseek($fh, 50);
echo ftell($fh); // 50

// Seek relative to current position (SEEK_CUR)
fseek($fh, 10, SEEK_CUR);  // now at 60

// Seek from end (SEEK_END)
fseek($fh, -10, SEEK_END); // 10 bytes before EOF

// rewind — back to start
rewind($fh);
echo ftell($fh); // 0

// Practical: read a specific record in a fixed-width binary file
$recordSize = 64; // bytes per record
$recordNum  = 5;
fseek($fh, $recordSize * $recordNum);
$record = fread($fh, $recordSize);

// Read a file twice
$fh   = fopen("log.txt", "r");
$data = fread($fh, filesize("log.txt")); // first pass
rewind($fh);
$data = fread($fh, filesize("log.txt")); // second pass
fclose($fh);',
                'doc_url' => 'https://www.php.net/manual/en/function.fseek.php',
            ],
        ];
    }

    public static function versions(): array
    {
        return [
            0 => 'PHP 3.0',
            1 => 'PHP 3.0',
            2 => 'PHP 4.0',
            3 => 'PHP 3.0',
            4 => 'PHP 4.0',
            5 => 'PHP 3.0',
            6 => 'PHP 4.0',
            7 => 'PHP 3.0',
            8 => 'PHP 3.0',
            9 => 'PHP 4.0',
            10 => 'PHP 4.0',
            11 => 'PHP 5.0',
            12 => 'PHP 5.0',
            13 => 'PHP 5.0',
            14 => 'PHP 5.0',
            15 => 'PHP 5.0',
            16 => 'PHP 5.0',
            17 => 'PHP 5.0',
            18 => 'PHP 5.6',
            19 => 'PHP 5.3',
            20 => 'PHP 4.0',
            21 => 'PHP 4.0',
            22 => 'PHP 4.0',
            23 => 'PHP 4.0',
            24 => 'PHP 4.0',
            25 => 'PHP 4.0',
            26 => 'PHP 4.0',
            27 => 'PHP 4.0',
            28 => 'PHP 3.0',
            29 => 'PHP 3.0',
            30 => 'PHP 4.0',
            31 => 'PHP 4.0',
            32 => 'PHP 4.0',
            33 => 'PHP 4.0',
            34 => 'PHP 4.0',
            35 => 'PHP 4.0',
            36 => 'PHP 4.0',
            37 => 'PHP 4.0',
            38 => 'PHP 4.0',
            39 => 'PHP 4.0',
            40 => 'PHP 4.0',
            41 => 'PHP 3.0',
            42 => 'PHP 4.0',
            43 => 'PHP 5.0',
            44 => 'PHP 4.0',
            45 => 'PHP 4.0',
            46 => 'PHP 4.0',
            47 => 'PHP 4.0',
            48 => 'PHP 4.0',
            49 => 'PHP 4.0',
            50 => 'PHP 4.0',
            51 => 'PHP 4.0',
            52 => 'PHP 4.0',
            53 => 'PHP 4.0',
            54 => 'PHP 4.0',
            55 => 'PHP 3.0',
            56 => 'PHP 5.0',
            57 => 'PHP 4.0',
            58 => 'PHP 4.3',
            59 => 'PHP 4.0',
            60 => 'PHP 4.0',
            61 => 'PHP 5.0',
            62 => 'PHP 5.0',
            63 => 'PHP 5.1',
            64 => 'PHP 5.1',
            65 => 'PHP 5.6',
            66 => 'PHP 4.0',
            67 => 'PHP 4.0',
            68 => 'PHP 4.0',
            69 => 'PHP 4.0',
            70 => 'PHP 4.0',
            71 => 'PHP 4.0',
            72 => 'PHP 4.0',
            73 => 'PHP 8.0',
            74 => 'PHP 4.0',
            75 => 'PHP 4.0',
            76 => 'PHP 4.0',
            77 => 'PHP 4.0',
            78 => 'PHP 4.0',
            79 => 'PHP 4.0',
            80 => 'PHP 4.0',
            81 => 'PHP 4.0',
            82 => 'PHP 4.0',
            83 => 'PHP 4.0',
            84 => 'PHP 4.0',
            85 => 'PHP 4.0',
            86 => 'PHP 4.0',
            87 => 'PHP 5.0',
            88 => 'PHP 4.0',
            89 => 'PHP 4.0',
            90 => 'PHP 4.0',
            91 => 'PHP 5.3',
            92 => 'PHP 4.0',
            93 => 'PHP 8.3',
            94 => 'PHP 4.0',
            95 => 'PHP 4.0',
            96 => 'PHP 4.1',
            97 => 'PHP 4.0',
            98 => 'PHP 4.0',
            99 => 'PHP 4.0',
        ];
    }
}
