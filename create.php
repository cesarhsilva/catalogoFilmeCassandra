<?php
require_once "config.php";

$nome = $ano_lancamento = "";
$nome_err = $ano_lancamento_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_nome = trim($_POST["nome"]);
    if(empty($input_nome)){
        $nome_err = "O nome é obrigatório.";
    } else{
        $nome = $input_nome;
    }
    
    $input_ano_lancamento = trim($_POST["ano_lancamento"]);
    if(empty($input_ano_lancamento)){
        $ano_lancamento_err = "O ano de lançamento é obrigatório.";     
    } else{
        $ano_lancamento = $input_ano_lancamento;
    }
    
    if(empty($nome_err) && empty($address_err)){
        $sql = "INSERT INTO filme (nome, ano_lancamento) VALUES (?, ?)";
        
		$statement = $session->execute(new Cassandra\SimpleStatement(
			"INSERT INTO filme (nome, ano_lancamento) 
			  VALUES ('". $nome ."', ". $ano_lancamento .")"
		));
		
		header("location: index.php");
		exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Novo Filme</title>
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
                        <h2>Novo Filme</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" placeholder="Nome do filme" value="<?php echo $nome; ?>">
                            <span class="help-block"><?php echo $nome_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Ano de lançamento</label>
							<input type="text" name="ano_lancamento" class="form-control" placeholder="2018"  onkeyup="this.value=this.value.replace(/[^\d]/,'')" maxlength="4" value="<?php echo $ano_lancamento; ?>">
                            <span class="help-block"><?php echo $ano_lancamento_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>