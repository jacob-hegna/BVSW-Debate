<?php
function get_tournaments() {
    global $database;
    $content =
    '<div class="jumbotron">
        <h1>Tournament Schedule</h1>
        <ul class="nav nav-pills">
          <li id="novice" class="active"><a class="tourntype" href="#novice">Novice</a></li>
          <li id="open"><a class="tourntype" href="#open">Open</a></li>
          <li id="varsity"><a class="tourntype" href="#varsity">Varsity</a></li>
          <li id="toc"><a class="tourntype" href="#toc">TOC</a></li>
        </ul>
        <div id="ttable">
        </div>
';
                $content .=
'       <script>
        function showType(t) {
            $(".tourntype").each(function(i) {
                $(this).parent().removeClass("active");
            });
            $("#" + t).addClass("active");
            $.ajax({
                type: "post",
                url: "/main.php",
                data: {
                    util: "tournament_table",
                    attr: {
                        type: t
                    }
                }
            }).done(function(data) {
                $("#ttable").html(data);
            });

        }
        switch($.url().segment(2)) {
            case "novice":
                showType("novice");
                break;
            case "open":
                showType("open");
                break;
            case "varsity":
                showType("varsity");
                break;
            case "toc":
                showType("toc");
                break;
            default:
                showType("novice");
                break;
        }
        $(".tourntype").on("click", function(e) {
            e.preventDefault();
            showType($(this).parent().attr("id"));
            history.pushState({}, "", "/tournaments/" + $(this).parent().attr("id") + "/");
        });
        </script>
    </div>';
    echo $content;
}
?>