FROM nginx:1.21-alpine
COPY nginx/default.conf /etc/nginx/conf.d/
WORKDIR /var/www/html