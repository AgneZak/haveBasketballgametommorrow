<?php
$nav = [
    'links' => [
        'Home' => 'index.php',
        'About' => 'about.php',
        'Statistics' => 'statistics.php',
        'Contact us' => 'contact.php',
    ]
];
?>
<nav>
    <ul>
        <?php foreach ($nav['links'] as $name => $link): ?>
            <li><a href="<?php print $link ?>"><?php print $name ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>