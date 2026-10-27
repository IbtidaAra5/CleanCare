<?php require '../includes/functions.php';require_role('customer');$title='Hello, '.$_SESSION['u']['name'];$id=$_SESSION['u']['id'];
$rows=q('SELECT o.*,s.name sv FROM orders o JOIN services s ON s.id=o.service_id WHERE customer_id=? ORDER BY o.id DESC',[$id])->fetchAll();
$n=q('SELECT message FROM notifications WHERE user_id=? ORDER BY id DESC LIMIT 3',[$id])->fetchAll();
include '../includes/header.php'; ?>
<div class="grid"><div class="card kpi"><span>My orders</span><b data-count="<?=count($rows)?>">0</b></div><div class="card kpi"><span>Total spent</span><b>৳<?=(int)array_sum(array_column($rows,'total'))?></b></div></div>
<div class="card"><h2>Notifications</h2><?php foreach($n as $m)echo '<p>🔔 '.e($m['message']).'</p>';?></div>
<div class="card"><a class="btn cta" href="new_order.php">+ New Order</a><table><tr><th>Order</th><th>Service</th><th>Qty</th><th>Total</th><th>Status</th></tr>
<?php foreach($rows as $r)echo '<tr><td>#CC-'.$r['id'].'</td><td>'.e($r['sv']).'</td><td>'.$r['qty'].'</td><td>৳'.e($r['total']).'</td><td>'.badge($r['status']).'</td></tr>';?></table></div>
<?php include '../includes/footer.php';
