<?php

use app\Core\Controller;

class ProviderController extends Controller
{
    public function index()
    {
        $providerModel = $this->model('Provider');
        $provider = $providerModel::index();
        $this->view('provider/index', ['provider' => $provider]);
    }

    public function create()
    {
        $this->view('provider/create');
    }

    public function edit($id = null)
    {
        if (is_numeric($id)) {
            $providerModel = $this->model('Provider');
            $provider = $providerModel::findById($id);
            $this->view('provider/edit', ['provider' => $provider]);
        }else{
            $this->pageNotFound();
        }
    }
}