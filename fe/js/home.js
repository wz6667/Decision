/**
 * Created by wangzhen19 on 2015/12/24.
 */


window.onload=function(){
    runSlide();
    navBarShow();
};

//幻灯片轮播
function runSlide(){
    //3秒轮播
    var arr = document.getElementsByClassName("slide");
    var text = ["Record Decision","Judge Decision","Make Decision"];
    var li = document.getElementsByClassName("slide-li");
    var num = 0;
    var leftArrow = document.getElementById("slide-button-left");
    var rightArrow = document.getElementById("slide-button-right");
    li[0].style.color = "#ffffff";

    function turn(){
        if (num ===arr.length - 1){
            num = 0;
        }else{
            num ++;
        }
        transfer();
    }

    function transfer(){
        arr[0].innerHTML = text[num];
        li[num].style.color = "#ffffff";
        for (j = 0;j < arr.length;j ++){
            if (j != num){
                li[j].style.color = "#aaaaaa";
            }
        }
    }

    retid = setInterval(turn,4000);

    //数字选播
    for (var i = 0;i < li.length;i ++){
        li[i].onmouseover = function(){
            clearInterval(retid);
            num = this.innerHTML-1;
           transfer();
        }
        li[i].onmouseout = function(){
            retid = setInterval(turn,4000);
        }

    }

    //左右箭头点击
    leftArrow.onclick = function(){
        if (num === 0){
            num = arr.length - 1;
        }else{
            num -- ;
        }
        transfer();
    }
    rightArrow.onclick = function(){
        turn();
    }
}



