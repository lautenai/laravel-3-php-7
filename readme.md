# [Laravel](http://laravel.com) - A PHP Framework For Web Artisans 3.2.14

Laravel is a clean and classy framework for PHP web development. Freeing you
from spaghetti code, Laravel helps you create wonderful applications using
simple, expressive syntax. Development should be a creative experience that you
enjoy, not something that is painful. Enjoy the fresh air.

[GitHub](https://github.com/laravel/laravel/tree/v3.2.14)

## Feature Overview

### Uses Laravel Verify Bundle by Todd Francis (https://github.com/Toddish/Verify)

### Uses Scaffold Laravel Bundle by Loïc Sharma (https://github.com/loic-sharma/scaffold)
```bash
php artisan scaffold::make user username:string password:string email:string verified:boolean disabled:boolean deleted:boolean
```

### Uses Cache:
Set Cache Key on application/config/cache.php

```php
<?php
$users = Cache::remember(Config::get('cache.key').'count', function() {return DB::table('users')->count();}, 5);
```

