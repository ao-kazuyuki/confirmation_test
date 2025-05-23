<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function index( Request $request ){
        $contacts = Contact::with('category')->Paginate(7);
        $categorys = Category::all();
        return view('admin', compact('contacts', 'categorys'));
    }

    public function search( Request $request ){
        $contacts = Contact::with('category')
                    ->KeyWordSearch($request->keyword,$request->gender,$request->category_id,$request->created_at)
                    ->Paginate(7)
                    ->appends($request->query());
        $categorys = Category::all();
        $forms = $request->all();
        unset($forms['_token']);
        return view('admin', compact('contacts', 'categorys', 'forms'));
    }

    public function destroy( Request $request ){
        Contact::find($request->contact_id)->delete();
        return redirect('/admin');
    }

    public function export( Request $request ){
        $keyword = $request->input('keyword');
        $gender = $request->input('gender');
        $category_id = $request->input('category_id');
        $created_at = $request->input('created_at');
        $contacts = Contact::with('category')->KeyWordSearch($keyword,$gender,$category_id,$created_at)->get();
        $header =[ 'id', 'category_id', 'category_content', 'first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail', 'created_at', 'updated_at' ];
        $datas = [];
        array_push($datas,$header);
        foreach( $contacts as $contact ){
            $data = [
                $contact->id,
                $contact->category_id,
                $contact->category->content,
                $contact->first_name,
                $contact->last_name,
                $contact->gender,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->detail,
                $contact->created_at->format('Y-m-d H:i:s'),
                $contact->updated_at->format('Y-m-d H:i:s')
            ];
            array_push( $datas, $data );
        }
        $handle = fopen('php://temp', 'r+b');
        foreach( $datas as $temp ){
            fputcsv( $handle, $temp );
        }
        rewind( $handle );
        $csv = stream_get_contents($handle);
        fclose( $handle );
        $csv = str_replace( PHP_EOL, "\r\n", $csv );
        //$csv = mb_convert_encoding( $csv, 'SJIS-win', 'UTF-8');
        $filename = "export_data.csv";
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename='.$filename,
        );
        return Response::make( $csv, 200, $headers );
    }

}
