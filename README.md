# Vuetified Laravel Preset

- Quick Install Vuetify and InertiaJS with Some Goodies You Need To Start a Project

![pic-full-191203-1400-24](https://user-images.githubusercontent.com/28816690/70024537-61212180-15d5-11ea-8b31-584c982507ba.png)


## Installation

- Install Package

```sh
composer require codeitlikemiley/vuetified-laravel-preset
```

- Run Command To Scaffold Preset

```sh
php artisan preset vuetified
```

- Compile Assets (note: this will intall laravel mix 5.0.0 DevDependencies)

```sh
npm run dev
```

- Development

```sh
npm run watch
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
vuetify-loader
deepmerge
fibers
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

- type vim .git/config and add this, this allows you to easily push tags to remote

```sh
[remote "upstream"]
    url = <redacted>
    fetch = +refs/heads/*:refs/remotes/upstream/*
    fetch = +refs/tags/*:refs/tags/*
```

- Push Tags to Remote

```sh
git push origin --tags
```

- To remove remote tags

```sh
git push --delete origin v1.0.0
```

- if your using private repo you can run this command so you can easily push to your repo

```sh
git config core.sshCommand "ssh -i ~/.ssh/id_codeitlikemiley_gh"
```

- This will add Your Private Key in your .git/config file

```sh
// .git/config
[core]
	repositoryformatversion = 0
	filemode = true
	bare = false
    logallrefupdates = true
    // IT WILL ADD THIS LINE
    sshCommand= ssh -i ~/.ssh/id_codeitlikemiley_gh
    editor = code
```

- If you wanna define You git Name and Email type:

```sh
git config user.name "Codeitlikemiley"
git config user.email "codeitlikemiley@gmail.com"
```

- This will add Your Credentials in .git/config file

```sh
// .git/config
[user]
    name = "Gold Coders LTD"
    email = "goldcoders@protonmail.com"
```

## VSCODE

- CTRL+ X (OPEN EXTENSIONS)
- Install Settings Sync
- CTRL +SHIFT + P (OPEN COMMAND PALETTE)
- type `Sync:Download Settings`
- Edit `.vscode/settings.json` (this is preconfigured to work in linux) check path of executables to avoid problems)

## Set Default PHP Formatter

```txt
right click on any open php file
choose "Format Document With"
choose "php-fmt"
```

## Run PhpUnit , Larastan and PHP Insights

- Create an Alias t,tt,ttt or an shell script (If your using windows use git bash)

```sh
//t
./vendor/bin/phpunit
//tt
./vendor/bin/phpstan analyse
//ttt
./vendor/bin/phpinsights
```
