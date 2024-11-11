<?php
require_once __DIR__ . '/../inc/view/app.view.php';
require_once __DIR__ . '/../inc/view/login.view.php';
require_once __DIR__ . '/../inc/config/login_session.config.php';
?>

<?php appHead(); ?>

<body>
    <?php appHeader(); ?>

    <div id="divForm" class="divForm">
        <h1 id="h1"></h1>
        <form action="/../inc/login.php" method="post">
            <?php loginInputs(); ?>
            <button id="b1" class="mainbNo"></button>
        </form>
        <div class="divb1b2">
            <button id="b2" class="b1"></button>
            <button id="b3" class="b2" onclick="window.location.href='/../signup';"></button>
        </div>
    </div>

    <?php checkErrors(); ?>
</body>

</html>
