<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template-head');
?>
	<?php $this->load->view('template-header'); ?>	
    
	<div id="content">
		<div class="width clear">
			
            <?php if($visible_leftmenu): ?>
            <div class="left tight">
                <h2 class="title"><?php echo $leftmenu_title; ?></h2>
                <ul class="lf-menu">
                	<?php
					foreach($content_menu as $menu_item):
					
					$_li_class=NULL;
					if(count($menu_item['subitems'])>0) {
						$_li_class=($menu1_id==$menu_item['item_id'])?'opened':'closed';
					}
					
					?>
                	<li class="<?php echo $_li_class; ?>">
                    	<a href="<?php echo base_url('page/practice/'.$menu_item['item_id']);?>">&bull; &nbsp;<?php echo $menu_item['label'];?></a>
                    	<?php if(count($menu_item['subitems'])): ?>
                        <ul>
                        	<?php foreach($menu_item['subitems'] as $menu_subitem): ?>
                            <li><a href="<?php echo base_url('page/practice/'.$menu_item['item_id'].'/'.$menu_subitem['subitem_id']);?>">&bull; &nbsp;<?php echo $menu_subitem['label'];?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <span class="has">+</span>
                        <?php endif; ?>
                    </li>
                    
                	<?php
					endforeach;
					?>
                </ul>
                <div class="cnt clear">
                    <?php echo $page_left_content; ?>
                </div>
            </div>
            <?php endif; ?>

			<?php if($visible_content): ?>
            <div class="right large">
                <?php echo $page_content; ?>
            </div>
            <?php endif; ?>

		</div>
	</div>
    
<script type="text/javascript">$.conf = { 'path': "http://contabilitate.loghin.com/", 'pic_path': "http://contabilitate.loghin.com/uploads/", 'intervalTime': 15 };</script>

<?php $this->load->view('template-footer'); ?>