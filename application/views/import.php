<?php if($this->session->userdata('userPositionSessId') == 0): // examiners only ?>
<div class="panel panel-primary">
	<div class="panel-heading text-uppercase"><strong>Browse file from your computer</strong></div>
	<div class="panel-body">
		<form action="/questions/importProcess" method="POST">
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="file" class="form-control" id="file" name="file">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
	</div>
</div>
<?php endif; ?>