<html>
<head>
    <meta charset="utf-8">
    <title>DigiCare | Community</title>
    <style type="text/css">
        body{font-size:20px;font-weight:200;line-height:30px;font-family:"Helvetica Neue",Helvetica,"Myriad Pro","Lucida Grande",sans-serif;}
        fieldset{border:1px groove threedface;}
        legend{font-size:130%;}
        ul{padding:0;}
        li{padding-bottom:20px;list-style:none;}
        fieldset:hover{background-color:#eeeeee}
        span.red{color:red;}
        span.underline{text-decoration:underline}
        span.blink{text-decoration:blink}
        p{margin:2px}
    </style>
</head>
<body>
    <div class="result">
        <p><?php echo $result;?></p>
    </div>
    <div class="community">
        <ul>
            <?php foreach ($communities as $community):?>
                <li>
                    <fieldset class="input-full center">
                         <legend><span class="underline"><?=$community->mail?></span> choose <span class="red blink"><?=$community->selection?></span> in <?=date("Y/m/d h:i:s", $community->time)?></legend>
                         <p><?=$community->advice?></p>
                    </fieldset>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</body>
</html>
