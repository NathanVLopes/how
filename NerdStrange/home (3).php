<?php

    session_start();

    //print_r($_SESSION);

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home1.css">
    <link rel="stylesheet" href="Home.js">
    <title>NerdStrange</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="central">
        <h1> Perfil </h1>   
        <ul>
            <li class="item-menu">
                <a href="#">
                    <span class="icon"> <i class="bi bi-gear"></i> </span>  
                </a>
                <a href="Index.php" href="#">
                    <span class="icon" >  <i class="bi bi-power"></i> </span>  
                </a>
            </li>
        </ul>
    </div>

    <div class="barra">
        <button class="bot"><a class="homerl" href="Hight.php"> HighLights </a></button>
        <br>
        <button class="bot"><a class="homegr" href="conversa.php"> Grupos </a></button>
        <br>
        <button class="bot"><a class="hometor" href=""> Torneios </a></button>
        <br>
        <button class="bot"><a class="homeajud" href=""> Ajuda </a></button>
    </div>

    <div class="cont">
        <div class="slides">
            <input type="radio" name="slide" id="slide1" checked>
            <input type="radio" name="slide" id="slide2">
            <input type="radio" name="slide" id="slide3">


        <div class="slide s1">
                <img src="Img/God.JPG.jpg" alt="God">
        </div>
        <div class="slide s2">
                <img src="Img/Elden.JPG.jpg" alt="Elden">
        </div>
        <div class="slide s3">
                   <img src="Img/Rest.JPG.jpg" alt="Rest">
        </div>
       </div>
       <div class="navigation">
               <label class="bar" for="slide1"></label>
               <label class="bar" for="slide2"></label>
               <label class="bar" for="slide3"></label>
       </div>
   </div>
    
</body>
</html>