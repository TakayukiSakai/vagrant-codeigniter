<div id="tweet_form">

    <?php echo validation_errors(); ?>

    <?php echo form_open('mypage') ?>

        <textarea name="tweet_text" rows="5" cols="40" style="font-size:16px"></textarea><br />

        <input type="submit" name="tweet_btn" value="ツイート" />

    </form>
</div>

<div id="tweet_list">
<!--
<div class="tweet">
    <div class="tweet_title">
        <div class="username">ユーザー名</div>
        <div class="time">ツイート時刻</div>
    </div>
    <div class="tweet_text">
私は東京大学工学部計数工学科の学生です。東京に引っ越してきてからもう３年半が経ちました。
    </div>
</div>
<div class="tweet">
    <div class="tweet_title">
        <div class="username">ユーザー名</div>
        <div class="time">ツイート時刻</div>
    </div>
    <div class="tweet_text">
私は東京大学工学部計数工学科の学生です。
    </div>
</div>
-->
</div>

<button id="get_tweet_btn">
もっと見る
</button>
<span id="no_tweet">これ以前のツイートはありません。</span>

