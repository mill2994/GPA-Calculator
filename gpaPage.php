<?php
require 'gpaPageView.php';
$view = new gpaPageView($_GET);
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>GPA calculator main page</title>
    <!--
    <link href="battleship.css" type="text/css" rel="stylesheet" />
    -->

</head>
<body>
<?php
echo $view->presentForm();
?>
</body>
</html>