### Coding Challenge

# Steps to launch the application
  - ```docker-compose build```
  - ```docker-compose up -d```
  - ```docker-compose run php composer install```
  - You will be able to launch it in *http://localhost:8001* from your browser or Rest API client(like POSTMAN)

# Structure of API
  * Used Symfony 4 as provided
  * Followed Domain driven development (DDD)
  * Controllers will be found in src/Controller directory
  * Domain files will be found in src/Domain directory
  * Service files will be found in src/Service directory
  * Model files will be found in src/Model directory
  * Event Listener files will be found in src/EventListener directory
  * Unit tests are written for Models, Domain, Service and EventListeners
  * Functional test is written for Controllers
  * Achieved Code coverage of 100% wherever applicable

# Steps to perform unit tests
  - ```docker-compose run php composer test``` For testing
  - ```docker-compose run php composer test-coverage``` For test coverage
  - ```"test": "php /www/vendor/bin/phpunit --colors=always --stderr",
       "test-coverage": "php /www/vendor/bin/phpunit -d memory_limit=512M --colors=always --coverage-html reports/phpunit/html --coverage-clover reports/phpunit/clover.xml --log-junit reports/phpunit/junit.xml"``` These are the underlying scripts. For easiness, shorted those in composer scripts part.

# Coding Standard
   * Followed PSR2 standard here.

# My suitable position
   * As asked in the [challenge.md](./docs/challenge.md), I've added my answer in [my-position.md](./docs/my-position.md)

# Sample endpoints
  - ***http://localhost:8001/job/1***
  - ***http://localhost:8001/job/location/Berlin/Salary***
  - ***http://localhost:8001/job/location/IE/Seniority%20level***
  - ***http://localhost:8001/job/match/PHP,LAMP,MySQL,PHPUnit,OOP/middle***

# Review
  * Hope that my code suits the need of the challenge. Please provide feedback to me If I need to improve in certain places. Hope to talk to you soon.
