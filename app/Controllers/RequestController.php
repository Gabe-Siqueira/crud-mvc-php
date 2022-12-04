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

        $this->view('request/index', ['provider' => $arrayProvider]);
    }

    public function create()
    {
        $providerModel = $this->model('Provider');
        $productModel = $this->model('Product');
        $provider = $providerModel::index();
        $product = $productModel::index();

        $this->view('request/create', ['provider' => $provider, 'product' => $product]);
    }

    public function store()
    {
        try {
            $id_provider = $_POST['provider'];
            $actions = $_POST['actions'];

            $providerProductModel = $this->model('ProviderProduct');

            foreach ($actions as $data) {
                $actions = explode('-', $data);
                $id_product = $actions[0];
                $value = $actions[1];

                $providerProductModel::store($id_product, $id_provider, $value);
            }

            $providerModel = $this->model('Provider');
            $productModel = $this->model('Product');
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

            $this->view('request/edit', ['providerProduct' => $providerProduct, 'provider' => $provider, 'product' => $product]);
        }else{
            $this->pageNotFound();
        }
    }

    public function update($id_provider = null)
    {
        try {

            $actions = $_POST['actions'];

            $providerProductModel = $this->model('ProviderProduct');
            $providerProductModel::delete($id_provider);

            foreach ($actions as $data) {
                $actions = explode('-', $data);
                $id_product = $actions[0];
                $value = $actions[1];

                $providerProductModel::store($id_product, $id_provider, $value);
            }

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