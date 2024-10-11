﻿# Proyecto-Final-Back
Se agrega cambio para el feature de prueba

## Como configurar el proyecto
### iniciar XAMPP levantando mysql y servidor apache
### ejecutar los siguientes comandos:
    composer install
    composer require vlucas/phpdotenv

## Como crear .env
    DB_HOST=127.0.0.1
    DB_NAME=mydb
    DB_USER=root
    DB_PASSWORD=contraseña

## Como usar git flow
    git flow init
    git flow feature start nombrebranch*
    git add *
    git commit -m ""
    git flow feature publish nombrebranch*
