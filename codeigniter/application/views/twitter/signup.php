<?php
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $address = isset($_POST['address']) ? $_POST['address'] : "";
    $pass = isset($_POST['pass']) ? $_POST['pass'] : "";
?>

<h2>ユーザー登録</h2>

<?php echo $message ?>
<br />
<?php echo validation_errors(); ?>

<?php echo form_open('twitter/signup') ?>

    <label for="name">名前</label>
    <input type="input" name="name" value=<?php echo $name ?> ></input><br />

    <label for="address">メールアドレス</label>
    <input type="input" name="address" value=<?php echo $address ?> ></input><br />

    <label for="pass">パスワード</label>
    <input type="password" name="pass" value=<?php echo $pass ?> ></input><br />

    <input type="submit" name="signup" value="登録する" />

</form>

