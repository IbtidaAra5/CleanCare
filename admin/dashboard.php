<?php require '../includes/functions.php';require_role('admin');$title='Admin Dashboard';
$k=q('SELECT COUNT(*) n,COALESCE(SUM(total),0) rev FROM orders')->fetch();
$st=q('SELECT status,COUNT(*) n FROM orders GROUP BY status')->fetchAll();
$rows=q('SELECT o.*,c.name cn,b.name bn FROM orders o JOIN users c ON c.id=o.customer_id JOIN branches b ON b.id=o.branch_id ORDER BY o.id DESC')->fetchAll();
include '../includes/header.php'; ?>
<div class="grid"><div class="card kpi"><span>Total orders</span><b data-count="<?=$k['n']?>">0</b></div><div class="card kpi"><span>Revenue</span><b>৳<span data-count="<?=(int)$k['rev']?>">0</span></b></div>
<div class="card kpi"><span>Staff</span><b data-count="<?=q("SELECT COUNT(*) FROM users WHERE role='staff'")->fetchColumn()?>">0</b></div></div>
<div class="card"><canvas id="c" height="90"></canvas></div>
<div class="card"><input class="search" placeholder="Search orders…" data-table="#t"><table id="t"><tr><th>Order</th><th>Customer</th><th>Branch</th><th>Total</th><th>Status</th></tr>
<?php foreach($rows as $r)echo '<tr><td>#CC-'.$r['id'].'</td><td>'.e($r['cn']).'</td><td>'.e($r['bn']).'</td><td>৳'.e($r['total']).'</td><td>'.badge($r['status']).'</td></tr>';?></table></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>new Chart(document.getElementById('c'),{type:'doughnut',data:{labels:<?=json_encode(array_column($st,'status'))?>,datasets:[{data:<?=json_encode(array_map('intval',array_column($st,'n')))?>,backgroundColor:['#94A3B8','#0EA5E9','#F59E0B','#22C55E','#8B5CF6','#10B981']}]}})</script>
<?php include '../includes/footer.php';
