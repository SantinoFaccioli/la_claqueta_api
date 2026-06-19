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

        
        // necesito que el de traer pelicula por id se llame asi pq se me rompen cosas :D
        public function traerPelicula($id) {
            
        }

    }
    
