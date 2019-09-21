<?php

global $Wcms;

/* Little bit janky, but okay */
if(isset($_GET["cookies"]) && $_GET["cookies"] == "accept") {
    setCookie("cookies", "accept", strtotime("+1year"), "/");
    header("location: ?");
    die();
}

function addCss($args) {
    global $Wcms;
    if($Wcms->loggedIn) return $args;

    $args[0] .= "<link rel='stylesheet' href='plugins/addon-cookie-message/css/cookie-message.css'>";

    return $args;
}

function createMessage($args) {
    global $Wcms;
    if($Wcms->loggedIn) return $args;

    if(!isset($_COOKIE["cookies"])) {
        $args[0] .= <<<HTML
        <div class="cookie-consent">
            <div class="cookie-message">
                This site uses cookies. By continuing your visit you accept these cookies.

                <a href="?cookies=accept">Close this message</a>
            </div>
        </div>
HTML;
    }

    return $args;
}

$Wcms->addListener("js", "createMessage");
$Wcms->addListener("css", "addCss");

?>
