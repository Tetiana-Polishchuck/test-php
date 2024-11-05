# test-php

docker-compose up -d
composer install
додати налаштування БД в config\database.php

перше завдання http://localhost:8080
друге завдання http://localhost:8080/script.php

при змінах в docker-compose.yml зупитини контейнери (docker-compose down) і заново білдити 

додала приклади таблиць в db_example, можливо будуть корисними

запуск тестування: php vendor/bin/phpunit з кореня проекта


приклад database.php

$host = 'host_name';
$db   = 'db_name';
$user = 'user_name';
$pass = 'password_name';
$charset = 'utf8mb4';



$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
