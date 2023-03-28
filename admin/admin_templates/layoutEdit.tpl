{include file='header.tpl'}
	{if $hideContent != 1}
	<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="0" cellspacing="0" width="100%" class="gridTable gridBorder" style="margin-bottom:0px;border-bottom:0px">
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
			<td class="gridLabels" style="width:100px">
				{'type'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue">
				<select class="inputCombo" name="type">
					{html_options options=$types selected=$type}
				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				{'group'|lang} <span class="required">*</span>
			</td>
			<td class="gridValue">
				<select class="inputCombo" name="group">
					<option value="">{'select_group'|lang}</option>
					{foreach $groups AS $layout}
						<optgroup label="{$layout.name}">
						{foreach $layout.items AS $_layout}
							<optgroup label=" &nbsp; &nbsp;{$_layout.name}">
							{if $_layout.items}{foreach $_layout.items AS $_group}
								<optgroup label=" &nbsp; &nbsp; &nbsp; &nbsp;{$_group.name}">
								{if $_group.items}{foreach $_group.items AS $__group}
									<option value="{$__group@key}"{if $__group@key == $group} selected="selected"{/if}> &nbsp; &nbsp; &nbsp; &nbsp;{$__group}</option>
								{/foreach}{/if}
								</optgroup>
							{/foreach}{/if}
							</optgroup>
						{/foreach}
						</optgroup>
					{/foreach}
				</select>
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
            	{'name'|lang} <span class="required">*</span>
            </td>
			<td class="gridValue">
			{foreach $name AS $lang => $value}
				<input class="inputText lang__{$lang}{if $sys_lang != $lang} hide{/if}" type="text" name="name[{$lang}]" value="{$value}" />
			{/foreach}
			</td>
		</tr>
		<tr>
			<td class="gridLabels">
				{'details'|lang}
			</td>
			<td class="gridValue">
			{foreach $details AS $lang => $value}
				<input class="inputText lang__{$lang}{if $sys_lang != $lang} hide{/if}" style="width:700px" type="text" name="details[{$lang}]" value="{$value}" maxlength="255" />
			{/foreach}
			</td>
		</tr>
		<tr>
			<td class="gridLabels">{'url'|lang}</td>
			<td class="gridValue">
				<input class="inputText" type="text" name="url" value="{$url}" />
			</td>
		</tr>
        {if $lastImage}<tr>
        	<td class="gridLabels">
            	{'last_image'|lang}
            </td>
            <td class="gridValue">
            	<img src="{$vir_pic_path}www/layouts/{$lastImage}" alt="" />
            </td>
        </tr>{/if}
        <tr>
        	<td class="gridLabels">
            	{'image'|lang}
            </td>
            <td class="gridValue">
            	<input class="inputFile" type="file" name="image" value="" />
            </td>
        </tr>
		<tr>
        	<td class="gridTabs" colspan="2"><strong>{'actions'|lang}</strong></td>
        </tr>
        {if $showParent}<tr>
        	<td class="gridLabels">
        		{'parent'|lang}
        	</td>
        	<td class="gridValue">
        	{foreach $parents AS $_type => $_parents}
        		<div{if $_type != $type} class="hide"{/if} id="parent_{$_type}">
	        		<select class="inputCombo" name="parent[{$_type}]">
	        			<option value="">{'select_option'|lang}</option>
	        			{html_options options=$_parents selected=$parent}
	        		</select>
        		</div>
        	{/foreach}
        	</td>
        </tr>{/if}
        <tr>
        	<td class="gridLabels">
            	{'status'|lang}
            </td>
            <td class="gridValue">
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
	    var group = $('select[name="group"]').closest('tr');
    	$('select[name="type"]').bind('change', function() {
    		if ($('#parent_'+ $(this).val()).length) {
    			$('div[id*="parent_"]').addClass('hide');
    			$('#parent_'+ $(this).val()).removeClass('hide');
    		}
    	});
	    $('select[name^="parent"]').on('change', function() {
		    if ($(this).val() != 0) {
			    group.hide();
            }
		    else {
			    group.show();
            }
	    }).parent(':not(.hide)').find('select').trigger('change');
    });
    </script>
	{/if}
{include file='footer.tpl'}