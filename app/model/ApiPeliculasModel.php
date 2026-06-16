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

    }
    
