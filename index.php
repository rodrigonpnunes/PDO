<?php
require_once("config.php");
//$sql = new Sql();
//$usuario=$sql->select("SELECT * FROM tab_usuario");
//echo json_encode($usuario);

$root = new usuario();
$root->loadByLogin("juliana");
echo $root;


$lista=usuario::getList();
echo "\n" . json_encode($lista);

$search =usuario::search("i");
echo "\n" . json_encode($search);


$user = new usuario();
$user->login("juliana", "123");
echo $user;

//$aluno = new usuario();
//$aluno->setDeslogin("Adriano");
//$aluno->setDessenha("senha");
//$aluno->insert();

$aluno = new usuario("Renan", "Tropico");
$aluno->insert();
echo $aluno;

$user2 = new usuario();
$user2->update("Maria", "123");
?>