<?php

namespace App\Http\Controllers\Deal;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function __invoke()
    {

//        $data = $request->validated();
//
//        $page = $data['page'] ?? 1;
//        $perPage = $data['per_page'] ?? 10;
//
//        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);
//        $posts = Post::filter($filter)->paginate($perPage, ['*'], 'page', $perPage);
        $deals = Deal::all();
//        dd($deals);
        return view('deal.index', compact('deals'));
    }
}
