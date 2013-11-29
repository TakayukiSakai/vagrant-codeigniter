<?php
    $title = isset($title) ? $title : "No Title";
    $username = isset($username) ? $username : "";
    header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="http://vagrant-codeigniter.local/css/style.css" />
    <title><?php echo $title ?> -- MyTwitter</title>
    <script type="text/javascript">
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>
