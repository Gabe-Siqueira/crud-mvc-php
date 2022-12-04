<?php

use app\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $providerProductModel = $this->model('ProviderProduct');
        $providerModel = $this->model('Provider');
        $providerProduct = $providerProductModel::indexWithProvider();
        $provider = $providerModel::index();

        $result_array = array_intersect_assoc($providerProduct, $provider);

        foreach ($provider as $value) {
            foreach ($result_array as $key) {
                if ($value['id'] == $key['id_provider']) {
                    $arrayProvider[] = [
                        "id" => $value['id'],
                        "name" => $value['name']
                    ];
                }
            }
        }

        // echo "<pre>";
        // var_dump($arrayProvider);
        // echo "<pre>";
        // exit;

        // $providerProductModel = $this->model('ProviderProduct');
        $providerProduct = $providerProductModel::index();

        // echo "<pre>";
        // var_dump($providerProduct);
        // echo "<pre>";
        // exit;

        foreach ($arrayProvider as $value) {
            foreach ($providerProduct as $key) {
                if ($value['id'] == $key['id_provider']) {
                    // $arrayProviderProduct[$value['id']] = [
                    //     "id_provider" => $value['id'],
                    //     "provider_name" => $value['name'],
                    //     "product" => [
                    //         "id_product" => $key['id_product'],
                    //         "value" => $key['value'],
                    //         "date_register" => $key['date_register'],
                    //     ]
                    // ];

                    $arrayProviderProduct[$value['id']]['id_provider'] = $value['id'];
                    $arrayProviderProduct[$value['id']]['provider_name'] = $value['name'];
                    $arrayProviderProduct[$value['id']]['product'][$key['id']]['id_provider'] = $key['id_provider'];
                    $arrayProviderProduct[$value['id']]['product'][$key['id']]['id_product'] = $key['id_product'];
                    $arrayProviderProduct[$value['id']]['product'][$key['id']]['name'] = $key['name'];
                    $arrayProviderProduct[$value['id']]['product'][$key['id']]['value'] = $key['value'];
                    $arrayProviderProduct[$value['id']]['product'][$key['id']]['date_register'] = $key['date_register'];
                }
            }
        }

        
        // echo "<pre>";
        // var_dump($arrayProviderProduct);
        // echo "<pre>";
        // exit;
        

        $this->view('home/index', ['providerProduct' => $arrayProviderProduct]);
    }
}