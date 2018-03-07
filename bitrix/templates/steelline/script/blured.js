function fromBlured(whatWait) {
    var needLoad = [];
    whatWait.ready(function () {
        whatWait.find(".blured img").each(function () {
            var bigImg = $(this).attr('data-src');
            if (bigImg) {
                changeOnLoad($(this),bigImg);
            }
        })
        // console.log(needLoad);
    })
    
}
function changeOnLoad(item, src) {
    var image = new Image();
    image.onload = function(){
        item.attr('src', src);
        item.parent('.blured').removeClass('blured');
        item.removeAttr('data-src');
    }
    image.src = src;
}