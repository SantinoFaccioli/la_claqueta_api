# TP API REST - La Claqueta

Este es el repositorio para la parte de la API REST de La Claqueta, usando arquitectura MVC y ruteo dinámico con la librería dada en la materia, procesando y transfiriendo los datos limpios en formato JSON.

## Tabla de Ruteo (Endpoints)

| URL | Método HTTP | Controlador | Método | Quién lo hizo |
| :--- | :--- | :--- | :--- | :--- |
| `api/peliculas` | **GET** | `ApiPeliculasController` | `getPeliculas` | **Miembro A** |
| `api/peliculas/:id` | **PUT** | `ApiPeliculasController` | `actualizarPelicula` | **Miembro A** |
| `api/peliculas/:id` | **GET** | `ApiPeliculasController` | `getPelicula` | **Miembro B** |
| `api/peliculas` | **POST** | `ApiPeliculasController` | `insertarPelicula` | **Miembro B** |
| `api/peliculas/:id` | **DELETE** | `ApiPeliculasController` | `eliminarPelicula` | **A o B** (Extra) |

---

## Qué hace cada Endpoint y cómo probarlo

### 1. Listado completo con ordenamiento (Miembro A)
* **URL:** `GET /api/peliculas`
* **Cómo probarlo:** Si se ejecuta limpio en Postman, trae la colección completa por defecto (ordenada por ID de forma ascendente). Permite inyectar parámetros en la URL (Query Parameters) para ordenar por cualquier columna existente de la tabla.
* **Ejemplo de uso:** `http://localhost/la_claqueta_api/api/peliculas?sortBy=estreno&order=desc` o `?sortBy=titulo&order=asc`.
* **Errores:** Si se envía un campo de ordenamiento que no existe en la base de datos, el sistema retorna un código `400 Bad Request` por seguridad.

### 2. Modificación completa - PUT (Miembro A)
* **URL:** `PUT /api/peliculas/:id`
* **Cómo probarlo:** Se debe pasar el ID del recurso directamente en la URL (ej: `/api/peliculas/1`). En la pestaña **Body** de Postman, seleccionar la opción **raw -> JSON** y enviar el objeto completo modificado.
* **Errores:** * Si falta algún campo obligatorio en la estructura JSON, devuelve un `400 Bad Request`.
  * Si se ingresa un ID que no corresponde a ninguna película en el sistema, retorna un `404 Not Found`.

---

### 3. Traer una película por ID (Miembro B)
* **URL:** `GET /api/peliculas/:id`
* **Descripción:** Recupera los detalles completos de una película específica según su identificador único.

#### Cómo probarlo en Postman:
1. Seleccioná el método **GET**.
2. Ingresá la URL especificando un ID existente (ejemplo: `http://localhost/la_claqueta_api/api/peliculas/2`).
3. Presioná **Send**.

#### Ejemplo de Respuesta Exitosa (200 OK):
```json
{
  "id_pelicula": 2,
  "titulo": "Interstellar",
  "director": "Christopher Nolan",
  "estreno": "2014",
  "imagen": "[https://images.unsplash.com/photo-1462331940025-496dfbfc7564](https://images.unsplash.com/photo-1462331940025-496dfbfc7564)",
  "resenia": "Un grupo de científicos y exploradores se embarcan en una misión espacial desesperada...",
  "id_categoria": 2,
  "nombre_categoria": "Ciencia Ficción"
}
