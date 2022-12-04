<?php

use app\Core\Controller;

class RequestController extends Controller
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
                        "name" => $value['name'],
                    ];
                }
            }
        }

        // echo "<pre>";
        // var_dump($arrayProvider);
        // echo "<pre>";
        // exit;

        $this->view('request/index', ['provider' => $arrayProvider]);
    }

    public function create()
    {
        $providerModel = $this->model('Provider');
        $productModel = $this->model('Product');
        $provider = $providerModel::index();
        $product = $productModel::index();

        // var_dump($ProviderProduct);

        // if ($ProviderProduct != null) {
        //     // echo "opa";
        //     foreach ($ProviderProduct as $value) {
        //         foreach ($provider as $key) {
        //             // var_dump($value['id_provider']);
        //             // echo "</br>";
        //             // var_dump($key['id']);
        //             // echo "</br>";
        //             if ($value['id_provider'] != $key['id']) {
        //                 // $teste['id'] = $value['id'];
        //                 // $teste['id_provider'] = $key['id'];
        //                 // $teste['provider'] = $key['name'];
        //                 $teste[] = [
        //                     'id' => $value['id'],
        //                     'id_provider' => $key['id'],
        //                     'name' => $key['name'],
        //                     'active' => true
        //                 ];
        //             }else{
        //                 $teste[] = [
        //                     'id' => $value['id'],
        //                     'id_provider' => $key['id'],
        //                     'name' => $key['name'],
        //                     'active' => false
        //                 ];
        //             }
        //         }
        //     }
        // }else{
        //     $teste = $provider;
        // }
        

        // var_dump($provider);
        // exit;

        $this->view('request/create', ['provider' => $provider, 'product' => $product]);
    }

    public function store()
    {
        try {
            // var_dump($_POST);
            // echo "</br>";
            // exit;
            $id_provider = $_POST['provider'];
            $actions = $_POST['actions'];

            // var_dump($actions);
            // echo "</br>";
            $providerProductModel = $this->model('ProviderProduct');

            foreach ($actions as $data) {
                $actions = explode('-', $data);
                $id_product = $actions[0];
                $value = $actions[1];

                // var_dump($id_product);
                // echo "</br>";
                // var_dump($id_provider);
                // echo "</br>";
                // var_dump($value);
                // echo "</br>";


                // exit;
                // $providerProductModel = $this->model('ProviderProduct');
                $teste = $providerProductModel::store($id_product, $id_provider, $value);
                // var_dump($teste);
                // exit;
            }

            $providerModel = $this->model('Provider');
            $productModel = $this->model('Product');
            // $ProviderProductModel = $this->model('ProviderProduct');
            // $providerProductModel = $this->model('ProviderProduct');
            $provider = $providerModel::index();
            $product = $productModel::index();
            
            $this->view('request/create', ['provider' => $provider, 'product' => $product, 'message' => 'success']);
        } catch (\Exception $e) {
            $this->view('request/create', ['provider' => $provider, 'product' => $product, 'message' => 'error']);
        }
        
    }

    public function edit($id_provider = null)
    {
        if (is_numeric($id_provider)) {
            $providerProductModel = $this->model('ProviderProduct');
            $providerModel = $this->model('Provider');
            $productModel = $this->model('Product');
            $providerProduct = $providerProductModel::show($id_provider, null);
            $provider = $providerModel::show($id_provider);
            $product = $productModel::index();

            // echo "<pre>";
            // var_dump($providerProduct);
            // echo "<pre>";
            // exit;

            $this->view('request/edit', ['providerProduct' => $providerProduct, 'provider' => $provider, 'product' => $product]);
        }else{
            $this->pageNotFound();
        }
    }

    public function update($id_provider = null)
    {
        try {
            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
            // exit;

            $actions = $_POST['actions'];

            $providerProductModel = $this->model('ProviderProduct');
            $providerProductModel::delete($id_provider);

            foreach ($actions as $data) {
                $actions = explode('-', $data);
                $id_product = $actions[0];
                $value = $actions[1];

                // var_dump($id_product);
                // echo "</br>";
                // var_dump($id_provider);
                // echo "</br>";
                // var_dump($value);
                // echo "</br>";


                // exit;
                // $providerProductModel = $this->model('ProviderProduct');
                $teste = $providerProductModel::store($id_product, $id_provider, $value);
                // var_dump($teste);
                // exit;
            }

            // $providerProductModel = $this->model('ProviderProduct');
            $providerModel = $this->model('Provider');
            $productModel = $this->model('Product');
            $providerProduct = $providerProductModel::show($id_provider, null);
            $provider = $providerModel::show($id_provider);
            $product = $productModel::index();
            
            $this->view('request/edit', ['providerProduct' => $providerProduct, 'provider' => $provider, 'product' => $product, 'message' => 'success']);
        } catch (\Exception $e) {
            $this->view('request/edit', ['providerProduct' => $providerProduct, 'provider' => $provider, 'product' => $product, 'message' => 'error']);
        }
    }

    public function delete($id_provider = null)
    {
        try {
            $providerProductModel = $this->model('ProviderProduct');
            $providerProductModel::delete($id_provider);

            $providerProduct = $providerProductModel::indexWithProvider();
            $providerModel = $this->model('Provider');            
            $provider = $providerModel::index();

            $result_array = array_intersect_assoc($providerProduct, $provider);

            foreach ($provider as $value) {
                foreach ($result_array as $key) {
                    if ($value['id'] == $key['id_provider']) {
                        $arrayProvider[] = [
                            "id" => $value['id'],
                            "name" => $value['name'],
                        ];
                    }
                }
            }

            $this->view('request/index', ['provider' => $arrayProvider, 'message' => 'success']);
        } catch (\Exception $e) {
            $this->view('request/index', ['provider' => $arrayProvider, 'message' => 'error']);
        }
    }
}