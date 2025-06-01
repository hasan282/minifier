# Minifier

Minifier is a simple Laravel package that automatically minifies the HTML output of your application's responses, helping to reduce page size and improve load times.

## Features

- Minify Laravel response HTML output.
- Easy to install and configure.
- No changes required to your existing views.

## Installation

```bash
composer require hasan282/minifier
```

## Usage

### In your route file

No changes are required to your route files. Once installed, use in your route file to minify all HTML responses.

```php
use Hasan282\Minifier\Middleware\Minify;
use Illuminate\Support\Facades\Route;

Route::middleware(Minifiy::class)->group(function () {

    Route::get('/', fn() => view('pages.website.home'))->name('home');
});
```

## How it works

The package hooks into Laravel's response lifecycle and minifies the HTML output before sending it to the browser.

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
