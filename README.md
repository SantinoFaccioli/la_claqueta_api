# TP API REST - La Claqueta

Este es el repositorio para la parte de la API REST de La Claqueta, usando arquitectura MVC y ruteo dinámico con la librería que nos dieron en la materia (pasando los datos en limpio por JSON).

## Tabla de Ruteo (Endpoints)

| URL | Método HTTP | Controlador | Método | Quién lo hizo |
| :--- | :--- | :--- | :--- | :--- |
| `api/peliculas` | **GET** | `ApiPeliculasController` | `getPeliculas` | **Miembro A** |
| `api/peliculas/:id` | **PUT** | `ApiPeliculasController` | `actualizarPelicula` | **Miembro A** |
| `api/peliculas/:id` | **GET** | `ApiPeliculasController` | `getPelicula` | **Miembro B** |
| `api/peliculas` | **POST** | `ApiPeliculasController` | `insertarPelicula` | **Miembro B** |
| `api/peliculas/:id` | **DELETE** | `ApiPeliculasController` | `eliminarPelicula` | **A o B** (Extra) |

---

##Qué hace cada Endpoint y cómo probarlo

### 1. Listado completo con ordenamiento (Miembro A)
* **URL:** `GET /api/peliculas`
* **Cómo probarlo:** Si lo tirás limpio en Postman, trae todo por defecto (ordenado por ID). Podés meterle parámetros en la URL para ordenar por cualquier columna de la tabla (ej: `?sortBy=estreno&order=desc` o `?sortBy=titulo&order=asc`).
* **Errores:** Si mandás un campo que no existe en la base de datos, te rebota con un código `400 Bad Request` por seguridad.

### 2. Modificación completa - PUT (Miembro A)
* **URL:** `PUT /api/peliculas/:id`
* **Cómo probarlo:** Tenés que pasarle el ID en la URL (ej: `/api/peliculas/1`) y en el **Body** de Postman elegir la opción **raw -> JSON** y mandarle el objeto entero con los cambios.
* **Errores:** * Si te falta algún campo obligatorio en el JSON, te devuelve un `400 Bad Request`.
  * Si ponés un ID que no existe, te tira un `404 Not Found`.

### 3. Traer una película por ID (Miembro B)
* **URL:** `GET /api/peliculas/:id`
* **Cómo probarlo:** Ponés el ID al final de la URL (ej: `/api/peliculas/2`) y te trae ese único registro en JSON.
* **Errores:** Si la película no existe en la base de datos, corta la ejecución y te salta un `404 Not Found`.

### 4. Alta de registros - POST (Miembro B)
* **URL:** `POST /api/peliculas`
* **Cómo probarlo:** Vas a la pestaña **Body -> raw -> JSON** en Postman y mandás los datos de la nueva película (sin pasarle el ID, porque es autoincremental).
* **Respuestas:** Si sale todo bien, te devuelve la película recién creada completa y un código `201 Created`. Si mandás campos vacíos, te tira un `400 Bad Request`.
