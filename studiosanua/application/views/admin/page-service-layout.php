<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('admin/template-head');
?>
</head>

<body>
	<?php $this->load->view('admin/template-header'); ?>
	
    <hgroup>
		<div class="btn-group" style="float:right;">
			<?php if($item_key): foreach($content_langs as $l): ?>
			<a href="<?php echo base_url('servicepage/layout/'.$item_key.'/'.$l['lang']);?>" type="button" class="btn btn-xs <?php echo $form_lang==$l['lang']?'btn-warning':'btn-default'; ?>"><?php echo $l['lang']; ?></a>
			<?php endforeach; endif; ?>
		</div>
        <h1><?php echo $title; ?></h1>
    </hgroup>
   
    <style>
	.nopadding {padding:0;margin:0;}
	.layoutSection {position:relative;display:block;background:#ccc;text-align:center;text-decoration:none;}
	.layoutSection:hover {text-decoration:none;color:black;background:#bbb;}
	.layoutSection.disabled {background:#eee;color:#999;cursor:default;}
	.layoutSection .visible_icon {width:20px;height:20px;background:url(https://www.shareicon.net/download/2016/09/10/827829_multimedia_512x512.png);background-size:20px 20px;position:absolute;top:2px;right:4px;z-index:10;}
	.layoutSection .visible_icon.hide {display:none;}
	</style>
	<div class="content-section">
		<div class="panel panel-default col-xs-12 col-sm-6 nopadding">
        	<div class="panel-body nopadding" style="padding:5px;">
            	<div class="col-sm-12 nopadding" style="padding-bottom:10px;">
                	<div class="layoutSection disabled" style="height:40px;line-height:40px;">Header</div>
                </div>
                <div class="col-sm-8 nopadding">
                	<a href="<?php echo base_url('/servicepage/layout/leftmenu/'.$form_lang);?>" class="layoutSection" style="height:50px;line-height:50px;margin-right:10px;">
                    <div class="visible_icon<?php echo $visible_leftmenu?' hide':'';?>" title="Not visible"></div>
                    Left menu</a>
                    
                    <a href="<?php echo base_url('/servicepage/layout/content/'.$form_lang);?>" class="layoutSection" style="height:120px;line-height:120px;margin-right:10px;margin-top:10px;">
                    <div class="visible_icon<?php echo $visible_content?' hide':'';?>" title="Not visible"></div>
                    Content</a>
                </div>
                <div class="col-sm-4 nopadding">
                	<a href="<?php echo base_url('/servicepage/layout/publications/'.$form_lang);?>" class="layoutSection" style="height:180px;line-height:180px;">
                    <div class="visible_icon<?php echo $visible_publications?' hide':'';?>" title="Not visible"></div>
                    Publications</a>
                </div>
                <div class="col-sm-12 nopadding" style="padding-top:10px;">
                	<div class="layoutSection disabled" style="height:40px;line-height:40px;">Footer</div>
                </div>
            </div>
		</div>
		<?php if($item_key!=NULL):?>
        <div id="ItemDetails-<?php echo $item_key;?>" class="col-xs-12 col-sm-6">
            <div class="alert alert-danger" role="alert"<?php echo !validation_errors()?' style="display:none;"':'';?>><?php echo validation_errors(); ?></div>
            <?php if ($successful):?>
            <div class="alert alert-success" role="alert">Successfully saved.</div>
            <script>
            $(".alert-success").fadeTo(2000, 500).fadeOut(500, function(){
                $(".alert-success").fadeOut(500);
            });
            </script>
            <?php endif; ?>
            <form method="post" action="" role="form">
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <table id="ListSubItems" class="table borderless">
                            <tr>
                                <td>
                                    <label style="padding-top:6px;">Visible</label>
                                </td>
                                <td style="width:100%">
                                    <input type="checkbox" name="field_visible" class="" value="1" <?php echo $field_visible?' checked':'';?>>
                                </td>
                            </tr>
                            <?php
							switch($item_key)
							{
								case 'leftmenu':
								{
									?>
                                    <tr>
                                        <td style="min-width:160px;">
                                            <label style="padding-top:6px;">Section title</label>
                                        </td>
                                        <td style="width:100%">
                                            <input type="text" name="field_title" class="form-control input-sm" value="<?php echo $field_title;?>">
                                        </td>
                                    </tr>
                                    <?php
									break;
								}
								case 'publications':
								{
									?>
                                    <tr>
                                        <td style="min-width:160px;">
                                            <label style="padding-top:6px;">Section title</label>
                                        </td>
                                        <td style="width:100%">
                                            <input type="text" name="field_title" class="form-control input-sm" value="<?php echo $field_title;?>">
                                        </td>
                                    </tr>
                                    <?php
									break;
								}
								case 'content':
								{
									?>
                                    
									<?php
									break;
								}
							}
							?>
                        </table>
                    </div>
                </div>
                <div class="form-group" style="text-align:center;"><button type="submit" name="save" class="btn btn-sm btn-success" value="1">Save</button></div>
            </form>
        </div>
        <?php endif; ?>
        <div style="clear:both"></div>
	</div>
<?php $this->load->view('admin/template-footer'); ?>