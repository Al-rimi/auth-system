<?php
require_once './inc/view/app.view.php';

if (!isset($_SESSION['userId'])) {
    // Redirect to login page if not authenticated
    $redirectUrl = dirname($_SERVER['PHP_SELF']) . '/login';
    header("Location: $redirectUrl");
    exit();
}

require_once './inc/view/app.view.php';
?>

<?php appHead(); ?>

<body>
    <div id="divForm" class="divForm">
        <h1 id="h1">You are in</h1>
    </div>
</body>

</html>