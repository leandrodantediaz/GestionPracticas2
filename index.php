<?php
include 'BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['ID'])){
        $query = "select * from users where ID=".$_GET['ID'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    else if(isset($_GET['username']))
    {
        $query = "select * from users where username='".$_GET['username']."'and password ='".$_GET['password']."'";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    else{
        $query = "select * from users";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $username=$_POST['username'];
    $nombre=$_POST['nombre'] ;
    $apellido=$_POST['apellido'];
    $mail=$_POST['email'];
    $passworduser=$_POST['passworduser'];
    $query="insert into users(username,password,nombre,apellido,email) values('$username','$passworduser','$nombre','$apellido','$mail')";
    $queryAutoincrement="select MAX(ID) as ID from users";
    $resultado=metodoPost($query,$queryAutoincrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}


if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['ID'];
    $username=$_POST['username'];
    $nombre=$_POST['nombre'] ;
    $apellido=$_POST['apellido'];
    $mail=$_POST['email'];
    $passworduser=$_POST['passworduser'];
    $query="update users SET username='$username', nombre='$nombre', apellido = '$apellido', email = '$mail', password ='$passworduser' where ID = '$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    $id=$_GET['ID'];
    $query="DELETE FROM users where ID = '$id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 BadRequest");
?>