<?php if($this->session->userdata('userPositionSessId') == 0): // admin only ?>
<div class="panel panel-primary" id="editQuestion">
	<div class="panel-heading text-uppercase"><strong>Questionnaires Management</strong><span class="pull-right"><a href="#" class="white" data-toggle="modal" data-target="#newChoicesModal"><i class="fa fa-plus"></i> NEW CHOICES</a></span></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<?php if($this->session->flashdata('choiceAdded') ): ?>
					<?php echo $this->session->flashdata('choiceAdded'); ?>
				<?php endif;?>
				<?php if($this->session->flashdata('questionUpdated') ): ?>
					<?php echo $this->session->flashdata('questionUpdated'); ?>
				<?php endif;?>
			</div>
			<div class="col-md-12">
				<?php if($questions): ?>
					<form method="POST" action="/questions/edit_question/">
						<?php $columns = array(); ?>
						<?php foreach($questions as $rows): ?>
							
							<?php if (!isset($columns[$rows->questions]) ): ?>
								<div class="row">
									<?php if($rows->choiceType == 3): ?>
										<div class="col-md-12">
											<div class="alert alert-info">
												<p>This will be answer by paragraph.</p>
											</div>
										</div>
									<?php endif; ?>
								</div>
								<div class="row">
									<div class="col-md-1 col-xs-2">
										<label>Q</label>
									</div>
									<div class="col-md-11 col-xs-10">
										<div class="form-group">
											<textarea name="question" class="form-control"><?php echo htmlspecialchars($rows->questions); ?></textarea>
										</div>
									</div>
								</div>
								<?php $columns[$rows->questions] = true; ?>
							<?php endif; ?>

							<?php if($rows->choices && $rows->choicesText): ?>
								<div class="row">
									<div class="col-md-1 col-xs-2">
										<label><?php echo $rows->choices; ?> <input type="radio" name="choice" value="<?php echo htmlspecialchars($rows->choices); ?>" <?php if($rows->choices == $rows->answer): ?>	CHECKED <?php endif; ?>></label>
									</div>
									<div class="col-md-11 col-xs-9">
										<div class="form-group"><input type="text" class="form-control" name="choiceText[]" value="<?php echo htmlspecialchars($rows->choicesText); ?>"></div>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
						<input type="hidden" name="hiddenID" id="hiddenID" value="<?php echo $this->uri->segment(3); ?>">
        				<input type="hidden" name="hiddenQuestionID" id="hiddenQuestionID" value="<?php echo $this->uri->segment(4); ?>">
        				<input type="hidden" name="hiddenAnswer" id="hiddenAnswer" value="<?php echo $rows->answer; ?>">
        				<div class="row">
							<div class="col-md-1 col-xs-2">
								<label>Status</label>
							</div>
							<div class="col-md-11 col-xs-9">
								<div class="form-group">
									<select name="questionStatus" id="questionStatus" class="form-control">
										<?php if($rows->questionStatus == 1): ?>
											<option value="1">Available</option>
											<option value="0">Unavailable</option>
										<?php else: ?>
											<option value="0">Unavailable</option>
											<option value="1">Available</option>
										<?php endif; ?>
									</select>
								</div>
							</div>
						</div>
						<a href="/questions/manage/<?php echo $this->uri->segment(3); ?>" class="btn pull-right">Back</a>
						<button class="btn btn-primary pull-right" onclick="return confirm('Do you like to continue?')">Update</button>
					</form>
				<?php else: ?>
					<div class="alert alert-warning"><p>No question yet! <a href="/questions/add">Add Question</p></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<!-- Modal -->
<div id="newChoicesModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">NEW CHOICES</h5>
      </div>
      <div class="modal-body">
        <form action="/questions/add_choice" method="POST">
        	<div class="form-group">
        		<select name="choiceType" id="choiceType" class="form-control">
        			<option value="1">Single Answer</option>
        			<option value="2">Multiple Answer</option>
        			<option value="3">Paragraph</option>
        		</select>
        	</div>
        	<div class="form-group">
        		<input type="text" name="choiceTerm" id="choiceTerm" class="form-control choice" placeholder="Enter question here..." autocomplete="off">
        	</div>
			<div class="form-group resultMsg"></div>
        	<div class="form-group text-right">
        		<input type="hidden" name="hiddenID" id="hiddenID" value="<?php echo $this->uri->segment(3); ?>">
        		<input type="hidden" name="hiddenQuestionID" id="hiddenQuestionID" value="<?php echo $this->uri->segment(4); ?>">
        		<input type="hidden" name="hiddenChoice" id="hiddenChoice" value="<?php if($rows->choices) echo $rows->choices; else echo "-A"; ?>">
        		<button type="reset" class="btn">Clear</button>
        		<button type="button" class="btn btn-primary">Submit</button>
        	</div>
        </form>
      </div>
    </div>

  </div>
</div>