<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template-head');
?>
	<?php $this->load->view('template-header'); ?>	
    
	<div id="content">
		<div class="width clear">

			<div class="left tight">
				<ul class="lf-menu">
					<li><a href="<?php echo base_url('article/show/news/');?>">&bull; &nbsp;News</a></li>
					<li><a href="<?php echo base_url('article/show/events/');?>">&bull; &nbsp;Events</a></li>
					<li><a href="<?php echo base_url('article/show/testimonials/');?>">&bull; &nbsp;Testimonials</a></li>
				</ul>
				
				<div id="calendar"><div class="head clear" data-time="1485907200"><div class="arrows left"><a class="top icon" href="javascript:void(0);"> </a><a class="bottom icon" href="javascript:void(0);"> </a></div><h3 class="left">February</h3><div class="arrows right"><a class="top icon" href="javascript:void(0);"> </a><a class="bottom icon" href="javascript:void(0);"> </a></div><h3 class="right">2017</h3></div><ul class="days"><li>Mon.</li><li>Tue.</li><li>Wed.</li><li>Thu.</li><li>Fri.</li><li>Sat.</li><li>Sun.</li></ul><ul class="dates"><li class="week">05</li><li class="no"></li><li class="no"></li><li class="">1</li><li class="">2</li><li class="">3</li><li class="">4</li><li class="">5</li><li class="week">06</li><li class="">6</li><li class="">7</li><li class="">8</li><li class="">9</li><li class="">10</li><li class="">11</li><li class="">12</li><li class="week">07</li><li class="">13</li><li class="">14</li><li class="">15</li><li class="">16</li><li class="">17</li><li class="">18</li><li class="">19</li><li class="week">08</li><li class="">20</li><li class="">21</li><li class="">22</li><li class="current ">23</li><li class="">24</li><li class="">25</li><li class="">26</li><li class="week">09</li><li class="">27</li><li class="">28</li><li class="no"></li><li class="no"></li><li class="no"></li><li class="no"></li><li class="no"></li></ul></div>
				
				<!--<div class="news-latter">
					<a href="http://studiosanua.com/newsletter/">Inscrizione Newsletter</a>
				</div>-->
			</div>

            <div class="right large">
            	<br>
            	<a class="btn btn-default" href="<?php echo base_url('/article/show/'.$page_name.'/'); ?>">&laquo; Back to articles</a><br>
                <style>
				.content {font-size:14px;padding-bottom:40px;}
				.content img {max-width:100%;margin-top:10px;margin-bottom:10px;}
				</style>
            	<h2 class="title"><?php echo $article_title; ?></h2>
                <div class="content">
					<?php echo $article_content; ?>
                </div>
            </div>

		</div>
	</div>

			

    
<script>$.conf = { 'path': "http://contabilitate.loghin.com/", 'pic_path': "http://contabilitate.loghin.com/uploads/", 'intervalTime': 15 };</script>

<?php $this->load->view('template-footer'); ?>