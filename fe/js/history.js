/**
 * Created by wangzhen19 on 2015/12/30.
 */

window.onload=function(){
    navBarShow();
    getHistory();
};

function getHistory(){
    $.ajax({
        type:"get",
        url:"/history/getContent",
        dataType:"json",
        success:function(data){
            switch (data.errNum){
                case "0000":
                    var content = document.getElementById("content");
                    content.style.display = "block";
                    for (var j = 0; j < data.content.length; j ++){
                        var h1 = [];
                        var h_p = [];
                        var i;
                        for (i = 0; i < 4; i ++){
                            h1[i] = document.createElement("h1");
                            content.appendChild(h1[i]);
                        }
                        h1[0].innerText = "Decision Name:";
                        h1[1].innerText = "Advantage:";
                        h1[2].innerText = "Disadvantage:";
                        h1[3].innerText = "Result:";
                        for (i = 0; i < 4; i ++){
                            h_p[i] = document.createElement("p");
                            h1[i].appendChild(h_p[i]);
                        }

                        h_p[0].innerText = data.content[j]['name'];
                        var k;
                        for (k = 0; k < data.content[j]['ad'].length; k ++){
                            h_p[1].innerHTML += (k+1) + ":" + data.content[j]['ad'][k] + "<br>";
                        }
                        for (k = 0; k < data.content[j]['dis'].length; k ++){
                            h_p[2].innerHTML += (k+1) + ":" + data.content[j]['dis'][k] + "<br>";
                        }
                        h_p[3].innerText = data.content[j]['final'];
                        var div = document.createElement("div");
                        div.className = "head-underline";
                        content.appendChild(div);
                    }
                    break;
                case "0007":
                    showLoginIn();
                    break;
                case "0008":
                    var con = document.getElementById("contentEmpty");
                    var p = document.createElement("p");
                    p.innerText = "Result Empty !";
                    con.style.display = "block";
                    con.appendChild(p);
                    break;
                default :
                    alert("error1");
            }

        },
        error:function(){
            alert("error2");
        }

    });
}

function addText(){
    var h1 = document.getElementsByTagName("h1");
    var p= document.createElement("p");
    p.innerHTML="abcdefg";
    p.style.fontSize="20px";
    p.style.fontFamily="serif";
    h1[0].appendChild(p);

}
