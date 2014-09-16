

■
{{{$last_name}}}  {{{$first_name}}}
{{{$last_name_kana}}}  {{{$first_name_kana}}}

{{{$zip}}}
{{{$prefecture}}} {{{$address1}}} {{{$address2}}}

■
{{{$addition_last_name}}}  {{{$additin_first_name}}}

{{{$addition_zip}}}
{{{$addition_prefecture}}} {{{$addition_address1}}} {{{$addition_address2}}}



@foreach ($cart as $item)
@foreach ($item as $val)
  [{{{$val['code']}}}] {{{$val['name']}}} {{{$val['price']}}} ×{{{$val['num']}}}   {{{$val['num']*$val['price']}}}円 ({{{$val['order_type']}}})
    
@endforeach
@endforeach
