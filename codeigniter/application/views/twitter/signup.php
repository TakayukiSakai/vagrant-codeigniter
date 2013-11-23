<h2>ユーザー登録</h2>

<?php echo $message ?>
<br />
<?php echo validation_errors(); ?>

<?php echo form_open('twitter/signup') ?>

    <label for="name">名前</label>
    <input type="input" name="name" /><br />

    <label for="address">メールアドレス</label>
    <input type="input" name="address" /><br />

    <label for="pass">パスワード</label>
    <input type="password" name="pass" /><br />

    <input type="submit" name="signup" value="登録する" />

</form>

