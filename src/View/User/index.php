<?php
    
define ( 'BASE_URI' , str_replace ( '\ ' , '/' , substr ( __DIR__ , strlen ( $_SERVER['DOCUMENT_ROOT']) ) ) ) ;
echo constant('BASE_URI');
require_once ( implode ( DIRECTORY_SEPARATOR , [ 'Core' , 'autoload.php']) ) ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<pre>
<?php
    print_r($_POST);
    print_r($_GET);
    print_r($_SERVER);
    
?>
</pre>
</body>
</html>