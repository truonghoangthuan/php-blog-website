<?php
require_once("/php/php-blog-website/php/db-connector.php");

if (isset($_POST['create'])) {
    $title = textboxValue("title");
    $content = textboxValue("content");

    echo $title . " " . $content;

    if ($title && $content) {
        $sql = "insert into blog(blog_title, blog_content) values('$title','$content')";

        if (mysqli_query($GLOBALS['conn'], $sql)) {
            sendNotification("success", "Inserted record");
        } else {
            sendNotification("error", "Please insert data");
        }
    } else {
        sendNotification("error", "Please insert data");
    }
}

function textboxValue($value)
{
    $validation = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));
    if (empty($validation)) {
        return false;
    } else {
        return $validation;
    }
}

function sendNotification($classname, $text)
{
    $noti = "<h6 class='$classname'>$text</h6>";
    echo $noti;
}
