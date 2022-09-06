<?php

namespace App\Http\Controllers;


use App\Http\Requests\UploadFileRequest;
use App\Http\Services\File\FileService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('welcome');
    }

    public function upload(UploadFileRequest $request)
    {
        $file = \request()->file('file');
        $fileData = $this->fileService->readFile($file->path());

        if ($this->fileService->store($fileData)){
            return redirect('/', 201)
                ->with('message', 'Success!');
        }
        return abort(501);
    }

}
