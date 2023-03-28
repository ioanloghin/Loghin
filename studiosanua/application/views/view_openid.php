<html>
<head>
    <title>PHP OpenID Authentication Example</title>
    
    <style>
        * { font-family: verdana,sans-serif; }
        body { width: 50em; margin: 1em; }
        div { padding: .5em; }
        table { margin: none; padding: none; }
        .alert { border: 1px solid #e7dc2b; background: #fff888; }
        .success { border: 1px solid #669966; background: #88ff88; }
        .error { border: 1px solid #ff0000; background: #ffaaaa; }
        #verify-form { border: 1px solid #777777; background: #dddddd; margin-top: 1em; padding-bottom: 0em; }
    </style>
</head>

<body>
	PHP OpenID Authentication Example
    
    This example consumer uses the PHP OpenID library. It just verifies that the URL that you enter is your identity URL. 
    
    <?php if (isset($msg)) { echo "$msg"; } ?> <?php if (isset($error)) { echo "$error"; } ?> <?php if (isset($success)) { echo "$success"; } ?> <form method="post" action="">
    Identity URL: <input type="hidden" name="action" value="verify" />
    <input type="text" name="openid_identifier" value="" />
    Optionally, request these PAPE policies:
    <?php foreach($pape_policy_uris as $i => $uri):
    ?> <input type="checkbox" name="policies[]" value="<?php echo $uri; ?>" /> <?php echo $uri; ?>
    <?php endforeach; ?> 
    
    <input type="submit" value="Verify" /> </form> 

</body>
</html>