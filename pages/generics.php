<?php

class Tabbed {
    public $top     = '<div class="jumbotron">';
    public $tabs    = '';
    public $middle  = '';
    public $bottom  = '</div>';

    public function __construct() {

    }

    public function setTabs($title, $p, $util, $attr) {
        $this->tabs = '<h1>'.$title.'</h1><ul class="nav nav-pills">';
        foreach($p as $t) {
            $this->tabs .= '<li id="'.strtolower($t).'"><a class="type" href="#'.strtolower($t).'">'.$t.'</a></li>';
        }
        $this->tabs .= '
        </ul>
        <script>
        function showType(t) {
            $(".type").each(function(i) {
                $(this).parent().removeClass("active");
            });
            $("#" + t).addClass("active");
            $.ajax({
                type: "get",
                url: "/main.php",
                data: {
                    util: "'.$util.'",
                    attr: {
                        type: t
                    }
                }
            }).done(function(data) {
                $("#tabbed-area").html(data);
            });

        }
        if($.url().segment().length < 2 || $.inArray($.url().segment(2), '.json_encode(array_map('strtolower', $p)).') == -1) {
            showType("'.strtolower($p[0]).'");
        } else {
            showType($.url().segment(2));
        }
        $(".type").on("click", function(e) {
            e.preventDefault();
            showType($(this).parent().attr("id"));
            history.pushState({}, "", "/'.$attr.'/" + $(this).parent().attr("id") + "/");
        });
        </script>';
        $this->middle = '<div id="tabbed-area"></div>';
    }

    public function insert($p) {
        $this->middle = $this->middle . $p;
    }

    public function update($p) {
        $this->middle = $p;
    }

    public function write() {
        echo $this->top . $this->tabs . $this->middle . $this->bottom;
    }
}
?>