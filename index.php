<?php require 'includes/functions.php';$sv=q('SELECT * FROM services')->fetchAll();$b=BASE_URL; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>CleanCare – Laundry made effortless</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet"><link rel="stylesheet" href="<?=$b?>/assets/css/style.css"></head><body>
<div class="wrap" style="display:flex;justify-content:space-between;align-items:center"><h2 class="logo">🫧 CleanCare</h2><span><button class="btn ghost" id="theme">🌙</button> <a class="btn ghost" href="login.php">Login</a> <a class="btn cta" href="register.php">Book Pickup</a></span></div>
<section class="hero"><div class="bubble" style="width:60px;height:60px;right:10%;top:20%"></div><div class="bubble" style="width:100px;height:100px;right:25%;top:50%;animation-delay:-4s"></div>
<h1>Laundry day,<br><em>made effortless.</em></h1><p>Schedule a pickup, track every wash in real time and get fresh, folded clothes delivered.</p><a class="btn cta" href="register.php">Schedule a Pickup →</a></section>
<div class="wrap"><h2>Instant price estimator</h2><div class="grid" style="margin-top:16px">
<div class="card reveal"><label>Service<select id="sv"><?php foreach($sv as $s)echo '<option data-p="'.$s['price'].'">'.e($s['name']).' (৳'.(int)$s['price'].'/'.e($s['unit']).')</option>';?></select></label>
<label>Quantity: <b id="qv">5</b><input type="range" id="qty" min="1" max="30" value="5"></label></div>
<div class="card est reveal">Estimated total<br><b id="tot">৳300</b></div></div>
<h2>FAQ</h2><details class="card"><summary>How long does a wash take?</summary>Standard 48h, Express 24h.</details><details class="card"><summary>Is pickup free?</summary>Yes, pickup and delivery are free.</details></div>
<div id="toast"></div><script src="assets/js/app.js"></script><script>
const f=()=>{const p=+sv.selectedOptions[0].dataset.p;qv.textContent=qty.value;tot.textContent='৳'+p*qty.value};sv.onchange=qty.oninput=f;f();</script></body></html>
