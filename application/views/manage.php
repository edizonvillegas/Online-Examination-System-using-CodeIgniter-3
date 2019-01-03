<?php if($this->session->userdata('userPositionSessId') == 0): // admin only ?>
<div class="panel panel-primary<?php if($topic->status == 0) echo " disable";  ?>" id="topicInfo">
	<div class="panel-heading"><strong><?php echo $topic->title . ' ( Duration : ' . $topic->duration.' )'; ?></strong>
	<div class="dropdown pull-right">
	  <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">ACTION <span class="caret"></span></a>
	  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
	  	<?php if($questions[0]->status): ?>
		    <li><a href="#" class="white" data-toggle="modal" data-target="#titleModal"><i class="fa fa-edit"></i> UPDATE TITLE</a></li>
		    <li><a href="#" class="white" data-toggle="modal" data-target="#durationModal"><i class="fa fa-edit"></i> UPDATE DURATION</a></li>
		    <li><a href="#" class="white" data-toggle="modal" data-target="#newQuestionModal"><i class="fa fa-plus"></i> NEW QUESTION</a></li>
		    <?php if($topic->duration ): ?>
		    	<li><a href="#" class="white" data-toggle="modal" data-target="#newExaminersModal"><i class="fa fa-plus"></i> ADD EXAMINER</a></li>
			<?php endif; ?>
		    <li><a href="/reports/history/<?php echo $this->uri->segment('3') ?>" class="white"><i class="fa fa-search"></i> EXAM HISTORY</a></li>
	    	<li class="divider"></li>
	    <?php endif; ?>
	    <li><a tabindex="-1" href="/questions/status/<?php echo $this->uri->segment(3); ?>/<?php echo $topic->status ?>" onclick="return confirm('Do yo like to continue?')"><i class="fa fa-power-off"></i><?php if($topic->status == 1): ?> DISABLE <?php else: ?> ENABLE <?php endif; ?></a></li>
	  </ul>
	</div>
</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<?php if(!$topic->duration ): ?>
					<div class="alert alert-warning">Duration not yet specify. <a href="#" data-toggle="modal" data-target="#durationModal">Add Duration</a> to be able to add examiners.</div>
				<?php endif;?>
			</div>
			<div class="col-md-12">
				<?php if($this->session->flashdata('questionStatusUpdated') ): ?>
					<?php echo $this->session->flashdata('questionStatusUpdated'); ?>
				<?php endif;?>
			</div><div class="col-md-12">
				<?php if($this->session->flashdata('topicTitleUpdated') ): ?>
					<?php echo $this->session->flashdata('topicTitleUpdated'); ?>
				<?php endif;?>
			</div>
			<div class="col-md-12">
				<?php if($this->session->flashdata('questionAdded') ): ?>
					<?php echo $this->session->flashdata('questionAdded'); ?>
				<?php endif;?>
			</div>
			<div class="col-md-12">
				<?php if($this->session->flashdata('updateExaminersByTopic') ): ?>
					<?php echo $this->session->flashdata('updateExaminersByTopic'); ?>
				<?php endif;?>
			</div>
			<div class="col-md-12">
				<?php if($this->session->flashdata('durationAdded') ): ?>
					<?php echo $this->session->flashdata('durationAdded'); ?>
				<?php endif;?>
			</div>
			<div class="col-md-12">
				<?php if($questions[0]->status): ?>
					<?php $columns = array(); $count = 1; ?>
					<?php foreach($questions as $rows): ?>
						<?php if ($rows->questions): ?>
							<?php if (!isset($columns[$rows->questions]) ): ?>
								<p class="hr <?php if($rows->qstat == 0): ?> disabled <?php endif; ?>"><a href="/questions/edit/<?php echo $rows->id ?>/<?php echo $rows->no ?>"><i class="fa fa-pencil"></i> </a><strong><?php echo $count++. '.) ' . $rows->questions; ?></strong> <?php if($rows->answer): ?><strong class="pull-right"><?php echo $rows->answer; ?></strong><?php endif; ?></p>
								<?php $columns[$rows->questions] = true; ?>
							<?php endif; ?>
						<?php else: ?>
							<div class="alert alert-warning"><p>No question yet! <a href="#" data-toggle="modal" data-target="#newQuestionModal">Add Question</a></p></div>
						<?php endif; ?>
						
						<?php if($rows->choices && $rows->choicesText): ?>
							<p class="<?php if($rows->qstat == 0): ?> disabled <?php endif; ?>"><?php echo $rows->choices . '. ' . htmlspecialchars($rows->choicesText); ?></p>
						<?php else: ?>
							<?php if($rows->type == 3): ?>
								<p class="text-info pull-right"><small><strong>This will be answer by paragraph.</strong></small></p>
							<?php endif; ?>
						<?php endif; ?>
						
					<?php endforeach; ?>
				<?php else: ?>
					<div class="alert alert-warning"><p>Please enable first to manage</p></div>
					<?php if(!$topic->duration ): ?>
						<div class="alert alert-warning">Duration not yet specify. <a href="#" data-toggle="modal" data-target="#durationModal">Add Duration</a> to be able to add examiners.</div>
					<?php endif;?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->

