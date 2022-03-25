<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
class CommonController extends Controller
{    
    /* 
    * routes/web.php: Route::get('displayFile/{id}/{type}/{name}', [App\Http\Controllers\CommonController::class,'displayFile'])->name('displayFile');
    *
    *
    * blade file: <a href="{{ url('common/displayFile/'.Crypt::encryptString($value['id']).'/'.Crypt::encryptString('LEAD_DOCUMENTS').'/'.$value['name']) }}" target="_blank">
    * 
    */
    public function displayFile(Request $request,$id, $type, $name)
    {
        try {
            $id = Crypt::decryptString($id);
            $type = Crypt::decryptString($type);
        } catch(\Exception $e) {
            abort(403);
        }

        $response = CommonService::getFileInformation($id, $type);
        if(!$response['status']) {
            return Redirect::back()->with('error', $response['message']);
        }
        $path = $response["data"]['path']."/";
        $img = file_get_contents(public_path($path).$response['data']['filename']);
        if(file_exists(public_path($path) . $response['data']['filename'])){
        }else{
            abort(404);
        }
        return response($img)->header('Content-type',$response['data']['mime_type']);
    }
}