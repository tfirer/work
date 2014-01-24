<html>
<head>
    <style type="text/css">
        body {
            height: 32px;
        }
        input#mail {
            height: 30px;
            width: 200px;
        }
        input#send {
            cursor: pointer;
            background-color: #eee;
            border: 0;
            font-size: 14px;
            height: 32px;
        }
        input#send:hover {
            background: #ccc;
        }
        .result {
            color: red;
        }
    </style>
</head>
<body>
    <?php if ($type=='result'):?>
        <div class="result">
            <p><?=$message?></p>
        </div>
    <?php endif;?>
    <div class="form">
        <form method="get" accept-charset="utf-8">
            <input type="text" id="mail" name="mail" value="<?=$mail?>" placeholder="Your mail" />
            <input type="hidden" name="mode" value="subscribe" />
            <input type="submit" id="send" value="Subscribe"  />
        </form>
    </div>
</body>
</html>
