### Projects running states

1. copy `.env.example` file under name of `.env`

#### Windows 
```shell
Copy-Item .env.example .env
```

#### Linux and Mac
```shell
cp .env.example .env

```

2. Create database file
```shell
php artisan migrate
```

3. Go to the folder `database` and click on the file `database.sqlite`.
Install missing packages, if they are missing. Click "ok", "cconfirm"
or another ok name of the button

4. Run php server
```shell
php artisan serve
```
