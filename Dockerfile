FROM php:7.4-cli
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
ENTRYPOINT [ "php", "./index.php" ]
CMD [ "0", "0","desc" ]