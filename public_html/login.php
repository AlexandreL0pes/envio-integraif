<?php

require_once '../vendor/autoload.php';
require_once '../config.php';

use core\sistema\Autenticacao;

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
    <link rel="stylesheet" href="assets/css/index1.css">

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

        <!--Mask-->
        <div id="intro" class="view center-block">
            <div class="container center-block container-login">
                <div class="row">
                    <div class="col-md-12">
                        <p></p>
                    </div>
                    <div class="col-md-12">
                        <p></p>
                    </div>
                    <div class="col-md-12">
                        <p></p>
                    </div>
                    <div class="col-md-12">
                        <p></p>
                    </div>

                </div>
                <div class="row ">
                    <div class="col"></div>
                    <div class="col-md-6">
                        <form class="form-signin" action="" method="post">
                            <h1 class="h3 mb-3 font-weight-normal text-center">Entrar</h1>
                            <div class="form-group">
                                <label for="email" class="sr-only">E-mail</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="senha" class="sr-only">Password</label>
                                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
                            </div>
                            <div class="checkbox">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="checkbox" id="lembrar" value="Lembrar-me">
                                            <label for="lembrar">Manter conectado</label>
                                        </div>
                                        <div class="col">
                                            <p class="text-right">
                                                <!-- <button class="btn btn-sm btn-link" id="botao_senha">Esqueci minha senha</button> -->
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-outline-dark btn-block" type="submit" id="botao_login">Entrar</button>
                            <hr>
                            <p class="text-center">Ainda não está cadastrado? <a href="./cadastro.php">Clique aqui</a></p>
                        </form>
                    </div>
                    <div class="col">
                        <div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <!--/.Mask-->

    </header>
    <!--Main Navigation-->

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

    <script src="assets/js/login.js"></script>
    <script src="assets/js/index.js"></script>

</body>

</html>