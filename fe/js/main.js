/**
 * Created by wangzhen19 on 2015/12/30.
 */

window.onload=function(){
    navBarShow();
};

//新增一个li
function addli(divid){
    var ol = document.getElementById(divid);
    var li = document.createElement("li");
    li.innerHTML="<textarea></textarea>";
    ol.appendChild(li);
}

//把输入内容发送给后端
function sendContent(){
    var name = document.getElementById("decisionName");
    var ad = document.getElementById("adol");
    var adlis = ad.getElementsByTagName("li");
    var dis = document.getElementById("disol");
    var dislis = dis.getElementsByTagName("li");
    var final = document.getElementById("final");

    var advantages = [];
    var disadvantages = [];
    for (var i = 0;i < adlis.length;i ++ ){
        advantages[i] = adlis[i].childNodes[0].value;
    }

    for (i = 0; i < dislis.length;i++){
        disadvantages[i] = dislis[i].childNodes[0].value;
    }

    $.ajax({
            type : "post",
            url : "/main/storeContent",
            data:{
                name:name.value,
                final:final.value,
                ad:advantages,
                dis:disadvantages
            },
            dataType:"json",
            success:function(data){
                if (data.errNum === "0000"){
                    var button = document.getElementById("buttonid");
                    button.innerHTML = "Record success!";
                    button.style.color = "red";
                    button.onclick = null;
                    setTimeout(function(){
                        window.location.reload();
                    },1000);
                }else{
                    switch (data.errNum){
                        case "0007":
                            showLoginIn();
                            break;
                        case "0005":
                            //alert("error1");
                            break;
                        default :
                            //alert("error2");
                    }
                }

            },
            error:function(data){
                //alert("error3");
            }
        }

    );
}
