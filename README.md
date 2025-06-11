# CubeRoute Ecommerce Installation steps on Laravel 8
    

1. Clone the repo on localhost using git clone https://github.com/Thapelo-M/CubeRouteEcommerce.git
2. Use phpmyadmin panel or similar to create an empty database 'cuberoute_ecommerce'
3. Once in project directory run command: 'php artisan migrate' --- To create tables using migration files
4. Run command: 'php artisan db:seed' --- To create sample data using (Factory and DbSeeder files)
5. Run: 'php artisan serve' to start local server
6. Navigate to the url the app is running on, usually ('http://127.0.0.1:8000/') to view all products


## To be able to access C.R.U.D operations

1. Click 'Register' button to register user
2. Under localhost:8000/dashboard you'll find navigation links to Manage Products, Variants and Categories
