<?php
// Shared helpers: PDO, escaping, CSRF, role guard, order status engine
require_once __DIR__.'/../config.php';
session_start();
function db(){static $p;if(!$p)$p=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);return $p;}
function q($sql,$a=[]){$s=db()->prepare($sql);$s->execute($a);return $s;}
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function csrf(){if(empty($_SESSION['t']))$_SESSION['t']=bin2hex(random_bytes(16));return '<input type="hidden" name="t" value="'.$_SESSION['t'].'">';}
function check_csrf(){if(!hash_equals($_SESSION['t']??'',$_POST['t']??''))die('Invalid CSRF token');}
function require_role($r){if(($_SESSION['u']['role']??'')!==$r){header('Location: '.BASE_URL.'/login.php');exit;}}
const FLOW=['Placed','Pickup Scheduled','Picked Up','Received','Washing','Ironing','Ready','Out for Delivery','Delivered'];
const CAN=['staff'=>['Picked Up','Received','Washing','Ironing'],'delivery'=>['Pickup Scheduled','Ready','Out for Delivery']];
function set_status($oid,$st){q('UPDATE orders SET status=? WHERE id=?',[$st,$oid]);
 q('INSERT INTO order_status_history(order_id,status) VALUES(?,?)',[$oid,$st]);
 q('INSERT INTO notifications(user_id,message) SELECT customer_id,? FROM orders WHERE id=?',["Order #$oid is now $st",$oid]);}
function badge($s){return '<span class="chip s-'.strtolower(str_replace(' ','-',$s)).'">'.e($s).'</span>';}
// Shared board for staff + delivery: lists actionable orders and advances them one step
function task_page($role,$title){
 $u=$_SESSION['u'];
 if($_SERVER['REQUEST_METHOD']==='POST'){check_csrf();$id=(int)$_POST['id'];
  $o=q('SELECT status FROM orders WHERE id=?',[$id])->fetch();
  if($o&&in_array($o['status'],CAN[$role],true))set_status($id,FLOW[array_search($o['status'],FLOW)+1]);
  header('Location: '.$_SERVER['PHP_SELF']);exit;}
 $in=implode(',',array_fill(0,count(CAN[$role]),'?'));$p=CAN[$role];$w='';
 if($role==='staff'){$w=' AND o.branch_id=?';$p[]=$u['branch_id'];}
 $rows=q("SELECT o.*,s.name sv,c.name cn FROM orders o JOIN services s ON s.id=o.service_id JOIN users c ON c.id=o.customer_id WHERE o.status IN($in)$w ORDER BY o.id",$p)->fetchAll();
 include __DIR__.'/header.php'; ?>
 <div class="card"><input class="search" placeholder="Search orders…" data-table="#t"><table id="t"><tr><th>Order</th><th>Customer</th><th>Service</th><th>Address</th><th>Status</th><th></th></tr>
 <?php foreach($rows as $r):$n=FLOW[array_search($r['status'],FLOW)+1]; ?>
 <tr><td>#CC-<?=$r['id']?></td><td><?=e($r['cn'])?></td><td><?=e($r['sv'])?> × <?=$r['qty']?></td><td><?=e($r['address'])?></td><td><?=badge($r['status'])?></td>
 <td><form method="post"><?=csrf()?><input type="hidden" name="id" value="<?=$r['id']?>"><button class="btn">Move to <?=e($n)?> →</button></form></td></tr>
 <?php endforeach;if(!$rows)echo '<tr><td colspan=6>Nothing to do right now 🎉</td></tr>'; ?></table></div>
 <?php include __DIR__.'/footer.php';}
