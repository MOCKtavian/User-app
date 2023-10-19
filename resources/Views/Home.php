<?php

namespace Views;
require __DIR__ . '/../../vendor/autoload.php';
class Home extends View
{

    public function index()
    {
        return <<<FORM
<form action = "/" method = "post" enctype="multipart/form-data">
    <input type="file" name = "image"><br>
    <label>File name</label>
    <input type="text" name = "fileName"><br>
    <button type = "submit">Upload</button>
</form>     
FORM;
    }
}
?>
<html>
    <body>
        <h1>Hello, {{$name}}</h1>
    </body>
</html>
