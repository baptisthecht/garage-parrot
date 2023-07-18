# Garage Parrot 🚗
## 👩‍💻 Évaluation de formation Studi
Ce projet a été créé dans le cadre d'une *Évaluation en Cours de Formation* dans le cadre d'une formation **Développeur web full stack** chez [Studi](https://www.studi.com/fr/formation/developpement/graduate-developpeur-web-full-stack).


## 🚀 Déploiement du projet en local

* Clonez ce dépot dans le dossier `/htdocs` de votre instance de **XAMPP**.
* Créez une base de donnée sur *phpmyadmin* et migrez les données via le [fichier SQL fourni](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/1-garageparrot.sql) *(en utilisant la fonction Importer ou un logiciel type : [Oracle WorkBench](https://docs.oracle.com/cd/E17952_01/workbench-en/index.html))*.
* Ajoutez les variables d'environnement dans le fichier `.env`.
* Installez les dépendances de **Symfony** pour ce projet avec la commande :

```bash
  composer install
```
* Pour démarrer le service, éxecutez la commande :
```bash
  symfony server:start
```
ou
```bash
  symfony serve
```
* Ouvrez votre **navigateur** à l'adresse : http://localhost:8000
* Le site du *Garage Parrot* devrait maintenant s'afficher ! Pour qu'il n'ait plus aucun secret pour vous, référez-vous au [manuel d'utilisation](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/Manuel.pdf).
* Pour tester les modes **administrateurs** et **employés**, des comptes *'exemples'* ont été créés et insérés dans la base de donnée :

| Identifiant        | Mot de passe      | Type de compte |
| ------|-----|-----|
| v.parrot@gmail.com  	| password 	| **Administrateur**	|
| j.philippe@gmail.com 	| password 	| Employé	|

## 📫 Annexes / Documents complémentaires

* [Fichier DB [SQL]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/1-garageparrot.sql)
* [Wireframes [PDF]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/2-Wireframes.pdf)
* [Documentation technique [PDF]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/3-Documentation%20technique.pdf)
* [Charte graphique [PNG]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/4-Charte%20graphique.png)
* [Diagramme de cas d'utilisation [PNG]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/5-Diagramme%20de%20cas%20d'utilisation.png)
* [Diagramme de classe [PNG]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/6-Diagramme%20de%20classe.png)
* [Fonctions d'utilisation [PNG]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/7-Fonctions%20d'utilisation.png)
* [Manuel d'utilisation [PDF]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/Manuel.pdf)
* [Fichier de rédaction de requêtes SQL [SQL.md]](https://github.com/baptisthecht/garage-parrot/blob/master/Documentation/SQL.md)
  > Le fichier de migration SQL étant généré par phpmyadmin, j'ai rédigé ce fichier par moi-même afin de valider la compétence du titre professionnel associé.
