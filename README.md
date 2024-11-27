# API : Gestion des Bâtiments

Cette API permet de gérer des bâtiments via diverses routes pour l'inscription, la connexion, l'ajout, la suppression et la récupération de bâtiments.

---

## 1. Inscription d’un Utilisateur

- **URL** : `http://localhost:8000/api/register`
- **Méthode** : `POST`
- **Description** : Crée un utilisateur avec un nom, prénom, email et mot de passe.

### Paramètres de la Requête (Body) :
```json
{
    "name": "John",
    "prenom": "Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

### Exemple de réponse (Body) :
```json
{
    "message": "Utilisateur enregistré avec succès.",
    "user": {
        "id": 1,
        "name": "John",
        "prenom": "Doe",
        "email": "john.doe@example.com",
        "created_at": "2024-11-23T12:00:00.000000Z",
        "updated_at": "2024-11-23T12:00:00.000000Z"
    }
}
```
## 2. Inscription d’un Utilisateur

- **URL** : `http://localhost:8000/api/login`
- **Méthode** : `POST`
- **Description** : Connecte un utilisateur avec son email et son mot de passe.

### Paramètres de la Requête (Body) :
```json
{
    "email": "john.doe@example.com",
    "password": "password123"
}
```


### Exemple de réponse (Body) :
```json
{
    "message": "Connexion réussie.",
    "token": "1|longaccesstoken..."
}
```

## 3. Ajouter plusieurs Bâtiments via un Fichier JSON

- **URL** : `http://localhost:8000/api/batiments/import`
- **Méthode** : `POST`
- **Description** : Ajoute plusieurs bâtiments à partir d’un fichier JSON.

### Paramètres de la Requête :
fichier json au format comme suit : 
```json
[
    {
        "id": "PA00132689",
        "data": {
            "name": "Église paroissiale",
            "description": "Le clocher a été fortifié au 17e siècle.",
            "localisation": {
                "latitude": 49.5726184796685,
                "longitude": -1.31094424831739
            }
        }
    },
    {
        "id": "PA00132898",
        "data": {
            "name": "Château",
            "description": "Reconstruction du 16e siècle.",
            "localisation": {
                "latitude": 48.5120195837517,
                "longitude": -0.367767874189509
            }
        }
    }
]
```


### exemple de réponse (Body) :
```json
{
    "message": "Bâtiments ajoutés avec succès.",
    "added_count": 2
}
```

## 4. Ajout d'un bâtiment 

- **URL** : `http://localhost:8000/api/batiments`
- **Méthode** : `POST`
- **Description** : Ajoute un bâtiment a l'aide d'une requête http.
### Paramètres de la Requête (Body) :
```json
{
    "name": "Château médiéval",
    "description": "Un château construit au XIVe siècle.",
    "latitude": 48.8566,
    "longitude": 2.3522

}
```
### exemple de réponse (body)
```json
{
    "message": "Bâtiment créé avec succès.",
    "batiment": {
        "id": "a123e456-7890-1234-b567-8c9def123456",
        "name": "Château médiéval",
        "description": "Un château construit au XIVe siècle.",
        "latitude": 48.8566,
        "longitude": 2.3522,
        "created_at": "2024-11-23T12:00:00.000000Z",
        "updated_at": "2024-11-23T12:00:00.000000Z"
    }
}
```
## 5. Supprimer un bâtiment 

- **URL** : `http://localhost:8000/api/batiments/{id}`
- **Méthode** : `POST`
- **Description** : Supprime un bâtiment via son ID

### exemple de réponse (body)
```json
{
    "message": "Bâtiment supprimé avec succès.",
    "batiment_id": "a123e456-7890-1234-b567-8c9def123456"
}
```
## 6.Récupérer tous les bâtiments 

- **URL** : `http://localhost:8000/api/batiments`
- **Méthode** : `GET`
- **Description** : récupère la liste de tous les batiments au format JSON. 

### exemple de réponse (body)
```json
{
    "message": "Liste des bâtiments récupérée avec succès.",
    "batiments": [
        {
            "id": "a123e456-7890-1234-b567-8c9def123456",
            "name": "Château médiéval",
            "description": "Un château construit au XIVe siècle.",
            "latitude": 48.8566,
            "longitude": 2.3522,
            "created_at": "2024-11-23T12:00:00.000000Z",
            "updated_at": "2024-11-23T12:00:00.000000Z"
        },
        {
            "id": "b234f567-8901-2345-c678-9d0efa123457",
            "name": "Église gothique",
            "description": "Une église remarquable du XIIIe siècle.",
            "latitude": 48.8582,
            "longitude": 2.2945,
            "created_at": "2024-11-23T12:00:00.000000Z",
            "updated_at": "2024-11-23T12:00:00.000000Z"
        }
    ]
}
```
## 7. Récupérer un bâtiment par son ID

- **URL** : `http://localhost:8000/api/batiments{id}`
- **Méthode** : `GET`
- **Description** : Récupère un bâtiment au format JSON via son ID.

### exemple de réponse (body):
```json
{
    "message": "Bâtiment récupéré avec succès.",
    "batiment": {
        "id": "a123e456-7890-1234-b567-8c9def123456",
        "name": "Château médiéval",
        "description": "Un château construit au XIVe siècle.",
        "latitude": 48.8566,
        "longitude": 2.3522,
        "created_at": "2024-11-23T12:00:00.000000Z",
        "updated_at": "2024-11-23T12:00:00.000000Z"
    }
}
```
## 8. Rendre un batiment visité

- **URL** : `http://localhost:8000/api/visited`
- **Méthode** : `POST`
- **Description** : Marque un batiment comme visité via une requete http contenant un json avec l'ID de l'utilisateur et du batiment.

