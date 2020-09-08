<?php 

    require_once "conexion.php";

    class ModeloBlog{

        /*=====================================
        Mostrar contenido tabla blog
        =====================================*/

        static public function mdlMostrarBlog($tabla){
            
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetch();

            $stmt -> close();

            $stmt = null;

        }

        /*=====================================
        Mostrar categorias
        =====================================*/

        static public function mdlMostrarCategorias($tabla){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();

            $stmt -> close();

            $stmt = null;

        }

        /*=====================================
        Mostrar articulos y categorias con inner join
        =====================================*/

        static public function mdlMostrarConInnerJoin($tabla1, $tabla2, $desde, $cantidad, $item, $valor){

            if ($item == null && $valor == null){

                $stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, DATE_FORMAT(fecha_articulo, '%d.%m.%Y') AS fecha_articulo FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_categoria = $tabla2.id_cat ORDER BY $tabla2.id_articulo DESC LIMIT $desde, $cantidad");
    
                $stmt -> execute();

                return $stmt -> fetchAll();

            }else{

                $stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, DATE_FORMAT(fecha_articulo, '%d.%m.%Y') AS fecha_articulo FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_categoria = $tabla2.id_cat WHERE $item = :valor ORDER BY $tabla2.id_articulo DESC LIMIT $desde, $cantidad");
    
                $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

                $stmt -> execute();

                return $stmt -> fetchAll();

            }

            $stmt -> close();

            $stmt = null;

        }

        /*=====================================
        Mostrar total articulos
        =====================================*/

        static public function mdlMostrarTotalArticulos($tabla1, $item, $valor){

            if ($item == null && $valor == null){
            
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla1");

                $stmt -> execute();

                return $stmt -> fetchAll();

            }else{

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla1 WHERE $item = :valor");

                $stmt -> bindParam(":valor",$valor,PDO::PARAM_STR);

                $stmt -> execute();

                return $stmt -> fetchAll();

            }

            $stmt -> close();

            $stmt=null;

        }

    }