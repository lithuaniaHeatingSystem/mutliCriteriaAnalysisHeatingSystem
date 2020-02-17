# How to run this project

## The first time only :
 - ▶ cp .env-dist to .env
 - ▶ docker-compose up -d
 - ▶ docker exec lithuania_project_php composer install
 - ▶ docker exec lithuania_project_php bin/console doctrine:schema:create
 - ▶ docker exec lithuania_project_node yarn install --no-bin-links
 
## Every time
 - ▶ docker-compose up -d
 - ▶ docker exec lithuania_project_node yarn watch (if you are error try: docker exec lithuania_project_node yarn add --dev @symfony/webpack-encore)

 After that you can go to localhost:8080, enjoy
 
 ## Stop containers
 - ▶ docker-compose stop
  
## Access to symfony console 
 - ▶ docker exec lithuania_project_php bin/console

## Access to yarn
 - ▶ docker exec lithuania_project_encore yarn add something


