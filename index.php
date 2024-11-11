<?php
require_once './inc/view/app.view.php';
require_once './inc/config/session.config.php';
?>

<?php if (!isset($_SESSION['userId'])) header("Location: /login"); ?>

<?php appHead(); ?>

<body>
    <div id="divForm" class="divForm">
        <h1 id="h1">You are in</h1>
    </div>
</body>

</html>