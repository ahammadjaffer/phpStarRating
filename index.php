<?php
    $connect=mysql_connect("localhost","root","");//DataBase Connect
    mysql_select_db("db_star",$connect);//DataBse Selection
    
    //TO SELECT DATA FROM TABLE TUTORIAL
    $DbQuery = "select * from tbl_tutorial";
    $DbData = mysql_query("$DbQuery");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STAR RATING</title>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <style>
        .demo-table ul{margin:0;padding:0;}
        .demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
        .demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
        .rowCard {background:#f2f2f2;border-radius:5px;margin:25px;box-shadow: 0 0 1px #F4B30A;}
        .rowCard:hover{border-color:#000;}
    </style>

    <script>
        function highlightStar(obj,id) {
        removeHighlight(id);		
        $('.demo-table #tutorial-'+id+' li').each(function(index) {
            $(this).addClass('highlight');
            if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
                return false;	
            }
        });
        }

        function removeHighlight(id) {
            $('.demo-table #tutorial-'+id+' li').removeClass('selected');
            $('.demo-table #tutorial-'+id+' li').removeClass('highlight');
        }

        function addRating(obj,id)
        {
            $('.demo-table #tutorial-'+id+' li').each(function(index) 
            {
                $(this).addClass('selected');
                $('#tutorial-'+id+' #rating').val((index+1));
                if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) 
                {
                    return false;	
                }
            });
            $.ajax({
            url: "add_rating.php",
            data:'id='+id+'&rating='+$('#tutorial-'+id+' #rating').val(),
            type: "POST"
            });
        }

        function resetRating(id) {
            if($('#tutorial-'+id+' #rating').val() != 0) {
                $('.demo-table #tutorial-'+id+' li').each(function(index) {
                    $(this).addClass('selected');
                    if((index+1) == $('#tutorial-'+id+' #rating').val()) {
                        return false;	
                    }
                });
            }
        } 
    </script>

</head>
<body>
    <table class="demo-table">
        <?php
           while($data = mysql_fetch_array($DbData)) {
        ?>
            <tr class="rowCard">
                <td>
                    <div id="tutorial-<?php echo $data["id"]; ?>">
                        <input type="hidden" name="rating" id="rating" value="<?php echo $data["rating"]; ?>" />
                        <h2><?php echo $data['title']; ?></h2>
                        <br>
                        <ul onMouseOut="resetRating(<?php echo $data["id"]; ?>);">
                            <?php
                                for($i=1;$i<=5;$i++)
                                {
                                    $selected = "";
                                    if(!empty($data["rating"]) && $i<=$data["rating"]) 
                                    {
                                        $selected = "selected";
                                    }
                            ?>
                                <li class='<?php echo $selected; ?>' onmouseover="highlightStar(this,<?php echo $data["id"]; ?>);" onmouseout="removeHighlight(<?php echo $data["id"]; ?>);" onClick="addRating(this,<?php echo $data["id"]; ?>);">&#9733;</li>  
                            <?php  
                                }  
                            ?>
                        <ul>
                        <br>
                        <p><?php echo $data['description']; ?></p>
                        <br>
                        <br>
                    </div>
                </td>
            </tr>
        <?php
            }
        ?>

        
    </table>
</body>
</html>