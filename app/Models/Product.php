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

            $result = $conn->executeQuery('SELECT * FROM product;');

            return $result->fetchAll(PDO::FETCH_ASSOC);

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

		} catch (Exception $e) {
			$e->getMessage();
		}
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param string    $name 
    *
    * @return array
    */
    public static function store($name)
    {
        try {

			$conn = new Database();

            $result = $conn->executeQuery('INSERT INTO product (`name`, date_register) VALUES (:name, NOW())', array(
                ':name' => $name
            ));

            return $result;

		} catch (Exception $e) {
			$e->getMessage();
		}
    }

    /**
    * Update the specified resource in storage.
    *
    * @param string     $name
    * @param int        $id 
    *
    * @return array
    */
    public static function update($name, $id)
    {
        try {

			$conn = new Database();

            $result = $conn->executeQuery('UPDATE product SET `name` = :name WHERE id = :id', array(
                ':name' => $name,
                ':id' => $id
            ));

            return $result;

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

		} catch (Exception $e) {
			$e->getMessage();
		}
    }
}