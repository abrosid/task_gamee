# task_gamee
---------------------------------

## Description

Zadáním je vytvořit API endpoint pro ukládání score ze hry a endpoint pro zobrazení prvních 10 hráčů pro konkrétní hru určenou v parametrech requestu.

 

Client (např JavaScript) zasílá po dohrání hry xhr request na server ve schématu jsonrpc (http://www.jsonrpc.org/specification). Payload requestu nese: ID hry (int), ID usera (int) a nahrané score (int).

PHP aplikace přijme request, uloží data do žebříčku a vrátí success odpověď. Je jedno, zda aplikace poběží přes php fpm, php server nebo cokoliv jiného.

 

Technologické požadavky:

    - Použití nette/di

    - Ukládání žebříčku do nějaké vhodné datové struktury Redisu (screw data persistency)

 

Validace vstupních dat:

    - zvalidovat vstup

    - Na nevalidní vstup potom smysluplně odpovídat (opět podle jsonrpc specky)

 

Bonusové body:

    - Usery mají pro stejné skóre stejný rank/pozici
    
    - vyklonovat git repo


## Usage and prerequests

Please, use <a href="https://www.getpostman.com/" target="_blank">Postman</a> to send JsonRPC requests and get preview of responses.

Connection to <a href="https://redis.io/" target="_blank">Redis</a> server is required.

PHP client <a href="https://github.com/nrk/predis" target="_blank">Predis</a> is used to handle connection to Redis server.


## Instalation guide


Clone from this repo and run in cli, inside project folder: `composer install`

Create folders named `log` and `temp` inside the project's root folder and set the previligues to write and read if required.

Configure `app\config\config.neon` and `app\config\config.local.neon` files if required (these files are preconfigured by default).

Open browser, run project url and follow the displyed info.


## TODO

    - napsat `docker-compose up`
    
    - aplikace nastartovat na předem daném portu
