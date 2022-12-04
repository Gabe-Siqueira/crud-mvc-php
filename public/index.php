<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <title>Teste Dev</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  </head>

  <body>
    <header>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
            <a href="http://localhost:8080/home/index" class="navbar-brand d-flex align-items-center">
                <strong>Sistema Fornecedor e Produto</strong>
            </a>
            <nav class="nav nav-masthead justify-content-center">
              <a class="nav-link text-white" href="http://localhost:8080/home/index">Home</a>
              <a class="nav-link text-white" href="http://localhost:8080/provider/index">Fornecedor</a>
              <a class="nav-link text-white" href="http://localhost:8080/product/index">Produto</a>
              <a class="nav-link text-white" href="http://localhost:8080/request/index">Pedido</a>
            </nav>
        </div>
      </div>
    </header>

    <?php
      require '../app/autoload.php';

      use app\Core\App;

      $app = new App();

    ?>

    <footer class="footer mt-auto py-3 bg-dark text-center">
      <div class="container">
          <span class="text-white text-muted">Teste Dev. CRUD MVC PHP.</span>
      </div>
    </footer>

    <script src="/assets/js/jquery.slim.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
  </body>

</html>
