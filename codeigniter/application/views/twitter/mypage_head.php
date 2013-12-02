
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="/js/datetime.min.js"></script>
    <script type="text/javascript">

        var stored_time = "2100-12-31 11:59:59";
        getTweet();
        var timerID = setInterval("updateTime()", 60 * 1000);

        $(function ()
        {
            $("#tweet_text").bind("keyup", function(event)
            {
                var current_length = $("#tweet_text").val().length;
                $("#count").html(140 - current_length);
                if (current_length == 0 || current_length > 140){
                    $("#tweet_btn").attr("disabled", "disabled");
                }else{
                    $("#tweet_btn").removeAttr("disabled");
                }
            });
        });

        $(function ()
        {
            $("#CI_form").submit(function (event)
            {
                event.preventDefault();
                var text = $("#tweet_text").val();
                $.post(
                    $("#CI_form").attr("action"),
                    $("#CI_form").serialize(),
                    function (data)
                    {
                        if (data['check'] === false){
                            $("#tweet_error").html(data["msg"]);
                        }else{
                            $("#tweet_error").html("");
                            $("#tweet_list").prepend(createTweetHTML(
                                data['username'],
                                data['time'],
                                data['timestamp'],
                                text
                            ));
                            $("#tweet_text").val("");
                            $("#count").html("140");
                            $("#tweet_btn").attr("disabled", "disabled");
                            updateTime();
                        }
                    },
                    "json"
                );
            });
        });

        $(function ()
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
                                data[i]['timestamp'],
                                data[i]['text']
                            ));
                        }
                        //取得したツイートの中で最も古い時刻を更新
                        stored_time = data[i-1]['time'];
                        updateTime();
                    }
                    if (data.length < 10){
                        document.getElementById("no_tweet").style.display = "inline";
                        document.getElementById("get_tweet_btn").disabled = "true";
                    }
                }
            });
        }

//        function createTweetHTML(name, time, text)
        function createTweetHTML(name, time, timestamp, text)
        {
            var return_HTML = '';
            return_HTML += '<div class="tweet"><div class="tweet_title"><div class="username">';
            return_HTML += name;
            return_HTML += '</div><div class="time" data-time="';
            return_HTML += time;
            return_HTML += '" data-timestamp="';
            return_HTML += timestamp;
            return_HTML += '"></div></div><div class="tweet_text">';
            return_HTML += text;
            return_HTML += '</div></div>';
            return return_HTML;
        }

        function updateTime()
        {
            var node_list = document.querySelectorAll(".time");
            var timestamp_now = Math.round(new Date().getTime() / 1000);
            for (var i = 0; i < node_list.length; i++){
                var time_diff = timestamp_now - node_list[i].dataset.timestamp;
                if (time_diff >= 86400){
                    var date = new Date(node_list[i].dataset.timestamp * 1000);
                    var month = date.getMonth() + 1;
                    var day = date.getDate();
                    node_list[i].innerHTML = month + "月" + day + "日";
                }else{
                    var hour = time_diff % 86400;
                    if (hour >= 3600){
                        node_list[i].innerHTML = (Math.round(hour / 3600)).toString() + "時間前";
                    }else{
                        minute = hour % 3600;
                        if (minute >= 60){
                            node_list[i].innerHTML = (Math.round(minute / 60)).toString() + "分前";
                        }else{
                            node_list[i].innerHTML = "ついさっき";
                        }
                    }
                }
            }
        }

    </script>

