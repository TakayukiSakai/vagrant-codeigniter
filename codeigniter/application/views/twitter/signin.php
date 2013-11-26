<?php
    $address = isset($_POST['address']) ? $_POST['address'] : "";
    $pass = isset($_POST['pass']) ? $_POST['pass'] : "";
?>

<h2>ログインして下さい</h2>

<?php echo $message ?>
<br />
<?php echo validation_errors(); ?>

<?php echo form_open('twitter/signin') ?>

    <label for="address">メールアドレス</label>
    <input type="input" name="address" value=<?php echo $address ?> ></input><br />

    <label for="pass">パスワード</label>
    <input type="password" name="pass" value=<?php echo $pass ?> ></input><br />

    <input type="submit" name="signin" value="ログインする" /><br /><br />

</form>

<p><a href="../twitter/signup">ユーザー登録する</a></p>

