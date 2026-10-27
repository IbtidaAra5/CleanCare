<?php require 'includes/functions.php';$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){check_csrf();$n=trim($_POST['name']);$m=trim($_POST['email']);
 if(!$n||!filter_var($m,FILTER_VALIDATE_EMAIL)||strlen($_POST['password'])<6)$err='Enter a name, valid email and 6+ char password.';
 elseif(q('SELECT id FROM users WHERE email=?',[$m])->fetch())$err='Email already registered.';
 else{q('INSERT INTO users(name,email,phone,password,role) VALUES(?,?,?,?,"customer")',[$n,$m,trim($_POST['phone']),password_hash($_POST['password'],PASSWORD_DEFAULT)]);header('Location: login.php');exit;}}
?><!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Register</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<form class="card authbox" method="post"><h2>Create account</h2><?=csrf()?><?php if($err)echo '<p style="color:#EF4444">'.e($err).'</p>';?>
<label>Name<input name="name" required></label><label>Email<input type="email" name="email" required></label><label>Phone<input name="phone"></label><label>Password<input type="password" name="password" minlength="6" required></label>
<button class="btn cta">Register</button> <a href="login.php">Login</a></form></body></html>
