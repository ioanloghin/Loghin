<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template-head');
?>
    <?php $this->load->view('template-header'); ?>	
  	<style>
	.excel-cols {display:flex;}
	.excel-cols > .excel-col {width:140px;margin:0 5px;}
	.excel-cols > .excel-col > select {margin-bottom:5px;}
	.excel-rows {padding:0;margin:0;}
	.excel-rows > li { white-space:nowrap;text-overflow:ellipsis; overflow:hidden; }
	</style>  
	<div id="content">
		<div class="width clear">
        	<h1>1. Upload file</h1>
			<form method="post" action="" enctype="multipart/form-data">
            	<label>File (excel):</label> <input type="file" name="file" class="form-control">
                <button type="submit" class="btn btn-warning">Upload</button>
            </form>
            <br><br>
            <h1>2. Select fields</h1>
            Import from <strong>test.xlsx</strong> file.<br>
            <div class="form-inline">
            	Ignore first <input type="number" size="2" style="width:50px;" class="form-control" value="1"> rows.
            </div>
            <form method="post">
            	<div class="excel-cols">
                	<?php foreach(range('A', 'D') as $c): ?>
                    <div class="excel-col">
                        <select class="form-control">
                        	<option></option>
                        	<option>Firstname</option>
                            <option>Lastname</option>
                            <option>Email</option>
                        </select>
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo $c;?></div>
                            <div class="panel-body" style="padding:0;">
                            	<ul class="list-group excel-rows">
                            	<?php foreach($DataInSheet as $row): ?>
                                	<li class="list-group-item" title="<?php echo $row[$c];?>"><?php echo $row[$c];?>&nbsp;</li>
                                <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="btn btn-primary">Import</button>
            </form>
            <script>
			$('.excel-col > select').on('change', function() {
				if($(this).val() != "") {
					$(this).parent().children('.panel').removeClass('panel-default').addClass('panel-primary');
				}
				else {
					$(this).parent().children('.panel').removeClass('panel-primary').addClass('panel-default');
				}
			});
			</script>
            <br><br>
            <h1>3. Conflicts</h1>
            <strong>23</strong> New records, <strong>4</strong> additional info, <strong>14</strong> conflicts.<br>
            <form method="post" action="" enctype="multipart/form-data">
            	<table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                      </tr>
                      <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                      </tr>
                      <tr>
                        <td>July</td>
                        <td>Dooley</td>
                        <td>july@example.com</td>
                      </tr>
                    </tbody>
				</table>
                <button type="button" class="btn btn-success">Finish</button>
            </form>
        </div>
    </div>

<?php $this->load->view('template-footer'); ?>