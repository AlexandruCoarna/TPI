Project install

To run this project very easy, you need Docker

 - Go into the ``docker-compose/tpi`` directory in the project
 - Run ``docker-compose up --build -d && docker exec -it tpi-www sh -c "npm run init"``
 
After the process is finished, access ``http://localhost:8000``
