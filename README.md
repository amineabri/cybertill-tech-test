<!-- PROJECT LOGO -->
<br />
<p align="center">
  <a href="#">
    <img src="https://www.cybertill.com/wp-content/uploads/2018/06/thumb-temp-v1.png" alt="Logo">
  </a>

  <h3 align="center">Cybertill Developer Test</h3>
</p>

<!-- TABLE OF CONTENTS -->

## Table of Contents

* [About the Project](#about-the-project)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Available Routes](#available-routes)
* [Kanban Board](#kanban-board)
* [API Documentation](#api-documentation)



<!-- ABOUT THE PROJECT -->
## About The Project

A log of web requests has been provided, in csv format, that we would like to access, sort
and display in a user-friendly manner.
- The request log includes the following data
- Client IP Address.
- Response Type (HTTP Code)
- Response Time (ms)
- Country of Origin
- Path Requested

### Built With
* [Bootstrap](https://getbootstrap.com)
* [Vue.js](https://vuejs.org)
* [Webpack](https://webpack.js.org)
* [Axios](https://www.npmjs.com/package/axios)
* [Lumen PHP Micro-Framework](https://lumen.laravel.com)


<!-- GETTING STARTED -->
## Getting Started

As a typical PHP app it needs a web server to work. If it's a local development, it might be necessary to create a new entry in the /etc/hosts file.

### Prerequisites

* NPM
* COMPOSER
* PHP +7.2

### Installation

After configuring the website with the web server of your choice, the database etc, a few commands need to be run:

1. Clone the repo
   ```sh
    git clone https://github.com/amineabri/cybertill-tech-test.git
   ```

2. Install npm dependencies:
   ```
    npm install
   ```
   
3. Compile the js files :
   ```
    npm run development
   ```
   
4. Copy the .env.example to .env and configure necessary settings:
   ```
    cp .env.example .env
   ```
   
5. Copy the cybertill.sqlite.example to cybertill.sqlite if you want to use sqlite DB:

   ```
    cp Domain/database/cybertill.sqlite.example Domain/database/cybertill.sqlite
   ```

6. Install dependencies:
   ```
    composer install
   ```

7. Run migrations:
  - This command will run the migration and dispatch an event to import the CSV data using Event/Listener

    ```
     php artisan migrate:refresh
    ```

<!-- Available Routes -->
## Available Routes

- **Example 1** : 
    On this example the pagination is generated via **vue-good-table** 

```
http://{your_app_link}/view-log/without-pagination
```

- **Example 2** : 
    On this example the pagination is generated via **LengthAwarePaginator** PHP Class  

```
http://{your_app_link}/view-log/with-pagination
```

<!-- Kanban Board -->
## Kanban Board

See the [projects board](https://github.com/amineabri/cybertill-tech-test/projects) for more details.

## API Documentation

The API documentation is generated by Swagger Library (https://github.com/zircote/swagger-php) from the files in the 
*swagger* and *routes* folders and stored inside the *swagger* folder. 

To generate this file, run this command:

```
vendor/bin/openapi swagger routes -o swagger/logs-api.yml
```
Then open that link to see the documentation 

```
http://{your_app_link}/api/v1/documentation
```
