<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template-head');
?>
	<?php if($visible_gallery): ?>
	<?php $this->load->view('template-header-with-gallery'); ?>	
    <?php else: ?>
    <?php $this->load->view('template-header'); ?>	
    <?php endif; ?>
    
	<div id="content">
		<div class="width clear">
			
            <div class="left large">
            	<?php if($visible_content):?>
                <?php echo $page_content; ?>
                <?php endif;?>
                
                <?php if($visible_pagelists): ?>
                <div class="lists clear">
					<?php foreach($content_lists as $list): ?>
                        <h2 class="title border">
                        	<?php if($list['link']): ?>
                            	<a href="<?php echo $list['link'];?>"><?php echo $list['label'];?></a>
                            <?php else: ?>
                            	<?php echo $list['label'];?>
                            <?php endif; ?>
                        </h2>
                        <div class="clear">
                            <ul class="left">
                                <?php foreach(array_slice($list['subitems'], 0, ceil(count($list['subitems'])/2)) as $subitem): ?>
                                <li>
                                    <?php if($subitem['link']): ?>
                                    <a href="<?php echo $subitem['link'];?>"><?php echo $subitem['label'];?></a>
                                    <?php else: ?>
                                    <span><?php echo $subitem['label'];?></span>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <ul class="right">
                                <?php foreach(array_slice($list['subitems'], ceil(count($list['subitems'])/2), floor(count($list['subitems'])/2)) as $subitem): ?>
                                <li>
                                    <?php if($subitem['link']): ?>
                                    <a href="<?php echo $subitem['link'];?>"><?php echo $subitem['label'];?></a>
                                    <?php else: ?>
                                    <span><?php echo $subitem['label'];?></span>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif;?>
            </div>
            <div class="right tight">
                
                <!--<div class="search-options">
                    <h5>Search Options</h5>
                    <div>
                        <ul class="clear">
                            <li><a href="#">Text</a></li>
                            <li><a class="selected" href="#">Text</a></li>
                            <li><a href="#">Text</a></li>
                        </ul>
                        <ul class="clear">
                            <li><a href="#">Text</a></li>
                            <li><a href="#">Text</a></li>
                            <li><a href="#">Text</a></li>
                        </ul>
                        <div class="fields">
                            <select name="">
                                <option value="">Text</option>
                            </select>
                            <select name="">
                                <option value="">Text</option>
                            </select>
                            <select name="">
                                <option value="">Text</option>
                            </select>
                            <select name="">
                                <option value="">Text</option>
                            </select>
                            <a class="button s-blue" href="http://contabilitate.loghin.com/search/"><strong>Search</strong></a>
                        </div>
                    </div>
                </div>-->
                
                <?php if($visible_news):?>
                <h2 class="title border"><a href="http://contabilitate.loghin.com/news/"><?php echo $newssection_title;?></a></h2>
                <div class="news">
                    <a class="scroll-arrow top icon" href="#"></a>
                    <br><br>
                    <!--<ul class="news-categories clear">
                        <li>
                            <div class="formLabel"><label>Tipo Utente</label></div>
                            <div class="formField">
                                <select class="inputCombo" name="">
                                    <option value="">All</option>
                                    <option value="">Institutii</option>
                                    <option value="">Profesionisti</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="formLabel"><label>Visualiza</label></div>
                            <div class="formField">
                                <select class="inputCombo" name="">
                                    <option value="">All</option>
                                    <option value="">News</option>
                                    <option value="">Events</option>
                                </select>
                            </div>
                        </li>
                    </ul>-->
					<?php
					$len=count($news);
					$i=0;
					foreach($news as $a): ?>
					<div class="cnt clear<?php echo $i==$len-1?' last':'';?>">
                        <span class="button green right"><strong><?php $date=date_create($a['dateinsert']); echo date_format($date, 'd/m/Y');?></strong></span>
                        <p style="min-height:40px;"><?php echo $a['description'];?></p>
                        <a class="more right" href="<?php echo base_url('article/show/news/'.$a['article_id']);?>"><?php echo $newssection_button_more;?></a>
                    </div>
					<?php $i++; endforeach; ?>
                    <br>
                    <a class="scroll-arrow bottom icon" href="#"></a>
                </div>
                <br>
                <?php endif;?>
            
                
                <div class="news-latter">
                    <a href="#newsletter">Iscrizione  Newsletter</a>
                    <div id="newsletter" style="display:none">
                <div class="head">
                    <input class="inputText" type="text" name="email" value="" placeholder="Enter your E-mail Adress" />
                    <span>or</span>
                    <input class="inputText" type="text" name="username" value="" placeholder="Enter your Loghin Account" />
                </div>
                <div class="clear">
                    <h3 class="left">User Type</h3>
                    <h3 class="right">Aplication List</h3>
                    <div class="cfix"></div>
                    <div class="left">
                        <a class="scroll-arrow top icon" href="#"></a>
                        <ul>
                            <li><label><input type="checkbox" name="" value="" checked="checked" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                        </ul>
                        <a class="scroll-arrow bottom icon" href="#"></a>
                    </div>
                    <div class="right">
                        <a class="scroll-arrow top icon" href="#"></a>
                        <ul>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                            <li><label><input type="checkbox" name="" value="" /> Lorem Ipsum Dolor</label></li>
                        </ul>
                        <a class="scroll-arrow bottom icon" href="#"></a>
                    </div>
                </div>
                <div class="foot">
                    <a class="button blue submit" href="javascript:void(0);"><strong>Send Message</strong></a>
                </div>
            </div>
                </div>
            
                <?php if($visible_testimonials):?>
                <h2 class="title border"><?php echo $testimonialssection_title;?></h2>
                <?php foreach($testimonials as $a): ?>
                <div class="cnt clear">
                    <p><?php echo $a['description'];?></p>
                    <a class="button big left" href="<?php echo base_url('article/show/testimonials/');?>"><strong><?php echo $testimonialssection_button_viewall;?></strong></a>
                </div>
                <?php $i++; endforeach; ?>
                <?php endif; ?>
            </div>
                    </div>
                </div>

