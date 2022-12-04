<?php

namespace app\Models;

use app\Core\DataBase;
use Exception;
use PDO;

class ProviderProduct
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

            // $result = $conn->executeQuery('SELECT * FROM provider_product;');

            $result = $conn->executeQuery("SELECT 
                                                provider_product.id as id, 
                                                provider_product.id_provider as id_provider,
                                                provider_product.id_product as id_product,
                                                product.name as name,
                                                provider_product.value as value,
                                                provider_product.date_register as date_register
                                            FROM 
                                                provider_product 
                                            INNER JOIN product ON provider_product.id_product = product.id ORDER BY id;");

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
    * @param int    $id_product
    * @param int    $id_provider
    *
    * @return array
    */
    public static function indexWithProvider()
    {
        try {

			$conn = new Database();

            $result = $conn->executeQuery("SELECT id_provider FROM provider_product GROUP BY id_provider;");

            return $result->fetchAll(PDO::FETCH_ASSOC);

            // if (!$result) {
			// 	throw new Exception("No record found");	
			// }

		} catch (Exception $e) {
			$e->getMessage();
		}
    }

    /**
    * Display the specified resource.
    *
    * @param int    $id_product
    * @param int    $id_provider
    *
    * @return array
    */
    public static function show($id_provider)
    {
        try {

			$conn = new Database();

            // $and = false;

            // if (isset($id_product) > 0) {
            //     $whereProduct = " WHERE id_product = $id_product ";
            //     $and = true;
            // }

            // if ($and) {
            //     $whereOrAnd = " AND ";
            // }else{
            //     $whereOrAnd = " WHERE ";
            // }

            // if (isset($id_provider) > 0) {
            //     $whereProvider = " $whereOrAnd id_provider = $id_product ";
            // }

            // $result = $conn->executeQuery("SELECT * FROM provider_product WHERE id_provider = :id_provider;", array(
            //     ':id_provider' => $id_provider
            // ));

            $result = $conn->executeQuery("SELECT 
                                                provider_product.id as id, 
                                                provider_product.id_provider as id_provider,
                                                provider_product.id_product as id_product,
                                                product.name as name,
                                                provider_product.value as value
                                            FROM 
                                                provider_product
                                            INNER JOIN product ON provider_product.id_product = product.id
                                            WHERE provider_product.id_provider = :id_provider;", array(
                ':id_provider' => $id_provider
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
    * @param int        $id_product
    * @param int        $id_provider
    * @param decimal    $value
    *
    * @return array
    */
    public static function store($id_product, $id_provider, $value)
    {
        try {
            // $id_provider = $dados['id_provider'];
            // $id_product = $dados['id_product'];
            // $value = $dados['value'];
			// $date_register = $dados['date_register'];

            // if (empty($id_provider) || empty($id_product) || empty($value) || empty($date_register)) {
			// 	throw new Exception("Fill in all fields");

			// 	return false;
			// }

			$conn = new Database();

            $result = $conn->executeQuery('INSERT INTO provider_product (id_provider, id_product, `value`, date_register) VALUES (:id_provider, :id_product, :value, NOW())', array(
                ':id_provider' => $id_provider,
                ':id_product' => $id_product,
                ':value' => $value,
            ));

            return true;

            // if ($result == 0) {
			// 	throw new Exception("Failed to insert");

			// 	return false;
			// }

			// return true;

		} catch (Exception $e) {
			$e->getMessage();
		}
    }

    // /**
    // * Update the specified resource in storage.
    // *
    // * @param array      $dados
    // * @param int        $id 
    // *
    // * @return array
    // */
    // public static function update($dados, $id)
    // {
    //     try {
    //         $value = $dados['value'];
	// 		$date_register = $dados['date_register'];

    //         if (empty($id) || empty($value) || empty($date_register)) {
	// 			throw new Exception("Fill in all fields");

	// 			return false;
	// 		}

	// 		$conn = new Database();

    //         $result = $conn->executeQuery('UPDATE provider_product SET `value` = :value, date_register = :date_register WHERE id = :id', array(
    //             ':value' => $value,
    //             ':date_register' => $date_register,
    //             ':id' => $id
    //         ));

    //         return $result;

    //         // if ($result == 0) {
	// 		// 	throw new Exception("Failed to update");

	// 		// 	return false;
	// 		// }

	// 		// return true;

	// 	} catch (Exception $e) {
	// 		$e->getMessage();
	// 	}
    // }

    /**
    * Remove the specified resource from storage.
    *
    * @param int        $id_product
    * @param int        $id_provider
    *
    * @return array
    */
    public static function delete($id_provider)
    {
        try {

            if (empty($id_provider)) {
				throw new Exception("Fill in all fields");

				return false;
			}

			$conn = new Database();

            // if (isset($id_provider) > 0) {
            //     $whereProvider = "id_provider = $id_product ";
            //     $and = true;
            // }

            // if (isset($id_product) > 0) {
            //     $whereProduct = " WHERE id_product = $id_product ";
                
            // }            

            $result = $conn->executeQuery('DELETE FROM provider_product WHERE id_provider = :id_provider', array(
                ':id_provider' => $id_provider
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