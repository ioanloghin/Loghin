<script>
$('#header .pres-toggle').on('click', function() {
	$(this).toggleClass('close');
	$('#header .round, #homeHead').toggleClass('hide');
	return false;
});
</script>
    
    <div id="header">
		<div class="width">
			<a class="close pres-toggle" href="#">Presentation Toggle</a>	
            		
			<?php $this->load->view('template-topbar'); ?>
			
            <style>
			#header .title > h1:after {content:'<?php echo $company_name;?>';}
			#header .title > .category:after {content:'<?php echo $company_domain;?>';}
			</style>
            <div class="head clear">
				<div class="left clear">
					<h1 class="logo left"><a style="background-image:url(<?php echo $logo_img;?>); background-size:191px 129px;" href="<?php echo base_url("/");?>">Ordine dei Dottori Commercialisti e delgi Esperti Contobili di lvrea, Pinerolo, Torino</a></h1>
					<hgroup class="title left">
                    	<h1><span><?php echo $company_name;?></span></h1>
                        <small class="category"><span><?php echo $company_domain;?></span></small>
                        <small class="address"><?php echo $company_register;?></small>
                    </hgroup>
				</div>
                <div class="right">
					<?php echo $header_content; ?>
                </div>
			</div>
            
			<!--<div class="head clear">
				<div class="left clear">
					<h1 class="logo left"><a href="#">Lighin Sstem | Format</a></h1>
					<div class="arrow-down left"><a class="icon" href="javascript:void(0);"></a></div>
				</div>
				<h2 class="left"><a href="#">Contabilitate | definire activitate / creatie de pagini web</a></h2>
				<ul class="p-items right clear">
					<li class="first"><a class="icon big" href="#"></a></li>
					<li><a class="icon big" href="#"></a></li>
					<li><a class="icon big" href="#"></a></li>
					<li><a class="icon big" href="#"></a></li>
				</ul>
				<div id="system" class="hide">
	<ul class="clear">
		<li class="left">
			<span>Text</span>
			<ul>
				<li><a href="#">Item Number one</a></li>
				<li><a href="#">Item Number two</a></li>
				<li><a href="#">Item Number three</a></li>
				<li><a href="#">Item Number four</a></li>
				<li><a href="#">Item Number five</a></li>
				<li><a href="#">Item Number six</a></li>
				<li><a href="#">Item Number seven</a></li>
				<li><a href="#">Item Number eight</a></li>
				<li><a href="#">Item Number nine</a></li>
			</ul>
		</li>
		<li class="right">
			<span>Text</span>
			<ul>
				<li><a href="#">Item Number one</a></li>
				<li><a href="#">Item Number two</a></li>
				<li><a href="#">Item Number three</a></li>
				<li><a href="#">Item Number four</a></li>
				<li><a href="#">Item Number five</a></li>
				<li><a href="#">Item Number six</a></li>
				<li><a href="#">Item Number seven</a></li>
				<li><a href="#">Item Number eight</a></li>
				<li><a href="#">Item Number nine</a></li>
			</ul>
		</li>
	</ul>
	<a class="icon top disabled" href="javascript:void(0);">&nbsp;</a>
	<div class="overflow">
		<div class="list">
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
			<a class="item" href="#">
				<span class="icon left"></span>
				<span class="left clear">Loghin System</span>
				<span class="right">Scottish referendum</span>
			</a>
		</div>
	</div>
	<a class="icon bottom disabled" href="javascript:void(0);">&nbsp;</a>
</div>
			</div>-->
			
			<script>
			$(document).ready(function(e) {
                $("a.fancy_image").fancybox({
					openEffect  : 'fade',
					closeEffect : 'fade',
					nextEffect  : 'fade',
					prevEffect  : 'fade',
					helpers : {
							title : {
								type : 'inside'
							},
							overlay : {
								css : {
									'background-color' : '#eee'
								}
							}
						},
					beforeLoad: function() {
						
						var el = $('#title-1');
						if (el.length) {
							this.title = el.html();
						}
					}
				});
            });
			</script>
			<div class="nav clear">
				<div class="left">
					<div class="round">
						<div class="left"></div>
						<div class="content">
                        	<?php foreach($gallery_items as $gallery_item): ?>
                            <?php foreach($gallery_item['subitems'] as $gallery_subitem): ?>
							<div class="image">
								<a class="back icon" href="javascript:void(0);">&laquo; <?php echo $button_prev; ?></a>
								<div class="above_image" id="title-0" style="display:none;">
                                    <div style="display:inline" class="desc"><?php echo $gallery_subitem['title'];?></div>
                                </div>
                                <a data-title-id="title-1" class="fancy_image" href="<?php echo $gallery_subitem['image'];?>" rel="sldData_<?php echo $gallery_subitem['slideshow_id'];?>"><img width="644" height="375" src="<?php echo $gallery_subitem['image'];?>" alt="" /></a>
                                <div class="below_image" id="title-1" style="display:none;">
                                    <div style="display:inline" class="desc"><?php echo $gallery_subitem['desc'];?></div>
                                    <a href="<?php echo $gallery_subitem['url'];?>"><?php echo $button_more; ?></a>
                                </div>
								<div class="info">
									<h3><?php echo $gallery_subitem['title'];?></h3>
									<div>
                                    	<p><?php echo $gallery_subitem['desc'];?></p>
                                        <br /><a href="<?php echo $gallery_subitem['url'];?>"><?php echo $button_more; ?></a>
                                    </div>
								</div>
								<a class="next icon" href="javascript:void(0);"><?php echo $button_next; ?> &raquo;</a>
							</div>
							<div class="clear">
								<a class="button small right" href="http://studiosanua.com/"><strong><?php echo $button_more; ?></strong></a>
								<div class="options clear">
									<div class="left clear">
										<a href="javascript:void(0);"><?php echo $button_prev; ?></a>
									</div>
									<div class="right clear">
										<a href="javascript:void(0);"><?php echo $button_next; ?></a>
									</div>
								</div>
							</div>
                            <?php break; endforeach; ?>
                            <?php break; endforeach; ?>
						</div>
						<div class="right"></div>
					</div>
					
                    <?php $this->load->view('template-topmenu'); ?>	
					
				</div>
				<div class="right">
					<div class="round">
						<div class="left"></div>
						<div class="content">
							<a class="top icon" href="javascript:void();"></a>
							<div class="overflow">
                            	<?php $first=true; foreach($gallery_items as $gallery_item) { ?>
                                    <h2><a href=""><?php echo $gallery_item['title'];?></a></h2>
                                    <ul>
									<?php foreach($gallery_item['subitems'] as $gallery_subitem): ?>
                                    	<li><a<?php echo $first?' class="selected"':'';$first=false;?> href="<?php echo $gallery_subitem['url'];?>" name="<?php echo $gallery_subitem['slideshow_id'];?>"><?php echo $gallery_subitem['title'];?></a></li>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php break;} ?>
							</div>
							<a class="bottom icon" href="javascript:void(0);"></a>
							<div class="items">
                            	<?php $first=true; foreach($gallery_items as $gallery_item): ?>
                                <a class="icon<?php echo $first?' selected':'';$first=false;?>" href="javascript:void(0);" name="<?php echo $gallery_item['category_id'];?>">&nbsp;</a>
                                <?php endforeach; ?>
                            </div>
						</div>
						<div class="right"></div>
					</div>
										
					<?php $this->load->view('template-topsearch'); ?>	
					
				</div>
			</div>
			
		</div>
	</div>
	
    <div id="homeHead"></div>