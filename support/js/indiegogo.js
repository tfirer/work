$(document).ready(function(){
    $('.colors li').click(function(e) {
        var self = $(this);
        if (self.hasClass('inactive')) {
            return;
        }

        var color = self.attr('value');
        var title = self.attr('title');
        var p = self.attr('for');
        $('.'+p).attr('src', '../images/eri-'+color);
        if ( ! self.hasClass('active')) {
            self.siblings().removeClass('active');
            self.addClass('active');
            if (p == "p1") {
                $('#color_p1').val(title);
            } else if (p == "p2") {
                $('#color_p2').val(title);
            } else if (p == "p3") {
                $('#color_p3').val(title);
            }
        };
    });
    $('#engravingp1').change(function(){
        var self = $(this);
        $('#engraving_p1').val(self.val());
    });
    $('#engravingp2').change(function(){
        var self = $(this);
        $('#engraving_p2').val(self.val());
    });
    $('#engravingp3').change(function(){
        var self = $(this);
        $('#engraving_p3').val(self.val());
    });
    $('#submit').click(function(){
        console.log('submit');
        submit();
    });
});
var buy_perk;

function init_color(p, color) {
    console.log(p + color);
    if (color == "Black") {
        $(".colors li.black[for=" + p + "]").addClass('active');
        $('.'+p).attr('src', '../images/eri-black');
    } else if (color == "White") {
        $(".colors li.white[for=" + p + "]").addClass('active');
        $('.'+p).attr('src', '../images/eri-white');
    } else if (color == "Mint Green") {
        $(".colors li.mintgreen[for=" + p + "]").addClass('active');
        $('.'+p).attr('src', '../images/eri-mintgreen');
    } else if (color == "Army Green") {
        $(".colors li.armygreen[for=" + p + "]").addClass('active');
        $('.'+p).attr('src', '../images/eri-armygreen');
    } else if (color == "Sexy Pink") {
        $(".colors li.sexypink[for=" + p + "]").addClass('active');
        $('.'+p).attr('src', '../images/eri-sexypink');
    }
}

function init_colors(perk) {
    buy_perk = perk;
    if (perk == "Early Bird") {
        $('.colors li.white, .colors li.mintgreen, .colors li.armygreen, .colors li.pink').addClass('inactive');
        $('.engraving').attr("readonly", "readonly");
    } else if (perk == "Discoverer") {
        $('.colors li.mintgreen, .colors li.armygreen, .colors li.pink').addClass('inactive');
        $('.engraving').attr("readonly", "readonly");
    } else if (perk == "Gift" || perk == "Fashion Plate") {
        $('.engraving').attr("readonly", "readonly");
    }
}

function submit() {
    document.buyerForm.submit();
}
