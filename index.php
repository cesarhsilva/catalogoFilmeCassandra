<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Catálogo de filmes</h2>
                        <a href="create.php" class="btn btn-success pull-right">Adicionar</a>
                    </div>
                    <?php
                    require_once "config.php";
                    
					$result = $session->execute(new Cassandra\SimpleStatement("SELECT * FROM filme"));
					
                    //$sql = "SELECT * FROM filme ORDER BY nome";
					//$result = mysqli_query($link, $sql);
					
                    if($result){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Nome</th>";
                                    echo "<th>Ano de lançamento</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            foreach ($result as $row) {
                                echo "<tr>";
                                    echo "<td>" . $row['nome'] . "</td>";
                                    echo "<td>" . $row['ano_lancamento'] . "</td>";
                                    echo "<td>";
                                        echo "<a href='delete.php?nome=". $row['nome'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                        echo "</table>";
                    } else{
                        echo "ERROR: Não foi possível executar o sql $sql. " . mysqli_error($link);
                    }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>