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
                <ul class="menu">
                	<?php
					foreach($content_menu as $menu_item):
					
					$_li_class=NULL;
					if(count($menu_item['subitems'])>0) {
						$_li_class=($menu1_id==$menu_item['item_id'])?'opened':'closed';
					}
					if($menu1_id==$menu_item['item_id']) {
						$_li_class.=' selected';
					}
					?>
                    <li class="<?php echo $_li_class; ?>">
                    	<a href="<?php echo base_url('page/resources/'.$menu_item['item_id']);?>"><?php echo $menu_item['label'];?></a>
                        <ul>
                        	<?php foreach($menu_item['subitems'] as $menu_subitem): ?>
                            <li class="<?php echo $menu_subitem['icon']; ?>"><a href="<?php echo base_url('page/resources/'.$menu_item['item_id'].'/'.$menu_subitem['subitem_id']);?>"><span class="icon"> </span> <?php echo $menu_subitem['label']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php if(count($menu_item['subitems'])>0): ?>
                        <span class="has icon"> </span>
                        <?php endif; ?>
                    </li>
                    <?php
					endforeach;
					?>
                </ul>
                
                <!--<div id="settings">
                    <div class="nav">
                        <a href="#">Library</a> &nbsp; &nbsp;|&nbsp; &nbsp;
                        <a class="selected" href="#">Events</a>
                    </div>
                    <div class="overflow">
                        <ul class="list">
                            <li class="opened">
                                <div class="clear">
                                    <div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
                                    <div class="right"><a href="#">9.250 Items</a></div>
                                </div>
                                <ul>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="clear">
                                    <div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
                                    <div class="right"><a href="#">9.250 Items</a></div>
                                </div>
                                <ul>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="clear">
                                    <div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
                                    <div class="right"><a href="#">9.250 Items</a></div>
                                </div>
                                <ul>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="clear">
                                    <div class="left"><a class="icon" href="javascript:void(0);">+</a> Ramura 1</div>
                                    <div class="right"><a href="#">9.250 Items</a></div>
                                </div>
                                <ul>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                    <li>
                                        <span class="left">Subramura:</span>
                                        <span class="right"><a href="#">3.250 Items</a></span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="buttons">
                            <a class="button s-blue" href="#"><strong>Open Selected</strong></a>
                        </div>
                        <div class="nav">
                            <a class="selected" href="#">Preference</a> &nbsp; | &nbsp;
                            <a href="#">Statistics</a> &nbsp; | &nbsp;
                            <a href="#">In / Out</a>
                        </div>
                        <div class="pref">
                            <div class="head clear">
                                <h3 class="left">Preference</h3>
                                <a class="close icon right" href="#">x</a>
                            </div>
                            <div class="line">
                                <p>Seleziona le schede delle notizie da visualizzare:</p>
                                <div class="clear">
                                    <div class="formLabel">
                                        <label>Visual Time:</label>
                                    </div>
                                    <div class="formField">
                                        <select class="inputCombo" name="">
                                            <option value="">Days</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clear">
                                    <div class="formLabel">
                                        <label>Total Hits:</label>
                                    </div>
                                    <div class="formField">
                                        <select class="inputCombo" name="">
                                            <option value="">Number</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clear">
                                    <div class="formLabel">
                                        <label>Visual:</label>
                                    </div>
                                    <div class="formField">
                                        <select class="inputCombo" name="">
                                            <option value="">Type</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="line">
                                <p>Processing System:</p>
                                <div class="clear">
                                    <div class="formLabel">
                                        <label>Modul 1 Activation:</label>
                                    </div>
                                    <div class="formField">
                                        <input class="inputCheckbox" type="checkbox" name="" value="" />
                                    </div>
                                </div>
                                <div class="clear">
                                    <div class="formLabel">
                                        <label>Modul 2 Activation:</label>
                                    </div>
                                    <div class="formField">
                                        <input class="inputCheckbox" type="checkbox" name="" value="" />
                                    </div>
                                </div>
                                <div class="clear">
                                    <div class="formLabel">
                                        <label>Arhive:</label>
                                    </div>
                                    <div class="formField">
                                        <select class="inputCombo" name="">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="clear">
                                    <div class="formLabel">
                                        <label>Newsletter:</label>
                                    </div>
                                    <div class="formField">
                                        <input class="inputCheckbox" type="checkbox" name="" value="" />
                                    </div>
                                </div>
                                <div class="formButton">
                                    <a href="#" rel="submit">Save<i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
            <?php endif; ?>

			<?php if($visible_content): ?>
            <div class="right large">
            	<div class="cnt">
                	<?php echo $page_content; ?>
                </div>
            </div>
            <?php endif; ?>

		</div>
	</div>
<script type="text/javascript">$.conf = { 'path': "http://contabilitate.loghin.com/", 'pic_path': "http://contabilitate.loghin.com/uploads/", 'intervalTime': 15 };</script>

<?php $this->load->view('template-footer'); ?>