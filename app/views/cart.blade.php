@extends('layouts.wrap')

@section('title')
タイトル
@stop

@section('body')

<div id="container">
<table class="unit-centered table-bordered cartTableVartical">
    <tr>
        <th>商品</th>
        <th>形態</th>
        <th>単価</th>
        <th>数量</th>
        <th>小計</th>
    </tr>
<?php foreach($cart as $item){ ?>
<?php foreach($item as $val){ ?>
    <tr>
    <td><?=$val['code']?></td>
    <td><?=$val['order_type']?></td>
    <td><?=$val['price']?></td>
    <td><?=$val['num']?></td>
    <td><?=$val['num']*$val['price']?></td>
    </tr>
<?php } ?>
<?php } ?>
</table>

<button src="input" onclick="javascript:location.href='./form'">入力</button>
</div>


@stop


