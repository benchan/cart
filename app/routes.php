<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//Route::get('/', 'HomeController@showWelcome');


// cart
Route::get('carttest', function() {
    $items = Item::all();
    return View::make('carttest');
});

Route::post('cart', function() {
    cartCache();
    $s =  Session::get('cart');
    return View::make('cart')->with('cart', $s);
});

Route::get('/', function() {
    return View::make('hello');
});



// form
Route::get('user/{userName}', function($userName)
{
    return 'Hello, ' . $userName . '!';
});


Route::get('/form', function()
{
    $validator = myValidation(array());
    View::share('messages', $validator->messages());
    return View::make('form', iniSet());
    //return View::make('form')->with('name', $data);;
});

Route::post('/form', function() {
    $input = Input::all();
    $validator = myValidation($input);
    
    if($validator->fails()){
        return View::make('form', $input)->withErrors($validator);   
    }
    Session::flash('data', $input);
    return View::make('form_confirm', $input);
});

// send email
Route::post('send', function() {

    $input = Session::get('data');
    $cart = Session::get('cart');
    $input = array_add($input, 'cart', $cart);

    $input['prefecture'] = $prefectures[$input['prefecture']];
    $input['addition_prefecture_name'] = $prefectures[$input['prefecture']];
    $input['gender'] = $genders[$input['gender']];

    saveData();

    Mail::send(array('text' => 'emails.form'), $input, function($message)
    {
        $message->to('foo@example.com','John Smith')
            ->from('horie@local')
            ->subject('Welcome!');
    });
    return Redirect::to('send');
});

Route::get('send', function() {
    return View::make('form_sent');
});

function saveData()
{
    $input = Session::get('data');
    $cart = Session::get('cart');
    $save_data = array();

    $input['prefecture'] = $prefectures[$input['prefecture']];
    $input['addition_prefecture_name'] = $prefectures[$input['prefecture']];
    $input['gender'] = $genders[$input['gender']];

    foreach($cart as $code => $item){
        foreach($item as $val){
            $save_data[] = array_merge($input, $val);
            $order = Order::create(array_merge($input, $val));
        }
    }

    return $order;
}

function iniSet()
{
    return array(
        'first_name'=>'',
        'last_name'=>'',
        'first_name_kana'=>'',
        'last_name_kana'=>'',
        'zip'=>'',
        'prefecture'=>'',
        'city'=>'',
        'address1'=>'',
        'address2'=>'',
        'tel'=>'',
        'email'=>'',
        'gender'=>'',
        'birth_year'=>'',
        'birth_month'=>'',
        'birth_day'=>'',
        'addition_type'=>'',

        'addition_last_name'=>'',
        'addition_first_name'=>'',
        'addition_last_name_kana'=>'',
        'addition_first_name_kana'=>'',
        'addition_zip'=>'',
        'addition_prefecture_name'=>'',
        'addition_city'=>'',
        'addition_address_1'=>'',
        'addition_address_2'=>'',
        'addition_tel_1'=>'',
        'payment'=>'',
    );
}

function myValidation($input)
{
    $custom_message = array(
        'tel.numeric' => '数字のみでご記入下さい',
        'email.required' => 'We need to know your e-mail address!',
    );

    $validator = Validator::make(
        $input,
        array(
            'tel' => 'required|numeric',
            'email' => 'required|email'
        ),
        $custom_message
    );
    View::share('messages', $validator->messages());

    return $validator;
}

function cartCache()
{
    $s = array();
    if(Session::has('cart')){
        $s = Session::get('cart');
    }

    $errors = "";
    $post = Input::all();
    if(!empty($post)){

        // $post = $this->getCartData($errors);
        $code = array_get($post, 'code');
        $num = array_get($post, 'num');
        $order_type = array_get($post, 'order_type');
        $price = array_get($post, 'price');


        // count
        if(isset($s[$code][$order_type]) && isset($s[$code][$order_type])){
            $s[$code][$order_type]['num'] += $num;
            $s[$code][$order_type]['price'] = $price;

        }else{
            if($code && $num && $order_type){
                $s[$code][$order_type]['code'] = $code;
                $s[$code][$order_type]['num'] = $num;
                $s[$code][$order_type]['order_type'] = $order_type;
                $s[$code][$order_type]['price'] = $price;
            }
        }
    }

    Session::put('cart', $s);

    return $s;
}




$prefectures = array(
        "北海道", "青森県", "岩手県", "宮城県", "秋田県",
        "山形県", "福島県", "茨城県", "栃木県", "群馬県",
        "埼玉県", "千葉県", "東京都", "神奈川県", "新潟県",
        "富山県", "石川県", "福井県", "山梨県", "長野県",
        "岐阜県", "静岡県", "愛知県", "三重県", "滋賀県",
        "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県",
        "鳥取県", "島根県", "岡山県", "広島県", "山口県",
        "徳島県", "香川県", "愛媛県", "高知県", "福岡県",
        "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県",
        "鹿児島県", "沖縄県");

$genders=array(0=>"-", 1=>"女性",2=>"男性");


View::share('prefectures', $prefectures);
View::share('genders', $genders);



