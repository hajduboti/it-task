# Flyhjaelp's IT task

Task description

## The application uses:

* Laravel
* MySQL
* Laravel's ORM Eloquent
* Vue.js

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

### Flightcase list

From a UI, all flightcases can be viewed and managed. A new flightcase can be added and an existing one deleted. (plus if you can make edit as well). A list of passengers should be displayed for each flightcase and it should be possible to add/remove(plus if you do edit) passengers. 

