# Magaya DFP
**Code Challenge - PHP Backend Developer**

This code challenge is part of the interview process for PHP Backend Developer at Magaya’s DFP (Digital Freight Portals) team.

## Task
Create a personal weather logger

Deliver an application that meets the following functional requirements:

- [X] Can receive a post request to fetch weather data for a given city (a WeatherRequest)
   and returns an ID for the request 
- [X] Asynchronously executes the request to the weather API at “https://weatherdbi.herokuapp.com/data/weather/{CITYNAME}” or "https://api.openweathermap.org/data/2.5/weather?q={CITYNAME}&APPID={TOKEN}" and stores the returned region name and current conditions in a database (next_days is not required)
   THIS WEBSITE SHOULD NOT REQUIRE ANY AUTHENTICATION, IF YOU HAVE PROBLEMS WITH IT PLEASE CONTACT US OR TRY TO FIND SOMETHING EQUIVALENT. 
- [X] Allows a user to find all the requests they have made and returns the data in JSON, this should be able to paginate.
- [X] Allows the user to find a request they have made by ID and returns the data
- [X] Allows the user to archive a request by deleting but must not delete permanently from the database. 
- [X] Does not allow a user to view the requests that another has made. 
- [ ] Allows the user to attach a comment or note to one of their previous requests. 
- [X] Allows the user to see all the comments made on a specific request
- [X] Allows the user to delete a comment.

## Notes
- Authentication is not important, so we recommend keeping this simple.
- We prefer to see comments implemented so they can be reused on other classes we
  might in the future extend the application with and allow comments to be made on.
  Technology requirements
- PHP 8+ (8.0 preferred)
- Laravel 8+ (9 preferred)
- Must work with MySQL
- Should implement REST methodology and proper HTTP verbs and response codes.
- Must be testable using PHPUnit 9
- Must have at least 85% coverage

## Delivery
Flexible, you can use GitHub/Gitlab or equivalent or send a Zip. Please do make sure the code can be easily run and doesn’t need a lot of setup beyond composer install etc. 

## Evaluation
  The deliverable will be evaluated by running and reviewing the attached test. Therefore make sure that for any relevant entry point or functionality some test exist otherwise we might miss some logic. 
  
## Questions
  Please email: hidden
