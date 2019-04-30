<?php
if (PHP_SAPI != 'cli') {
    exit('RODAR VIA CLI');
}

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/src/dependencies.php';
$dependencies($app);


$container = $app->getContainer();

$db = $container->get('db');
$schema = $db->schema();
$tableName = 'produtos';

$schema->dropIfExists($tableName);
$schema->create($tableName, function ($table) {
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->timestamps();
});

$db->table($tableName)->insert(
    [
        'titulo' => 'Moto G6',
        'descricao' => 'Celular motorola moto g6 com 32gb de memoria interna.',
        'preco' => 899.99,
        'fabricante' => 'Motorola',
        'created_at' => '2019-10-22',
        'updated_at' => '2019-10-22'
    ]
);

$db->table($tableName)->insert(
    [
        'titulo' => 'iPhone X',
        'descricao' => 'Celular Apple iPhone X com 64gb de memoria interna e um preço salgado.',
        'preco' => 6999.99,
        'fabricante' => 'Apple',
        'created_at' => '2019-04-20',
        'updated_at' => '2019-04-20'
    ]
);