# 这是一个博客系统

## 技术参数
* ubuntu15.10
* php7.0
* mysql5.6.*
* nginx1.9.*
* 后端框架zendframework2.5

## 安装步骤
* 下载composer到项目文件夹并且安装依赖

````
curl -s https://getcomposer.org/installer | php
php composer.phar self-update
php composer.phar install

````

## nginx配置
````
server {
	listen 80;
	server_name dev.blog.com;
	index index.php index.html index.htm;
	root /www/blog/public;
	location / {
		try_files $uri @orig;
	}
	location @orig {
		rewrite ^/(.*)$ /index.php last;
	}
	location ~ \.php$ {
   		fastcgi_split_path_info ^(.+\.php)(/.+)$;
	   	fastcgi_pass 127.0.0.1:9000;
    	fastcgi_index index.php;
		fastcgi_param  SCRIPT_FILENAME   $document_root$fastcgi_script_name;
	    include fastcgi_params;
	}
}
````