/**
 * Created by wangzhen19 on 2016/1/7.
 */
//用户注册
function signUp(email,passwd){
    $.ajax({
        type:"post",
        url:"/sign/signUp",
        data:{
            em:email,
            pass:passwd
        },
        dataType:"json",
        success:function(data){
            var note = document.getElementById("note");
            note.style.visibility= "visible";
            if (data.errNum === "0000"){
                note.innerHTML = "signUp success";
                loginIn(email,passwd,"yes");
            }else{
                switch (data.errNum){
                    case "0002":
                        note.innerHTML = "email already exist";
                        break;
                    case "0006":
                        note.innerHTML = "input illegal";
                        break;
                    default :
                        note.innerHTML = "web connect error,please retry";
                }
            }
        },
        error:function(data){
            var note = document.getElementById("note");
            note.style.visibility= "visible";
            note.innerHTML = "web connect error,please retry";
        }
    });
}

//用户登录
function loginIn(email,passwd,checkBox){
    $.ajax({
        type:"post",
        url:"/sign/loginIn",
        data:{
            em:email,
            pass:passwd,
            check:checkBox
        },
        dataType:"json",
        success:function(data){
            var note = document.getElementById("note2");
            note.style.visibility= "visible";
            if (data.errNum === "0000"){
                note.innerHTML = "welcome,"+data.email;
                setTimeout(function(){
                    window.location.reload();
                },1000);
            }else{
                switch (data.errNum){
                    case "0001":
                        note.innerHTML = "sorry,email or password error";
                        break;
                    case "0006":
                        note.innerHTML = "input illegal";
                        break;
                    default :
                        note.innerHTML = "web connect error,please retry";
                }
            }
        },
        error:function(data){
            var note = document.getElementById("note");
            note.style.visibility= "visible";
            note.innerHTML = "web connect error,please retry";
        }
    });
}

//改变checkbox的value值
function changeCheckBox(checkId){
    checkId.value = "yes";
}

//用户登出
function logOut(){
    $.ajax({
        type:"get",
        url:"/sign/loginOut",
        success:function(data){
            window.location.reload();
        }
    });

}