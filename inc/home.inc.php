<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/home.css"/>
    </head>

    <body>
        <div class="container">
            <form method="post" class="squish-input">
                <div class="logo"></div>
                <div class="inline-fix">
                    <input type="text" name="url" />
                    <input type="submit" />
                </div>
                <p>
                    <?php
                    // Only need to check if one value is set
                    if(isset($squished_url)) {
                        echo "<small>{$long_url}</small> <a href='{$squished_url}'>{$squished_url}</a>";
                    }
                    ?>
                </p>
            </form>
        </div>
    </body>
</html>
