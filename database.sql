<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>Login - Adminer</title>
<link rel="stylesheet" type="text/css" href="adminer.php?file=default.css&amp;version=4.6.1&amp;driver=mysql">
<script src='adminer.php?file=functions.js&amp;version=4.6.1&amp;driver=mysql' nonce="ZDhhNzljMTM4YzYzN2UzYWYwMTFlYjk4ODcxNzJjMDc="></script>
<link rel="shortcut icon" type="image/x-icon" href="adminer.php?file=favicon.ico&amp;version=4.6.1&amp;driver=mysql">
<link rel="apple-touch-icon" href="adminer.php?file=favicon.ico&amp;version=4.6.1&amp;driver=mysql">
<link rel="stylesheet" type="text/css" href="adminer.css">

<body class="ltr nojs">
<script nonce="ZDhhNzljMTM4YzYzN2UzYWYwMTFlYjk4ODcxNzJjMDc=">
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = 'You are offline.';
var thousandsSeparator = ',';
</script>

<div id="help" class="jush-sql jsonly hidden"></div>
<script nonce="ZDhhNzljMTM4YzYzN2UzYWYwMTFlYjk4ODcxNzJjMDc=">mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});</script>

<div id="content">
<h2>Login</h2>
<div id='ajaxstatus' class='jsonly hidden'></div>
<div class='error'>Access denied for user &#039;root&#039;@&#039;localhost&#039; (using password: NO)<br>Master password expired. <a href="https://www.adminer.org/en/extension/" target="_blank" rel="noreferrer noopener">Implement</a> <code>permanentLogin()</code> method to make it permanent.</div>
<form action='' method='post'>
<div></div>
<table cellspacing="0">
<tr><th>System<td><input type='hidden' name='auth[driver]' value='server'>MySQL
<tr><th>Server<td><input name="auth[server]" value="" title="hostname[:port]" placeholder="localhost" autocapitalize="off">
<tr><th>Username<td><input name="auth[username]" id="username" value="root" autocapitalize="off">
<tr><th>Password<td><input type="password" name="auth[password]">
<tr><th>Database<td><input name="auth[db]" value="nfq" autocapitalize="off">
</table>
<script nonce="ZDhhNzljMTM4YzYzN2UzYWYwMTFlYjk4ODcxNzJjMDc=">focus(qs('#username'));</script>
<p><input type='submit' value='Login'>
<label><input type='checkbox' name='auth[permanent]' value='1'>Permanent login</label>
</form>
</div>

<div id="menu">
<h1>
<a href='https://www.adminer.org/' target="_blank" rel="noreferrer noopener" id='h1'>Adminer</a> <span class="version">4.6.1</span>
<a href="https://www.adminer.org/#download" target="_blank" rel="noreferrer noopener" id="version"></a>
</h1>
</div>
<script nonce="ZDhhNzljMTM4YzYzN2UzYWYwMTFlYjk4ODcxNzJjMDc=">setupSubmitHighlight(document);</script>
