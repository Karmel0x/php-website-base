
<div class="row">
	<table class="col-12">
		<tr>
			<th style="width: 30%;">Name</th>
			<th style="width: 30%;">E-mail</th>
			<th style="width: 20%;">Rights</th>
			<th style="width: 20%;">Actions</th>
		</tr>

		<?php
		$dbh = getUserAll();
		while($result = $dbh->fetch()){
			$result['name'] = getUserDetailsById($result['user_id']);
		?>
		<tr>
			<td><?=$result['name']; ?></td>
			<td><?=$result['a_email']; ?></td>
			<td><?=$result['rights']; ?></td>
			<td><button class="btn btn-warning btn-sm" onclick='return false;'>Edit **</button></td>
		</tr>
		<?php
		}
		?>
	</table>
</div>
