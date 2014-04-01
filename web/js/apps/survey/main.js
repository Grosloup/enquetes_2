/**
 * Created by Nicolas on 02/04/2014.
 */
(function(w,d){
    function getScrollTop(){
        var h,st,test;
        h = d.body.style.height;
        d.body.style.height = w.innerHeight+10+"px";
        st = d.body.scrollTop;
        d.body.scrollTop += 9;
        test = st === document.body.scrollTop;
        d.body.scrollTop -= 9;
        d.body.style.height = h + "px";
        return test;
    }
    function setMaxHeight(_node){
        var h = (w.innerHeight > d.body.offsetHeight) ? w.innerHeight : d.body.offsetHeight;
        if( h > _node.offsetHeight ){
            _node.style.height = h + "px";
        }
    }

    var sidebar = d.querySelector("#sidebar");

    w.addEventListener("resize", function(){
        setMaxHeight(sidebar);


    }, false);

    setMaxHeight(sidebar);
})(window, document, undefined);
