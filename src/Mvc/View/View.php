<?php
namespace Mvc\View;

class View
{
    public $result = null;
    //*建立計畫
    public static function insertPlan()
    {
        ?>
    <html>
        <head>
            <title></title>
            <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js"></script>
        </head>
        <script type="text/javascript">
            $(function(){
                $("#divShow").hide();

                $('body').click(function(evt) {
                    if($(evt.target).parents("#divShow").length==0 &&
                        evt.target.id != "aaa" && evt.target.id != "divShow") {
                        $('#divShow').hide();
                    }
                });
            });
        </script>
        <body>
        <form action="/check" method="post">

            <h2 style='color:#8a2f12' id="aaa" name="aaa" onclick="$('#divShow').show();" href="#">建立旅遊計畫</h2>
                <div id="divShow" name="divShow" blockquote style="color:#000000;
                font-size:13px;
                background-color:#ffc991;
                margin-left:15px;
                margin-right:0px;-webkit-box-shadow:#333333 4px 4px 6px;
                padding:10px;
                border:1px dashed #aabbcc;">
                    <p style='color:#1b16da'>遊記名稱(*)：<input type="text" name="title"><br><br>
                        旅行日期：<input type="text" name="startDate" id="datepicker1">
                        ~<input type="text" name="endDate" id="datepicker2"><br><br>
                    <td>旅行人數:</td>
                    <td><select size="1" name="nop">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="5">6</option>
                            <option value="5">7</option>
                            <option value="5">8</option>
                            <option value="5">9</option>
                            <option value="5">10</option>
                        </select></td><br><br>
                    遊記簡介：<textarea name="introduction" rows="4" cols="20" style='color:#78788a'>輸入你想要寫的內容...</textarea><br><br>
                    描述：<input type="text" name="description"><br><br></p>
                    <input type="submit" name="submit" value="Go" formaction="insertPlanCheck"/>
                    </blockquote>
                </div>
        </form>
        </body>
        </html>
    <?php
    }
    //*修改計畫
    public static function editPlan()
    {
        ?>
        <html>
        <head>
            <meta charset="utf-8"/>
            <title>修改旅遊計畫</title>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
            <script src="//code.jquery.com/jquery-1.10.2.js"></script>
            <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
            <link rel="stylesheet" href="/resources/demos/style.css">
            <script>
                $(function() {
                    $( "#datepicker1" ).datepicker({dateFormat: "yy-mm-dd"});
                    $( "#datepicker2" ).datepicker({dateFormat: "yy-mm-dd"});
                });
            </script>
        </head>
        <body>
        <form action="/" method="post">
            <blockquote style="color:#000000;
            font-size:13px;
            background-color:#ffffcc;
            margin-left:15px;
            margin-right:0px;-webkit-box-shadow:#333333 4px 4px 6px;
            padding:10px;
            border:1px dashed #aabbcc;">
                <h2 style='color:#8a2f12'>編輯旅遊計畫</h2>
                <p style='color:#1b16da'>遊記名稱(*)：<input type="text" name="title"><br><br>
                    旅行日期：<input type="text" name="startDate" id="datepicker1">
                    ~<input type="text" name="endDate" id="datepicker2"><br><br>
                    旅行人數：<input type="text" name="nop"><br><br>
                    遊記簡介：<textarea name="introduction" rows="4" cols="20"></textarea><br><br>
                    描述：<input type="text" name="description"><br><br></p>
                <input type="submit" name="submit" value="Go" formaction="createCheck"/>
            </blockquote>
        </form>
        </body>
        </html>
    <?php
    }
    //*刪除計畫
    public static function delPlan()
    {
    }
    //*瀏覽計畫項目
    public static function browsePlan($PlanItemId)
    {
        $show ='<html>
        <head><meta charset="utf-8"/><title>browsePlanItem</title>
        </head>
        <body>
        <form action="/" method="post">';
        foreach ($PlanItemId as $row) {
            $show .= '<br><p>序:'.$row["id"];
            $show .= '<p>-planid:'.$row["planid"];
            $show .= '<p>-旅行日期:'.$row["starttime"].'～'.$row["endtime"];
            $show .= '<p>-描述:'.$row["description"];
            $show .= '<p>-預設成本:'.$row["nop"];
            $show .= '<p>-成本:'.$row["introduction"];
            $show .= '<p>-建立時間:'.$row["createon"];
            $show .= '<p>-修改時間:'.$row["modifyon"].'<br><br>';
            $show .= '<input type="submit" name="submit" value="編輯" formaction="editPlan"/> ';
            $show .= '<input type="submit" name="submit" value="刪除" formaction="delPlan"/><br><br>';
        }
        echo $show;
     }
    //*計畫清單
    public static function planLists($allResult)
    {
        $show ='<html>
        <head><meta charset="utf-8"/><title>planLists</title>
        <link href="http://www.appelsiini.net/stylesheets/main2.css" rel="stylesheet" type="text/css">
        <script type="text/javascript"></script>
        </head>
        <body>
        <form action="/" method="post">';
        foreach ($allResult as $row) {
            $show .= '<br><br><p>序:'.$row["id"];
            $show .= '<p>-遊記名稱:'.$row["title"];
            $show .= '<p>-旅行日期:'.$row["startdate"].'～'.$row["enddate"];
            $show .= '<p>-旅行人數:'.$row["nop"];
            $show .= '<p>-遊記簡介:'.$row["introduction"];
            $show .= '<p>-描述:'.$row["description"];
            $show .= '<p><input type="submit" name="submit" value="瀏覽" formaction="browsePlan"/> ';
            $show .= '<input type="submit" name="submit" value="編輯" formaction="editPlan"/> ';
            $show .= '<input type="submit" name="submit" value="刪除" formaction="delPlan"/>';
        }
        '</form>';
        echo $show;
    }
    //*單一計畫清單
    public static function uniquePlanLists($thisResult)
    {
        $show ='<html>
        <head><meta charset="utf-8"/><title>uniquePlanLists</title>
        </head>
        <body>
        <form action="/" method="post">';
            foreach ($thisResult as $row) {
                $show .= '<br>序:'.$row["id"];
                $show .= '<br>-遊記名稱:'.$row["title"];
                $show .= '<br>-旅行日期:'.$row["startdate"].'～'.$row["enddate"];
                $show .= '<br>-旅行人數:'.$row["nop"];
                $show .= '<br>-遊記簡介:'.$row["introduction"];
                $show .= '<br>-描述:'.$row["description"].'<br><br>';
                $show .= '<input type="submit" name="submit" value="瀏覽" formaction="browsePlan"/> ';
                $show .= '<input type="submit" name="submit" value="編輯" formaction="editPlan"/> ';
                $show .= '<input type="submit" name="submit" value="刪除" formaction="delPlan"/><br><br>';
            }
            echo $show;
    }
}
