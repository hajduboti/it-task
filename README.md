# Flyhjaelp's IT task

To get you introduced to what our amazing team works on, we would like you to build a simple flightcase list, where we can create new flightcases and add passengers to them.

## We expect your application to:

* Use Laravel
* Use a relational database with initial seed data
* Use Laravel's ORM Eloquent
* Follow the classic MVC pattern

We use Vue.js, but you are free to use anything (Laravel Blade, SPA with or without a JS framework). 

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

A fligthcase can have many passengers. There should be always only one passenger as contact person on a flightcase.

### Flightcase list

From a UI, all flightcases can be viewed and managed. A new flightcase can be added and an existing one deleted. (plus if you can make edit as well). A list of passengers should be displayed for each flightcase and it should be possible to add/remove(plus if you do edit) passengers as long as there is always one passenger on a flightcase. The structure and design of the page(s) is completely up to you. 

## What now?

To get started, fork this repository, implement your solution and send it to the person that handed the task to you. 

If you have questions, you can email it@flyhjaelp.dk or the person that forwarded you the task.