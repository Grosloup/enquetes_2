/**
 * Created by Nicolas on 29/03/2014.
 */

;(function(w,d){
    /***************** functions ****************/
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

    function setCurrentFromH(hPrefix){
        var tempH = location.hash;
        if(location.hash == ""){
            current = 0;
        } else {
            if(hPrefix){
                tempH = tempH.replace("#question-","");
            }
            current = parseInt(tempH) - 1;
        }
    }

    function setMaxHeight(_node, min){
        var h = w.innerHeight;
        var m = min || 1;
        if( h > m ){
            _node.style.height = h + "px";
        }
    }

    function positionNavigator(){
        var h = w.innerHeight/3;
        navigator.style.top = h - navigatorHalfHeight + "px";
    }

    function navigatorBtnsToggleClass(){
        [].slice.call(navigatorBtns).forEach(function(el){
            el.classList.remove("disabled");
        });

        if(current == 0){
            navigatorFirstBtn.classList.add("disabled");
            navigatorPrevBtn.classList.add("disabled");
        }
        if(current == numSections-1){
            navigatorNextBtn.classList.add("disabled");
            navigatorLastBtn.classList.add("disabled");
        }
    }

    function displayScrollbar(_node, selector){
        var target = _node.querySelector(selector);
        var h = target.offsetHeight, H = _node.offsetHeight;
        if(h>H-20 && !_node.classList.contains("closed")){
            _node.classList.add("scrollable");
        } else {
            _node.classList.remove("scrollable");
        }
    }

    function setHash(h){
        if(history.pushState){
            history.pushState(null,"",h);
        } else {
            location.hash = h;
        }
    }
    /****************** vars  *******************/
    var testScrollTop = getScrollTop();
    var hPrefix = "#question-";
    var sidebar = d.querySelector("#sidebar");
    var sidebarLinks = sidebar.querySelectorAll(".goto-question");
    var closeSidebarBtn = sidebar.querySelector("button.toggler");
    var sections = d.querySelectorAll(".section");
    var numSections = sections.length;
    var sectionMinHeight = 400;
    var animSteps = 60,animCounter = 0,  Interval, animStarted = false, current_id = false;
    var sectionsArr = [];
    var WindowHeight = w.innerHeight;
    var current = 0;
    var navigator = d.querySelector("#navigator");
    var navigatorHandle = navigator.querySelector("#navigator-grip");
    var navigatorBtns = navigator.querySelectorAll(".navBtn");
    var navigatorFirstBtn = navigator.querySelector("#navigator-first");
    var navigatorPrevBtn = navigator.querySelector("#navigator-prev");
    var navigatorNextBtn = navigator.querySelector("#navigator-next");
    var navigatorLastBtn = navigator.querySelector("#navigator-last");
    var navigatorHalfHeight = navigator.offsetHeight/2;
    var submitBtn = d.querySelector("#submitBtn");
    var theForm = d.querySelector("#theForm");
    var now = new Date();
    var dateContainer = d.querySelector("#q_1");
    var yearContainer = d.querySelector("#q_1_1");
    var dejaVenuOui = d.querySelector("#q_6_a");
    var dejaVenuNon = d.querySelector("#q_6_b");
    var dateRegex = /^(0[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])$/;
    var error = d.querySelector(".error");
    var errorMsg = d.querySelector(".error-msg");



    /***************** listeners ****************/
    w.addEventListener("resize", function(){
        setMaxHeight(sidebar);
        displayScrollbar(sidebar, "#sb-inner");
        positionNavigator();
        [].slice.call(sections).forEach(function(el){
            setMaxHeight(el);
            var wrapper = el.querySelector(".wrapper");
            if(wrapper){
                setMaxHeight(wrapper);
            }
        });
        if(testScrollTop){
            d.documentElement.scrollTop -= (WindowHeight - w.innerHeight) * current;
        } else {
            d.body.scrollTop -= (WindowHeight - w.innerHeight) * current;
        }
        WindowHeight = w.innerHeight;

    }, false);

    closeSidebarBtn.addEventListener("click", function(){
        if(sidebar.classList.contains("closed")){
            sidebar.classList.remove("closed");
            d.body.classList.remove("closed");
            displayScrollbar(sidebar, "#sb-inner");
        } else {
            sidebar.classList.add("closed");
            if(sidebar.classList.contains("scrollable")){
                sidebar.classList.remove("scrollable")
            }
            d.body.classList.add("closed");
        }
    },false);

    w.addEventListener("scroll", function(e){
        e.preventDefault();
        var scrollTop = w.innerHeight/2;
        var id;
        for (var i in sectionsArr){
            var s = sectionsArr[i];
            var top = s.getBoundingClientRect().top;
            if(scrollTop > top){
                id = s.id;
            }
        }
        if(current_id !== id){
            current_id = id;
            for(var i=0; i<sidebarLinks.length;i++){
                sidebarLinks[i].classList.remove("current");
            }
            [].slice.call(sidebarLinks).forEach(function(el){
                if(el.getAttribute("href") == "#"+current_id){
                    el.classList.add("current");
                }
            });
        }
    }, false);

    navigatorFirstBtn.addEventListener("click", function(e){
        if(!animStarted){
            sidebarLinks[0].click();
        }
        navigatorBtnsToggleClass();
    },false);

    navigatorPrevBtn.addEventListener("click", function(e){
        if(current-1 > -1 && !animStarted){
            sidebarLinks[current-1].click();
        }
        navigatorBtnsToggleClass();
    },false);

    navigatorNextBtn.addEventListener("click", function(e){
        if(current+1 < numSections && !animStarted){
            sidebarLinks[current+1].click();
        }
        navigatorBtnsToggleClass();
    },false);

    navigatorLastBtn.addEventListener("click", function(e){
        if(!animStarted){
            sidebarLinks[numSections-1].click();
        }
        navigatorBtnsToggleClass();
    },false);

    /*w.addEventListener("keyup", function(e){
        e.preventDefault();
        var codes = [38,40];
        if(codes.indexOf(e.keyCode) != -1){
            if(e.keyCode == 38 && !animStarted){
                if(current-1 > -1){
                    sidebarLinks[current-1].click();
                }
                navigatorBtnsToggleClass();
            }
            if(e.keyCode == 40 && !animStarted){
                if(current+1 < numSections){
                    sidebarLinks[current+1].click();
                }
                navigatorBtnsToggleClass();
            }
        }
    }, false);*/

    theForm.addEventListener("submit", function(e){
        var val = dateContainer.value;
        if(!val){
            errorMsg.textContent = "Vous devez obligatoirement entrer une valeur pour le date de visite.";
            error.style.display = "block";
            e.preventDefault();
            return false;
        }
        if(!val.match(dateRegex)){ // verif masque JJ/MM
            errorMsg.textContent = "La date de visite n'a pas le bon format.";
            error.style.display = "block";
            e.preventDefault();
            return false;
        }
        var arr = val.split("/");
        var d = "20" + yearContainer.value + "-" + arr[1] + "-" + arr[0] ;
        console.log(d);
        var testDate = new Date(d);
        console.log(testDate.toDateString());
        if(testDate.toDateString() == "Invalid Date"){ // verif date existe
            errorMsg.textContent = "La date de visite n'est pas une date valide.";
            error.style.display = "block";
            e.preventDefault();
            return false;
        }
        var dejaVenu = false;
        for(var i=0;i<theForm.elements["form[q_6]"].length; i++){
            if(theForm.elements["form[q_6]"][i].checked){
                dejaVenu = true;
            }
        }
        if(!dejaVenu){
            errorMsg.textContent = "Vous devez obligatoirement entrer à la question Q6a.";
            error.style.display = "block";
            e.preventDefault();
            return false;
        }
        errorMsg.textContent = "";
        error.style.display = "none";

    },false);

    var parent, target, deltaX, deltaY;;

    function docMouseMove(e){
        parent.style.top = e.clientY - deltaY +"px";
        parent.style.left = e.clientX - deltaX+"px";
    }


    navigatorHandle.addEventListener("mousedown", function(e){
        e.preventDefault();
        parent = e.target.parentNode;



         //parent.style.position = "absolute";
        var rect = e.target.parentNode.getBoundingClientRect();

        deltaX = e.clientX - rect.left;
        deltaY = e.clientY - rect.top;

        console.log(e, e.target.parentNode.getBoundingClientRect());



        d.addEventListener("mousemove", docMouseMove ,false);
    },false);

    d.addEventListener("mouseup", function(e){
        d.removeEventListener("mousemove", docMouseMove ,false);
        //parent.style.position = "fixed";
    });



    /***************** app ****************/

    setCurrentFromH(hPrefix);
    setMaxHeight(sidebar);
    displayScrollbar(sidebar, "#sb-inner");
    positionNavigator();
    navigatorBtnsToggleClass();

    [].slice.call(sections).forEach(function(el){
        setMaxHeight(el,sectionMinHeight);
        var wrapper = el.querySelector(".wrapper");
        if(wrapper){
            setMaxHeight(wrapper);
        }
    });

    [].slice.call(sidebarLinks).forEach(function(el){
        var href = el.getAttribute("href");
        sectionsArr.push(document.querySelector(href));
        el.setAttribute("title", el.textContent);
        el.textContent = el.textContent.substr(0, 25);
        el.textContent += "...";
        el.addEventListener("click", function(e){
            e.preventDefault();
            var h = this.getAttribute("href");
            setHash(h);
            current = [].slice.call(sidebarLinks).indexOf(this);
            navigatorBtnsToggleClass();
            var section = d.querySelector(h);
            var so = section.offsetTop;
            var st;
            if(testScrollTop){
                st = d.documentElement.scrollTop;
            } else {
                st = d.body.scrollTop;
            }
            var modulo =(so - st)%animSteps;
            var stepVal = (so - st - modulo)/animSteps;
            if(!animStarted){
                Interval = w.setInterval(function(){
                    animStarted = true;
                    if(animCounter < animSteps){
                        if(testScrollTop){
                            d.documentElement.scrollTop += stepVal;
                        } else {
                            d.body.scrollTop += stepVal;
                        }
                        animCounter++;
                        if(animCounter == animSteps){
                            if(testScrollTop){
                                d.documentElement.scrollTop += modulo;
                            } else {
                                d.body.scrollTop += modulo;
                            }
                        }
                    } else {
                        w.clearInterval(Interval);
                        animCounter =  0;
                        animStarted = false;
                    }
                },5);
            }
        }, false);

        el.addEventListener("mouseenter", function(e){
            e.preventDefault();
            var rect = this.getBoundingClientRect();
            var content = tooltip.querySelector(".content");
            content.textContent = this.getAttribute("title");
            this.setAttribute("title", "");
            tooltip.style.top = rect.top + "px";
            tooltip.style.left = rect.right + 11 + "px";
            if(!tooltip.classList.contains("visible")){
                tooltip.classList.add("visible");
            }
        }, false);

        el.addEventListener("mouseleave", function(e){
            e.preventDefault();
            var content = tooltip.querySelector(".content");
            if(tooltip.classList.contains("visible")){
                tooltip.classList.remove("visible");
                this.setAttribute("title", content.textContent);
                content.textContent = "";
                tooltip.style.top = 0;
                tooltip.style.left = 0;
            }
        }, false);

    });

    yearContainer.value = now.getFullYear().toString().substr(2);

    var tooltip = d.createElement("div");
    tooltip.classList.add('tooltip');
    tooltip.insertAdjacentHTML("afterbegin", "<div class=\'arrow\'></div><div class=\"content\"></div>");
    d.body.appendChild(tooltip);

})(window, document, undefined);
