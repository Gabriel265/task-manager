Task Management Application

Using Laravel web application to manage tasks and associated projects

Features
- Create, edit, and delete tasks.
- Reorder tasks using drag-and-drop.
- Assign tasks to projects.
- Create, edit, and delete projects.
- View tasks associated with a specific project.

Requirements
- PHP 8.2 or higher
- Composer
- MySQL
- Node.js (for frontend dependencies, if any)

Installation for testing Purposes in Development

1. If from Git hub: Clone the Repository:
   bash
   git clone https://github.com/Gabriel265/task-manager
   cd task-manager

2. If using zip then extract files to desired location

3. Update the .env file with your database credentials, the database name is "task_manager"

4. Generate Application Key:
php artisan key:generate

5. Run Migrations:
php artisan migrate
6. Run the development server
php artisan serve

7. Access the Application:

Visit http://localhost:8000 in your browser.



Set Up Environment Variables:

1. make sure the env file is setup for production, including database connections to the server

2. Generate Application Key:
commands: 

php artisan key:generate
3.Optimize the Application:
php artisan config:cache
php artisan route:cache
php artisan view:cache

3. Install Dependencies:
Run composer install with the --no-dev flag to install only production dependencies:

composer install --optimize-autoloader --no-dev

4. Set File Permissions:

Ensure the storage and bootstrap/cache directories are writable:
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

5. Choose a Hosting Provider

Shared Hosting,VPS or Platform as a Service

6. Upload Your Application
Upload Files:

Use FTP or SCP or use Git to clone your repository to the server.

7. Set Up the Web Server:

Configure your web server to point to the public directory of your Laravel application.

8. Set Up the Database:

Create a database and user on your server.

Update the .env file with the database credentials.

7. Run Migrations and Seeders
Run Migrations:

Run the following command to create the database tables:

php artisan migrate --force

Run Seeders (Optional):

If you have seeders, run them to populate the database with initial data:

php artisan db:seed --force

8. Test Your Application
Visit your domain

