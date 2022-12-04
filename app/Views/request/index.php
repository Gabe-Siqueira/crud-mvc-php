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

$result = '';
foreach ($data['provider'] as $value) {
    $result .=  "<tr class='table-active' id='".$value['id']."'>
                    <td>".$value['name']."</td>
                    <td class='text-center' >
                        <div class='row' style='display: inline-flex;'>
                            <a class='btn btn-primary btn-sm mr-1' href='http://localhost:8080/request/edit/".$value['id']."' role='button'>
                                Editar <i class='fa fa-pencil-square-o' aria-hidden='true'></i>
                            </a>
                            <a class='btn btn-danger btn-sm' href='http://localhost:8080/request/delete/".$value['id']."' role='button'>
                                Excluir <i class='fa fa-trash-o' aria-hidden='true'></i>
                            </a>
                        </div>
                    </td>
                </tr>";
}

$result = strlen($result) ? $result : '<tr>
                                            <td colspan="2" class="text">
                                                Nenhum dado encontrado.
                                            </td>
                                        </tr>';

?>

<main class="main">
    <section class="jumbotron text-center" style="margin: 0px;">
        <div class="container">
            <h1 class="jumbotron-heading">Pedido</h1>
            <p>
                <a href="http://localhost:8080/home/index" class="btn btn-secondary my-2">Voltar</a>
                <a href="http://localhost:8080/request/create" class="btn btn-success my-2">Cadastrar</a>    
            </p>
        </div>
    </section>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <?=$message?>
                <!-- INCIO CARD LISTA REQUEST -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive-sm  table-responsive-md mt-3">
                                    <table id="providerDataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Fornecedor</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?=$result?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FIM CARD LISTA REQUEST -->
            </div>
        </div>
    </div>

</main>
