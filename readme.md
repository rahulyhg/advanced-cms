I use laravel 5.8 and laratrust 5.2 (Maybe you need more configuration for future version)

To use the project, do the following step
1. Clone the repositories by using this command : 
git clone https://github.com/wahyaumau/advanced-cms.git
2. Enter the project : 
cd advanced-cms
3. Install composer dependency. This will create vendor folder : 
composer install
4. Install npm dependency : 
npm install
5. Apply npm dependency :
npm run dev
6. Create copy of envexample file : 
copy .env.example .env
7. Generate app encription key : 
php artisan key:generate
8. Create and setup your database
9. Configure database that you will use in .env file, fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created.
10. migrate the database : 
php artisan migrate
11. Seed the database : 
php artisan db:seed
12. You can use this project, note that in the database there will be some data, go check it and the password for every user is "password"


I made example of how to protect route and controller using middleware in routes/web.php and in UserController, RoleController just an example of use middleware to protect some action, i also made example of how to protect some view component in resources/views/layouts/app.blade.php, read more to the full documentation of laratrust : https://laratrust.santigarcor.me/docs/5.2/
