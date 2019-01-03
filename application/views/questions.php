<?php //if($this->session->userdata('userPositionSessId') == 0): // admin only ?>
<div class="panel panel-primary">
	<?php if($this->session->userdata('userPositionSessId') == 0): ?>
		<div class="panel-heading text-uppercase"><strong>Topics Management</strong>
			<span class="pull-right"><a href="#" class="white" data-toggle="modal" data-target="#newTopicModal"><i class="fa fa-plus"></i> New Topic</a></span>
		</div>
	<?php else: ?>
		<div class="panel-heading text-uppercase"><strong>List of available exams</strong>
		</div>
	<?php endif; ?>
	<div class="panel-body">
		<?php if($this->session->flashdata('questionAdded') ): ?>
			<?php echo $this->session->flashdata('questionAdded'); ?>
		<?php endif;?>
		<?php if($this->session->flashdata('invalidId') ): ?>
			<?php echo $this->session->flashdata('invalidId'); ?>
		<?php endif;?>
		<?php if($this->session->flashdata('examFinished') ): ?>
			<?php echo $this->session->flashdata('examFinished'); ?>
		<?php endif;?>
		<?php if($this->session->flashdata('alreadyTAken') ): ?>
			<?php echo $this->session->flashdata('alreadyTAken'); ?>
		<?php endif;?>
		<?php if($allTopics): ?>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Topic</th>
							<?php if($this->session->userdata('userPositionSessId') == 0): ?>
								<th class="text-center">Passed</th>
								<th class="text-center">Failed</th>
							<?php else: ?>
								<th class="text-center">Date Taken</th>
								<th class="text-center">Score</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>

						<?php foreach($allTopics as $item): ?>
							<?php if($this->session->userdata('userPositionSessId') == 1): // if examiner level ?>
								<?php if(isset($item->escore) ): ?>
									<tr onclick="window.location = '/questions/view/<?php echo $item->id ?>'">
								<?php else: ?>
									<tr onclick="window.location = '/questions/instructions/<?php echo $item->id ?>'">
								<?php endif; ?>
									<td class="col-md-8"><?php echo $item->title ?></td>
									<?php if($this->session->userdata('userPositionSessId') == 0): ?>
										<td class="text-center">1</td>
										<td class="text-center">2</td>
									<?php else: ?>
										<td class="text-center"><?php 
										if(isset($item->dateTaken) ) {
											echo date("F d Y h:i:A", strtotime($item->dateTaken) );
										} else {
											echo "N/A";
										}

										?></td>
										<td class="text-center">
										<?php 
										if(isset($item->escore) ) {
											if($item->escore != "") {
											    if($item->estat == 1) {
											      echo '<button type="button" class="btn btn-success">Passed <span class="badge">'.$item->escore.'</span></button>';
											    } else {
											      echo '<button type="button" class="btn btn-danger">Failed <span class="badge">'.$item->escore.'</span></button>';
											    }
											} else {
												echo "N/A";
											}
										}
										?>
										</td>
									<?php endif; ?>
								</tr>
							<?php elseif($this->session->userdata('userPositionSessId') == 0): // if admin level ?>
								<tr onclick="window.location = '/questions/manage/<?php echo $item->id ?>'" <?php  if($item->status == 0) echo "class='bg-danger'"; ?> >
									<td class="col-md-8"><?php echo $item->title ?></td>
									
									<td class="text-center bg-passed">
										<?php 
										$count = 0;
										foreach($scores as $key => $score) {
											if($item->id == $score->topic) {
												if($score->status == 1) {
													$count++;
												}
											}
										}
										echo $count;
										 ?>
									</td>
									<td class="text-center bg-failed">
										<?php 
										$count = 0;
										foreach($scores as $key => $score) {
											if($item->id == $score->topic) {
												if($score->status == 0) {
													$count++;
												}
											}
										}
										echo $count;
										 ?>
									</td>
								</tr>
							<?php endif; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		<?php else: ?>
			<div class="alert alert-warning">
				You dont have a topic yet!
			</div>
		<?php endif; ?>
	</div>
		<?php echo $links; ?>
</div>
<?php //endif; ?>
<!-- Modal -->
<div id="newTopicModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">NEW TOPIC</h5>
      </div>
      <div class="modal-body">
        <form action="/questions/add" method="POST">
        	<div class="form-group">
        		<input type="text" name="term" id="term" class="form-control topic" required placeholder="Enter topic title here..." autocomplete="off">
        	</div>
			<div class="form-group resultMsg"></div>
        	<div class="form-group text-right">
        		<button type="reset" class="btn">Clear</button>
        		<button type="button" class="btn btn-primary">Submit</button>
        	</div>
        </form>
      </div>
    </div>

  </div>
</div>