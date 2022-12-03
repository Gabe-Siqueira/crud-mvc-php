<?php

use app\Core\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $productModel = $this->model('Product');
        $product = $productModel::index();
        $this->view('product/index', ['product' => $product]);
    }

    public function create()
    {
        $this->view('product/create');
    }

    public function store()
    {
        try {
            $name = $_POST['name'];
            $productModel = $this->model('Product');
            $productModel::store($name);
            $this->view('product/create', ['message' => 'success']);
        } catch (\Exception $e) {
            $this->view('product/create', ['message' => 'error']);
        }
        
    }

    public function edit($id = null)
    {
        if (is_numeric($id)) {
            $productModel = $this->model('Product');
            $product = $productModel::show($id);
            $this->view('product/edit', ['product' => $product]);
        }else{
            $this->pageNotFound();
        }
    }

    public function update($id = null)
    {
        try {
            $name = $_POST['name'];
            $productModel = $this->model('Product');
            $productModel::update($name, $id);
            $product = $productModel::show($id);
            $this->view("product/edit", ['product' => $product, 'message' => 'success']);
        } catch (\Exception $e) {
            $this->view("product/edit", ['product' => $product,'message' => 'error']);
        }
    }

    public function delete($id = null)
    {
        try {
            $productModel = $this->model('Product');
            $productModel::delete($id);
            $product = $productModel::index($id);
            $this->view("product/index", ['product' => $product, 'message' => 'success']);
        } catch (\Exception $e) {
            $this->view("product/index", ['product' => $product, 'message' => 'error']);
        }
    }
}