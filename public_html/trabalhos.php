<?php

require_once '../vendor/autoload.php';
require_once '../config.php';

use core\sistema\Autenticacao;

if (!Autenticacao::verificarLogin()) {
    header("Location:login.php");
}

use core\controller\Trabalhos;
$trabalhos = new Trabalhos();


if (Autenticacao::usuarioAdministrador()) {
    $pg = isset($_GET['pg']) ? $_GET['pg'] : null;
    
    $busca = [];
    
    if (isset($_GET['autores'])) $busca['texto'] = $_GET['autores'];
    if (isset($_GET['pagamento'])) $busca['statusPagamento'] = $_GET['pagamento'];
    if (isset($_GET['impressao'])) $busca['statusImpressao'] = $_GET['impressao'];
    $busca['enviados'] = 1;
    
    $dados = [];
    
    if ($pg != null) $dados['pg'] = $pg;
    
    if (count($busca) > 0) $dados['busca'] = $busca;
} else {
    $dados = [
        "busca" => [
            "idUsuario" => Autenticacao::getCookieUsuario()
        ]    
    ];
}

$trabalhos = $trabalhos->listarTrabalhos($dados);

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Envio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CSS Autoral -->
    <link rel="stylesheet" href="assets/css/trabalhos.css">

    <!-- Biblioteca de ícones do Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
    <!--Main Navigation-->
    <header>

        <!--Navbar-->
        <nav class="navbar navbar-expand-lg ">

            <div class="container">

                <!-- Navbar brand -->
                <a class="navbar-brand text-uppercase" href="https://integra.ifgoiano.edu.br/">INTEGRA If GOIANO</a>

                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="basicExampleNav">

                    <!-- Links -->
                    <ul class="navbar-nav mr-auto smooth-scroll">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">Início</a>
                        </li>

                        <?php
                        if (!Autenticacao::verificarLogin()) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./login.php">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./cadastro.php">Cadastro</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./trabalho.php">Enviar Trabalho</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./trabalhos.php">Acompanhar Trabalhos</a>
                        </li>
                    </ul>

                    <!-- Links -->

                    <!-- Social Icon  -->
                    <ul class="navbar-nav nav-flex-icons">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/integra.ifgoiano/"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.instagram.com/integra.ifgoiano/"><i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>

                    <?php
                    if (Autenticacao::verificarLogin()) { ?>
                        <a href="#" class="nav-link" rel="Sair" id="logout"><i class="fas fa-sign-out-alt"></i></a>
                    <?php } ?>
                </div>
                <!-- Collapsible content -->

            </div>

        </nav>
        <!--/.Navbar-->



    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="mt-5">

        <?php if (Autenticacao::verificarLogin() && !Autenticacao::usuarioAdministrador()) { ?>
            <div class="container">
                <!--Section: Best Features-->
                <section id="best-features" class="text-center">

                    <!-- Heading -->
                    <h2 class="mb-5 font-weight-bold">Trabalhos Enviados</h2>

                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Título</th>
                                <th scope="col">Pagamento</th>
                                <th scope="col">Impressão</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count((array)$trabalhos["lista_trabalhos"][0]) > 0) {
                                foreach ($trabalhos["lista_trabalhos"] as $j => $trab) { ?>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><?= $trab->titulo ?></td>
                                    <td><?= $trab->statusPagamento ?></td>
                                    <td><?= $trab->statusImpressao ?></td>
                                </tr>
                            <?php } } else { ?>
                                <tr>
                                    <td colspan="4" class="align-text-center">Nenhum trabalho enviado para impressão.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </section>
                <!--Section: Best Features-->
                <hr class="my-5">
            </div>
        <?php }
        if (Autenticacao::verificarLogin() && Autenticacao::usuarioAdministrador()) {  ?>
            <div class="container">
                <!--Section: Best Features-->
                <section id="best-features" class="text-center">

                    <h2 class="mb-5 font-weight-bold">Trabalhos Enviados</h2>
                    <form id="filtrar">
                        <div class="form-row text-left">
                            <div class="form-group col-md-5">
                                <input type="text" class="form-control" id="autores" value="" placeholder="Ex.: João Ferreira da Silva; Maria Silva Ferreira; ">
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <select class="custom-select" name="pagamento" id="pagamento">
                                        <option selected disabled value="10">Selecione status de pagamento</option>
                                        <option value="1">Aguardando Pagamento</option>
                                        <option value="2">Pagamento Confirmado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="input-group">
                                    <select class="custom-select" name="impressao" id="impressao">
                                        <option selected disabled value="10">Selecione status de impressão</option>
                                        <option value="1">Em Impressão</option>
                                        <option value="2">Impressão Finalizada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-1 text-center  justify-content-center text-center ">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-outline-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>

                            </div>

                        </div>

                    </form>

                    <div class="row d-flex justify-content-center text-center ">
                    </div>

                    <form id="formulario" method="post">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Download</th>
                                    <th scope="col">Pagamento</th>
                                    <!-- <th scope="col">Impressão</th> -->
                                    <th scope="col text-center"> <button type="submit" class="btn btn-success">Salvar Alterações</button> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count((array)$trabalhos["lista_trabalhos"][0]) > 0) {
                                        $cont = 1;
                                    foreach ($trabalhos["lista_trabalhos"] as $j => $trab) { ?>
                                <tr data-idTrabalho="<?= $trab->idTrabalho ?>" id="tr">
                                    <th scope="row"><?= $cont++ ?></th>
                                    <td><?= $trab->titulo ?></td>
                                    <td>
                                        <a href="#" class="btn btn-outline-dark"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        <select class="custom-select" name="statusPagamento" id="statusPagamento">
                                            <option value="1" <?= $trab->statusPagamento == 1 ? 'selected' : '' ?>>Aguardando Pagamento</option>
                                            <option value="2" <?= $trab->statusPagamento == 2 ? 'selected' : "" ?>>Pagamento Confirmado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="custom-select" name="statusImpressao" id="statusImpressao">
                                            <option value="1" <?= $trab->statusImpressao == 1 ? 'selected' : '' ?>>Em Impressão</option>
                                            <option value="2" <?= $trab->statusImpressao == 2 ? 'selected' : '' ?>>Impressão Finalizada</option>
                                        </select>
                                    </td>
                                </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="5" class="align-text-center">Nenhum trabalho enviado para impressão.</td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </form>
                </section>
                <!--Section: Best Features-->
                <hr class="my-5">

            </div>
        <?php  } ?> 
    </main>
    <!--Main layout-->

    <?php if (isset($trabalhos['total_paginas']) && $trabalhos['total_paginas'] > 1) { ?>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($pg == null || $pg < 2) ? "disabled" : "" ?>">
                    <a class="page-link" href="<?= ($pg == null || $pg <= 2) ? "trabalhos.php" : "trabalhos.php?pg=" . ($pg-1) ?>">Anterior</a>
                </li>

                <?php for ($i = 1; $i <= $trabalhos['total_paginas']; $i++) { ?>

                    <li class="page-item <?= (($pg == null && $i == 1) || $pg == $i) ? "disabled" : "" ?>">
                        <a class="page-link" href="trabalhos.php?pg=<?= $i ?>"><?= $i ?></a>
                    </li>

                <?php } ?>

                <li class="page-item <?= ($pg == $trabalhos['total_paginas']) ? "disabled" : "" ?>">
                    <a class="page-link" href="trabalhos.php?pg=<?= ($pg == null) ? '2' : ($pg+1) ?>">Próximo</a>
                </li>
            </ul>
        </nav>
    <?php } ?>

    <!-- Footer -->
    <footer class="page-footer  unique-color-dark">

        <!--Footer Links-->
        <div class="container mt-5 mb-4 text-center text-md-left">
            <div class="row mt-3">

                <!--First column-->
                <div class="col-md-4  col-lg-5 col-xl-5 mb-4">
                    <h6 class="text-uppercase font-weight-bold">
                        <strong>INTEGRA IF GOIANO</strong>
                    </h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>Conheça Integra IF Goiano 📚🧩🔍 Estreia no ano de 2019 o maior evento científico do IF Goiano - o primeiro integrado entre ensino, pesquisa, extensão e inovação.</p>
                </div>
                <!--/.First column-->

                <!--Fourth column-->
                <div class="col-md-4 offset-md-4 col-lg-3 col-xl-3">
                    <h6 class="text-uppercase font-weight-bold">
                        <strong>Contato</strong>
                    </h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <i class="fas fa-home"></i></i> Rodovia Go-154, Km 03, Zona Rural, Ceres - GO, 76300-000</p>
                    <p>
                        <i class="fa fa-envelope mr-3"></i> info@example.com</p>
                    <p>
                        <i class="fa fa-phone mr-3"></i>(62) 3307-7100</p>
                </div>
                <!--/.Fourth column-->

            </div>
        </div>
        <!--/.Footer Links-->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="assets/js/index.js"></script>
    <script src="assets/js/pesquisar_trabalho.js"></script>
</body>

</html>