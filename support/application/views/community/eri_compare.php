<html>
<head>
    <style type="text/css">
        body {
            font-size:18px;
            font-weight:200;
            width:500px;
            margin:0 auto;
        }
        input[type=radio] {
            height:20px;
        }
        input[type=radio].radio-left {
            margin-left:10px;
        }
        input[type=radio].radio-right {
            margin-left:30px;
        }
        input#mail {
            font-size:100%;
            height: 40px;
            width: 500px;
            margin-top: 10px;
        }
        textarea {
            font-size: 100%;
            height: 200px;
            width: 500px;
        }
        .result {
            color: red;
        }
        .submit {
            width: 300px;
            height: 80px;
            margin: 30px auto;
        }
        .submit input:hover {
            background-color: #087672;
        }
        .submit input {
            width: 100%;
            height: 100%;
            font-size: 200%;
            color: white;
            cursor: pointer;
            background-color: #16aaa5;
            border-radius: 10px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
        }
        .error {
            width: 500px;
            height: 50px;
            margin: 10px auto;
            text-align: center;
            font-size: 100%;
            color: red;
        }
    </style>
</head>
<body>
    <div class="error">
        <?php echo validation_errors();?>
        <p><?php echo $result;?></p>
    </div>
    <div class="form">
        <form method="post" accept-charset="utf-8">
            <div class="selection">
                <span>You favour ERI : </span>
                <input type="radio" class="radio-left" name="selection" value="old" <?=set_radio('selection', 'old')?> />Old
                <input type="radio" class="radio-right" name="selection" value="new" <?=set_radio('selection', 'new')?> />New
            </div>
            <input type="text" id="mail" name="mail" value="<?=set_value('mail')?>" placeholder="Your mail" /><br />
            <textarea id="advice" name="advice" placeholder="Your advice"><?=$advice?></textarea><br />
            <div class="submit">
                <input type="submit" value="Submit"  />
            </div>
            <input type="hidden" name="mode" value="submit" />
            <input type="hidden" name="token" value="<?=md5(uniqid())?>" />
        </form>
    </div>
</body>
</html>
