# Minifier

Minifier is a simple `Laravel` package that automatically minifies the HTML output of your application's responses, helping to reduce page size and improve load times.

## Features

- Minify Laravel response HTML output.
- Easy to install and configure.
- No changes required to your existing views.

## Installation

Update your `composer.json` file.
```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/hasan282/minifier"
    }
],
```
and run command on your terminal.
```bash
composer require hasan282/minifier:v0.1.1
```

## Usage

### In your Laravel route file

You can use minifier just like other middleware class in your `routes/web.php` file.

```php
use Hasan282\Minifier\Middleware\Minify;
use Illuminate\Support\Facades\Route;

Route::middleware(Minifiy::class)->group(function () {

    Route::get('/', fn() => view('pages.website.home'))->name('home');
});
```

## License
This package is open-sourced software licensed under the [MIT license](LICENSE).