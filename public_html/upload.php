<?php
    require_once '../vendor/autoload.php';
    require_once '../config.php';    

    use core\controller\Trabalhos;

    if ( 0 < $_FILES['caminhoTrabalho']['error'] ) {
        echo 'Error: ' . $_FILES['caminhoTrabalho']['error'] . '<br>';
    }
    else {
        $name = $_FILES['caminhoTrabalho']['name'];
        $tmp = $_FILES['caminhoTrabalho']['tmp_name'];
    }

    $trabalhos = new Trabalhos();

    $dados = [     
        "titulo" => $_POST['titulo'],
        "statusImpressao" => $_POST['statusImpressao'],
        "statusPagamento" => $_POST['statusPagamento'],
        "datahora" => $_POST['datahora'],
        "idUsuario" => $_POST['idUsuario'],
        "caminhoTrabalho" => $name,
        "tmp" => $tmp
    ];
    
   

    if($_POST['idUsuario'] > 0){
        $trabalhos = $trabalhos->atualizarDados($dados);        
    } else{
        header('Location: cadastro.php');
    }
?>