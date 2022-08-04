## About IRecharge

IRecharge is a web application built with Laravel 8, and uses MySQL as it's database manager. it solves a simple problem of integrating with FlutterWave and making card payment seamlessly 

## Configuration
To run this application they are some perquisites that a system must have 
- PHP 7.4 and above
- installed Composer
- installed MySQL and set up a user
- Good Internet 
and all other simple but needful software needed to run a web application

having confirmed all needed software 

- open your terminal to the desired directory and paste the following
 git clone https://github.com/Jacreator/FlutterWave-Charge-card.git

 when done next step:- 
 - cd FlutterWave-charge-card

 - when done next step:-
  composer install

- when done copy this and paste in .env for test purpose only

FLW_PUBLIC_KEY=FLWPUBK_TEST-8ef39dd7ae7f03ca7198625c66d0d299-X
FLW_SECRET_KEY=FLWSECK_TEST-65b5bb61f3b127a6033eb502ba0e80ce-X
FLW_SECRET_HASH='Z0vaf5Dok2qc15iBewzPHTP6oQ12hyxFhHzgqWmsJ/w='
FLW_ENCRYPTION_KEY='FLWSECK_TESTd93b205eebdc'

- next step:- 
 php artisan serve

- for testing the application
 php artisan test

## Published Doc

check out the [endpoint doc](https://documenter.getpostman.com/view/12580278/VUjJrTSp) for your reference


## Author

James Adakole
[LinkedIn Page](https://www.linkedin.com/in/jacreator/).


## Contributing

Thank you for considering contributing to the IRecharge. Reach out to me with [Email](jambone.james82@gmail.com).


## Security Vulnerabilities

If you discover a security vulnerability within IRecharge, please send an e-mail to Me via [Email](jambone.james82@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The IRecharge Application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
