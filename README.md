# A simple system of roles and permissions with the ability to edit users.

### Usage example

#### In Controllers:
```php
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
...
abort_if(Gate::denies('user_index'), Response::HTTP_FORBIDDEN, 'prohibited (not authorized)');
```

#### In Vue files:
- Checking for a role in the Vue file
```php
<div v-if="$page.props.auth.hasRole.admin">
OR
<div v-if="$page.props.auth.hasRole.user">
```

Read more in the file [HandleInertiaRequests.php](https://github.com/Baton4ikoff/Laravel-Inertia-roles-and-permission/blob/master/app/Http/Middleware/HandleInertiaRequests.php)

### Installation

``` bash
git clone https://github.com/Baton4ikoff/Laravel-Inertia-roles-and-permission.git folder
cd folder
cp .env.example .env
composer install
npm i && npm run dev
php artisan key:generate
php artisan migrate --seed
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
