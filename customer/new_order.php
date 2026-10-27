<?php require '../includes/functions.php';require_role('customer');$title='New Order';$sv=q('SELECT * FROM services')->fetchAll();$br=q('SELECT * FROM branches')->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){check_csrf();
 $s=q('SELECT * FROM services WHERE id=?',[(int)$_POST['service']])->fetch();$qty=max(1,min(100,(int)$_POST['qty']));$addr=trim($_POST['address']);
 if($s&&$addr){q('INSERT INTO orders(customer_id,branch_id,service_id,qty,total,address,slot,notes) VALUES(?,?,?,?,?,?,?,?)',
  [$_SESSION['u']['id'],(int)$_POST['branch'],$s['id'],$qty,$s['price']*$qty,$addr,$_POST['slot'],trim($_POST['notes'])]);
  $id=db()->lastInsertId();q('INSERT INTO order_status_history(order_id,status) VALUES(?,"Placed")',[$id]);set_status($id,'Pickup Scheduled');
  header('Location: track_order.php');exit;}}
include '../includes/header.php'; ?>
<form class="card" method="post" style="max-width:560px"><?=csrf()?>
<label>Service<select name="service"><?php foreach($sv as $s)echo '<option value="'.$s['id'].'">'.e($s['name']).' – ৳'.(int)$s['price'].'</option>';?></select></label>
<label>Quantity<input type="number" name="qty" min="1" max="100" value="1" required></label>
<label>Branch<select name="branch"><?php foreach($br as $b)echo '<option value="'.$b['id'].'">'.e($b['name']).'</option>';?></select></label>
<label>Pickup address<input name="address" required></label><label>Time slot<select name="slot"><option>Morning</option><option>Afternoon</option><option>Evening</option></select></label>
<label>Special instructions<textarea name="notes" maxlength="255"></textarea></label><button class="btn cta">Place order</button></form>
<?php include '../includes/footer.php';
