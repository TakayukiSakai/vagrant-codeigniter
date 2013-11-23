<?php echo validation_errors(); ?>

<?php echo form_open('twitter/home') ?>

    <textarea name="text" rows="5" cols="50"></textarea><br />

    <input type="submit" name="tweet" value="ツイート" />

</form>
