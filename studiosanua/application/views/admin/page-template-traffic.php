<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
	<link rel="stylesheet" href="<?php echo base_url('assets/morris.js-0.5.1/morris.css');?>">
	<script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="<?php echo base_url('assets/morris.js-0.5.1/morris.min.js');?>"></script>
</head>

<body>
	<?php $this->load->view('admin/template-header'); ?>
	
    <hgroup>
        <h1><?php echo $title; ?></h1>
    </hgroup>
	
	<div class="content-section">
    	<strong>In the last 10 days</strong>
    	<div id="graph" style="height: 250px;"></div>
    </div>

<script>
var day_data = [
<?php $i=0; foreach($stats as $date => $count): ?>
  {"period": "<?php echo $date;?>", "values": <?php echo $count;?>}
<?php if($i++<count($stats)-1) { echo ',';} ?>
<?php endforeach; ?>
];
new Morris.Line({
  element: 'graph',
  data: day_data,
  xkey: 'period',
  ykeys: ['values'],
  labels: ['Visitors']
});

</script>

<?php $this->load->view('admin/template-footer'); ?>