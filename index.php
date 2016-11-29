<html>
<head>
    <title>Hello Kubernetes</title>
</head>
<body>

<h1>Demo App</h1>

<p>
    <a href=phpinfo.php>phpinfo</a>
</p>

<p>
    <a href=host.php>hostname</a>
</p>

<p>
    <form method=get action=echo.php>
        <input type=submit value="Echo"/> <input type=text name="text" value="Some text here"/>
    </form>
</p>

<p>
    <form method=get action=env.php>
        <input type=submit value="Env var"/> <input type=text name="var" value="Env var name"/>
    </form>
</p>

<p>
    <form method=get action=fibonacci.php>
        <input type=submit value="Fibonacci"/> <input type=text name="value" value="5"/>
    </form>
</p>

<p>
    <form method=get action=log.php>
        <input type=submit value="Logger"/> <input type=text name="lines" value="100"/>
    </form>
</p>

<hr>
Version: <a href="version.php"><?php include 'version.php'; ?></a>

</body>
</html>
