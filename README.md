# Vuetified Laravel Preset

## Demo
<iframe width="560" height="315" src="https://www.youtube.com/embed/5rTqqHm2cWM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

## Installation

```
composer require codeitlikemiley/vuetified-laravel-preset
```

## Usage

### Scafold Basic Set Up

- The Following Composer json to be added

```
inertiajs/inertia-laravel
squizlabs/php_codesniffer
pragmarx/version
jackiedo/dotenv-editor
```

- The Following NPM packages to be added

```
inertiajs/inertia-vue
@babel/plugin-syntax-dynamic-import
```

- The Following Stubs to be added (intertia.js)
<iframe width="560" height="315" src="https://www.youtube.com/embed/5rTqqHm2cWM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
```
resources/views/app.blade.php
app/Http/Kernel.php
webpack.mix.js
.babelrc
app.js (inertia enable + plugins enabled)
resouces/js/Shared/Layout.vue
resources/js/Pages
```

- the following stubs to be added Vuetify

```

```

- The Following Stubs Be added on root folder

```
.vscode
.phpcs.xml
```

- The Following Stube Be added on .git folder

```
pre-commit
post-commit
```

```
php artisan preset vuetified

Procedues
// Remove Unneccesarry Packages
// Add VSCODE Settings
// Add PHPCS linting and Fix
// Add app.js (plugins Ready)
// Add Options to Install Tailwind / Vuetify
// Scaffold Inertia.js
```

### Scaffold A Laravel Echo Server Set Up

- The Following Stubs Will Be Used

```
config/echo.php
.env.echo
websockets.js
resources/js/plugins/laravel-echo-server
```

- The Following Composer Dependencies will be Installed

```
predis/predis

```

- The Following NPM Packages wil be Installed

```
laravel-echo-server
laravel-echo
sqlite3
socket.io-client
```

- To Install And Scaffold This Run

```
php artisan echo:install

Procedures
// install predis is found on composer.json
// add to packages.json needed packages
// copy stubs
// append to .env new ENV VARS
// generate echo keys
// ask if we wanna use ssl cert
// run valet secure and edit env var
// echo uncomment // App\Providers\BroadcastServiceProvider::class
// Add mixins stubs for listening to frontend broadcast
// echo `node websockets` to run laravel echo server

```

- To Remove Laravel Echo Run this

```
php artisan echo:uninstall

Procedures
// remove predis on composer.json
// remove all added packages in packages.json
// remove all stubs that was copied
// remove all .env VARS appended
// issue valet unsecure command if ECHO_PROTOCOL=https
// remove sqlite file if ECHO_DB=sqlite
```

### Add Laravel Websockets

- The Following Composer Dependencies Will Be Installed

```
beyondcode/laravel-websockets
pusher/pusher-php-server
```

- The Following NPM Package Will Be Installed

```
laravel-echo
pusher-js
```

- To Install and Scaffold Laravel Websockets run

```
php artisan websockets:install

Procedures
// Check Composer.json for Dependencies
// Check For Needed NPM Dependencies
// add laravel-websockets.js stub and be loaded in plugins
// ask if you want to install valet ssl cert
// append to ENV needed ENV VARS
// Add mixins stubs for listening to frontend broadcast
```
