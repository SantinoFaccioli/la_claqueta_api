<?php
    require_once 'libs/router.php';

    require_once 'app/controller/ApiPeliculasController.php';

    $router = new Router();

    // --- MAPEO DE ENDPOINTS ---
        // --- todo esto se borra antes de entregar XD

/* MIEMBRO A */
//Trae toda la colección aplicando ordenamiento
$router->addRoute('peliculas', 'GET',  'ApiPeliculasController', 'getPeliculas');

/* MIEMBRO A */
// PUT /api/peliculas/:id -> Modifica los datos de una película específica según su ID [cite: 23, 64]
$router->addRoute('peliculas/:id', 'PUT',    'ApiPeliculasController', 'actualizarPelicula');


/* ==========================================================================
   MIEMBRO B: Obtener elemento por ID y Altas de registros (POST) [cite: 67, 68]
   ========================================================================== */

/* MIEMBRO B */
// GET /api/peliculas/:id -> Obtiene el detalle de una sola película usando su ID [cite: 22, 67]
$router->addRoute('peliculas/:id', 'GET',    'ApiPeliculasController', 'getPelicula');

/* MIEMBRO B */
// POST /api/peliculas -> Inserta una nueva película leyendo el JSON del Body [cite: 23, 68]
$router->addRoute('peliculas', 'POST', 'ApiPeliculasController', 'insertarPelicula');


/* ==========================================================================
   ACCIONES COMPLEMENTARIAS (A definir libremente en el equipo)
   ========================================================================== */

/* MIEMBRO A o B */
// DELETE /api/peliculas/:id -> Elimina una película por su ID (Cierra el ciclo del CRUD)
$router->addRoute('peliculas/:id', 'DELETE', 'ApiPeliculasController', 'eliminarPelicula');

    $router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);