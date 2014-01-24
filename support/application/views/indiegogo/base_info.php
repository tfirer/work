<html>
    <head>
        <title>DigiCare</title>
        <script type="text/javascript" src='<?=base_url().'/js/jquery.min.js'?>'></script>
        <script type="text/javascript" src='<?=base_url().'/js/indiegogo.js'?>'></script>
        <link rel="stylesheet" type="text/css" href="<?=base_url().'css/indiegogo.css'?>">
    </head>
    <body>
        <div class="error">
            <?php echo validation_errors();?>
            <p><?php echo $result;?></p>
        </div>
        <div class="main content">
        <h3>Hello <?=$buyer->name?></h3>
        <form class="info" method="post" name="buyerForm" accept-charset="utf-8">
            <div class="row">
                <fieldset class="input-full center">
                     <legend>Full Name</legend>
                     <input type="text" name="name" value="<?=$buyer->name?>" />
                </fieldset>
            </div>
            <div class="row">
                <fieldset class="input-full center">
                     <legend>Shipping Address</legend>
                     <input type="text" name="shipping_address" value="<?=$buyer->shipping_address?>" />
                     <input type="text" name="shipping_address2" value="<?=$buyer->shipping_address2?>" />
                </fieldset>
            </div>
            <div class="row">
                <fieldset class="input-half-left">
                     <legend>City</legend>
                     <input type="text" name="shipping_city" readonly="readonly" value="<?=$buyer->shipping_city?>" />
                </fieldset>
                <fieldset class="input-half-right">
                     <legend>State / Province</legend>
                     <input type="text" name="shipping_state_or_province" readonly="readonly" value="<?=$buyer->shipping_state_or_province?>" />
                </fieldset>
            </div>
            <div class="row">
                <fieldset class="input-half-left">
                     <legend>Zip</legend>
                     <input type="text" name="shipping_zip_or_postal_code" readonly="readonly" value="<?=$buyer->shipping_zip_or_postal_code?>" />
                </fieldset>
                <fieldset class="input-half-right">
                     <legend>Country</legend>
                     <input type="text" name="shipping_country" readonly="readonly" value="<?=$buyer->shipping_country?>" />
                </fieldset>
            </div>
            <input type="hidden" name="pledge_id" value="<?=$buyer->pledge_id?>" />
            <input type="hidden" name="remark" id="remark" value="" />
            <input type="hidden" name="mode" value="submit"  />
            <input type="hidden" name="color_p1" id="color_p1" value="<?=$buyer->color_p1?>" />
            <input type="hidden" name="engraving_p1" id="engraving_p1" value="<?=$buyer->engraving_p1?>" />
            <input type="hidden" name="color_p2" id="color_p2" value="<?=$buyer->color_p2?>" />
            <input type="hidden" name="engraving_p2" id="engraving_p2" value="<?=$buyer->engraving_p2?>" />
            <input type="hidden" name="color_p3" id="color_p3" value="<?=$buyer->color_p3?>" />
            <input type="hidden" name="engraving_p3" id="engraving_p3" value="<?=$buyer->engraving_p3?>" />
        </form>       
