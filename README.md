# Piewpiew - PHP View Renderer

[![Latest Version on Packagist](https://img.shields.io/packagist/v/razherana/piewpiew.svg)](https://packagist.org/packages/razherana/piewpiew)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/razherana/piewpiew.svg)](https://packagist.org/packages/razherana/piewpiew/stats)

## Description

Piewpiew is an extendable view renderer for PHP that allows you to compile and render views with different template syntaxes. The library comes with two main compilers:

- **PHP Compiler**: For standard PHP templates
- **HPHP AST Compiler**: For custom templating syntax with special tags like `<if>`, `<for>`, `<template>`, etc.

## Installation

```bash
composer require razherana/piewpiew
```

## Basic Configuration

After installation, you need to configure Piewpiew:

1. Copy config.example.php to config.php
2. Configure the view paths and compilation settings:

```php
return [
  // The directory where your view files are located
  "folder" => "/path/to/your/views",
  
  // Where compiled views will be stored
  "compiled" => "/path/to/storage/compiled",
  
  // Where compilation maps will be stored
  "map" => "/path/to/storage/maps",
  
  // Set to false in production
  "always_compile" => true
];
```

## Basic Usage

### Rendering Views

```php
<?php
use function Piewpiew\piewpiew;

// Render a view with the HPHP AST compiler (default)
piewpiew('path.to.view', [
    'variable' => 'value',
    'another' => [1, 2, 3],
]);

// Get the ViewElement without rendering
use function Piewpiew\piewpiew_view;
$viewElement = piewpiew_view('path.to.view', $variables);
```

### Using the PHP Compiler

```php
<?php
use function Piewpiew\piewsub;
use Piewpiew\compilers\php\PhpCompiler;

// Render a PHP view
piewsub('path.to.php.view', $variables, PhpCompiler::class);
```

## HPHP Template Syntax

The HPHP templating language provides a cleaner syntax for common PHP operations.

### Conditionals

```html
<if condition="$user->isLoggedIn()">
  <p>Welcome, <?= $user->name ?></p>
</if else>
<else>
  <p>Please log in</p>
</else>
```

### Loops

```html
<for loop="$i = 0; $i < 5; $i++">
  <div>Item <?= $i ?></div>
</for>

<foreach loop="$items as $item">
  <div><?= $item->name ?></div>
</foreach>
```

### Templates and Blocks

```html
<!-- Define a template -->
<template main_layout use="['title' => 'Default Title']">
  <!DOCTYPE html>
  <html>
    <head>
      <title><?= $title ?></title>
    </head>
    <body>
      <header>
        <use header />
      </header>
      <main>
        <use content />
      </main>
      <footer>
        <use footer />
      </footer>
    </body>
  </html>
</template>

<!-- Define blocks -->
<block header>
  <h1>Site Header</h1>
</block>

<block content>
  <p>Default content</p>
</block>

<block footer>
  <p>&copy; 2023</p>
</block>
```

### Including Other Views

```html
<include other.view vars="['param' => 'value']" />
```

### Using Templates

```html
<use-template user_card vars="['title' => 'Custom Title']" />
```

### Joining Views

```html
<join another.view vars="['param' => 'value']" />
```

## VSCode Snippets

Piewpiew includes VSCode snippets to speed up development with HPHP templates. They can be found in html.json.

To use them:

1. Copy the content of html.json to your VSCode user snippets for HTML files
2. Use prefixes like `if`, `for`, `foreach`, `block`, etc. to access the snippets

## Extending Piewpiew

### Creating Custom Compilers

1. Create a folder in the `compilers` directory
2. Add your compiler class extending `AbstractCompiler` or `AbstractASTCompiler`
3. Implement the required abstract methods
4. Add custom `ViewVars` class if needed

```php
<?php

namespace Piewpiew\compilers\custom;

use Piewpiew\view\comm\ViewVars;
use Piewpiew\view\compiler\AbstractCompiler;

class CustomCompiler extends AbstractCompiler
{
    protected function get_compiler_name(): string
    {
        return "custom";
    }

    protected function get_extensions(): array
    {
        return ["custom"];
    }

    protected function get_components(): array
    {
        return [];
    }

    public function get_view_var_class(): string
    {
        return ViewVars::class;
    }
}
```

## Live Testing

For interactive testing and real-time demonstrations, visit the companion repository: [razherana/php-piewpiew-test](https://github.com/razherana/php-piewpiew-test) 

That test repository provides practical examples and allows you to experiment with Piewpiew's features in a working environment.

## Security

Note that Piewpiew doesn't automatically escape output. Always use `htmlspecialchars()` or similar functions to escape user-generated content to prevent XSS attacks.

## License

The MIT License (MIT). Please see License File for more information.
