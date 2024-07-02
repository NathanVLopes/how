<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdStrange</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Hight1.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Para evitar barras de rolagem horizontais */
        }

        .container-full-height {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .container-full-height > .row {
            flex: 1;
        }

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .btn-like, .btn-comment {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            margin-right: 10px;
        }

        .btn-like i, .btn-comment i {
            margin-right: 5px;
        }

        .likes-count {
            margin-left: auto;
        }

        .modal-dialog {
            max-width: 100%;
            margin: auto;
        }

        .modal-content {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .modal-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container-full-height">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="inicio bg-primary text-white p-3 rounded mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <a class="voltar btn btn-outline-light" href="home.php"><i class="bi bi-arrow-left"></i> Voltar</a>
                    <h1 class="text-center mb-0">Perfil</h1>
                    <div>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#"><i class="bi bi-gear"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center mb-4">
                <h2>Melhores jogadas!!</h2>
            </div>

            <div class="row flex-grow-1">
                <?php
                require 'conn.php';
                $query = mysqli_query($conn, "SELECT * FROM `video` ORDER BY `video_id` ASC") or die(mysqli_error());
                while($fetch = mysqli_fetch_array($query)){
                ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm rounded d-flex flex-column">
                        <div class="position-relative">
                            <video class="card-img-top" controls>
                                <source src="<?php echo $fetch['location']; ?>">
                            </video>
                            <div class="overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                                <a href="<?php echo $fetch['location']; ?>" class="text-light" download>
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p class="card-text flex-grow-1">Descrição do vídeo ou informações adicionais.</p>
                            <div class="d-flex align-items-center mt-2">
                                <button class="btn btn-primary btn-like" data-video-id="<?php echo $fetch['video_id']; ?>">
                                    <i class="bi bi-hand-thumbs-up"></i> <span class="ml-2">Curtir</span>
                                </button>
                                <button class="btn btn-primary btn-comment ml-2" data-video-id="<?php echo $fetch['video_id']; ?>">
                                    <i class="bi bi-chat-dots"></i> <span class="ml-2">Comentar</span>
                                </button>
                                <span class="likes-count ml-auto">0 curtidas</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            
            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_modal">
                    <i class="bi bi-plus"></i> Adicionar Vídeo
                </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Upload de Vídeo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="save_video.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="video">Selecione o vídeo:</label>
                                    <input type="file" name="video" id="video" class="form-control-file">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" name="save" class="btn btn-primary"><i class="bi bi-save"></i> Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('.btn-like').click(function() {
        var videoId = $(this).data('video-id');
        var likesCount = parseInt($(this).siblings('.likes-count').text().split(' ')[0]);
        likesCount++;
        $(this).siblings('.likes-count').text(likesCount + ' curtidas');
        // Aqui você pode adicionar lógica para registrar a curtida no servidor, se necessário.
    });

    $('.btn-comment').click(function() {
        var videoId = $(this).data('video-id');
        // Aqui você pode adicionar lógica para abrir uma caixa de comentário ou direcionar para uma página de comentários.
        alert('Botão de comentário clicado para o vídeo com ID: ' + videoId);
    });
});
</script>

</body>
</html>
