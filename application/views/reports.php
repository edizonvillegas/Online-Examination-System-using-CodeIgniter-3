<div class="panel panel-primary">
	<div class="panel-heading text-uppercase"><strong>Reports (<?php echo $total_rows; ?>)</strong></div>
	<div class="panel-body">
		<?php if($reports): ?>
		<div class="table-responsive">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>Topic</th>
						<th class="text-center">User</th>
						<th class="text-center">Date Taken</th>
						<th class="text-center">Score</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($reports as $report): ?>
						<?php if($this->uri->segment(3) ): ?><tr onclick="window.location = '/questions/view/<?php echo $this->uri->segment(3); ?>/<?php echo $report->id; ?>'">
						<?php else: ?><tr onclick="window.location = '/questions/view/<?php echo $report->tid; ?>/<?php echo $report->id; ?>'">
						<?php endif; ?>
							<td><?php echo $report->title ?></td>
							<td><?php echo $report->name ?></td>
							<td class="text-center"><?php echo $report->dateTaken ?></td>
							<td class="text-center"><?php echo $report->score ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php else: ?>
			<div class="alert alert-warning">No history yet.</div>
		<?php endif; ?>
	</div>
	<?php echo $links; ?>
</div>