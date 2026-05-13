# 使用官方的 PHP 8.0 搭配 Apache 伺服器作為基底
FROM php:8.0-apache

# 將我們剛才寫的網頁代碼，複製到容器內的網頁根目錄
COPY src/ /var/www/html/

# 宣告容器會使用 80 埠 (Port)
EXPOSE 80