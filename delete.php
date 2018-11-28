<?php
if(isset($_POST["nome"]) && !empty($_POST["nome"])){
    require_once "config.php";
    
    $sql = "DELETE FROM filme WHERE nome = ?";
            
    $param_nome = trim($_POST["nome"]);
        
	$delete = $session->execute(new Cassandra\SimpleStatement
       ("DELETE FROM filme WHERE nome = '". $param_nome ."'"));
		
    header("location: index.php");
    exit();
    
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
} else{
    if(empty(trim($_GET["nome"]))){
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Excluir Filme</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Excluir Filme</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="nome" value="<?php echo trim($_GET["nome"]); ?>"/>
                            <p>Tem certeza que deseja excluir o filme <?php echo trim($_GET["nome"]); ?> ?</p><br>
                            <p>
                                <input type="submit" value="Sim" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">Não</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>