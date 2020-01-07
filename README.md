Project install

Run following commands:
- ``cd docker-compose/tpi``
- ``docker-compose up --build -d``

In another terminal run this after the compose up is done:
-  ``docker exec -it tpi-web bash``

Inside the container run following commands:
- ``npm install``
- ``composer install``
- ``npm run tsc``
- ``composer dump-autoload -o``

After all of this, if you go into the browser and fire up ``http://localhost:8000`` the application should start.
