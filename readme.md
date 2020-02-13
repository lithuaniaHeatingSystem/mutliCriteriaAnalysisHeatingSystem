# How to run this project
 - ▶ cp .env-dist to .env
 - ▶ docker-compose up -d
 - ▶ docker exec lithuania_project_php composer install
 - ▶ docker exec lithuania_project_php bin/console doctrine:schema:create
 
 After that you can go to localhost:8080, enjoy
 
# Update database 
 - ▶ docker exec lithuania_project_php bin/console doctrine:schema:update



