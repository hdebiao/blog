#!/bin/bash

sudo docker rm -f php7.0 convee

sudo docker run -d --restart=always -v ~/workspace/www:/www --net=convee -p 9001:9000 --hostname dev.convee.cn --name php7.0 netroby/docker-php-fpm
sudo docker run -d --restart=always -v ~/workspace/www:/www -v ~/workspace/conf.d:/etc/nginx/conf.d --hostname dev.convee.cn --net=convee -p 8080:80 -p 4431:443 --name convee docker.isrv.us/deyi/docker-nginx
