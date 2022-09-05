
# Laravel Job/Listing App

A fully functioning job gigs site with laravel.
I use migrations and factories to create and seed the database.
The breeze package was installed and configure for authentication to developed
both a landing page and an individual listing page
with the help of blade components and tailwind css
which enable end users to register, create listings to be displayed on the job board.

There is still a lot that we can add to improve this setup,
such as:
1. Apply button links that will take the users to the
    job application board after clicking
2. Tracking analytics to prevent people from clicking the apply button

3. We could add a company logo and pagination.

4. Policy filters (to allow a user to have a certain access privilege on the gig/listing bases on the level of allowed user/admin abilities) and much more...


## Authors
- [@phemorah](https://www.github.com/phemorah)

## Deployment
Simply carry out the following steps to conveniently setup and run this project;

    - Clone/download the project on your local pc

    - Open up your terminal and cd to the project directory

    - Run composer install to setup all required laravel libraries and packages

    - Rename .env.example to .env

    - Open the new .env file

    - To generate the App key in the (.env) file,
    simply type the following command in the terminal:
    php artisan key:generate

    - Create a database and add the DB_DATABASE name, DB_USERNAME & DB_PASSWORD to the .env environment

    - Run php artisan migrate command to migrate the
    database tables

    - To populate the data tables with some default and pre-installed data, simply run the following command: php artisan db:seed on the same command line terminal where your project directory is sitting

    - Visit mailtrap.io to login or create an account, and then update the following constants in your .env file:
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME= get this from mailtrap.io
        MAIL_PASSWORD= get this from mailtrap.io
        MAIL_ENCRYPTION=tls

    - Start the laravel server by running php artisan serve on the command line

    - Go to localhost:8000 on your browser or enter the localhost address that the artisan serve generates.
      If you encouner any form of error like: "Vite manifest not found at...", simply run npm install && npm run dev to clear the error on your browser.

    You are all set.. Goodluck!


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

- `API_KEY`

- Visit mailtrap.io to login or create an account, and then update the following constants in your .env file:
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME= get this from mailtrap.io
    MAIL_PASSWORD= get this from mailtrap.io
    MAIL_ENCRYPTION=tls


