<?php require 'includes/functions.php';$err='';
if($_SERVER['REQUEST_METHOD']==='POST'){check_csrf();
 $u=q('SELECT * FROM users WHERE email=?',[trim($_POST['email'])])->fetch();
 if($u&&password_verify($_POST['password'],$u['password'])){session_regenerate_id(true);$_SESSION['u']=['id'=>$u['id'],'name'=>$u['name'],'role'=>$u['role'],'branch_id'=>$u['branch_id']];
  $home=['admin'=>'admin/dashboard.php','staff'=>'staff/orders.php','delivery'=>'delivery/tasks.php','customer'=>'customer/dashboard.php'];
  header('Location: '.BASE_URL.'/'.$home[$u['role']]);exit;}
 $err='Wrong email or password.';}
?><!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<form class="card authbox" method="post"><h2>Welcome back</h2><?=csrf()?><?php if($err)echo '<p style="color:#EF4444">'.e($err).'</p>';?>
<label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label>
<button class="btn">Login</button> <a href="register.php">Create account</a></form><script src="assets/js/app.js"></script></body></html>
