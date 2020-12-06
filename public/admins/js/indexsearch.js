$(".containerpages svg").css('transform', 'translateX(101px)');
$(".paginations li").first().addClass('previous round');
$(".paginations li").last().addClass('next round');
$(".paginations li").not(':first').not(':last').addClass("index");


$("input[name=page]").keyup(function (event) {
    val = $(this).val();
    $(".submitlinks").attr("href", "http://films/public/search?page=" + val + "");
});


$('input[name=page]').keypress(function (event) {
    if (event.keyCode == 13) {
        link = $(".submitlinks").attr("href");
        window.location.replace(link);
    }
});

$("input[name=pagenew]").keyup(function (event) {
    val = $(this).val();
    $(".submitlinksnew").attr("href", "http://films/public/new?page=" + val + "");
});


$('input[name=pagenew]').keypress(function (event) {
    if (event.keyCode == 13) {
        link = $(".submitlinksnew").attr("href");
        window.location.replace(link);
    }
});
$("input[name=pagetop]").keyup(function (event) {
    val = $(this).val();
    $(".submitlinkstop").attr("href", "http://films/public/top?page=" + val + "");
});


$('input[name=pagetop]').keypress(function (event) {
    if (event.keyCode == 13) {
        link = $(".submitlinkstop").attr("href");
        window.location.replace(link);
    }
});
