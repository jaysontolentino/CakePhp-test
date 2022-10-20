<?php

$order = $data['Order'];
$detail = $data['OrderDetail'];

?>


<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<h1><?= $order['name'] ?> Details</h1>
		</div>
	</div>
	<div class="portlet-body">

		<table class="table table-striped table-bordered table-hover">
			<thead>
				<th>ID</th>
				<th>Description</th>
				<th>Quantity</th>
			</thead>

			<tbody>
			<?php 
			foreach($detail as $result):
				$item = $result['Item'];
			?>
				<tr>
					<td><?= $result['id']; ?></td>
					<td><?= $item['name']; ?></td>
					<td><?= $result['quantity']; ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<!-- <pre>
		<?php //die(var_dump($detail));?>
		</pre> -->
	</div>
	
</div>