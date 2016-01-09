/**
 * Created by wangzhen19 on 2016/1/9.
 * 通用函数
 */

//导航栏显示
function navBarShow(){
    var xhr = new XMLHttpRequest();
    var sign = document.getElementById("sign");
    var login = document.getElementById("login");
    var loginOut = document.getElementById("loginOut");

    xhr.onload = function(){
        if(xhr.status === 200){
            data = JSON.parse(xhr.responseText);
            if(data.errNum === "0000"){
                loginOut.style.display = "block";
            }else{
                sign.style.display = "block";
                login.style.display = "block";
            }
        }
    };
    xhr.open('get','/home/isLogin',true);
    xhr.send();
}

//显示注册框，隐藏登录框
function showSignUp(){
    var sign = document.getElementById("signUp");
    var login = document.getElementById("loginIn");
    sign.style.display = "block";
    login.style.display = "none";
}

//显示登录框，隐藏注册框
function showLoginIn(){
    var sign = document.getElementById("signUp");
    var login = document.getElementById("loginIn");
    login.style.display = "block";
    sign.style.display = "none";
}

//显示div标签
function showDiv(divId){
    var div = document.getElementById(divId);
    div.style.display="block";
}

//不显示div标签
function hiddenDiv(divId){
    var div = document.getElementById(divId);
    div.style.display="none";
}

//展示home页面
function goHome(){
    var host = window.location.host;
    window.open("http://"+host);

}

//展示main页面
function goMain(){
    var host = window.location.host;
    window.open("http://"+host+"/main/showMain");

}

//展示history页面
function goHistory(){
    $.ajax({
        type:"get",
        url:"/home/getUid",
        dataType:"json",
        success:function(data){
            if (data.errNum === "0000"){
                var host = window.location.host;
                newWindow = window.open("http://"+host+"/history/showHistory");
            }else{
                showLoginIn();
            }
        }
    });


}