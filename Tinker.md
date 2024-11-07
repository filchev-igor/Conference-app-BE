Open Tinker and create the user with the specified details

```shell
php artisan tinker
```

```text
use App\Models\User;

\App\Models\User::create([
    'name' => 'Test User',
    'email' => 'user@example.com',
    'password' => bcrypt('password'), // Hash the password
    'role' => 'user', // or another role as required, like 'admin'
]);

exit
```
