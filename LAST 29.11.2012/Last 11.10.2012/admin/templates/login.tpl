<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{if $app_page}{$app_page} | {/if}{$app_title}</title>
{stylesheets}{scripts}	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body leftmargin="0" topmargin="0">
<table width="100%" cellpadding="0" cellspacing="0" class="headerMenuTable">
	<tr>
		<td class="headerMenuRow1" width="100%">
			<h1>{$app_title}</h1>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="100%" valign="top" style="padding-top: 128px">
			{if $msgType == 'error'}
				<table width="400" cellpadding="0" cellspacing="0" style="margin:0px auto"><tr><td>
					{include file='error.tpl'}
				</td></tr></table>
			{/if}
			<table cellpadding="0" cellspacing="1" width="400" class="gridTable" style="margin:0px auto">
				<form method="post" action="" name="loginform">
				<tr>
					<td class="gridHeader" colspan="2" nowrap>
						{'login'|lang}
					</td>
				</tr>
				<tr>
					<td class="gridRow1" nowrap>
						{'username'|lang}
					</td>
					<td width="100%" class="gridRow1">
						<input maxlength="32" size="30" type="text" name="username" value="" class="inputText" />
					</td>
				</tr>
				<tr>
					<td class="gridRow1" nowrap>
						{'password'|lang}
					</td>
					<td width="100%" class="gridRow1">
						<input maxlength="32" size="30" type="password" name="password" value="" class="inputText" />
					</td>
				</tr>
				<tr>
					<td class="gridRow1" colspan="2" nowrap>
						<label for="nonxpcookie"><input type="checkbox" name="nonxpcookie" id="nonxpcookie" class="inputCheck" /> {'remember_me'|lang}</label>
					</td>
				</tr>
				<tr>
					<td class="gridFooter" colspan="2">
						<input type="submit" name="login" value="{'submit'|lang}" class="inputSubmit" />
						<input type="hidden" name="islogin" value="1" />
					</td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
</table>
</body>
</html>