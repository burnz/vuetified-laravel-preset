# Vuetified Laravel Preset
- Quick Install Vuetify and InertiaJS with Some Goodies You Need To Start a Project

## Installation

Install Package
```sh
composer require codeitlikemiley/vuetified-laravel-preset
```

Run Command To Scaffold Preset
```sh
php artisan preset vuetified
```

## Composer Packages Included

```php
'inertiajs/inertia-laravel',
'tightenco/ziggy',
'pragmarx/version',
'reinink/remember-query-strings',
'spatie/laravel-permission',
'barryvdh/laravel-cors',
'envant/fireable'
```

## NPM Packages Included

```php
vue
vuetify
@inertiajs/inertia
@inertiajs/inertia-vue
@babel/plugin-syntax-dynamic-import
@babel/preset-env
vue-template-compiler
css-loader
style-loader
stylus
stylus-loader
vuetify-loader
deepmerge
fibers
eslint
eslint-plugin-vue
eslint-plugin-import
@fortawesome/fontawesome-free
font-awesome
@mdi/font
@mdi/js
material-design-icons-iconfont
roboto-fontface
```

## The Following Stubs Added

```php
resources/views/app.blade.php
app/Http/Kernel.php
webpack.mix.js
.babelrc
resouces/js/app.js
resouces/js/plugins/vuetify.js
resouces/js/Shared/HelloWorld.vue
resources/js/Pages/Welcome.vue
.eslintrc.js
phpcs.xml
phpstan.neon.dist
post-commit
pre-commit
```

## Enable Git Hooks
- This Will Use PHPCS to Check Your Code (pre-commit)
- This Will Run `php artisan code:analyse` during (post-commit)

```sh
pre-commit
post-commit
```
Make File Executable
```
chmod +x pre-commit
chmod +x post-commit
```
Move To `.git/hooks`

```sh
cp pre-commit .git/hooks/pre-commit
cp post-commit .git/hooks/post-commit
```

## Enable Git Tags
- add to .env
```env
VERSION_GIT_REMOTE_REPOSITORY=https://github.com/username/projectname.git
```
- Read config/version.yml
```
current:
  label: v
  major: 1
  minor: 0
  patch: 0
```
- Run this command where in version is v1.0.0 from the version.yml
```sh
git tag -a -f v1.0.5
```
- Everytime you need make commit the version is updated You can use that version number to create it before pushing to remote Push tags to remote

```sh
git push origin --tags
```
- To remove remote tags
```sh
git push --delete origin v1.0.0
```
- type vim .git/config and add this
```sh
[remote "upstream"]
    url = <redacted>
    fetch = +refs/heads/*:refs/remotes/upstream/*
    fetch = +refs/tags/*:refs/tags/*
```
## VSCODE
- CTRL+ X (OPEN EXTENSIONS)
- Install  Settings Sync
- CTRL +SHIFT + P (OPEN COMMAND PALETTE)
- type `Sync:Download Settings`

## Set Default PHP Formatter
```txt
right click on any open php file
choose "Format Document With"
choose "php-fmt"
```