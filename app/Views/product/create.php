<?php

$message = '';
if(isset($data['message'])){
    switch ($data['message']) {
        case 'success':
        $message = '<div class="alert alert-success">Ação executada com sucesso!</div>';
        break;

        case 'error':
        $message = '<div class="alert alert-danger">Ação não executada!</div>';
        break;
    }
}

?>

<main class="main">
    <section class="jumbotron text-center" style="margin: 0px;">
        <div class="container">
            <h1 class="jumbotron-heading">Cadastrar Produto</h1>
            <p>
                <a href="http://localhost:8080/product/index" class="btn btn-secondary my-2">Voltar</a>   
            </p>
        </div>
    </section>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <?=$message?>
                <!-- INCIO CARD CRIAR PRODUCT -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="http://localhost:8080/product/store" method="post">
                                    <div class="product">
                                        <div class="row ml-1">
                                            <h4 class="bold">
                                                Dados
                                            </h4>
                                        </div>
                                        <hr style="margin-top: -5px;">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="form-product">
                                                    <b>Nome:</b>
                                                    <input type="text" class="form-control" name="name" maxlength="255" required >
                                                    <span class="error-validate"><p id="validate-name"></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ml-1">
                                        <div class="form-group">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> Cadastrar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM CARD CRIAR PRODUCT -->
            </div>
        </div>
    </div>

</main>
