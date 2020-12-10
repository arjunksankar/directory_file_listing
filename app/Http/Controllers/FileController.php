<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Requests\FileRequest;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * Listing function
     */
    public function index(Request $request, $slug=null){
        $files = File::query();
        if($request->search){
            if(strpos($request->search, '*') !== false){
                $request->search = str_replace('*','%',$request->search);
            }
            $files = $files->where('name','like','%'.$request->search.'%');
        }
        if($slug == 'uploaded'){
            $files = $files->withTrashed();
        } elseif($slug == 'deleted'){
            $files = $files->onlyTrashed();
        }
        return view('files.index', [
            'files' => $files->paginate(5)->appends(['search'=>$request->search]),'request'=>$request
        ]);
    }

    /**
     * Store function
     */
    public function store(FileRequest $request){
        $fileName = "file".time().'.'.request()->file->getClientOriginalExtension();
        $request->file->storeAs('files',$fileName);
        File::create(['name'=>$fileName]);
        return redirect()->route('list_files')->withSuccess('File uploaded successfully');;
    }
    /**
     * Destroy function
     */
    public function destroy(File $file){
        $file->delete();
        return redirect()->route('list_files');
    }
}
