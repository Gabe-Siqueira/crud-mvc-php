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

$array = '';
foreach ($data['providerProduct'] as $value) {
    foreach ($value['product'] as $key) {
        $array .=  "<p class='card-text'>".$key['name']." - R$".$key['value']."</p>";
    }
}

$result = '';
foreach ($data['providerProduct'] as $value) {
    $result .=  "<div class='col-md-4'>
                    <div class='card mb-4 shadow-sm'>
                        <div class='card-body'>
                            <h5 class='card-title'>".$value['provider_name']."</h5>
                            <h6 class='card-subtitle mb-2 text-muted'>Lista</h6>";
                                $total = 0;
                                foreach ($value['product'] as $key) {
                                    if ($value['id_provider'] == $key['id_provider']) {
                                        $result .= "<p class='card-text'>".$key['name']." - R$".$key['value']."</p>";
                                    }

                                    $total = $total + $key['value'];
                                    
                                }
    $result .= "            <p class='card-text'><strong>Total: R$".$total."</strong></p>
                        </div>
                    </div>
                </div>";
}



$result = strlen($result) ? $result : '<tr>
                                            <td colspan="5" class="text">
                                                Nenhum dado encontrado.
                                            </td>
                                        </tr>';

?>

<main class="main">
    <section class="jumbotron text-center" style="margin: 0px;">
        <div class="container">
            <h1 class="jumbotron-heading">Registro</h1>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?=$result?>
            </div>
        </div>
    </div>
</main>
