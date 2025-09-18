<?php
$pages = [
    "home" => "index.php",
    "school" => "index.php?page=school",
    "work" => "index.php?page=work",
    "hobbies" => "index.php?page=hobbies",
    "contact" => "index.php?page=contact",
	"results" => "index.php?page=results",
	"login" => "index.php?page=login"
];

foreach ($pages as $name => $link) {
    $class = ($page == $name) ? ' class="current"' : '';
    echo "<li{$class}><a href=\"$link\" title=\"$name\">" . ucfirst($name) . "</a></li>";
}
?>