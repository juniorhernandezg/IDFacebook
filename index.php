 <!DOCTYPE html>
 
<html lang="es">
 
<head>
<title>Buscar usuario por ID Facebook</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
 
<body>

 <h1>Ingrese el ID del usuario en Facebook</h1>
 <h4><i>Ejemplo: Coloque 4 para ver la información de Mark Zuckerberg</h4></i>
 <form class="form-wrapper" action="index.php" method="post">
    <input type="text" id="variable1" name="variable1" placeholder="Buscar por ID Facebook" required>
    <input type="submit" value="go" id="submit">
</form>

<?php

if(isset($_POST['variable1'])) {
    $variable = $_POST['variable1'];
} else {
    $variable = 0; // O cadena vacia o el valor que requieras por defecto
}

require_once('src/facebook.php');

require_once __DIR__ . '/src/autoload.php'; 

$fb = new Facebook\Facebook([
  'app_id' => '1687334331316678',
  'app_secret' => '8bc20ad0af04a9a334da1a1db0272306',
  'default_graph_version' => 'v2.11',
  ]);

try {

  
 
  $response = $fb->get('/'.$variable.'?fields=name,id,first_name,last_name,age_range,cover,link,picture', 'EAAXZBnyNvecYBAJLb3HA1mDGqv52T5ojucFEVCJ1N7x9nh5WwoPELKs47LwqF6KPDm05ZCZAfhgXKm48rMg9lxHZAtcuQZCvyzivnikOfU5hHnh8GEdZAc3E2RvNrvl7QnfQrS0kSBIDfFHtFbvYsTTmZC8jsL63FEZD');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Debe ingresar el ID del usuario de Facebook';
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Error de SDK Facebook: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo '<b>ID:</b> ' . $user['id'] .'<br>';
echo '<b>Nombre:</b> ' . $user['first_name'] .'<br>';
echo '<b>Apellido:</b> ' . $user['last_name'] .'<br>';

?>
</body>
</html>