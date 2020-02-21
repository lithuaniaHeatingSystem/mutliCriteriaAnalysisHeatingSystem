# What is main of this project

 The purpose of this application is to find the best component using the Complex Proportional Assessment of alternatives.

 First you need to define the components types in the database. This types can be modified and are going to appear in the menu.

 Then you can add criterias for each components types. One criteria can be defined positively or negatively and can concerned one or many components types.

 Next you can add components and define the values of each criteria according to its type.

 Lastly you can process the COPRAS by assigning weights for every criteria.

 The application will finally return all the components sorted in ascending order.

 ## This project was carried out in an educational setting with french students (CNAM GRAND EST) and lithuanian students at Vilnius college of technologies and design
 
# How to run this project

## The first time only :
 - ▶ cp .env-dist to .env
 - ▶ docker-compose up -d
 - ▶ docker exec lithuania_project_php composer install
 - ▶ docker exec lithuania_project_php bin/console doctrine:schema:create
 - ▶ docker exec lithuania_project_php php doctrine:fixtures:load
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


