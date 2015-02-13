<?php
namespace Mvc\View;

class View
{
    public static function createPlan()
    {
        ?>
        <html>
        <head>
            <meta charset="utf-8"/>
            <title>旅遊計畫</title>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
            <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
            <link rel="stylesheet" href="/resources/demos/style.css">
            <script>
                $(function() {
                    $( "#datepicker1" ).datepicker();
                    $( "#datepicker2" ).datepicker();
                });
            </script>
        </head>
        <body>
        <form action="/check" method="post">
            <h2 style='color:#8a2f12'>建立旅遊計畫</h2>
            <p style='color:#1b16da'>遊記名稱：<input type="text" name="title"><br>
            旅行日期：<input type="text" name="startDate" id="datepicker1">
                   ~<input type="text" name="endDate" id="datepicker2"><br><br>
            旅行人數：<input type="text" name="nop"><br><br>
            遊記簡介：<textarea name="introduction" rows="4" cols="20"></textarea><br><br>
            描述：<input type="text" name="description"><br><br></p>
            <input type="submit" name="submit" value="Go" formaction="write"/>
        </form>
        </body>
        </html>
    <?php
    }
}
