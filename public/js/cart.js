$(function(){
    $("#goBack").click(function(){
        alert("前のページへ戻る");
    });
    $("#goLogin").click(function(){
        alert("購入手続きへ");
    });
    $("#goNoMember").click(function(){
        // 会員登録しないで購入
        location.href = "cart/input_customer";
    });
});
