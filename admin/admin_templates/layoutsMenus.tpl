{include file='header.tpl'}
	{if $hideContent != 1}
	<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs">
	           	<a href="javascript:void(0);" onclick="$('#rowLayoutsMenus').toggle();">{'manage_layouts_menus'|lang}</a>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowLayoutsMenus">
		<tr>
			<td class="gridValue">
				<h3>Left</h3>
				<ul class="field_items">
                	{if false === empty($fields.left)}
                    	{foreach $fields.left AS $menu_id => $name}
                        <li>
                            <input class="inputText" style="width:350px" type="text" name="items[left][][{$menu_id}]" value="{$name}" />
                            <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                            <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                            <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="addItem(this);">
                            <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="removeItem(this);">
                            <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
	                        <ul>
	                        {if false === empty($items[$menu_id])}
	                            {foreach $items[$menu_id] AS $item_id => $item}
                                <li>
			                        <input class="inputText" style="width:350px" type="text" name="items[{$menu_id}][][{$item_id}]" value="{$item}" />
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
			                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
			                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="addItem(this);">
			                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="removeItem(this);">
			                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
	                                <a href="{$vir_cp_path}index.php?m=layoutsgroups&id={$item_id}"><img src="{$vir_tpl_path}media/options/fields.gif" align="absmiddle" /></a>
			                    </li>
		                        {/foreach}
	                        {/if}
		                        <li>
			                        <input class="inputText" style="width:350px" type="text" name="items[{$menu_id}][][0]" value="" />
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
			                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
			                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="addItem(this);">
			                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="removeItem(this);">
			                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
			                    </li>
		                    </ul>
                        </li>
                    	{/foreach}
                    {/if}
                    <li>
                        <input class="inputText" style="width:350px" type="text" name="items[left][][0]" value="" />
                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="addItem(this);">
                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="removeItem(this);">
                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
                    </li>
                </ul>
				<h3>Right</h3>
				<ul class="field_items">
                	{if false === empty($fields.right)}
                    	{foreach $fields.right AS $menu_id => $name}
                        <li>
                            <input class="inputText" style="width:350px" type="text" name="items[right][][{$menu_id}]" value="{$name}" />
                            <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                            <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                            <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="addItem(this);">
                            <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="removeItem(this);">
                            <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
	                        <ul>
	                        {if false === empty($items[$menu_id])}
	                            {foreach $items[$menu_id] AS $item_id => $item}
                                <li>
			                        <input class="inputText" style="width:350px" type="text" name="items[{$menu_id}][][{$item_id}]" value="{$item}" />
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
			                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
			                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="addItem(this);">
			                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="removeItem(this);">
			                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
	                                <a href="{$vir_cp_path}index.php?m=layoutsgroups&id={$item_id}"><img src="{$vir_tpl_path}media/options/fields.gif" align="absmiddle" /></a>
			                    </li>
		                        {/foreach}
	                        {/if}
		                        <li>
			                        <input class="inputText" style="width:350px" type="text" name="items[{$menu_id}][][0]" value="" />
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
			                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
			                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="addItem(this);">
			                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
			                        <a href="javascript:void(0);" onclick="removeItem(this);">
			                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
			                    </li>
		                    </ul>
                        </li>
                    	{/foreach}
                    {/if}
                    <li>
                        <input class="inputText" style="width:350px" type="text" name="items[right][][0]" value="" />
                        <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                        <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                        <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="addItem(this);">
                        <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
                        <a href="javascript:void(0);" onclick="removeItem(this);">
                        <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
                    </li>
                </ul>
			</td>
		</tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="isLayoutsMenus" value="1" />
			</td>
		</tr>
	</table>
    </form>
	<script type="text/javascript">
	<!--//
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