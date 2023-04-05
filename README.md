<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Task Description

Objective:
The goal of this test task is to assess your understanding of PHP, server-side frameworks, databases, and RESTful API design. You are required to build a simple, yet functional, web application with a basic user authentication system using the Laravel framework and MySQL.

Task Description:
Set up a new Laravel project.
Create a MySQL database and configure the connection settings in the Laravel project.

Design a database schema that includes the following tables:
users: id, name, email, password, created_at, updated_at
posts: id, user_id, title, content, created_at, updated_at
Create migrations for the tables and run them.

Develop an API with the following endpoints:
POST /api/register: Create a new user. Required fields: name, email, password.
POST /api/login: Authenticate a user. Required fields: email, password. Return an access token on successful authentication.
GET /api/posts: Retrieve a list of all posts. Accessible only to authenticated users.
POST /api/posts: Create a new post. Required fields: title, content. Accessible only to authenticated users.

Implement user authentication using Laravel's built-in authentication system, and protect the API routes accordingly.
Write basic validation rules for the input fields (e.g., required, email format, password length).
Optimize the performance of the API, including proper indexing and pagination for the list of posts.

Submission:
Please submit your project as a compressed archive (ZIP, TAR, or similar) containing the entire Laravel project directory. Include a README file with clear instructions on how to set up and run the project, including any necessary environment configurations, database setup, and API usage examples.

Evaluation Criteria:
Your submission will be evaluated based on the following criteria:
Functionality: The application should work as described in the task description, with all endpoints functioning correctly.

Code quality: The code should be clean, efficient, and maintainable, adhering to best practices.
Security: The application should properly handle user authentication and protect API routes.
Performance: The application should demonstrate optimized performance and scalability.
Documentation: The README file should provide clear and concise instructions for setting up and running the project.

## API Documentation

To use the app API follow the next steps:

- Install composer on your machine https://getcomposer.org
- Clone the repository, open the console and type "composer install" to install dependencies
- run "php artisan migrate --seed" - this command will create a database, tables and will fill it with faker rows (2 default users, 20 default posts)
- run "php artisan serve" this command will run the app

## Usage guide
As requested app API contains the following endpoints considering that you're running the app on localhost:8000

Login and Register routes:

Default seeded login credentials are:
- admin@admin.com
- password

When user is registered it is added to the users table, then after you can login with previously registered credentials

- [POST http://localhost:8000/api/login](http://localhost:8000/api/login).
- [POST http://localhost:8000/api/register](http://localhost:8000/api/register). [https://prnt.sc/--uW-oL1RV-o](https://prnt.sc/--uW-oL1RV-o).

On each request posts are listed as 5 per page, to request the next page add "?page=2" parameter to the query. 
Routes are protected so after login use bearer token [https://prnt.sc/oI5jmNY0WG-P](https://prnt.sc/oI5jmNY0WG-P). (valid for 180 minutes) otherwise it will throw you a login GET method not supported error.
Also added relation one user can have many posts if needed.

- [GET http://localhost:8000/api/posts](http://localhost:8000/api/posts).
- [GET http://localhost:8000/api/posts?page=2](http://localhost:8000/api/posts?page=2). [https://prnt.sc/Qj-2cGifw5Wq](https://prnt.sc/Qj-2cGifw5Wq)

And to create a post [https://prnt.sc/qC4xh7sbtwdb](https://prnt.sc/qC4xh7sbtwdb)

- [POST http://localhost:8000/api/posts](http://localhost:8000/api/posts).

Since resource controllers was generated, I added update/delete routes and methods as well (entire CRUD process) even if it was not required.

