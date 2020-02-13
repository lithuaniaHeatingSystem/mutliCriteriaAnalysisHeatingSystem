# How to run this project
 - ▶ cp .env-dist to .env.local
 - ▶ docker-compose up -d
 - ▶ docker exec lithuania_project_php composer install
 - ▶ docker exec lithuania_project_php bin/console doctrine:schema:create
 
# Update database 
 - ▶ docker exec lithuania_project_php bin/console doctrine:schema:update



