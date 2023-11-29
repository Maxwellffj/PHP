<form action="processa_formulario.php" method="post">
    Nome: <input type="text" name="nome"><br>
    E-mail: <input type="email" name="email"><br>
    <input type="submit" valeu="Enviar">
</form>

<?php
$nome = $_POST['nome']; //Pega o que foi escrito no campo "nome"
$email = $_POST['email']; //Pega o que foi escrito no campo "email"

echo "Obrigado por enviar, $nome! Seu e-mail é $email.";
?>