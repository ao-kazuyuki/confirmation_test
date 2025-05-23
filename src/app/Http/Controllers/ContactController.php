<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $categorys = Category::all();
        return view('index', compact('categorys'));
    }

    public function edit( Request $request ){
        $categorys = Category::all();
        $forms = $request->all();
        unset($forms['_token']);
        return view('index', compact('categorys', 'forms'));
    }

    public function confirm( ContactRequest $request ){
        $categorys = Category::all();
        $form = $request->all();
        unset($form['_token']);
        return view('confirm', compact('categorys', 'form') );
    }

    public function add( Request $request ){
        $inputs = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail'
        ]);
        Contact::create($inputs);
        return view('thanks');
    }

}
