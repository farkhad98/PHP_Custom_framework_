<?php

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

// function env(string $name): string | null{
//     try{
//         return $_ENV[$name];
//     } catch (\Exception $e){
//         return null;
//     }
// }
