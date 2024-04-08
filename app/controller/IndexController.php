<?php

namespace app\controller;

use support\Request;

class IndexController
{
    public function index(Request $request)
    {
        static $readme;
        if (!$readme) {
            $readme = file_get_contents(base_path('README.md'));
        }
        return $readme;
    }

    public function home()
    {
        return json([
            'server' => $_SERVER,
            'env' => getenv(),
        ]);
    }

    public function view(Request $request)
    {
        return view('index/view', ['name' => 'webman !']);
    }

    public function json(Request $request)
    {
        return json(['code' => 0, 'msg' => 'ok']);
    }

    public function upload(Request $request)
    {
        return view('upload', ['host' => "http://{$request->host()}"]);
    }

    public function upload_file(Request $request)
    {
        // return json(request()->file());
        // return json($request->file());
        // return var_dump($_FILES);
        $file = $request->file('avatar');
        return json($file->getUploadExtension());
        if ($file && $file->isValid()) {
            $file->move(public_path() . '/files/myfile.' . $file->getUploadExtension());
            return json(['code' => 0, 'msg' => 'upload success']);
        }
        return json(['code' => 1, 'msg' => 'file not found']);
    }

    public function test(Request $request)
    {
        return json($request->header());
    }
}
