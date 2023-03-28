<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template-head');
?>
	<?php $this->load->view('template-header'); ?>
	
	<div id="content">
		<div class="width clear">
			
            <div class="left large">
            	<?php if($visible_leftmenu): ?>
                <h2 class="title"><?php echo $leftmenu_title; ?></h2>
                
                <div id="services" class="clear">
                    
                    <div class="left">
                        <?php foreach(array_slice($content_menu, 0, ceil(count($content_menu)/2)) as $item): ?>
                        <div class="<?php echo $item['icon'];?> clear">
                            <a href="<?php echo base_url('page/service/'.$item['item_id']);?>"><span class="icon"></span><?php echo $item['label'];?></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="right">
                        <?php foreach(array_slice($content_menu, ceil(count($content_menu)/2), floor(count($content_menu)/2)) as $item): ?>
                        <div class="<?php echo $item['icon'];?> clear">
                            <a href="<?php echo base_url('page/service/'.$item['item_id']);?>"><span class="icon"></span><?php echo $item['label'];?></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <br>
                <?php endif; ?>
                <?php if($visible_content): ?>
                	<?php echo $page_content; ?>
                <?php endif; ?>
            </div>
            
            <div class="right tight">
                <?php if($visible_publications): ?>
                <h3 class="title"><?php echo $publications_title; ?></h3>
                <?php foreach($events as $a): ?>
                <div class="cnt">
                    <span class="button green left"><strong>Business</strong></span>
                    <p style="padding-top:20px;margin:0" class="center"><img src="http://contabilitate.loghin.com/uploads/glob.png" alt="" /></p>
                    <div class="cfix"></div>
                    <p class="border"><?php echo $a['description'];?> <a href="<?php echo base_url('article/show/events/'.$a['article_id']);?>">view articol</a></p>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

		</div>
	</div>

<?php $this->load->view('template-footer'); ?>