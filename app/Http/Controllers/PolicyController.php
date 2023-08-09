<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Parsedown;

use App\Models\Policy;

class PolicyController extends Controller
{

    // 隱私權政策
    public function privacy_policy()
    {

        $data = Policy::find(1);

        $parser = new Parsedown();
        $content_markdown = $parser->text($data->content);

        return view(
            'privacy',
            compact('data', 'content_markdown')
        );
    }
}
