<?php

namespace app\Core;

class Controller
{
    /**
    * method returns model
    *
    * @return string
    */
    public function model($model)
    {
        require '../app/Models/' . $model . '.php';
        $class = 'app\\Models\\' . $model;
        return new $class();
    }

    /**
    * method returns view
    *
    * @return string
    * @return array
    */
    public function view(string $view, $data = [])
    {
        require '../app/Views/' . $view . '.php';
    }

    /**
    * method return view erro404
    *
    */
    public function pageNotFound()
    {
        $this->view('error/404');
    }
}