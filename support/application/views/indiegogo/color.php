<div class="product product-<?=$p?>">
    <div class="sample" method="post" accept-charset="utf-8">
        <img class="<?=$p?>" src="<?=base_url()?>images/eri-black">
    </div>
    <div class="colors">
        <ul>
          <li for="<?=$p?>" class="black" title="Black" value="black"></li>
          <li for="<?=$p?>" class="white" title="White" value="white"></li>
          <li for="<?=$p?>" class="mintgreen" title="Mint Green" value="mintgreen"></li>
          <li for="<?=$p?>" class="armygreen" title="Army Green" value="armygreen"></li>
          <li for="<?=$p?>" class="sexypink" title="Sexy Pink" value="sexypink"></li>
        </ul>
    </div>
    <div class="<?=$p?> engraving">
        <?php if($p == 'p1'):?>
            <input id="engraving<?=$p?>" for="<?=$p?>" value="<?=$buyer->engraving_p1?>" class="engraving" placeholder="YOUR ENGRAVING" type="text" maxlength="20" />
        <?php elseif($p == 'p2'):?>
            <input id="engraving<?=$p?>" for="<?=$p?>" value="<?=$buyer->engraving_p2?>" class="engraving" placeholder="YOUR ENGRAVING" type="text" maxlength="20" />
        <?php elseif($p == 'p3'):?>
            <input id="engraving<?=$p?>" for="<?=$p?>" value="<?=$buyer->engraving_p3?>" class="engraving" placeholder="YOUR ENGRAVING" type="text" maxlength="20" />
        <?php endif;?>
    </div>
</div>
<script>
    var p = "<?=$p?>"; 
    if (p == "p1") init_color("p1", "<?=$buyer->color_p1?>");
    if (p == "p2") init_color("p2", "<?=$buyer->color_p2?>");
    if (p == "p3") init_color("p3", "<?=$buyer->color_p3?>");
    init_colors("<?=$buyer->perk?>");
</script>
