
<div id="tweet_form">

    <?php echo form_open('tweet', array('id' => 'CI_form')); ?>

        <textarea name="tweet_text" id="tweet_text" rows="5" cols="40" style="font-size:16px"></textarea><br />

        <input type="submit" name="tweet_btn" id="tweet_btn" value="ツイート" disabled="disabled" /><div id="count">140</div>
        <div id="tweet_error"></div>

    </form>
</div>

<div id="tweet_right">
    <div id="tweet_list"></div>
    <button id="get_tweet_btn">もっと見る</button>
    <span id="no_tweet">これ以前のツイートはありません。</span>
</div>

