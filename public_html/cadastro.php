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

                    <!-- Collapsible content -->

                </div>

        </nav>
        <!--/.Navbar-->



    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="mt-5">
        <div class="container">

            <!--Section: Best Features-->
            <section id="best-features" class="">

                <!-- Heading -->
                <h2 class="mb-5 font-weight-bold text-center">Cadastre-se</h2>

                <form id="formulario" class="needs-validation">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" value="" placeholder="Insira seu nome completo" required autofocus>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="cpf">CPF:</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" pattern="\d{3}\.\d{3}.\d{3}-\d{2}" title="Exemplo: xxx.xxx.xxx-xx" value="" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" value="" placeholder="Insira seu e-mail" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" id="telefone" class="form-control" placeholder="(00) 90000-0000" value="" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" id="senha" placeholder="Crie uma senha" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirm_senha">Confirmação de Senha:</label>
                            <input type="password" class="form-control" id="confirm_senha" placeholder="Confirme sua senha" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="offset-md-8 col-md-4">
                            <button type="submit" class="btn btn-block btn-outline-success">Cadastrar</button>
                        </div>
                    </div>
                    <input type="hidden" id="usuario_id" name="usuario_id" value="">
        </div>
        </form>
        </section>
        <!--Section: Best Features-->
        <hr class="my-5">

        <!-- Toast Alerta -->

        <div class="toast" id="msg_alerta" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000" style="position: absolute; top: 4rem; right: 1rem;">
            <div class="toast-header">
                <strong class="mr-auto">Houve um erro!</strong>
                <small>Agora</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Por favor, confira todos os dados informados.
            </div>
            <div class="card-footer text-muted bg-warning p-1"></div>
        </div>
        <!-- Toast -->

        </div>
    </main>
    <!--Main layout-->

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

    <script src='assets/js/index.js'></script>
    <script src='assets/js/cadastro_usuario.js'></script>
</body>

</html>