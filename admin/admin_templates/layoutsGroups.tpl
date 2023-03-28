{include file='header.tpl'}
	{if $hideContent != 1}
	<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowLayoutsGroups').toggle();">{'manage_layouts_groups'|lang}</a>
                  	</div>
                    <div class="right">
                    	<select class="inputCombo" id="toggleMenus">
                        	{foreach $layoutsMenus AS $menu}
		                        <optgroup label="{$menu.name}">
			                        {foreach $menu.items AS $_menu}
			                        <option value="{$_menu@key}"{if $_menu@key == $id} selected="selected"{/if}>{$_menu}</option>
			                        {/foreach}
		                        </optgroup>
							{/foreach}
                        </select>
                    </div>
              	</div>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowLayoutsGroups">
		<tr>
			<td class="gridValue">
				<ul id="itemsList" class="field_items">
                	{if count($fields)}
                    	{foreach $fields AS $group_id => $group}
                        <li>
                            <input class="inputText" style="width:350px" type="text" name="items[][{$group_id}]" value="{$group.name}" />
	                        <input class="inputText" style="width:350px" type="text" name="url[][{$group_id}]" value="{$group.url}" />
                            <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                            <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                            <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" border="0" /></a>
                            <a href="javascript:void(0);" onclick="addItem(this);">
                            <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" border="0" /></a>
                            <a href="javascript:void(0);" onclick="removeItem(this);">
                            <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" border="0" /></a>
	                        <ul>
		                        {if false === empty($group.items)}{foreach $group.items AS $item}
		                        <li>
			                        <input class="inputText" style="width:350px" type="text" name="_items[{$group_id}][][{$item@key}]" value="{$item.name}" />
			                        <input class="inputText" style="width:350px" type="text" name="_info[{$group_id}][][{$item@key}]" value="{$item.info}" />
				                    <input class="inputText" style="width:350px" type="text" name="_url[{$group_id}][][{$item@key}]" value="{$item.url}" />
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
			                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
			                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" border="0" /></a>
			                        <a href="javascript:void(0);" onclick="addItem(this);">
			                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" border="0" /></a>
			                        <a href="javascript:void(0);" onclick="removeItem(this);">
			                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" border="0" /></a>
									<a href="{$vir_cp_path}index.php?m=layoutsgroups&p=edit&id={$item@key}" title="{'edit_layout'|lang}"><img src="{$vir_tpl_path}media/options/fields.gif" align="absmiddle" /></a>
			                    </li>
		                        {/foreach}{/if}
		                        <li>
			                        <input class="inputText" style="width:350px" type="text" name="_items[{$group_id}][][0]" value="" />
			                        <input class="inputText" style="width:350px" type="text" name="_info[{$group_id}][][0]" value="" />
				                    <input class="inputText" style="width:350px" type="text" name="_url[{$group_id}][][0]" value="" />
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
			                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
			                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" border="0" /></a>
			                        <a href="javascript:void(0);" onclick="addItem(this);">
			                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" border="0" /></a>
			                        <a href="javascript:void(0);" onclick="removeItem(this);">
			                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" border="0" /></a>
			                    </li>
	                        </ul>
                        </li>
                    	{/foreach}
                    {/if}
                    <li>
                        <input class="inputText" style="width:350px" type="text" name="items[][0]" value="" />
	                    <input class="inputText" style="width:350px" type="text" name="url[][0]" value="" />
                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" border="0" /></a>
                        <a href="javascript:void(0);" onclick="addItem(this);">
                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" border="0" /></a>
                        <a href="javascript:void(0);" onclick="removeItem(this);">
                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" border="0" /></a>
                    </li>
                </ul>
			</td>
		</tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="isLayoutsGroups" value="1" />
			</td>
		</tr>
	</table>
    </form>
	</script>
	<script type="text/javascript">
	<!--//
	$(function() {
		$('#toggleMenus').on('change', function() {
			window.location.href = "{$vir_cp_path}index.php?m=layoutsgroups&id="+ $(this).val();
		});
    });
	function addItem(obj) {
		var $this = $(obj).closest('li');
		$this.after($this.closest('ul').children('li:last').clone().find('.inputText').val('').closest('li'));
	}
	function removeItem(obj) {
		if (confirm('Are you sure?')) {
			$(obj).parent().remove();
		}
	}
	function moveItem(obj, move) {
		var el = $(obj).parent();

		if (move == 'up' && $(el).prev().is('li') == true) {
			$(el).insertBefore($(el).prev());
		}
		else if (move == 'down' && $(el).next().is('li') == true) {
			$(el).insertAfter($(el).next());
		}
	}
	//-->
	</script>
	{/if}
{include file='footer.tpl'}