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
				
                <div id="calendar">
                    <div class="head clear" data-time="1485907200">
                        <div class="arrows left"><a id="ButtonUpMonth" class="top icon" href="javascript:void(0);"> </a><a id="ButtonDownMonth" class="bottom icon" href="javascript:void(0);"> </a></div>
                        <h3 id="CalendarMonthLabel" class="left"><?php echo date('m');?></h3>
                        <div class="arrows right"><a id="ButtonUpYear" class="top icon" href="javascript:void(0);"> </a><a id="ButtonDownYear" class="bottom icon" href="javascript:void(0);"> </a></div>
                        <h3 id="CalendarYearLabel" class="right"><?php echo date('Y');?></h3>
                    </div>
                    <ul class="days">
                        <li>Mon.</li>
                        <li>Tue.</li>
                        <li>Wed.</li>
                        <li>Thu.</li>
                        <li>Fri.</li>
                        <li>Sat.</li>
                        <li>Sun.</li>
                    </ul>
                    <ul id="CalendarDays" class="dates">
                        <!-- ajax content -->
                    </ul>
                    <input id="CalendarMonth" type="hidden" value="<?php echo date('m');?>">
                    <input id="CalendarYear" type="hidden" value="<?php echo date('Y');?>">
                    <script>
					var calendarButtonsDisabled=false;
					
					function getCalendarDays() {
						var month = parseInt($('#CalendarMonth').val());
						var year = $('#CalendarYear').val();
						$.get("<?php echo base_url('article/getCalendarDays/'); ?>"+month+'/'+year, function( data ) {
							$("#CalendarDays").html( data );
							setCalendarDisabled(false);
						});
					}
					
					function updateCalendarLabels(month, year) {
						$('#CalendarMonth').val(month);
						$('#CalendarYear').val(year);
						$('#CalendarMonthLabel').html(month<10?'0'+month:month);
						$('#CalendarYearLabel').html(year);
					}
					
					function setCalendarDisabled(disabled) {
						calendarButtonsDisabled=disabled;
					}
					
					$(document).ready(function(e) {
                        getCalendarDays();
						
						$('#ButtonDownMonth').on('click', function() {
							if (calendarButtonsDisabled) {
								return;
							}
							setCalendarDisabled(true);
							
							var month = parseInt($('#CalendarMonth').val());
							var year = $('#CalendarYear').val();
							if (month == 1) {
								month=12;
								year--;
							}
							else {
								month--;
							}
							
							updateCalendarLabels(month, year);
							getCalendarDays();
						});
						
						$('#ButtonUpMonth').on('click', function() {
							if (calendarButtonsDisabled) {
								return;
							}
							setCalendarDisabled(true);
							
							var month = parseInt($('#CalendarMonth').val());
							var year = $('#CalendarYear').val();
							if (month == 12) {
								month=1;
								year++;
							}
							else {
								month++;
							}
							
							updateCalendarLabels(month, year);
							getCalendarDays();
						});
						
						$('#ButtonDownYear').on('click', function() {
							if (calendarButtonsDisabled) {
								return;
							}
							setCalendarDisabled(true);
							
							var month = parseInt($('#CalendarMonth').val());
							var year = $('#CalendarYear').val();
							year--;
							
							updateCalendarLabels(month, year);
							getCalendarDays();
						});
						
						$('#ButtonUpYear').on('click', function() {
							if (calendarButtonsDisabled) {
								return;
							}
							setCalendarDisabled(true);
							
							var month = parseInt($('#CalendarMonth').val());
							var year = $('#CalendarYear').val();
							year++;
							
							updateCalendarLabels(month, year);
							getCalendarDays();
						});
                    });
					</script>
                </div>
				
				<!--<div class="news-latter">
					<a href="http://studiosanua.com/newsletter/">Inscrizione Newsletter</a>
				</div>-->
			</div>

			<div class="right large">
				<ul class="news-categories clear">
					<!--<li>
						<div class="formLabel"><label>Tipo Utente</label></div>
						<div class="formField">
							<select class="inputCombo" name="">
								<option value="">All</option>
								<option value="">Institutii</option>
								<option value="">Profesionisti</option>
							</select>
						</div>
					</li>-->
					<li>
						<div class="formLabel"><label>Visualiza</label></div>
						<div class="formField">
							<select id="VisualizaSelect" class="inputCombo" name="">
								<option<?php echo $page_name=='all'?' selected':'';?> value="all">All</option>
								<option<?php echo $page_name=='news'?' selected':'';?> value="news">News</option>
								<option<?php echo $page_name=='events'?' selected':'';?> value="events">Events</option>
                                <option<?php echo $page_name=='testimonials'?' selected':'';?> value="testimonials">Testimonials</option>
							</select>
                            <script>
							$('#VisualizaSelect').on('change', function() {
								window.location.href = "<?php echo base_url('article/show/');?>"+$(this).val();
							});
							</script>
						</div>
					</li>
					<!--<li class="search">
						<div class="space clear">
							<input class="inputSubmit icon" type="submit" value="" />
							<input class="inputText" type="text" name="" value="" />
						</div>
					</li>-->
				</ul>
                <style>
				.news .content {font-size:14px;padding-bottom:40px;}
				.news .content img {max-width:100%;margin-top:10px;margin-bottom:10px;}
				</style>
				<ul class="news">
                <?php foreach($articles as $a):?>
					<li>
						<span class="button green right"><strong><?php $date=date_create($a['dateinsert']); echo date_format($date, 'd/m/Y');?></strong></span>
						<h2><a href="<?php echo base_url('/article/show/'.$page_name.'/'.$a['article_id']);?>"><?php echo $a['title'];?></a></h2>
						<div class="cnt" style="padding-bottom:15px;">
							<div class="content" style="max-height:290px;overflow:hidden;">
								<?php echo $a['content'];?>
							</div>
                        </div>
					</li>
                <?php endforeach; ?>
				</ul>
                <?php echo $this->pagination->create_links(); ?>
			</div>

		</div>
	</div>

			

    
<script type="text/javascript">$.conf = { 'path': "http://contabilitate.loghin.com/", 'pic_path': "http://contabilitate.loghin.com/uploads/", 'intervalTime': 15 };</script>

<?php $this->load->view('template-footer'); ?>