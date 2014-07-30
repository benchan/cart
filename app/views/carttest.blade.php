@extends('layouts.wrap')

@section('title')
タイトル
@stop

@section('body')
{{Form::open(array('url' => 'cart'))}}


<p>商品ID:<input type="text" name="code" value="1001" /><!-- 商品ID -->
個数: <input name="num" type="text" value="1" /><!-- 個数 -->
価格: <input name="price" type="text" value="3200" /><!-- 価格 -->
<select name="order_type">
<option value="1">通常購入</option>
<option value="2">定期購入</option>
<option value="3">サンプル</option>
</select>
<button type="submit">買い物カゴに入れる</button>
</p>


{{Form::submit('submit')}}
{{Form::close()}}
@stop


