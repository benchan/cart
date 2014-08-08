

{{{$last_name}}}  {{{$first_name}}}
{{{$last_name_kana}}}  {{{$first_name_kana}}}

{{{$zip}}}
{{{$prefecture}}} {{{$address1}}} {{{$address2}}}


@foreach ($cart as $item)
@foreach ($item as $val)
  [{{{$val['code']}}}] {{{$val['price']}}} ×{{{$val['num']}}} = {{{$val['num']*$val['price']}}}円 ({{{$val['order_type']}}})
    
@endforeach
@endforeach
