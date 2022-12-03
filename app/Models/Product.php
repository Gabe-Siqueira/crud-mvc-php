<?php

namespace app\Models;

use app\Core\DataBase;
use Exception;
use PDO;

class Product
{
    /**
    * Display a listing of the resource.
    *
    * @return array
    */
    public static function index()
    {
        try {
            $conn = new Database();

            $result = $conn->executeQuery('SELECT * FROM product');

            return $result->fetchAll(PDO::FETCH_ASSOC);

			// if (!$result) {
			// 	throw new Exception("Não foi encontrado nenhum registro no banco");		
			// }

		} catch (Exception $e) {
			$e->getMessage();
		}
    }

    /**
    * Display the specified resource.
    *
    * @param int    $id 
    *
    * @return array
    */
    public static function show($id)
    {
        try {

			$conn = new Database();

            $result = $conn->executeQuery('SELECT * FROM product WHERE id = :id', array(
                ':id' => $id
            ));

            return $result->fetchAll(PDO::FETCH_ASSOC);

            // if (!$result) {
			// 	throw new Exception("No record found");	
			// }

		} catch (Exception $e) {
			$e->getMessage();
		}
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param array    $dados 
    *
    * @return array
    */
    public static function store($dados)
    {
        try {
            $name = $dados['name'];
			$date_register = $dados['date_register'];

            if (empty($name) || empty($date_register)) {
				throw new Exception("Fill in all fields");

				return false;
			}

			$conn = new Database();

            $result = $conn->executeQuery('INSERT INTO product (`name`, date_register) VALUES (:name, :date_register)', array(
                ':name' => $name,
                ':date_register' => $date_register,
            ));

            return $result;

            // if ($result == 0) {
			// 	throw new Exception("Failed to insert");

			// 	return false;
			// }

			// return true;

		} catch (Exception $e) {
			$e->getMessage();
		}
    }

    /**
    * Update the specified resource in storage.
    *
    * @param array      $dados
    * @param int        $id 
    *
    * @return array
    */
    public static function update($dados, $id)
    {
        try {
            $name = $dados['name'];
			$date_register = $dados['date_register'];

            if (empty($id) || empty($name) || empty($date_register)) {
				throw new Exception("Fill in all fields");

				return false;
			}

			$conn = new Database();

            $result = $conn->executeQuery('UPDATE product SET `name` = :name, date_register = :date_register WHERE id = :id', array(
                ':name' => $name,
                ':date_register' => $date_register,
                ':id' => $id
            ));

            return $result;

            // if ($result == 0) {
			// 	throw new Exception("Failed to update");

			// 	return false;
			// }

			// return true;

		} catch (Exception $e) {
			$e->getMessage();
		}
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param int    $id 
    *
    * @return array
    */
    public static function delete($id)
    {
        try {

            if (empty($id)) {
				throw new Exception("Fill in all fields");

				return false;
			}

			$conn = new Database();

            $result = $conn->executeQuery('DELETE FROM product WHERE id = :id', array(
                ':id' => $id
            ));

            return $result;

            // if (!$result) {
			// 	throw new Exception("No record found");	
			// }

            return true;

		} catch (Exception $e) {
			$e->getMessage();
		}
    }
}