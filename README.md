# LEMP Stack
LEMP Stack is Open source software for website with Docker

* L = Linux OS
* E = Nginx or Apache Web Server
* M = MariaDB or MongoDB -> database
* P = PHP, NodeJS

# Create work

**Create folder**
```sh
mkdir html nginx mariadb
```
**Create file config in folder nginx**
```conf
#nginx.conf
worker_processes 1;
daemon off;
events {
    worker_connections 1024;
}
error_log   /var/log/nginx/error.log warn;
pid         /var/run/nginx.pid;
http {
    include /etc/nginx/conf/mime.types;
    default_type application/octet-stream;
    log_format main '$remote_addr - $remote_user [$time_local] "$request"'
    '$status $body_bytes_sent "$http_referer"'
    '"$http_user_agent" "$http_x_forwarded_for"';
    access_log /var/log/nginx/access.log main;
    sendfile on;
    #tcp_nopush on;
    keepalive_timeout 65;
    gzip on;
    gzip_disable "msie6";
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_buffers 16 8k;
    gzip_http_version 1.1;
    gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript;
    # tells the server to use on-the-fly gzip compression.
    include /etc/nginx/conf.d/*.conf;
}
```
```conf
#defalte.conf
server {
   charset utf-8;
   client_max_body_size 128M;
   listen 80; ## listen for ipv4
   #listen [::]:80 default_server ipv6only=on; ## listen for ipv6
   
   root /var/www/html;
   index index.php;

   location / {
       # Redirect everything that isn't a real file to index.php
       try_files $uri $uri/ /index.php$is_args$args;
   }

   # uncomment to avoid processing of calls to non-existing static files by Yii

   #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
   #    try_files $uri =404;
   #}

   #error_page 404 /404.html;

   location ~ \.php$ {
       include fastcgi_params;
       fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
       fastcgi_pass php:9000;
       try_files $uri =404;
   }

   location ~ /\.(ht|svn|git) {
       deny all;
   }
}
```
**Create index.php or add code php to file index.php**
```php
...
<?php
  $servername = "db";
  $username = "devops";
  $password = "devops101";

  $dbhandle = mysqli_connect($servername, $username, $password);
  $selected = mysqli_select_db($dbhandle, "titanic");

  echo "Connected database server<br>";
  echo "Selected database";
?>
...
```

**Create docker-compose.yml**
```yaml
version: '3'

services:
  php:
    container_name: lemp_php
    build: .
    restart: unless-stopped
    volumes:
      - ./html/:/var/www/html
    expose:
      - "9000"
    depends_on:
      - db

  nginx:
    container_name: lemp_nginx011
    image: nginx:stable-alpine
    restart: unless-stopped
    volumes:
      - ./html/:/var/www/html

      - ./nginx/conf/nginx.conf:/etc/nginx/conf/nginx.conf:ro
      - ./nginx/conf.d:/etc/nginx/conf.d:ro

    ports:
      - "80:80"
      
  db:
    container_name: lemp_mariadb
    image: mariadb:latest
    restart: unless-stopped
    volumes:
      - ./mariadb/initdb/:/docker-entrypoint-initdb.d
      - ./mariadb/data/:/var/lib/mysql/
    environment:
      - MYSQL_ROOT_PASSWORD=devops101
      - MYSQL_DATABASE=devops_db
      - MYSQL_USER=devops
      - MYSQL_PASSWORD=devops101

networks:
  default:
    external:
      name:
        web_network
```

# Run Docker

- create container, network and build image
```sh
docker-compose up -d
```

- check container
```sh
dokcer-compose ps
```
or 
```sh
docker ps
```

- delete container
```sh
docker-compose --rmi all
```











