### About
This is a simple task management app built by Laravel and Laravel Liverwire.
It's featured include.

1. Login and Registration
2. Ability to create project if you are authenticated
3. Ability to add tasks inside project, update and drag by changing task priority dynamically
4. Users can only see their projects and Tasks

It users Laravel 10 - which is the latest version at this time.

### Installation
* Run `git clone https://github.com/Abdifatahz/taskily taskily`
* `cd taskily` 
* Run `composer install` (install composer beforehand)
* From the projects root run `cp .env.example .env`
* Configure your `.env` file, with:

Database settings
```
DB_DATABASE=taskily
DB_USERNAME=YOUR_DB_USERNAME
DB_PASSWORD=YOUR_DB_PASSWORD
```

* Run `php artisan key:generate`
* Run `php artisan migrate`
* Run `npm install && npm run dev`
* Run `php artisan db:seed`

* Start the Laravel server `php artisan serve`

### Access dashboard
 - You can access dashboard by registrating new User. or
 - You can login faked users data by using `password` AS a password.

### License
TASKILY is licensed under the MIT license. Enjoy!
