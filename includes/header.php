<?php // expects $title; uses session role for sidebar
$u=$_SESSION['u'];$r=$u['role'];$b=BASE_URL;
$nav=['admin'=>['admin/dashboard.php'=>'Dashboard'],'staff'=>['staff/orders.php'=>'Queue'],'delivery'=>['delivery/tasks.php'=>'Tasks'],
'customer'=>['customer/dashboard.php'=>'Dashboard','customer/new_order.php'=>'New Order','customer/track_order.php'=>'Track Order']][$r]; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=e($title??'CleanCare')?> · CleanCare</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=$b?>/assets/css/style.css"></head><body class="app">
<aside class="side" id="side"><div class="logo">🫧 CleanCare</div>
<?php foreach($nav as $href=>$l)echo '<a href="'.$b.'/'.$href.'">'.e($l).'</a>';?><a href="<?=$b?>/logout.php">Logout</a></aside>
<main><header class="top"><button class="btn ghost" id="burger" aria-label="Menu">☰</button><h1><?=e($title??'')?></h1>
<span><button class="btn ghost" id="theme">🌙</button> <span class="avatar"><?=e(strtoupper($u['name'][0]))?></span></span></header>
