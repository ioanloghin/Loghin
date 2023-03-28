{include file='header.tpl'}
	{if $hideContent != 1}
	<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
		<tr>
			<td class="gridTabs">
	           	<a href="javascript:void(0);" onclick="$('#rowExtensions').toggle();">{'manage_extensions'|lang}</a>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowExtensions">
		<tr>
			<td class="gridValue">
				<ul class="field_items">
                	{if false === empty($items)}
                    	{foreach $items AS $item}
                        <li>
                            <input class="inputText" style="width:350px" type="text" name="items[][{$item@key}]" value="{$item}" />
                            <a href="javascript:void(0);" onclick="moveItem(this, 'down');">
                            <img src="{$vir_tpl_path}media/options/move_down.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="moveItem(this, 'up');">
                            <img src="{$vir_tpl_path}media/options/move_up.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="addItem(this);">
                            <img src="{$vir_tpl_path}media/options/add.gif" align="absmiddle" /></a>
                            <a href="javascript:void(0);" onclick="removeItem(this);">
                            <img src="{$vir_tpl_path}media/options/delete.gif" align="absmiddle" /></a>
                    	{/foreach}
                    {/if}
                    <li>
                        <input class="inputText" style="width:350px" type="text" name="items[][0]" value="" />
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
				<input type="hidden" name="isExtensions" value="1" />
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