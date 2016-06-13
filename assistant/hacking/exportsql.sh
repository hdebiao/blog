#!/bin/sh
#导出本地数据库

PROJECT_DIR="/home/wk/workspace/www/blog"
mysqldump --default-character-set=utf8mb4 --opt -B blog -h 127.0.0.1 -P 3307 -u root > $PROJECT_DIR/assistant/sql/blog.sql
