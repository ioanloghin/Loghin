{include file='header.tpl'}
	{if $hideContent != 1}
	<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0;border-bottom:0">
		<tr>
			<td class="gridTabs" style="padding:2px 8px">
                <div class="clear">
                	<div class="left" style="padding:6px 0">
                    	<a href="javascript:void(0);" onclick="$('#rowNew').toggle();">{$appPage}</a>
                  	</div>
                    <div class="right">
                    	<select class="inputCombo" id="toggleLanguage">
                        	{html_options options=$languages selected=$sys_lang}
                        </select>
                    </div>
              	</div>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable" id="rowNew">
		<tr>
			<td class="gridLabels">
				{'member_type'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue" colspan="2">
				<select class="inputCombo" name="member_type">
					<option value="">{'select_member_type'|lang}</option>
					{html_options options=$memberTypes selected=$member_type}
				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
            	{'name'|lang} <span class="required">*</span>
            </td>
			<td class="gridValue" colspan="2">
			{foreach $name AS $lang => $value}
				<input class="inputText lang__{$lang}{if $sys_lang != $lang} hide{/if}" type="text" name="name[{$lang}]" value="{$value}" />
			{/foreach}
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
	    <tr>
	        <td class="gridHeader" width="50%">{'sites'|lang}</td>
	        <td class="gridHeader" width="50%">{'applications'|lang}</td>
	    </tr>
		<tr id="items">
			<td class="gridValue">
				<ul class="field_items site">
				{if $_items.site}
					{foreach $_items.site AS $item}
					<li><label><input type="checkbox" name="items[]" value="{$item@key}"{if in_array($item@key, $items)} checked="checked"{/if} /> {$item}</label></li>
					{/foreach}
				{/if}
				</ul>
			</td>
			<td class="gridValue">
				<ul class="field_items application">
				{if $_items.application}
					{foreach $_items.application AS $item}
					<li><label><input type="checkbox" name="items[]" value="{$item@key}"{if in_array($item@key, $items)} checked="checked"{/if} /> {$item}</label></li>
					{/foreach}
				{/if}
				</ul>
			</td>
		</tr>
	</table>
	<table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
        	<td class="gridTabs" colspan="3"><strong>{'actions'|lang}</strong></td>
        </tr>
        <tr>
        	<td class="gridLabels">
            	{'status'|lang}
            </td>
            <td class="gridValue" colspan="2">
            	<select class="inputCombo" name="status">
                	{html_options options=$statuse selected=$status}
                </select>
            </td>
        </tr>
   	</table>
    <table cellpadding="0" cellspacing="1" width="100%" class="gridTable">
		<tr>
			<td class="gridFooter">
				<input class="inputSubmit" type="submit" name="submit" value="{'submit'|lang}" />
				<input type="hidden" name="isLayout" value="1" />
			</td>
		</tr>
	</table>
    </form>
    <script type="text/javascript">
    $(function() {
    	$('select[name="member_type"]').bind('change', function() {
    		var $this = $(this);
		    $.post($.conf.path +'index.php?m=layouts&p=items', { 'id': $this.val() }, function(data) {
			    if (typeof data.site == 'object' && typeof data.application == 'object') {
				    $.each(data, function(key, items) {
					    /* Set tag */
					    var tag = $('#items').find('.'+ key).html('');
					    $.each(items, function(id, name) {
						    tag.append('<li><label><input type="checkbox" name="items[]" value="'+ id +'" /> '+ name +'</label></li>');
					    });
				    });
                }
		    }, 'json');
    	});
		$('#items').on('click check', 'input', function() {
			var $this = $(this).parents('ul');
			if ($this.find(':checked').length >= 6) {
				$this.find(':not(:checked)').attr('disabled', true);
            }
			else {
				$this.find(':disabled').attr('disabled', false);
            }
		}).find('input').trigger('check');
    });
    </script>
	{/if}
{include file='footer.tpl'}