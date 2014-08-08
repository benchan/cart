@extends('layouts.wrap')

@section('title')
タイトル
@stop

@section('head')
<script src="/js/cart.input_customer.js"></script>
@stop

@section('body')
<?=Form::open(array('url' => 'form'));?>
<div>
<table class="unit-centered table-bordered cartTableVartical">
    <tbody><tr>
        <td colspan="2"><strong>ご注文者様情報</strong></td>
    </tr>
    <tr>
        <th>お名前</th>
        <td>
<?=Form::text('last_name', $last_name, array('required'=>'required', 'placeholder'=>'姓'));?>
            &nbsp;
<?=Form::text('first_name', $first_name, array('required'=>'required', 'placeholder'=>'名'));?>
</td>
    </tr>
    <tr>
        <th>フリガナ</th>
        <td>
<?=Form::text('last_name_kana', $last_name_kana, array('required'=>'required', 'placeholder'=>'セイ'));?>
            &nbsp;
<?=Form::text('first_name_kana', $first_name_kana, array('required'=>'required', 'placeholder'=>'メイ'));?>
       </td>
    </tr>
    <tr>
        <th>郵便番号</th>
        <td>

〒 <?=Form::text('zip', $zip, array(
    'required'=>'required',
    'placeholder'=>'郵便番号',
    'maxlength'=>'8',
    'size'=>'12'
));?>
    </tr>
    <tr>
        <th>都道府県</th>
        <td>
   <?=Form::select('prefecture', $prefectures, $prefecture);?>
      </td>
    </tr>
    <tr>
        <th>市区町村</th>
        <td>
<?=Form::text('city', $city, array('required'=>'required', 'placeholder'=>'市区町村', 'class'=>'width-80'));?>
    </tr>
    <tr>
        <th>住所1</th>
        <td>
<?=Form::text('address1', $address1, array('required'=>'required', 'placeholder'=>'住所1', 'class'=>'width-80'));?>
    </tr>
    <tr>
        <th>住所2</th>
        <td>
<?=Form::text('address2', $address2, array('required'=>'required', 'placeholder'=>'住所2','class'=>"width-80"));?>

        </td>
    </tr>
    <tr>
        <th>電話番号</th>
        <td>
<?=Form::text('tel', $tel, array(
    'required'=>'required',
    'placeholder'=>'TEL',
    'maxlength'=>'11',
    'class'=>'width-80',
));?>

{{{$messages->first('tel')}}}
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td>
<?=Form::text('email', $email, array('required'=>'required', 'placeholder'=>'メールアドレス','class'=>"width-80"));?>
{{{$messages->first('email')}}}
    </tr>
    <tr>
        <th>性別</th>
        <td>
   <?=Form::select('gender', $genders, $gender);?>
        </td>
    </tr>
    <tr>
        <th>生年月日</th>
        <td>
<?=Form::text('birth_year', $birth_year, array('maxlength'=>"4","class"=>"width-10"));?>
 年
<?=Form::text('birth_month', $birth_month, array('maxlength'=>"2","class"=>"width-10"));?>
 月
<?=Form::text('birth_day', $birth_day, array('maxlength'=>"2","class"=>"width-10"));?>
 日
 </td>
    </tr>
    <tr>
        <th>お届け先選択</th>
        <td>
<?=Form::radio('addition_type', 0, ! $addition_type, array("id"=>"addition_type", "required"=>"required"));?>顧客住所へ配送
<?=Form::radio('addition_type', 1, $addition_type, array("id"=>"addition_type_on","required"=>"required"));?>別の住所へ配送
    </tr>
</tbody></table>
<br/>
<table style="display: table;" class="unit-centered table-bordered cartTableVartical" id="additionTable">
    <tbody><tr>
        <td colspan="2"><strong>お届け先情報</strong></td>
    </tr>
    <tr>
        <th>お届け先お名前</th>
        <td>
<!--
            <input name="addition_last_name" placeholder="姓" disabled="disabled" maxlength="40" id="addition_last_name" type="text">&nbsp;<input name="addition_first_name" placeholder="名" disabled="disabled" maxlength="40" id="addition_first_name" type="text">        
-->
<?=Form::text('addition_last_name', $addition_last_name, array('placeholder'=>'姓'));?>
            &nbsp;
<?=Form::text('addition_first_name', $addition_first_name, array('placeholder'=>'名'));?>


        </td>
    </tr>
    <tr>
        <th>お届け先フリガナ</th>
        <td>

<?=Form::text('addition_last_name_kana', $addition_last_name_kana, array('placeholder'=>''));?>
            &nbsp;
<?=Form::text('addition_first_name_kana', $addition_first_name_kana, array('placeholder'=>''));?>
</td>
    </tr>
    <tr>
        <th>お届け先郵便番号</th>
        <td>
            〒 <?=Form::text('addition_zip', $addition_zip, array(
    'placeholder'=>'郵便番号',
    'maxlength'=>'8',
    'size'=>'12'
));?>
        </td>
    </tr>
    <tr>
        <th>お届け先都道府県</th>
        <td>
            <?=Form::select('addition_prefecture_name', $prefectures, $addition_prefecture_name);?>
        </td>
    </tr>
    <tr>
        <th>お届け先市区町村</th>
        <td>

<?=Form::text('addition_city', $addition_city, array('placeholder'=>'市区町村', 'class='>'width-80'));?>
        </td>
    </tr>
    <tr>
        <th>お届け先住所1</th>
        <td>
<?=Form::text('addition_address_1', $addition_address_1, array('placeholder'=>'住所1','class'=>"width-80"));?>
</td>
    </tr>
    <tr>
        <th>お届け先住所2</th>
        <td>

<?=Form::text('addition_address_2', $addition_address_2, array('placeholder'=>'住所2','class'=>"width-80"));?>
        </td>
    </tr>
    <tr>
        <th>お届け先電話番号</th>
        <td>

<?=Form::text('addition_tel_1', $addition_tel_1, array(
    'placeholder'=>'TEL',
    'maxlength'=>'11',
    'class'=>'width-80',
));?>

</td>
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
@stop


