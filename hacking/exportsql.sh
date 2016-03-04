#!/bin/sh
#导出本地数据库
mysqldump --default-character-set=utf8mb4 --opt --databases blog -h 127.0.0.1 --port=3306 -u root > /www/blog/sql/blog.sql
