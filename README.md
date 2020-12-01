# Employee Management System
## Development tools
* [Composer](https://getcomposer.org/download/)
* [Symfony CLI](https://symfony.com/download)
* [XAMPP](https://www.apachefriends.org/pl/download.html)
* [Git](https://git-scm.com/downloads)
* [Node.js](https://nodejs.org/en/download/) 
* Code Editor (PHPStorm, Visual Studio Code etc.)
## Instalation
1. Clone repository: `git clone https://github.com/TheSylwio/employee-management-system.git`
2. Install composer dependencies: `composer i`
3. Run MySQL in XAMPP
4. Create local database: `php bin/console doctrine:database:create`
5. Update database schema: `php bin/console doctrine:schema:update --force`
6. Load example data: `php bin/console doctrine:fixtures:load -n`
7. Install JavaScript dependencies: `npm i`
8. Build JavaScript bundle: `npm run build`
9. Run local server: `symfony serve`
