<?php
require_once __DIR__ . '/inc/config/session.config.php';
require_once __DIR__ . '/inc/contr/route.contr.php';

if (!isset($_SESSION['userId'])) {
    redirect('/login');
    exit();
}

require_once __DIR__ . '/inc/view/app.view.php';
?>

<?php appHead(); ?>

<body>
    <div id="divForm" class="divForm">
        <h1 id="h1">You are in</h1>
    </div>
</body>

</html>