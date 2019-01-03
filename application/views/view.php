<?php $count = ""; ?>
<?php foreach($questions as $key => $rows): ?>
	<?php if($rows->choices == $rows->recordAnswer): ?>
		<?php if($rows->recordAnswer == $rows->answer): ?>
			<?php $count[] = $key; ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; ?>

<?php  if ($this->session->userdata('userPositionSessId') == 0 ) : ?>
<div class="panel panel-primary">
	<div class="panel-heading text-uppercase"><strong>EXAM REPORT</strong></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<th class="col-md-2">Examiner</th>
							<td><?php echo $questions[0]->userName; ?></td>
						</tr>
						<tr>
							<th>Date taken</th>
							<td><?php echo $questions[0]->dateAdded; ?></td>
						</tr>
						<tr>
							<th>Topic title</th>
							<td><?php echo $questions[0]->title; ?></td>
						</tr>
						<tr>
							<th>Score</th>
							<td><?php echo count($count); ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<div class="panel panel-primary<?php if($topic->status == 0) echo " disable";  ?>" id="topicInfo">
	<div class="panel-heading text-uppercase"><strong><?php echo $topic->title . ' (' . $topic->duration.')'; ?></strong>
		<span class="pull-right score">Score : <b><?php echo count($count);  ?></b></span>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<?php if(count($count) ): ?>
					
					<?php $columns = array(); $count = 1; ?>
					<?php foreach($questions as $key => $rows): ?>


						<?php if (!isset($columns[$rows->questions]) ): ?>
							<p class="hr <?php if($rows->qstat == 0): ?> disabled <?php endif; ?>">
								<strong><?php echo $count++ . '.) ' . $rows->questions; ?></strong>
								<?php if($rows->answer != $rows->recordAnswer): ?>
									<?php if($rows->answer): ?><strong class="pull-right correction"><?php echo $rows->answer; ?></strong><?php endif; ?>
								<?php endif; ?>
							</p>
							<?php $columns[$rows->questions] = true; ?>
						<?php endif; ?>
						
						
						<?php if($rows->choices == $rows->recordAnswer): ?>
							<?php if($rows->recordAnswer == $rows->answer): ?>
								<p class="<?php if($rows->qstat == 0): ?> disabled <?php endif; ?> correct"><?php echo $rows->choices . '. ' . htmlspecialchars($rows->choicesText); ?></p>
							<?php else: ?>
								<p class="<?php if($rows->qstat == 0): ?> disabled <?php endif; ?> wrong"><?php echo $rows->choices . '. ' . htmlspecialchars($rows->choicesText); ?></p>
							<?php endif; ?>
						<?php else: ?>
							<p class="<?php if($rows->qstat == 0): ?> disabled <?php endif; ?> "><?php echo $rows->choices . '. ' . htmlspecialchars($rows->choicesText); ?></p>
						<?php endif; ?>
						
						
					<?php endforeach; ?>
				<?php else: ?>
					<div class="alert alert-warning"><p>You dont have access in this topic!</p></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
