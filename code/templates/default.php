<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $title; ?></title>
        <script src="assets/js/app.js"></script>
    </head>
    <body>
        <?php if (isset($jsonString)) : ?>
            <script>
                var data = <?php echo $jsonString; ?>
            </script>
        <?php endif; ?>
        <?php echo $body; ?>
    </body>
</html>