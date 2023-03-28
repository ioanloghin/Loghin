function pop2close(tree_refresh, id_tree, id_user, direction)
{
	if(tree_refresh == 1)
	{
		sURL = ROOT;
		sURL += 'tree-'+id_tree+'/';
		if(id_user > 0)
			sURL += id_user+'/';
		if(direction)
			sURL += direction;
		parent.location = sURL;
	}
	else
		pop2operation('close', '');
	
	
}