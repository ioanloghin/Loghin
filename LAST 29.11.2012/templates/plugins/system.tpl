<div id="system" class="hide">
	<ul class="clear">
		<li class="left">
			<span>Loghin System</span>
			<ul>
				<li>
					<a href="#">System Menu A</a>
					<ul>
						<li><a href="#">System Menu A 1</a></li>
						<li><a href="#">System Menu A 2</a></li>
						<li><a href="#">System Menu A 3</a></li>
						<li><a href="#">System Menu A 4</a></li>
					</ul>
				</li>
				<li>
					<a href="#">System Menu B</a>
					<ul>
						<li><a href="#">System Menu B 1</a></li>
						<li><a href="#">System Menu B 2</a></li>
						<li><a href="#">System Menu B 3</a></li>
						<li><a href="#">System Menu B 4</a></li>
					</ul>
				</li>
				<li>
					<a href="#">System Menu C</a>
					<ul>
						<li><a href="#">System Menu C 1</a></li>
						<li><a href="#">System Menu C 2</a></li>
						<li><a href="#">System Menu C 3</a></li>
						<li><a href="#">System Menu C 4</a></li>
					</ul>
				</li>
				<li>
					<a href="#">System Menu D</a>
					<ul>
						<li><a href="#">System Menu D 1</a></li>
						<li><a href="#">System Menu D 2</a></li>
						<li><a href="#">System Menu D 3</a></li>
						<li><a href="#">System Menu D 4</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li class="right">
			<span>Loghin Users</span>
			<ul class="member-types">
			{foreach $memberTypes AS $type}
				<li><a data-id="{$type@key}" href="#">{$type}</a></li>
			{/foreach}
			</ul>
		</li>
	</ul>
	<a class="icon top disabled" href="javascript:void(0);">&nbsp;</a>
	<div class="overflow">
		<div class="list">
		</div>
	</div>
	<a class="icon bottom disabled" href="javascript:void(0);">&nbsp;</a>
</div><!-- #sites -->