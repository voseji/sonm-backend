<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use Validator;
use Illuminate\Http\Request;

class FileUploadController extends Controller {
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(),[
              'file' => 'required|mimes:png,jpeg,jpg|max:2048',
        ]);

        if($validator->fails()) {

            return response()->json(['error'=>$validator->errors()], 401);
         }


        if ($file = $request->file('file')) {
          $path = $request->file('file')->store('public/files');
            // $path = $file->store('public/files');
            // $name = $file->getClientOriginalName();
            $special = $request->special;

            //store your file into directory and db
            $save = new FileUpload();
            $save->special = $special;
            // $save->special2 = $special;
            $save->path= $path;
            $save->save();

            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $path
            ]);
        }
    }

    public function getImage(Request $request, $special) {
      return File::where('special', '=', $special)->first();
    }

}