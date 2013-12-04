
<div id="tweet_form">

    <?php echo form_open('tweet', array('id' => 'CI_form')); ?>

        <textarea name="tweet_text" id="tweet_text" rows="6" cols="45" style="font-size:16px"></textarea><br />

        <input type="submit" name="tweet_btn" id="tweet_btn" value="ツイート" disabled="disabled" /><div id="count">140</div>
        <div id="tweet_error"></div>

    </form>
</div>

<div id="tweet_right">
    <div id="tweet_list"></div>

    <?php echo form_open('gettweet', array('id' => 'CI_get_tweet')); ?>

        <input type="hidden" name="stored_time" value="2100-12-31 11:59:59" />
        <input type="submit" id="get_tweet_btn" value="もっと見る" />
        <div id="no_tweet">これ以前のツイートはありません。</div>
    </form>
</div>

