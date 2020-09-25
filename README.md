dcat-admin extension
======

Config manager for dcat-admin
========================

## Installation

```
$ composer require tizipso/config

$ php artisan migrate

$ php artisan admin:import Dcat\Admin\Extension\Config\Config
```

Open `http://your-host/admin/config`

## Usage

After add config in the panel, use `config($key)` to get value you configured.

License
------------
Licensed under [The MIT License (MIT)](LICENSE).
