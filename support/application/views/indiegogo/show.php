<html>
<head>
<style>
body {
    line-height: 25px;
}
br {
    line-height: 0;
}
img.logo {
    width: 100px;
    height: 100px;
}
.show {
    border-top: 2px dashed #ccc;
    border-bottom: 2px dashed #ccc;
    width: 100%;
    padding: 5px;
}
</style>
</head>
<body>
<div class="header">
    <p>Dear <?=$buyer->name?></p>
    <p>We are excited to annouce that ERI smart wristband is ready for shipping now. Please confirm your order information below and click the link behind them if something is wrong. Thank you.</p>
</div>
<div class="show">
    <div class="row">
        <label>Full Name:</label>
        <span><?=$buyer->name?></span>
    </div>
    <div class="row">
        <label>Shipping Address:</label>
        <span><?=$buyer->shipping_address?></span>
        <span><?=$buyer->shipping_address2?></span>
    </div>
    <div class="row">
        <label>City:</label>
        <span><?=$buyer->shipping_city?></span>
    </div>
    <div class="row">
        <label>State or Province:</label>
        <span><?=$buyer->shipping_state_or_province?></span>
    </div>
    <div class="row">
        <label>Zip:</label>
        <span><?=$buyer->shipping_zip_or_postal_code?></span>
    </div>
    <div class="row">
        <label>Country:</label>
        <span><?=$buyer->shipping_country?></span>
    </div>
    <div class="row">
        <label>Perk:</label>
        <span><?=$buyer->perk?></span>
        <div><?=$perk_info?></div>
        <div>
            <?php if ($buyer->color_p1 != ''):?>Color:'<?=$buyer->color_p1?>'<?php endif;?> 
            <?php if ($buyer->engraving_p1 != ''):?>Engraving:'<?=$buyer->engraving_p1?>'<?php endif;?>
        </div>
        <div>
            <?php if ($buyer->color_p2 != ''):?>Color:'<?=$buyer->color_p2?>'<?php endif;?> 
            <?php if ($buyer->engraving_p2 != ''):?>Engraving:'<?=$buyer->engraving_p2?>'<?php endif;?>
        </div>
        <div>
            <?php if ($buyer->color_p3 != ''):?>Color:'<?=$buyer->color_p3?>'<?php endif;?> 
            <?php if ($buyer->engraving_p3 != ''):?>Engraving:'<?=$buyer->engraving_p3?>'<?php endif;?>
        </div>
    </div>
</div>
<div class="perk">
</div>
<div class="link">
    <p><a href="<?=base_url()?>indiegogo/check?mode=check&pledge_id=<?=md5($buyer->pledge_id)?>">Confirm Link</a></p>
</div>
<div class="footer">
    <p>
    <div>Best Regards.</div>
    <div><img class="logo" src="http://api.digi-care.com/images/DigicareSquareLogo250x250.jpg"></div>
    <div>DigiCare Technology Limited</div>
    <div>HK Adds:Room 703 Kowloon Building 555 Nathan Road Kowloon Hong Kong</div>
    <div>SZ Adds:Room 6A Building No.8 You Ran Tian Di Nanshan Shenzhen</div>
    <div><a href="http://www.digi-care.com">http://www.digi-care.com</a></div>
    <div>Tel: 00852-8192 6860</div>
    <div>086-0755-86955502</div>
    <div>Fax: 00852-2159 8092</div>
    <div>086-0755-86955502</div>
    </p>
</div>
</body>
</html>
