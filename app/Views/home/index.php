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
        // echo "<pre>";
        // var_dump($key);
        // echo "</pre>";
        // exit;
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
                                    // echo "<pre>";
                                    // var_dump($key);
                                    // echo "</pre>";
                                    // exit;
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
                <!-- <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div> -->
                <?=$result?>
            </div>
        </div>
    </div>
</main>
