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
Route::get('/', function() {
    return View::make('hello');
});


Route::get('/item', 'ItemController@show');

//Route::get('/', 'HomeController@showWelcome');


// cart
Route::get('carttest', function() {
    return View::make('carttest');
});

// cart insert
Route::post('cart', function() {
    cartCache();
    $s =  Session::get('cart');
    return View::make('cart')->with('cart', $s);
});
// cart view
Route::get('cart', function()
{
    if(!Session::has('cart')) return View::make('cart_none');
 

    $s =  Session::get('cart');
    return View::make('cart')->with('cart', $s);
});


// form
Route::get('user/{userName}', function($userName)
{
    return 'Hello, ' . $userName . '!';
});

// form
Route::get('/form', function()
{
    if(!Session::has('cart')) return Redirect::to('cart');
 
    $validator = myValidation(array());
    View::share('messages', $validator->messages());
    return View::make('form', iniSet());
    //return View::make('form')->with('name', $data);;
});

Route::post('/form', function() {
    $input = Input::all();
    $validator = myValidation($input);
    Session::put('data', $input);

    if($validator->fails()){
        return View::make('form', $input)->withErrors($validator);   
    }
    return View::make('form_confirm', $input);
});

// send email
Route::post('send', function() {

    $input = Session::get('data');
    $cart = Session::get('cart');
    $input = array_add($input, 'cart', $cart);
    saveData();

    Mail::send(array('text' => 'emails.form'), $input, function($message)
    {
        $message->to('foo@example.com','John Smith')
            ->from('horie@local')
            ->subject('Welcome!');
    });
    Session::flush();
    return Redirect::to('send');
});

Route::get('send', function() {
    return View::make('form_sent');
});


Route::get('/csv', function() {
    $table = Order::all();
    $output="";
 
    foreach ($table as $row) {
        $output .= '"';
        $output .=  implode('","',$row->toArray());
        $output .= "\"\n";
    }
    $headers = array(
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="ExportFileName.csv"',
    );
 
    return Response::make(rtrim($output, "\n"), 200, $headers);
});


Route::get('/csv2', function() {
    get_export();
});




/**
 * get_export 
 * saved to public folder
 * 
 * @access public
 * @return void
 */
function get_export()
{
    $table = Order::all();
    $file = fopen('file.csv', 'w');
    foreach ($table as $row) {
        fputcsv($file, $row->toarray());
    }
    fclose($file);
    //return Redirect::to('consolidated');
}




function saveData()
{
    $input = Session::get('data');
    $cart = Session::get('cart');
    $save_data = array();

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
    // ある場合
    if($input = Session::get('data'))  return $input;

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
        'addition_prefecture'=>'',
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
    //$items = Item::all();
 
    $s = array();
    if(Session::has('cart')){
        $s = Session::get('cart');
    }

    $errors = "";
    $post = Input::all();
    if(!empty($post)){

        // $post = $this->getCartData($errors);
        $code = array_get($post, 'code');
        $name = array_get($post, 'name');
        $num = array_get($post, 'num');
        $order_type = array_get($post, 'order_type');
        $price = array_get($post, 'price');

        /**
         *  DBAから商品コードを元に
         *  商品データの取得
         */
        $itemArr = Item::where('code', '=', $code)->first();
        if(!empty($itemArr)){
            $item = $itemArr->toarray();
            $name = $item["name"];
            $price = $item["price"];
        }


        // count
        if(isset($s[$code][$order_type]) && isset($s[$code][$order_type])){
            $s[$code][$order_type]['name'] = $name;
            $s[$code][$order_type]['num'] += $num;
            $s[$code][$order_type]['price'] = $price;

        }else{
            if($code && $num && $order_type){
                $s[$code][$order_type]['code'] = $code;
                $s[$code][$order_type]['name'] = $name;
                $s[$code][$order_type]['num'] = $num;
                $s[$code][$order_type]['order_type'] = $order_type;
                $s[$code][$order_type]['price'] = $price;
            }
        }
    }

    Session::put('cart', $s);

    return $s;
}




$_prefectures = array(
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
foreach($_prefectures as $val){
    $prefectures[$val] = $val;
}

$genders=array(0=>"-", "女性"=>"女性", "男性"=>"男性");

View::share('prefectures', $prefectures);
View::share('genders', $genders);



