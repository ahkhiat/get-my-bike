# Application Getmybike

## Application developpée sur Symfony 7

### Base de données :
C'est une base de données Mysql

### Entités
Nous avons 6 entités :
* User
* Propriétaires
* Motos
* Modeles
* Reservations
* Commentaires

### Fixtures
Nous avons rempli la BDD grâces au bundle 
[Fixtures](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html)

Ainsi, la BDD peut être remplie sur demande.
Le fichier avec les fonction de remplissage se trouve dans **DataFixtures\AppFixtures.php**





Des fonctions dans les entités permettent de récuperer le nombre de notes total, le nombre de 1, le nombre de 2, etc...
Nous récupérons aussi la moyenne, qui est calculée.

