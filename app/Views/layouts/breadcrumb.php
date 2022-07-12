<?php
    $router = \Config\Services::router();

    $route = $router->controllerName();
    $method = $router->methodName();
    $uriString = uri_string(false);
?>

<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url($uriString) ?>"><?= $uriString; ?></a></li>
    <li class="breadcrumb-item active"><?= $method; ?></li>
</ol>