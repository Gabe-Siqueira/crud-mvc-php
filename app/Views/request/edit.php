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
}

?>

<main class="main">
    <section class="jumbotron text-center" style="margin: 0px;">
        <div class="container">
            <h1 class="jumbotron-heading">Atualizar Pedido - <?=$name?></h1>
            <p>
                <a href="http://localhost:8080/request/index" class="btn btn-secondary my-2">Voltar</a>   
            </p>
        </div>
    </section>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <?=$message?>
                <!-- INCIO CARD ATUALIZAR REQUEST -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="http://localhost:8080/request/update/<?=$id?>" method="post">
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
                                                <b>Fornecedor:</b>
                                                    <input type="text" class="form-control" name="name" maxlength="255" value="<?=$name?>" disabled >
                                                    <span class="error-validate"><p id="validate-name"></p></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="product">
                                        <div class="row ml-1">
                                            <h4 class="bold">
                                                Produto
                                            </h4>                                    
                                        </div>
                                        <hr style="margin-top: -5px;">
                                        <div class="row">
                                            <div class="col-sm-8 col-md-8 col-lg-8 col-xs-12">
                                                <div class="form-group">
                                                    <select class="form-control" multiple="multiple" id="actions" name="actions[]">
                                                        <?php
                                                            foreach ($data['providerProduct'] as $value) {
                                                                echo    "<option value='".$value['id_product']."-".intval($value['value'])."' selected>
                                                                            ".$value['name']." - R$".$value['value']."
                                                                        </option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-md-2 col-lg-2 col-xs-12">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalAddProduct">
                                                        <i class="fa fa-plus" aria-hidden="true"></i> Adicionar
                                                    </button>
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
                <!-- FIM CARD ATUALIZAR REQUEST -->
            </div>
        </div>
    </div>

</main>

<!-- INICIO MODAL PRODUCT -->
<div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title bold" id="exampleModalLongTitle">Criar action</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label class="control-label">Produto: </label>
                                <select class="form-control" id="variavelAdicional" name="variavelAdicional" required >
                                    <?php

                                        if (isset($data['product']) > 0) {
                                            foreach ($data['product'] as $value) {
                                                echo    "<option value='".$value['id']."'>
                                                            ".$value['name']."
                                                        </option>";
                                            }
                                        }else{
                                            echo    "<option value='' disabled>
                                                        Nenhum dado encontrado.
                                                    </option>";
                                        }
                                        
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label class="control-label">Valor: </label>
                                <input type="number" step="0.01" id="price" name="price" class="form-control" min="0" required /> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i> Fechar
                </button>
                <button type="button" class="btn btn-primary btn-sm" id="adicionarVariavel">
                    <i class="fa fa-check" aria-hidden="true"></i> Adicionar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- FIM MODAL PRODUCT -->

<script src="https://code.jquery.com/jquery-1.9.1.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#adicionarVariavel").click(function() {
            var novaVariavel = $('#modalAddProduct').find("[name='variavelAdicional']").val();
            if (novaVariavel.length > 0) {
                variavelActiona();
            }
        });
        function variavelActiona() {
            var novaVariavel = $("#variavelAdicional").val();

            var select = document.querySelector('#variavelAdicional');
            var option = select.children[select.selectedIndex];
            var texto = option.textContent;

            var valor = $("#price").val();

            if (novaVariavel.length > 0) {

                $("#variavelAdicional").val("").focus();

                $("#price").val("");

                $("#actions").append('<option selected value="'+novaVariavel+'-'+valor+'">'+texto+'- R$'+valor+'</option>');

                $("#actions").refresh("true");

            }
        }
    });
</script>