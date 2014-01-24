<html>
<head>
<title>DigiCare</title>
<link rel="stylesheet" type="text/css" href="<?=base_url().'css/common.css'?>">
</head>
<body>
<div class="error">
    <?php echo validation_errors();?>
    <p><?php echo $result;?></p>
</div>
<div class="main">
    <form method="post">
        <input type="text" placeholder="Your order email on indiegogo" name="email" value="<?=set_value('email')?>"/>
        <input type="hidden" name="mode" value="checked" />
        <input type="hidden" name="pledge_id" value="<?=$pledge_id?>" />
        <div class="submit">
            <input type="submit" class="submit" name="submit" value="Login" />
        </div>
    </form>
</div>
<?$this->load->view('common/footer')?>
</body>
</html>
