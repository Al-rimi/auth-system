<?php
require_once '../inc/view/app.view.php';
require_once '../inc/view/signup.view.php';
require_once '../inc/config/signup_session.config.php';
?>

<?php appHead(); ?>

<body>
    <?php appHeader(); ?>

    <div id="divForm" class="divForm">
        <h1 id="h1"></h1>
        <form action="../inc/signup.php" method="post">
            <?php signupInputs(); ?>
            <button id="b1" class="mainbNo"></button>
        </form>
        <div class="divb1b2">
            <button id="b2" class="b1"></button>
            <button id="b3" class="b2" onclick="window.location.href='../login';"></button>
        </div>
    </div>

    <?php checkErrors(); ?>
</body>

</html>