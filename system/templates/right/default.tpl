<div class="block-nav">
	<a class="selected" href="#">Source</a> &nbsp;|&nbsp;
	<a href="#">Structure</a> &nbsp;|&nbsp;
	<a href="#">Information</a>
</div>

{if false === empty($showRightInfo)}<dl class="info">
	<dt>Model</dt>
	<dd>
		<div class="clear">
			<span class="left">Name:</span>
			<span class="right">Lorem Ipsum</span>
		</div>
	</dd>

	<dt>Author</dt>
	<dd>
		<div class="clear">
			<span class="left">Name:</span>
			<span class="right">Lorem Ipsum</span>
		</div>
	</dd>

	<dt>Albums</dt>
	<dd>
		<div class="clear">
			<span class="left">Lorem Ipsum:</span>
			<span class="right">02/05/2012</span>
		</div>
		<div class="clear">
			<span class="left">Gallery:</span>
			<span class="right">5.260 Items</span>
		</div>
	</dd>

	<dt>Details</dt>
	<dd>
		<div class="clear">
			<span class="left">Submitted:</span>
			<span class="right">02/05/2012</span>
		</div>
		<div class="clear">
			<span class="left">Image Size:</span>
			<span class="right">4.1 MB</span>
		</div>
		<div class="clear">
			<span class="left">Resolution:</span>
			<span class="right">3750x3000</span>
		</div>
	</dd>

	<dt>Device data</dt>
	<dd>
		<div class="clear">
			<span class="left">Make:</span>
			<span class="right">Canon</span>
		</div>
		<div class="clear">
			<span class="left">Model:</span>
			<span class="right">Canon EOS 60 D</span>
		</div>
	</dd>
</dl>{/if}

<div class="block-nav">
	<a class="selected" href="#">Preference</a> &nbsp;|&nbsp;
	<a href="#">Statistics</a> &nbsp;|&nbsp;
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
			<a href="#submit">Save<i></i></a>
		</div>
	</div>
</div>