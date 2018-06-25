<html>
    <head>
    </head>

    <body>
        <form method="post">
            <input type="text" name="url" />
            <input type="submit" />
        </form>
        <p>
            <?= $squished_url ?? ""; ?>
        </p>
    </body>
</html>
