Segui questi passaggi per configurare e avviare il progetto localmente:

composer update

php artisan migrate

php artisan db:seed --class=userSeeder    
php artisan db:seed --class=DatabaseSeeder
php artisan db:seed --class=FlightsTableSeeder
php artisan db:seed --class=Seed     

php artisan serve
