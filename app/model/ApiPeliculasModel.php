<?php
    
    class ApiPeliculasModel{
        
        private $db;

        public function __construct() {
            $this->db= new PDO('mysql:host=localhost;dbname=la_claqueta_db;charset=utf8', 'root', '');
        }

        public function getPeliculasOrdenadas($sortBy, $order) {
            $sql = "SELECT p.*, c.nombre AS nombre_categoria 
                    FROM pelicula p 
                    INNER JOIN categoria c ON p.id_categoria = c.id_categoria 
                    ORDER BY $sortBy $order";
                    
            $query = $this->db->prepare($sql);
            $query->execute();
            
            return $query->fetchAll(PDO::FETCH_OBJ); 
        }

        public function validarCampo($campo) {
            switch ($campo) {
                case 'id_pelicula':
                case 'titulo':
                case 'director':
                case 'estreno':
                case 'imagen':
                case 'resenia':
                case 'id_categoria':
                    return true;
                default:
                    return false;
            }
        }

        public function actualizarPeliculaInDB($id, $titulo, $director, $estreno, $imagen, $resenia, $id_categoria) {
            $query = $this->db->prepare('UPDATE pelicula 
                                        SET titulo = ?, director = ?, estreno = ?, imagen = ?, resenia = ?, id_categoria = ? 
                                        WHERE id_pelicula = ?');
            
            $query->execute([$titulo, $director, $estreno, $imagen, $resenia, $id_categoria, $id]);
        }

        public function traerPelicula($id) {
            $query = $this->db->prepare('SELECT p.*, c.nombre AS nombre_categoria 
                                         FROM pelicula p 
                                         INNER JOIN categoria c ON p.id_categoria = c.id_categoria 
                                         WHERE p.id_pelicula = ?');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_OBJ); 
        }
        public function insertarPeliculaInDB($titulo, $director, $estreno, $imagen, $resenia, $id_categoria) {
            $query = $this->db->prepare('INSERT INTO pelicula (titulo, director, estreno, imagen, resenia, id_categoria) 
                                         VALUES (?, ?, ?, ?, ?, ?)');
            $query->execute([$titulo, $director, $estreno, $imagen, $resenia, $id_categoria]);
            
            return $this->db->lastInsertId();
        }

    }
    
