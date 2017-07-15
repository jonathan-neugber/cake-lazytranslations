[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.txt)

A CakePHP 3 plugin that overrides the default `__` translation function to enable lazy evaluation.

## Preface

For now this is only a prototype/proof of concept.

## Use case

Let's say you define some translations in a configuration file which is loaded in the `bootstrap.php`.
But afterwards in the code the locale in the `I18n` class is changed.

**Result:** The translations in the config are in a different locale than those evaluated after changing the locale.

## Solution

`__` now returns an object that contains everything needed to create the translation but is only evaluated
when cast to a string.

## Installation

#### 1. require the plugin in `composer.json`

```
"require": {
	"jonathan-neugber/cake-lazytranslations": "dev-master",
}
```

#### 2. Include the plugin using composer
Open a terminal in your project-folder and run

	$ composer update

#### 3. Load the plugin `config/functions.php`

Now here it gets a bit tricky.
As you can't yet set the order of loaded files in the composer.json
you need it manually add it in the `index.php` file **BEFORE** the `autoloader.php`
(Same applies for the `bin/cake.php` file for the shell).

```
require dirname(__DIR__) . '/vendor/jonathan-neugber/cake-lazytranslations/config/functions.php';
require dirname(__DIR__) . '/vendor/autoload.php';
```
