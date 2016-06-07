 sudo docker run -d --restart=always -v ~/workspace/www:/www --net=convee --name php7.0 netroby/docker-php-fpm
 sudo docker run -d --restart=always -v ~/workspace/www:/www -v ~/workspace/conf.d:/etc/nginx/conf.d --hostname dev.convee.cn --net=convee -p 8080:80 --name nginx docker.isrv.us/deyi/docker-nginx
