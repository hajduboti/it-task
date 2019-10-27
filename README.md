# Flyhjaelp's IT task

Task description

## The application uses:

* Laravel and it's ORM Eloquent
* Vue.js
* MySQL

## Data description:

### Flightcase model

A fligthcase has:
* unique case number
* departure date
* flight_number
* booking_number
* delay: one of the following "Cancellation","Delay","Overbooking"

### Passenger model

A passenger has:
* first name
* last name
* email
* phone number

A fligthcase can have many passengers.

## UI:

From a UI, all flightcases can be viewed and managed. A new flightcase can be added and an existing one edited and deleted. 
A list of passengers should be displayed for each flightcase and it should be possible to add/remove(plus if you do edit) passengers. 

<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these steps.

### Prerequisites

The following should be installed on your machine:

* Node.js
* PHP 7.1
* Composer
* XAMPP

### Installation

1. Clone the repo
```sh
git clone https://github.com/hajduboti/it-task.git
```
2. Install NPM packages
```sh
npm install
```
3. Install Dependencies
```sh
composer install
```
4. Set up virtual host if using Apache

5. Run migrations
```sh
php artisan migrate
```
6. Seed the database
```sh
php artisan db:seed
```

### Run the application



```sh
php artisan serve --port=8080
```