<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="/public/images/school-manager.png" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/public/css/main.css">

    <script src="/public/js/jquery-3.6.0.min.js" defer></script>
    <script src="/public/js/jquery.mask.min.js" defer></script>
    <script src="/public/js/main.js" defer></script>

    <?php foreach ($data['scripts'] as $script) { ?>
        <script src="/public/js/<?= $script ?>.js" defer></script>
    <?php } ?>

    <title><?= $data['title'] ?></title>
</head>

<body>

    <?php if (!isset($data['navbar_off'])) { ?>
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <i class="fas fa-house"></i>
                    <?= SCHOOL_NAME ?>
                </a>
            </div>
        </nav>
    <?php } ?>