<?php if($this->session->userdata('userPositionSessId') == 1): // examiners only ?>
<div class="panel panel-primary<?php if($topic->status == 0) echo " disable";  ?>" id="topicInfo">
	<div class="panel-heading text-uppercase"><strong><?php echo $topic->title ?></strong>
	
</div>
	<div class="panel-body">
		<p class="h3">Instructions</p>
		<br>
		<p><strong>During the exam:</strong></p>
	
		<ul>
			<li>- Examiner cannot go back to previous question after submiting.</li>
			<li>- Examiner will be given 1 hour to finish the exam.</li>
		</ul>
		<br>
		<p><strong>After the exam:</strong></p>
	
		<ul>
			<li>- Close your browser and ask for assistance</li>
			<li>- The management will process the result of your exam.</li>
		</ul>
		<br>
		
		<p><strong>NOTE:</strong> Timer will starts when you start the exam.</p>
	
		<br>
		<a href="<?php echo base_url().'questions/logstart/'.$this->uri->segment(3); ?>" class="btn btn-info">Start Exam</a>
	</div>
</div>
<?php endif; ?>