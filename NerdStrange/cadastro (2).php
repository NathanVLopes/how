<?php

if(isset($_POST['submit']))

//print_r('nome: ' . $_POST{'nome'});
//print_r('<br>');
//print_r('email: ' . $_POST{'email'});
//print_r('<br>');
//print_r('senha: ' . $_POST{'senha'});

{
 include_once('config.php');

 $name=$_POST['nome'];
 $email=$_POST['email'];
 $senha=$_POST['senha'];


$result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, senha) VALUES ('$name', '$email', '$senha')");

header('Location: login.php');

}
?>
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="cadastro.css">
        <title>NerdStrange</title>
    </head>
    <body>
        <br>
       <a href="Index.php" class="Voltar">Voltar</a>
        <div class="box">
            <form action="cadastro.php" method=post>
                <fieldset>
                    <legend><b> Preencha os dados </b></legend>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" class="inputUser" required>
                        <label for="nome" class="inputlabel"> Nome Compeleto </label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="email" id="email" class="inputUser" required>
                        <label for="email" class="inputlabel"> Email </label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="senha" name="senha" id="senha" class="inputUser" required>
                        <label for="senha" class="inputlabel"> Senha </label>   
                    </div>
                    <br>
                   
                <br><br>
                <input  type="submit" name="submit" id="submit">
                
            </fieldset>
        </form>
    </div>
</body>
</html>

