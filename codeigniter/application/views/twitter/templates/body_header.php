</head>
<body>
<div id="main">
<div id="top_bar">
    <?php
        if ($username != ""){
            echo $username;
            echo '　　　　';
            echo '<a href="http://vagrant-codeigniter.local/signout" style="text-decoration: none"><font color="ffffff">ログアウト</font></a>';
        }
    ?>
</div>
<div id="content">
