<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
</head>

<body>
	<?php $this->load->view('admin/template-header'); ?>
	
	<hgroup>
        <h1><?php echo $title; ?></h1>
    </hgroup>

	<div class="content-section">
    	<div class="alert alert-danger" role="alert"<?php echo !validation_errors()?' style="display:none;"':'';?>><?php echo validation_errors(); ?></div>
        <?php if ($successful):?>
        <div class="alert alert-success" role="alert">Successfully saved.</div>
		<script>
		$(".alert-success").fadeTo(2000, 500).fadeOut(500, function(){
			$(".alert-success").fadeOut(500);
		});
		</script>
        <?php endif; ?>
    	<form method="post" action="">
            <div class="form-group">
            	<label>Old password</label>
            	<input type="password" name="password_old" class="form-control">
            </div>
            <div class="form-group">
            	<label>New password</label>
            	<input type="password" name="password_new" class="form-control">
            </div>
            <div class="form-group">
            	<label>Repeat password</label>
            	<input type="password" name="password_re" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
		</form>
    </div>


<?php $this->load->view('admin/template-footer'); ?>