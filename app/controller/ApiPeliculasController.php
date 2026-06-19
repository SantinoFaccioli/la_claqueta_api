<?php
    require_once 'app/model/ApiPeliculasModel.php';

    
    class ApiPeliculasController {
        private $model;

        public function __construct() {
            $this->model = new ApiPeliculasModel();
        }

        public function getPeliculas($req, $res) {
            // 1. Criterios por defecto (Funcionalidad por defecto requerida)
            $sortBy = 'id_pelicula'; 
            $order = 'ASC';

            // 2. Leemos los Query Parameters usando la estructura de la librería ($req->query)
            if (!empty($req->query->sortBy)) {
                $campo = $req->query->sortBy;
                if ($this->model->validarCampo($campo)) {
                    $sortBy = $campo;
                } else {
                    // Código 400 Bad Request ante parámetros inválidos
                    return $res->json("El campo '$campo' no es un criterio de ordenamiento válido.", 400);
                }
            }

            if (!empty($req->query->order)) {
                $direccion = strtoupper($req->query->order);
                if ($direccion === 'ASC' || $direccion === 'DESC') {
                    $order = $direccion;
                } else {
                    return $res->json("La dirección '$direccion' no es válida. Use ASC o DESC.", 400);
                }
            }

            // 3. Invocación al modelo con las variables limpias y respuesta
            $peliculas = $this->model->getPeliculasOrdenadas($sortBy, $order);
            return $res->json($peliculas, 200);
        }

        public function actualizarPelicula($req, $res) {
            $id = $req->params->id;

            
            $pelicula = $this->model->traerPelicula($id);
            if (!$pelicula) {
                return $res->json("La pelicula con el id=$id no existe", 404);
            }
 
            if (empty($req->body->titulo) || empty($req->body->director) || empty($req->body->estreno) || empty($req->body->imagen) || empty($req->body->resenia) || empty($req->body->id_categoria)) {
                 return $res->json("Faltan completar campos obligatorios", 400);
            }
            $titulo       = $req->body->titulo;
            $director     = $req->body->director;
            $estreno      = $req->body->estreno;
            $imagen       = $req->body->imagen;
            $resenia      = $req->body->resenia; 
            $id_categoria = $req->body->id_categoria;

            $this->model->actualizarPeliculaInDB($id, $titulo, $director, $estreno, $imagen, $resenia, $id_categoria);

            return $res->json("Pelicula id=$id actualizada con exito", 200);
        }

    }