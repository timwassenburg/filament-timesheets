# Laravel Timesheets for Filament

<img src="https://raw.githubusercontent.com/timwassenburg/filament-timesheets/main/img/banner.png" class="filament-hidden" alt="Logo">

[![Latest Version on Packagist](https://img.shields.io/packagist/v/timwassenburg/filament-timesheets.svg?style=flat-square)](https://packagist.org/packages/timwassenburg/filament-timesheets)
[![Total Downloads](https://img.shields.io/packagist/dt/timwassenburg/filament-timesheets.svg?style=flat-square)](https://packagist.org/packages/timwassenburg/filament-timesheets)
[![License](https://img.shields.io/packagist/l/timwassenburg/filament-timesheets)](https://packagist.org/packages/timwassenburg/filament-timesheets)

<hr>

This Laravel package integrates seamlessly with Filament, providing a straightforward way to manage and track time spent on various projects. Checkout the **demo** on [https://interimblue.com](https://interimblue.com).

## Installation

Install the package with composer.

```bash
composer require timwassenburg/filament-timesheets
```

Then open `app/Providers/Filament/AdminPanelProvider.php` and add the plugin to the `plugin()` function.

```php
namespace App\Providers\Filament;

use Filament\Panel;
use Filament\PanelProvider;
use TimWassenburg\FilamentTimesheets\FilamentTimesheetsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->plugin(FilamentTimesheetsPlugin::make())
            ...
```

## Translations

You can customize the language of the package by publishing the language files.

```bash
php artisan vendor:publish --tag=filament-timesheet
```

After publishing the language files, you can edit the translations in `resources/lang/vendor/filament-timesheet`.

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any
contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also
simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
