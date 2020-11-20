<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Docker development environment</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="container-body">
        <section>
            <div class="head">
                <h1 class="title">
                    < localhost>
                        <img src="/assets/docker-logo.png" width="100" />
                </h1>
                <h2 class="subtitle">
                    Docker development environment
                </h2>
            </div>
            <hr />
            <hr />
        </section>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <h3 class="title">Environment:</h3>
                        <hr />
                        <div class="content">
                            <ul>
                                <li><?= apache_get_version(); ?></li>
                                <li>PHP <?= phpversion(); ?></li>
                                <li>
                                    <?php
                                    $link = mysqli_connect("mysql", "root", "password", null);

                                    if (mysqli_connect_errno()) {
                                        printf("MySQL connecttion failed: %s", mysqli_connect_error());
                                    } else {
                                        printf("MySQL Server %s", mysqli_get_server_info($link));
                                    }
                                    $res = mysqli_query($link, "SHOW DATABASES");
                                    ?>
                                    <h4>Databases:</h4>
                                    <ul>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            echo "<li>" . $row['Database'] . "</li>";
                                        }
                                        mysqli_close($link);
                                        ?>
                                        <ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="column">
                        <h3 class="title">Quick Links:</h3>
                        <hr>
                        <div class="content">
                            <ul>
                                <li><a href="http://localhost/phpinfo.php">phpinfo()</a></li>
                                <li><a href="http://localhost:8080">phpMyAdmin</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>