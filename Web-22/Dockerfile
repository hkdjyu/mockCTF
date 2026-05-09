FROM php:8.0-apache

RUN apt-get update && apt-get install -y python3 python3-pip && \
    pip install pillow && \
    apt-get clean

COPY src/ /var/www/html/

RUN python3 /var/www/html/generate_files.py

EXPOSE 80
