<!DOCTYPE HTML>
<html xmlns = "http://www.w3.org/1999/xhtml" xml:lang="pl" lang = "pl">
<head>
    <meta charset="utf-8" />
    <title> Logowanie</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:80%; margin: 2em auto;">

<form action="<?php print(_APP_ROOT); ?>/app/security/login.php" method="post" class="pure-form pure-form-stacked">
    <legend>Logowanie</legend>
    <fieldset>
        <label for="id_login"> login: </label>
        <input id="id_login" type="text" name="login" value="<?php out($form['login']); ?>"/>
        <label for="id_pass"> hasło: </label>
        <input id="id_pass" type="text" name="pass" />
    </fieldset>
    <input type="submit" value="zaloguj" class="pure-button pure-button-primary" />
</form>

<?php
    if(isset($messages)){
        if(count($messages) > 0) {
            foreach ($messages as $key => $msg){
                echo('<ol style="padding: 10px 10px 10px 30px; border-radius: 5px; background-color: yellow; width:300px;">');
                echo('<li>'. $msg .'</li>');
                echo('</ol>');
            }
        }
    }

 ?>

</div>
</body>
</html>

