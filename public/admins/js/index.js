
$(".pagination li").first().addClass('previous round');
$(".pagination li").last().addClass('next round');
$(".pagination li").not(':first').not(':last').addClass("index");

const c = document.querySelector('.containerpage')
const indexs = Array.from(document.querySelectorAll('.index'))
let cur = -1
indexs.forEach((index, i) => {
    index.addEventListener('mouseover', (e) => {
        // clear
        c.className = 'containerpage'
        void c.offsetWidth; // Reflow
        c.classList.add('open')
        c.classList.add(`i`)
        if (cur > i) {
            c.classList.add('flip')
        }
        cur = i

    })
})

$(".pagination li").not(':first').not(':last').mouseover(function () {
    $(".containerpage").removeClass(function (index, css) {
        return (css.match(/\i\S+/g) || []).join(' '); // removes anything that starts with "itemnx"
    });
    child = $(this).index() - 1;
    value =  $(this).find("a").text();
  
    $(".containerpage").addClass("i" + child);
    if(value>9){
        $(".containerpage svg").css('transform', 'translateX(' + child * 47.3 + 'px)');
    }else{
        if(value < 7){
             
             $(".containerpage svg").css('transform', 'translateX(' + child * 46.5 + 'px)');
        }else{
           $(".containerpage svg").css('transform', 'translateX(' + child * 48 + 'px)');  
        }
       
    }
    
    

});



$("input[name=page]").keyup(function (event) {
    val = $(this).val();
    $(".submitlink").attr("href", "http://localhost1/public?page=" + val + "");
});


$('input[name=page]').keypress(function (event) {
    if (event.keyCode == 13) {
        link = $(".submitlink").attr("href");
        window.location.replace(link);
    }
});
