<?php

use app\Core\Controller;

class ProviderController extends Controller
{
    public function index($message = null)
    {
        $providerModel = $this->model('Provider');
        $provider = $providerModel::index();
        $this->view('provider/index', ['provider' => $provider, 'message' => $message]);
    }

    public function create()
    {
        $this->view('provider/create');
    }

    public function store()
    {
        try {
            $name = $_POST['name'];
            $providerModel = $this->model('Provider');
            $providerModel::store($name);
            $this->view('provider/create', ['message' => 'success']);
        } catch (\Exception $e) {
            $this->view('provider/create', ['message' => 'error']);
        }
        
    }

    public function edit($id = null)
    {
        if (is_numeric($id)) {
            $providerModel = $this->model('Provider');
            $provider = $providerModel::show($id);
            $this->view('provider/edit', ['provider' => $provider]);
        }else{
            $this->pageNotFound();
        }
    }

    public function update($id = null)
    {
        try {
            $name = $_POST['name'];
            $providerModel = $this->model('Provider');
            $providerModel::update($name, $id);
            $provider = $providerModel::show($id);
            $this->view("provider/edit", ['provider' => $provider, 'message' => 'success']);
        } catch (\Exception $e) {
            $this->view("provider/edit", ['provider' => $provider,'message' => 'error']);
        }
    }

    public function delete($id = null)
    {
        try {
            $providerModel = $this->model('Provider');
            $providerModel::delete($id);
            $provider = $providerModel::index($id);
            $this->view("provider/index", ['provider' => $provider, 'message' => 'success']);
        } catch (\Exception $e) {
            $this->view("provider/index", ['provider' => $provider, 'message' => 'error']);
        }
    }
}