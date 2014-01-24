<html>
    <head>
        <title>Edit html mail</title>
        <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector:'textarea',
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                height:600
            });
        </script>
        <style>
            body {
                font-size:14px;
            }
            #mail_subject {
                width: 100%;
                height: 50px;
                font-size: 120%;
            }
            .error {
                margin-top: 10px;
                padding: 10px 5px;
            }
            
            .error p {
                color: red;
            }
        </style>
    </head>
    <body>
        <form method="post" accept-charset="utf-8">
            <input type="text" id="mail_subject" name="mail_subject" value="<?php echo set_value('mail_subject');?>" placeholder="Subject" />
            <textarea name="mail_content" >
                <?php echo set_value('mail_content');?>
            </textarea><br>
            <div>
            From:
            <select size="1" id="select" name="mail_from">
                    <option>support@digi-care.com</option>
                    <option>public@digi-care.com</option>
                    <option>jimmyliao@digi-care.com</option>
            </select>
            To:
            <select size="1" name="mail_to_group">
                    <option value="test">Test(Jimmy, Deng)</option>
                    <option value="indiegogo">Indigogo user</option>
                    <option value="subscribe">Subscribe user</option>
            </select>
            <input type="submit" name="send" value="Send mail"  />
            <input type="reset" name="reset" value="reset"  />
            <input type="hidden" name="mode" value="submit"  />
            </div>
        </form>       
        <div class="error">
            <?php echo validation_errors();?>
            <p><?php echo $result;?></p>
        </div>
    </body>
</html>
