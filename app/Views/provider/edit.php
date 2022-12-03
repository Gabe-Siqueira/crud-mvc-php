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

foreach ($data['provider'] as $value) {
    $id = $value['id'];
    $name = $value['name'];
    $date_register = $value['date_register'];
}

?>

<main class="main">
    <section class="jumbotron text-center" style="margin: 0px;">
        <div class="container">
            <h1 class="jumbotron-heading">Atualizar Fornecedor - ID <?=$id?></h1>
            <p>
                <a href="http://localhost:8080/provider/index" class="btn btn-secondary my-2">Voltar</a>   
            </p>
        </div>
    </section>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <?=$message?>
                <!-- INCIO CARD ATUALIZAR PROVIDER -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="http://localhost:8080/provider/update/<?=$id?>" method="post">
                                    <div class="provider">
                                        <div class="row ml-1">
                                            <h4 class="bold">
                                                Dados
                                            </h4>
                                        </div>
                                        <hr style="margin-top: -5px;">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                                <div class="form-provider">
                                                    <b>Nome:</b>
                                                    <input type="text" class="form-control" name="name" maxlength="255" value="<?=$name?>" required >
                                                    <span class="error-validate"><p id="validate-name"></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ml-1">
                                        <div class="form-group">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-primary btn-sm" type="submit">
                                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> Salvar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM CARD ATUALIZAR PROVIDER -->
            </div>
        </div>
    </div>

</main>
