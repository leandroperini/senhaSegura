<!DOCTYPE html>
<html lang="en">
<?php require_once(dirname(__FILE__) . '/' . '../elements/header.php'); ?>
<body class="bg-light">
<header>
<!--    --><?php //require_once(dirname(__FILE__) . '/' . '../elements/navbar.php'); ?>
</header>
<main role="main" class="container shadow py-4 bg-white rounded <?php echo @$pageColWidth ?: ''; ?>">
    <?php if (isset($message)): ?>
        <div class="row justify-content-md-center">
            <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible col-10 show fade" role="alert">
                <span><?php echo $message['text']; ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    <?php endif; ?>
    <?php require_once(dirname(__FILE__) . '/../' . $page . '.php'); ?>
</main>
<?php require_once(dirname(__FILE__) . '/' . '../elements/footer.php'); ?>
</body>
</html>
