# How To Run The App

## Prerequisites
1. Install PHP, you can download PHP from [Wampserver](https://wampserver.aviatechno.net/files/install/wampserver3.2.6_x86.exe) or the [binary](https://windows.php.net/downloads/releases/php-7.4.29-Win32-vc15-x86.zip). I personally use Wampserver
2. Install [Composer](https://getcomposer.org/download/) for unit test library
3. Download [pcov](https://windows.php.net/downloads/pecl/releases/pcov/1.0.11/php_pcov-1.0.11-7.4-ts-vc15-x86.zip) PHP Extension for code coverage
4. After download pcov, copy .dll file to extension folder in php and add this line in php.ini file at extension section
    ```
   extension=pcov
   ```
5. Restart PHP service

## Run The App
1. Clone this repository
2. Run this command for install unit test library
    ```
    composer install
    ```
3. Run this command for build the image
    ```
   docker build -t list-hotel .
   ```
4. Run this command for run the app
    ```
   docker run --rm list-hotel 0 2 desc
   ```
   
## Run Unit Test and Get Code Coverage
1. Run this command to execute unit test
    ```
    ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/TestHotel.php
    ```
2. Run this command to generate code coverage report
    ```
   ./vendor/bin/phpunit --html-coverage html tests/TestHotel.php
   ```
3. After you run the second command the html folder will generate in root project, open the folder and run index.html file in browser