### exemple de la requête (body)
```json
{
    "batiment_id": "PA00132689",
    "user_id": "4"
}
```
### exemple de la réponse (body)
```json
{
    "message":"Batiment visited successfully",
    "visited_batiment":{
        "batiment_id":"PA00132689",
        "user_id":"5",
        "visited_at":"2024-11-26T13:46:01.171628Z",
        "updated_at":"2024-11-26T13:46:01.000000Z",
        "created_at":"2024-11-26T13:46:01.000000Z",
        "id":2
    }
}
```

## 9. récupérer tous les batiments visités d'un utilisateur

- **URL** : `http://localhost:8000/api/visited`
- **Méthode** : `GET`
- **Description** : Récupère tous la liste de tous les batiments visités par l'utilisateur via son ID.

### exemple de la requête (body):

```json
{
    "user_id": "5"
}

```
### exemple de la réponse (body):

```json
{
    "batiment_id":"PA00132689",
    "data":
    {
        "name":"église paroissiale",
        "description":"Le clocher a été fortifié au 17e siècle. La nef et le choeur ont été reconstruits au 18e siècle.",
        "localisation":
        {
            "latitude":49.572618479668,
            "longitude":-1.3109442483174
        },
        "visited_at":"2024-11-26 13:46:01"
    }
}
```
## 10. compter le nombre de visite sur un bâtiment.

- **URL** : `http://localhost:8000/api/visited/count`
- **Méthode** : `GET`
- **Description** : compte le nombre de visite d'un POI via son ID.

### exemple de la requête (body)
```json

{
    "batiment_id": "PA00132689"
}

```

### exemple de la réponse (body)
```json
{
    "batiment_id":"PA00132689",
    "count_visit":2
}
```

## 11. ajouter un itiniraire 

- **URL** : `http://localhost:8000/api/tours`
- **Méthode** : `POST`
- **Description** : créer un itinéraire en base de données en envoyant la liste des POI traversés

### exemple de la requête (body)

```json

{
    "batiments_id" : [
        "PA00132689", "PA00132894","PA00125294"
    ],
    "name" : "test d'itinéraire",
    "user_id": 4,
    "distance":"23.5km",
    "adviced_locomotion" : "parcours à vélo"
}

```
### exemple de réponse (body) : 

```json
{
    "tour":
    {
        "id":6,
        "name":"test d'itinéraire",
        "distance":"23.5km",
        "adviced_locomotion":"parcours à vélo",
        "batiments":
            [
                {
                    "id":"PA00125294",
                    "name":"demeure"
                },
                {
                    "id":"PA00132689",
                    "name":"église paroissiale"
                },
                {
                    "id":"PA00132894",
                    "name":"batterie d'artillerie"
                }
            ]
    }
}

```
## 12. récupérer tous les itinéraires

- **URL** : `http://localhost:8000/api/tours`
- **Méthode** : `GET`
- **Description** : récupère tous les itinéraires avec a chaque fois l'id, le nom, l'auteur, la distance, le moyen de locomotion conseillé ainsi que pour chaque POI passé, l'id et le nom


### exemple de réponse : 

```json
{
    "tours":[
        {
            "id":1,
            "author":"Miss Danyka Hilpert I",
            "name":"test d'itinéraire",
            "distance":"23.5km",
            "adviced_locomotion":"parcours à vélo",
            "batiments":[
                {
                    "id":"PA00132689",
                    "name":"église paroissiale"
                },
                {
                    "id":"PA00132894",
                    "name":"batterie d'artillerie"
                },
                {
                    "id":"PA00125294",
                    "name":"demeure"
                }
            ]
        },
        {
            "id":2,
            "author":"Miss Queenie Gislason",
            "name":"test d'itinéraire numéro 2",
            "distance":"23.5km",
            "adviced_locomotion":"parcours à pieds",
            "batiments":[
                {
                    "id":"PA00132689",
                    "name":"église paroissiale"
                },
                {
                    "id":"PA00132894",
                    "name":"batterie d'artillerie"
                },
                {
                    "id":"PA00125294",
                    "name":"demeure"
                },
                {
                    "id":"PA27000011",
                    "name":"couvent"
                }
            ]
        }
    ]
}

```
## 13. récupérer le détail du tracé d'un itinéraire

- **URL** : `http://localhost:8000/api/tours/details`
- **Méthode** : `GET`
- **Description** : récupère via un ID d'itinéraire le detail de ce dernier au format JSON incluant son id, son auteur, son nom, sa distance, son moyen de locomotion conseillé et sa date de création ainsi que pour chaque batiment traversé, le nom de ce dernier, son id, sa latitude et sa longitude

### exemple de requête (body) : 

```json
{
    "tour_id" : 3
}

```

### exemple de réponse (body) : 

```json

{
    "tour":
        {
            "id":3,
            "author":"Miss Queenie Gislason",
            "name":"test d'itin\u00e9raire num\u00e9ro 3",
            "distance":"23.5km",
            "adviced_locomotion":"parcours \u00e0 pieds",
            "created_at":"2024-11-27T16:06:48.000000Z",
            "batiments":[
                {
                    "id":"PA00132689",
                    "name":"\u00e9glise paroissiale",
                    "longitude":-1.3109442483174,
                    "latitude":49.572618479668
                },
                {
                    "id":"PA00132894",
                    "name":"batterie d'artillerie",
                    "longitude":-0.25237801617416,
                    "latitude":49.287464947376
                },
                {
                    "id":"PA00125294",
                    "name":"demeure",
                    "longitude":-0.38660742115417,
                    "latitude":49.290622316452
                },
                {
                    "id":"PA27000011",
                    "name":"couvent",
                    "longitude":1.473656586863,
                    "latitude":49.399335560273
                }
            ]
        },
}

```
# API_datathon
