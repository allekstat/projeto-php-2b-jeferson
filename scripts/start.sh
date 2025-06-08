php -S [::]:8080 >> ./logs/php-server.txt 2>&1 &
firefox [::]:8080 >> ./logs/php-server.txt 2>&1 &
jobs
