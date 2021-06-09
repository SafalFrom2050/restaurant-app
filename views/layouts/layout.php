<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles.css"/>
    <title><?php echo isset($title) ? $title : "Kate's Kitchen" ?></title>
</head>
<body>
<header>
    <section>
        <aside>
            <h3>Opening times:</h3>
            <p>Sun-Thu: 12:00-22:00</p>
            <p>Fri-Sat: 12:00-23:30</p>
        </aside>
        <h1>Kate's Kitchen</h1>

    </section>
</header>
<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li>Menu
            <ul>
                <br>
                <?php require COMPONENTS_PATH.'sidebar-li.php'?>
            </ul>
        </li>
        <li><a href="/faqs">FAQs</a></li>
        <li>More
            <ul>
                <br>
                <li><a href="/about">About Us</a></li>
                <li><a href="/booking">Booking</a></li>
                <li><a href="/admin">Staff and Admins</a></li>
            </ul>
        </li>

    </ul>

</nav>
<img src="/images/randombanner.php"/>

<main class="<?php echo isset($layoutStyle) ? $layoutStyle : '' ?>">
    <?php echo isset($content) ? $content : '' ?>
</main>

<footer>
    &copy; Kate's Kitchen <?php echo date("Y"); ?>
</footer>
</body>
</html>
