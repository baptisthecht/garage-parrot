  # Création des tables dans la base de données

Voici un fichier résumant les requêtes SQL rédigées afin de créer les tables associées aux entités présentes dans le projet **Symfony**.

Précisions :
* `tinyint(1)` correspond à une **variable booléenne** en SQL.
* ``double` correspond à un **nombre flottant** (précis à 10^-15).
* `varchar(255)` correspond à une **variable string** de longueur *255 max*.
* `time` correspond à une **variable de temps**.

### Table : Car 

Création de la table :

```
CREATE TABLE 'car' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'brand' varchar(255)  NOT NULL,
  'model' varchar(255)  NOT NULL,
  'price' double NOT NULL,
  'year' int(11) NOT NULL,
  'km' int(11) NOT NULL,
  'main_image' varchar(255)  NOT NULL,
  'climatisation' tinyint(1) NOT NULL,
  'centralisation' tinyint(1) NOT NULL,
  'reg_lim_vitesse' tinyint(1) NOT NULL,
  'auto' tinyint(1) NOT NULL,
  'toit_ouvrant' tinyint(1) NOT NULL,
  'commentaire' varchar(1000)  NOT NULL,
  'img2' varchar(255) DEFAULT NULL,
  'img3' varchar(255) DEFAULT NULL,
  'img4' varchar(255) DEFAULT NULL,
  'power' varchar(255) NOT NULL,
  'energy_id' int(11) NOT NULL,
   FOREIGN KEY ('energy_id') REFERENCES 'carburant' ('id');
)
```

### Table : Carburant

Création de la table :

```
CREATE TABLE 'carburant' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'name' varchar(255) NOT NULL
)
```

### Table : Service

Création de la table :

```
CREATE TABLE 'service' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'name' varchar(255) NOT NULL,
  'description' varchar(255) NOT NULL,
  'available' tinyint(1) NOT NULL,
  'image' varchar(255) NOT NULL,
  'type_de_service_id' int(11) NOT NULL,
   FOREIGN KEY ('type_de_service_id') REFERENCES 'type_de_service' ('id');
)
```

### Table : TypeDeService

Création de la table :

```
CREATE TABLE 'type_de_service' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'nom' varchar(255) NOT NULL
)
```



### Table : Contact

Création de la table :

```
CREATE TABLE 'contact' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'nom' varchar(255) NOT NULL,
  'prenom' varchar(255) NOT NULL,
  'email' varchar(255) NOT NULL,
  'phone' varchar(255) NOT NULL,
  'subject' varchar(255) NOT NULL,
  'message' varchar(1000) NOT NULL,
  'lu' tinyint(1) NOT NULL
)
```

### Table : Avis

Création de la table :

```
CREATE TABLE 'avis' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'sender_first_name' varchar(255) NOT NULL,
  'sender_last_name' varchar(255) NOT NULL,
  'is_positive' tinyint(1) NOT NULL,
  'comment' varchar(255) NOT NULL,
  'is_verified' tinyint(1) NOT NULL,
  'note_id' int(11) NOT NULL,
   FOREIGN KEY ('note_id') REFERENCES 'mark' ('id');
)
```

### Table : Mark

Création de la table :

```
CREATE TABLE 'mark' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'note' varchar(255) NOT NULL
)
```
### Table : Horaires

Création de la table :

```
CREATE TABLE 'horaires' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'day' varchar(255) NOT NULL,
  'open_time' time NOT NULL,
  'close_time' time NOT NULL,
  'is_closed' tinyint(1) NOT NULL
)
```

### Table : User

Création de la table :

```
CREATE TABLE 'user' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'email' varchar(180) NOT NULL,
  'roles' json NOT NULL,
  'password' varchar(255) NOT NULL,
  'prenom' varchar(255) NOT NULL,
  'nom' varchar(255) NOT NULL
)
```

Insertion des comptes exemples :

```
INSERT INTO 'user' ('id', 'email', 'roles', 'password', 'prenom', 'nom') VALUES
(1, 'v.parrot@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$1s24qhwaODI.HN7gvXns0.0AZ.zuzJV1sxki/X6YMTwI2w7kKHWc.', 'Vincent', 'Parrot'),
(2, 'j.philippe@gmail.com', '[\"ROLE_EMPLOYEE\"]', '$2y$13$dpEPKHVHr8qQBXC2vLkM8uQdzLbHap1Wv85NAzhbfoYRBzVzTJ5Yu', 'Jean', 'Philippe'),
```

