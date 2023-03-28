jQuery.fn.extend(
{
	carousel: function(params)
	{
		var options =  {
			move: 2,
			back: false,
			next: false,
		}
		var options = jQuery.extend(options, params);

		return this.each(function()
		{
		
			alert('este?');
		});
	}
});