<script>
$.conf = {
	'path': "http://contabilitate.loghin.com/",
	'pic_path': "",
	'intervalTime': 15
};
$.slideShow = {
<?php
$i=0;
$len=count($gallery_items);
foreach($gallery_items as $gallery_item):
?>
	"<?php echo $gallery_item['category_id'];?>":{
		"name":"<?php echo $gallery_item['title'];?>",
		"url":"<?php echo $gallery_item['url'];?>",
		"items":{
			<?php
			$i2=0;
			$len2=count($gallery_item['subitems']);
			foreach($gallery_item['subitems'] as $gallery_subitem):
			?>
			"<?php echo $gallery_subitem['slideshow_id'];?>":{
				"name":"<?php echo $gallery_subitem['title'];?>",
				"image":"<?php echo $gallery_subitem['image'];?>",
				"url":"<?php echo $gallery_subitem['url'];?>",
				"desc":"<?php
				$desc=str_replace(array("\n","\t","\r"),'', htmlentities($gallery_subitem['desc'], ENT_QUOTES));
				echo substr($desc, 0, 100).(strlen($desc)>100?'...':'');
				?>",
				"new_tab":"<?php echo $gallery_subitem['new_tab'];?>"
			}<?php echo $i2<$len2-1?',':''; $i2++; ?>
			<?php endforeach; ?>
		},
		"orderid":[ <?php
			$i2=0;
			$len2=count($gallery_item['subitems']);
			foreach($gallery_item['subitems'] as $gallery_subitem):
?><?php echo $gallery_subitem['slideshow_id'];?><?php echo $i2<$len2-1?', ':''; $i2++; ?><?php
			endforeach;
			?> ]
	}<?php echo $i<$len-1?',':''; $i++; ?>
<?php endforeach; ?>
};
</script>
<?php $this->load->view('template-footer'); ?>