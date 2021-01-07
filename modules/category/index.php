<?php
require_once __DIR__ . "/../../autoload/autoload.php";
require_once __DIR__ . "/../../layouts/header.php";
require_once __DIR__ . "/../../layouts/navbar.php";
$currentUser = $database->getCurrentUser();
if ($currentUser) {
    $currentUser = new Account($currentUser);
} else {
    $currentUser = null;
}
?>

<?php
require_once __DIR__ . "/../../layouts/footer.php";
?>