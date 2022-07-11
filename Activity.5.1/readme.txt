name database: db_user 
les commandes utilisés pour executer le projet:

composer install
symfony console doctrine:database:create (ou bien importer la base des données presente dans le dossier )
symfony console doctrine:migrations:migrate
php bin/console server:run 


@Route ("/"): Home
@Route ("/Register"): pour créer un compte
@Route ("/login"): pour se connecter
@Route ("/index"): voir les champs dipsonibles 
@Route ("/user"): 
@Route ("/logout"):pour se déconnecter

