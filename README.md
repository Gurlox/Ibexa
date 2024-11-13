## About
Application and Infrastructure directories are made to show layered DDD structure of code.
Application layer is prepared for CQRS, and messenger is installed for using bus in the future
for possible async. Also deptrac is installed for checking code structure quality.
All of required code from task is inside \App\Domain.
I extended interfaces from task to apply design patterns with more clean code.

I know it's YAGNI, and I wouldn't add that much in real case scenario, but it's recruitment task,
so I wanted to show some of my skills :)

## Set up:
- docker-compose build
- docker-compose up -d
- composer install

## Tests:
- docker exec -it php bash
- php bin/phpunit tests
