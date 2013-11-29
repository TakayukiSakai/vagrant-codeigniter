
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript">

        var stored_time = "2100-12-31 11:59:59";
        getTweet();

        $(document).ready(function ()
        {
            $("#get_tweet_btn").click(getTweet);
        });

        function getTweet()
        {
            $.ajax({
                type : "post",
                dataType : "json",
                url : "/gettweet",
                data : {
                    "stored_time" : stored_time
                },
                success : function(data)
                {
                    var i = 0;
                    if (data.length != 0){
                        for(i = 0; i < data.length; i++){
                            $("#tweet_list").append(createTweetHTML(
                                data[i]['username'],
                                data[i]['time'],
                                data[i]['text']
                            ));
                        }
                        //取得したツイート時刻を更新
                        stored_time = data[i-1]['time'];
                    }
                    if (data.length < 10){
                        document.getElementById("no_tweet").style.display = "inline";
                        document.getElementById("get_tweet_btn").disabled = "true";
                    }
                }
            });
        }

        function createTweetHTML(name, time, text){
            var return_HTML = '';
            return_HTML += '<div class="tweet"><div class="tweet_title"><div class="username">';
            return_HTML += name;
            return_HTML += '</div><div class="time">';
            return_HTML += time;
            return_HTML += '</div></div><div class="tweet_text">';
            return_HTML += text;
            return_HTML += '</div></div>';
            return return_HTML;
        }
    </script>
