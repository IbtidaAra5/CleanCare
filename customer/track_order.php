<?php require '../includes/functions.php';require_role('customer');$title='Track Order';
$rows=q('SELECT * FROM orders WHERE customer_id=? ORDER BY id DESC',[$_SESSION['u']['id']])->fetchAll();include '../includes/header.php';
foreach($rows as $r){$i=array_search($r['status'],FLOW);echo '<div class="card"><b>#CC-'.$r['id'].'</b> '.badge($r['status']).'<div class="steps">';
 foreach(FLOW as $k=>$s)echo '<div class="step '.($k<$i?'done':($k==$i?'now':'')).'"><i>'.($k<$i?'✓':$k+1).'</i>'.e($s).'</div>';echo '</div></div>';}
if(!$rows)echo '<div class="card">No orders yet.</div>';include '../includes/footer.php';
