<?php

namespace App\Http\Controllers;

use App\Lib\Hash;
use App\Http\Requests\UrlRequest;
use App\Url;
use Illuminate\Http\Request;

/**
 * Class UrlController
 * @package App\Http\Controllers
 */
class UrlController extends Controller
{
    /**
     * @param UrlRequest|Request $request
     * @return string
     */
    public function hash(UrlRequest $request)
    {
        $input = $request->all();

        $id = Url::create($input)->id;
        $shortLink = (new Hash())->hash($id);

        return collect(['result' => $shortLink])->toJson();
    }

    /**
     * @param $short
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect($short)
    {
        $id = (new Hash())->unhash($short);
        $url = Url::findOrFail($id)->url;

        return redirect($url);
    }
}
