<?php

namespace App\Http\Controllers;

use App\Lib\Hash;
use App\Http\Requests\UrlRequest;
use App\Url;
use App\PremiumUrl;
use Illuminate\Http\Request;
use function Psy\sh;

/**
 * Class UrlController
 * @package App\Http\Controllers
 */
class UrlController extends Controller
{
    private $premium = [
        'http://vk.com' => 'cool_vk',
        'http://google.com' => 'cool_google'
    ];

    /**
     * @param UrlRequest|Request $request
     * @return string
     */
    public function hash(UrlRequest $request)
    {
        $input = $request->all();
        $id = Url::create($input)->id;
        $shortLink = (new Hash())->hash($id);
        if(in_array($shortLink, array_values($this->premium))) {
            return collect(['result' => false, 'message' => 'Данный uri уже занят'])
                ->toJson();
        }

        return collect(['result' => $shortLink])->toJson();
    }

    /**
     * @param $short
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function action($short)
    {
        if(in_array($short, array_values($this->premium))) {
            return redirect(array_flip($this->premium)[$short]);
        }

        $id = (new Hash())->unhash($short);
        $url = Url::findOrFail($id)->url;

        return redirect($url);
    }
}
