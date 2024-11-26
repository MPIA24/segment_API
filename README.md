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

###exemple de réponse (body):
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
# API_datathon
