#### To be able to install yo'll need to have at least 8.2 version of PHP

# How to install

### Open the terminal and navigate to your projects directory, for example
`cd /var/www/vhosts`

### Clone the repo and navigate the new created directory
`git clone https://github.com/and-koghb/laravel-test-task.git`

`cd laravel-test-task`

### Create a MySQL database for the project with charset and collation marked as default in `config/database.php`

### Create `.env` file based on `.env.example`

### Write database credentials in `.env` file

### For local work would be good to create a virtual host `http://laravel-test-task.loc` and write the value as `APP_URL` value in `.env`

### Install packages
`composer install`

### Run database migrations
`php artisan migrate`

### Open a new terminal and navigate to the project directory
`cd /var/www/vhosts/laravel-test-task`

### Run unit and feature tests in the first terminal
`php artisan test`

### There also is arequests.http file which can help to send requests from your IDE


# The task

## Simple Laravel API with Job Queue, Database, and Event Handling

### Objective 

Create a Laravel API that demonstrates your proficiency with Laravel's job queues, database operations, migrations, and event handling. This test should take approximately 2-3 hours to complete.

### Requirements

API Endpoint: Develop a single API endpoint `/submit` that accepts a `POST` request with the following JSON payload structure:
```
{
      "name": "John Doe",
      "email": "john.doe@example.com",
      "message": "This is a test message."
}
```
1. Validate the data (ensure `name`, `email`, and `message` are present).
2. Database Setup: Use Laravel migrations to create a table named `submissions` with columns for `id`, `name`, `email`, `message`, and timestamps (`created_at` and `updated_at`).
3. Job Queue: Upon receiving the API request, the data should not be immediately saved to the database. Instead, dispatch a Laravel job to process the data. The job should perform the following tasks:
a) Save the data to the `submissions` table in the database.
4. Events: After the data is successfully saved to the database, trigger a Laravel event named `SubmissionSaved`. Attach a listener to this event that logs a message indicating a successful save, including the `name` and `email` of the submission.
5. Error Handling: Implement error handling for the API to respond with appropriate messages and status codes for the following scenarios:
a) Invalid data input (e.g., missing required fields).
b) Any errors that occur during the job processing.
6. Documentation: Briefly document the following in a README file:
a) Instructions on setting up the project and running migrations.
b) simple explanation of how to test the API endpoint.
7. Write a simple Unit test.

### Deliverables

 - Source code for the Laravel project, including all migrations, models, controllers, jobs, and event classes.
 - A README file with setup and testing instructions.

### Submission Instructions
 Please submit your project as a link to a GitHub repository. Ensure that any necessary setup instructions are included in your README to facilitate the review of your project.
