Jagger
===

> **Note:** This branch (`copilot/update-package-to-laravel-12`) contains the in-progress conversion of Jagger from CodeIgniter 3 to **Laravel 12**. See [Laravel 12 Migration Notes](#laravel-12-migration) below.

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/dc2b2ceb-7538-4f57-81b2-305fbb7ee4e5/big.png)](https://insight.sensiolabs.com/projects/dc2b2ceb-7538-4f57-81b2-305fbb7ee4e5)

Jagger (http://jagger.heanet.ie) is developed by HEAnet to manage the Edugate multiparty SAML federation. Other organisations use Jagger to manage their federations but it can be used to manage the web-of-trust for a single entity. It can also be used a a GUI for the Shibboleth SAML Identity Provider (www.shibboleth.net)

Features:

1. Synchronise SAML metadata from another federation.
2. Create and manage a federation
3. Create a single circle of trust containing metadata of all entities that your organisation particpates via multiple federations.
4. GUI to manage to the attribute policy of identity providers based on the Shibboleth SAML implementation.
5. Filter the RequestedAttribute's of a SAML service provider to allow and IdP release attributes to such providers based on a policy set in the Jagger GUI.
6. Create and edit metadata of individual entities.
7. Notification subsystem with subscription options


Installation: check INSTALL.txt


Upgrades: UPGRADE.txt


Documentation (Admin guide) - http://jagger.heanet.ie/jaggerdocadmin/ (not final yet)

----

## Laravel 12 Migration

This branch converts the Jagger application from **CodeIgniter 3** to **Laravel 12**.

### Requirements

- PHP >= 8.2
- MySQL >= 5.7 / MariaDB >= 10.3 / PostgreSQL >= 11
- Composer
- Node.js >= 18 (for frontend assets)

### New Structure

```
.
├── app/                    # Laravel application code
│   ├── Http/Controllers/   # Laravel controllers (migration in progress)
│   ├── Models/             # Eloquent models (migration in progress)
│   └── Providers/          # Service providers
├── bootstrap/              # Laravel bootstrap files
├── config/                 # Laravel configuration
├── database/               # Migrations, factories, seeders
├── public/                 # Web root (Laravel)
├── resources/              # Views, CSS, JS
├── routes/                 # Route definitions
│   ├── web.php             # Web routes (converted from CodeIgniter routes.php)
│   └── console.php         # Console commands
├── storage/                # Logs, cache, sessions
├── tests/                  # PHPUnit tests
├── artisan                 # Laravel CLI tool
├── composer.json           # Laravel 12 + Jagger dependencies
└── application/            # Legacy CodeIgniter code (reference, being migrated)
```

### Quick Start (Laravel 12)

```bash
# 1. Install dependencies
composer install

# 2. Copy environment file
cp .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Configure your database in .env

# 5. Run migrations
php artisan migrate

# 6. Install frontend dependencies
npm install
npm run build

# 7. Start the development server
php artisan serve
```

### Dependency Changes

The following packages have been updated for PHP 8.2+ and Laravel 12 compatibility:

| Old Package | New Package | Reason |
|---|---|---|
| `zendframework/zend-permissions-acl` ^2.6 | `laminas/laminas-permissions-acl` ^2.13 | ZendFramework was rebranded to Laminas |
| `mtdowling/cron-expression` 1.1.* | `dragonmantank/cron-expression` ^3.3 | Package was transferred to new maintainer |
| `phpseclib/phpseclib` 2.0.* | `phpseclib/phpseclib` ^3.0 | Updated for PHP 8.x compatibility |
| `lcobucci/jwt` 3.2.* | `lcobucci/jwt` ^5.4 | Major version update with PSR compliance |
| `php-amqplib/php-amqplib` 2.6.* | `php-amqplib/php-amqplib` ^3.6 | PHP 8.x compatibility update |
| `doctrine/orm` 2.4.* | `doctrine/orm` ^2.18 | Updated for PHP 8.2+ compatibility |
| `robrichards/xmlseclibs` ^3.0 | `robrichards/xmlseclibs` ^3.1 | Minor security update |

### Migration Status

- [x] Laravel 12 project structure scaffolded
- [x] Root `composer.json` updated with Laravel 12 + updated dependencies
- [x] Application `application/composer.json` dependencies updated to PHP 8.2+ versions
- [x] Bootstrap files (`bootstrap/app.php`, `bootstrap/providers.php`)
- [x] Configuration files (`config/app.php`, `config/database.php`, etc.)
- [x] Routes converted (`routes/web.php` from CodeIgniter `application/config/routes.php`)
- [x] Base controller and model stubs
- [x] Database migrations (users, sessions, cache, jobs tables)
- [x] Laravel environment configuration (`.env.example`)
- [x] Public entry point (`public/index.php`, `public/.htaccess`)
- [ ] Controllers migration (CodeIgniter → Laravel HTTP controllers)
- [ ] Models migration (Doctrine ORM → Eloquent or Doctrine-Laravel integration)
- [ ] Views migration (PHP views → Blade templates)
- [ ] Authentication system migration
- [ ] Middleware migration (from CodeIgniter hooks)
- [ ] Service layer migration (libraries → Service classes)
- [ ] Console commands migration
- [ ] Full test coverage

----

