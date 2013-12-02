<h2>ユーザー登録</h2>

<?php echo $message ?>
<br />
<?php echo validation_errors(); ?>

<?php echo form_open('signup') ?>

    <label for="name">名前</label>
    <input type="input" name="name" value=<?php echo set_value('name'); ?> ></input><br />

    <label for="address">メールアドレス</label>
    <input type="input" name="address" value=<?php echo set_value('address'); ?> ></input><br />

    <label for="pass">パスワード</label>
    <input type="password" name="pass" value=<?php echo set_value('pass'); ?> ></input><br />

    <input type="submit" name="signup" value="登録する" />

</form>

