# Prolosaurs Test Tech

Prolosaures Test Tech est une application Laravel sous **Docker Compose**.

---

##  Pré-requis

Avant de commencer, vérifiez si vous avez installé :

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/install/)

---

##  Installation & Lancement

**1 Cloner le projet:**
```sh
git clone https://github.com/ramziab-test-tech/prolosaures-test-tech.git
cd prolosaures-test-tech
```
**2 Créez un fichier .env à partir du fichier .env.example à la racine du projet :**
```sh
cp .env.example .env
```
Assurez-vous d'avoir bien :
```sh
DB_DATABASE=un nom pour la base de donnée
DB_USERNAME=un username
DB_PASSWORD=un password
```
et que : 
```sh
DB_HOST=db
```
**3 Lancez les conteneurs avec Docker Compose :**
```sh
docker-compose up -d --build
```
Le site est accessible via: http://127.0.0.1:8080/

**4 Commandes utiles:**
```sh
docker exec -it laravel_app bash # Accéder au conteneur Laravel
npm run build
php artisan test # Exécutez les tests unitaires une fois que vous êtes dans le conteneur.
```
