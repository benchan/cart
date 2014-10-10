<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>confirm</title>
	<link rel="stylesheet" type="text/css" href="/css/kube.css">
	<link rel="stylesheet" type="text/css" href="/css/cart.css">
    <style>
        body {
            margin:0;
            font-family:'Lato', sans-serif;
            text-align:center;
            color: #999;
        }
        a, a:visited {
            text-decoration:none;
        }

        h1 {
            font-size: 32px;
            margin: 16px 0 0 0;
        }
        #wrap{
            width:80%;
            max-width:500px;
            margin:auto;
        }
        table{
            margin-bottom:10px !important;
        }
    </style>
</head>
<body>
<?php //var_dump($errors); ?>
<?php 
    echo $errors->first('tel');
?>
    <div id="wrap">
<?=Form::open(array('url' => 'send'));?>
<div>
<table class="unit-centered table-bordered cartTableVartical">
    <tbody><tr>
        <td colspan="2"><strong>ご注文者様情報</strong></td>
    </tr>
    <tr>
        <th>お名前</th>
        <td>
{{{$last_name}}} &nbsp; {{{$first_name}}}
</td>
    </tr>
    <tr>
        <th>フリガナ</th>
        <td>
            {{{$last_name_kana}}} &nbsp; {{{$first_name_kana}}}
       </td>
    </tr>
    <tr>
        <th>郵便番号</th>
        <td>{{{$zip}}}</td>
    </tr>
    <tr>
        <th>都道府県</th>
        <td>{{{$prefecture}}} </td>
    </tr>
    <tr>
        <th>市区町村</th>
        <td>{{{$city}}} </td></tr>
    <tr>
        <th>住所1</th>
        <td> {{{$address1}}} </td>
    </tr>
    <tr>
        <th>住所2</th>
        <td> {{{$address2}}} </td>
    </tr>
    <tr>
        <th>電話番号</th>
        <td>{{{$tel}}}</td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td> {{{$email}}} </td>
    </tr>
    <tr>
        <th>性別</th>
        <td> {{{$gender}}} </td>
    </tr>
    <tr>
        <th>生年月日</th>
        <td> {{{$birth_year}}} 年 {{{$birth_month}}} 月 {{{$birth_day}}} 日 </td>
    </tr>
    <tr>
        <th>お届け先選択</th>
        <td>
<?=Form::radio('addition_type', 0, ! $addition_type, array("id"=>"addition_type", "required"=>"required"));?>顧客住所へ配送
<?=Form::radio('addition_type', 1, $addition_type, array("id"=>"addition_type_on","required"=>"required"));?>別の住所へ配送
    </tr>
</tbody></table>

<table style="display: table;" class="unit-centered table-bordered cartTableVartical" id="additionTable">
    <tbody><tr>
        <td colspan="2"><strong>お届け先情報</strong></td>
    </tr>
    <tr>
        <th>お届け先お名前</th>
        <td> {{{$addition_last_name}}} &bsp; {{{$addition_first_name}}} </td>
    </tr>
    <tr>
        <th>お届け先フリガナ</th>
        <td> {{{$addition_last_name_kana}}} &nbsp; {{{$addition_first_name_kana}}} </td>
    </tr>
    <tr>
        <th>お届け先郵便番号</th>
        <td>{{{$addition_zip}}}</td>
    </tr>
    <tr>
        <th>お届け先都道府県</th>
        <td>{{{$addition_prefecture}}} </td>
    </tr>
    <tr>
        <th>お届け先市区町村</th>
        <td>{{{$addition_city}}} </td>
    </tr>
    <tr>
        <th>お届け先住所1</th>
        <td>{{{$addition_address_1}}} </td>
    </tr>
    <tr>
        <th>お届け先住所2</th>
        <td>{{{$addition_address_2}}} </td>
    </tr>
    <tr>
        <th>お届け先電話番号</th>
        <td>{{{$addition_tel_1}}} </td>
    </tr>
</tbody></table>

<table class="unit-centered table-bordered cartTableVartical">
    <tbody><tr>
        <td colspan="2"><strong>支払い・配送</strong></td>
    </tr>
    <tr>
        <th>支払方法</th>
        <td>

<?=Form::radio('payment', 'a', ($payment=='a'), array("required"=>"required"));?>クレジットカード
<?=Form::radio('payment', 'b', ($payment=='b'), array("required"=>"required"));?>代引き


    </tr>
</table>
</div>


<?=Form::submit('submit');?>
<?=Form::close(); ?>
    </div>
</body>
</html>
