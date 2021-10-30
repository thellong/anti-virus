<?php

namespace App\Http\Services\News;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Session;

class NewsAdminService
{
    public function getAll()
    {
        return Category::orderByDesc('id')->get();
    }

    public function get()
    {
        return News::orderByDesc('id')->paginate(15);
    }
    public function insert($request)
    {
        try {
            $request->except('_token');
            News::create($request->all());
            Session::flash('success', 'Thêm bài viết thành công!');
        } catch (\Exception $error) {
            Session::flash('error', 'Thêm bài viết thật bại! Mã lỗi: ' . $error->getMessage());
            return false;
        }
        return true;
    }
}