# What is main of this project

 The purpose of this application is to find the best component using the Complex Proportional Assessment of alternatives (Multi criteria decision analysis).

 First you need to define the components types in the database. This types can be modified and are going to appear in the menu.

 Then you can add criterias for each components types. One criteria can be defined positively or negatively and can concerned one or many components types.

 Next you can add components and define the values of each criteria according to its type.

 Lastly you can process the COPRAS by assigning weights for every criteria.

 The application will finally return all the components sorted in ascending order.

 ## This project was carried out in an educational setting by french students (CNAM Grand-Est) and lithuanian students at Vilnius college of technologies and design
 
# How to run this project
## Docker is need it for follow directives below 
### The first time only :
 - ▶ cp .env-dist to .env (you can custom environment if you want)
 - ▶ docker-compose up -d (run containers)
 - ▶ docker exec lithuania_project_php composer install (install php dependencies)
 - ▶ docker exec lithuania_project_php php bin/console doctrine:schema:create (create database schema)
 - ▶ docker exec lithuania_project_php php bin/console doctrine:fixtures:load (load fixtures in database)
 - ▶ docker exec lithuania_project_node yarn install --no-bin-links (install front dependencies)
 
### Every time
 - ▶ docker-compose up -d (run container)
 - ▶ docker exec lithuania_project_node yarn dev (compile assets)

 After that you can go to localhost:8080, enjoy
 
### Stop containers
 - ▶ docker-compose stop
  
### Access to symfony console 
 - ▶ docker exec lithuania_project_php bin/console

### Access to yarn
 - ▶ docker exec lithuania_project_encore yarn add something