<div id="durationModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">ADD DURATION</h5>
      </div>
      <div class="modal-body">
        <form action="/questions/add_duration" method="POST" Class="form-inline">
        	<div class="row">
	        	<div class="form-group col-md-4">
	        		<label>
	        			HOURS : 
		        		<select name="hours" class="form-control">
		        			<?php for($x = 0; $x <= 59; $x++): ?>
		        				<option value="<?php echo str_pad($x, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($x, 2, '0', STR_PAD_LEFT); ?></option>
		        			<?php endfor; ?>
		        		</select>
	        		</label>
	        	</div>
	        	<div class="form-group col-md-4 text-left">
	        		<label>
	        			MINUTES : 
		        		<select name="minutes" class="form-control">
		        			<?php for($x = 0; $x <= 59; $x++): ?>
		        				<option value="<?php echo str_pad($x, 2, '0', STR_PAD_LEFT); ?>"><?php echo str_pad($x, 2, '0', STR_PAD_LEFT); ?></option>
		        			<?php endfor; ?>
		        		</select>
	        		</label>
	        	</div>
	        	<div class="col-md-4 text-right">
		        	<div class="form-group">
		        		<input type="hidden" name="hiddenID" id="hiddenID" value="<?php echo $this->uri->segment(3); ?>">
		        		<button class="btn btn-primary">Submit</button>
		        	</div>
	        	</div>
        	</div>
        	
        </form>
      </div>
    </div>

  </div>
</div>


<div id="titleModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">UPDATE TITLE</h5>
      </div>
      <div class="modal-body">
        <form action="/questions/updateTitle" method="POST">
        	<div class="form-group">
        		<input type="text" name="term" id="term" class="form-control title" required placeholder="Enter title here..." autocomplete="off" value="<?php echo $topic->title; ?>">
        		<input type="hidden" name="oldTitle" id="oldTitle" value="<?php echo $topic->title; ?>">
        	</div>
			<div class="form-group resultMsg"></div>
        	<div class="form-group text-right">
        		<button type="reset" class="btn">Clear</button>
        		<input type="hidden" name="hiddenID" id="hiddenID" value="<?php echo $this->uri->segment(3); ?>">
        		<button type="button" class="btn btn-primary">Submit</button>
        	</div>
        </form>
      </div>
    </div>

  </div>
</div>


<div id="newQuestionModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">NEW QUESTION</h5>
      </div>
      <div class="modal-body">
        <form action="/questions/add_question" method="POST">
        	<div class="form-group">
        		<input type="text" name="term" id="term" class="form-control question" required placeholder="Enter question here..." autocomplete="off">
        	</div>
			<div class="form-group resultMsg"></div>
        	<div class="form-group text-right">
        		<button type="reset" class="btn">Clear</button>
        		<input type="hidden" name="hiddenID" id="hiddenID" value="<?php echo $this->uri->segment(3); ?>">
        		<button type="button" class="btn btn-primary">Submit</button>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="newExaminersModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">NEW EXAMINERS</h5>
      </div>
      <div class="modal-body">
        <form action="/questions/add_examiner" method="POST">
        	<div class="form-group">
        		<input type="text" name="examiners" id="examiner" class="form-control examiner" placeholder="Enter examiner name here..." autocomplete="off">
        	</div>
			<div class="examiners">
				<ul id="examiners">
					<?php foreach($examiners as $rows): ?>
						<li>
							<?php if($rows->dateTaken): ?>
								<label><input type="checkbox" name="oldExaminers[]" class="oldExaminers hidden-lg" checked="checked" checked value="<?php echo $rows->id; ?>">
							<?php else: ?>
								<label><input type="checkbox" name="oldExaminers[]" class="oldExaminers" checked="checked" checked value="<?php echo $rows->id; ?>">
							<?php endif; ?>
							<?php echo $rows->name; ?>
							<input type="hidden" name="hiddenOldExaminers[]" class="hiddenOldExaminers" checked="checked" checked value="<?php echo $rows->id; ?>"></label>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
        	<div class="form-group text-right">
        		<button type="reset" class="btn">Clear</button>
        		<input type="hidden" name="hiddenID" id="hiddenID" value="<?php echo $this->uri->segment(3); ?>">
						<?php if(isset($rows->dateTaken) ): ?>
						<button class="btn btn-warning" name="removeAll">Unselect All</button>
						<?php endif; ?>
						<button class="btn btn-info" name="addAll">Select All</button>
        		<button class="btn btn-primary">Submit</button>
        	</div>
        </form>
      </div>
    </div>

  </div>
</div>
<?php else: ?>
	<div class="alert alert-danger">You dont have access to this page.</div>
<?php endif; ?>