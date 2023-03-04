<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Services\Admin\Setting\QaService;
use Illuminate\Http\Request;

class QaController extends Controller
{

    private $qaService;

    public function __construct()
    {
        $this->qaService = new QaService();
    }
    
    public function api_store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $qa = $this->qaService->save($validated);

        return response()->json(['msg' => 'success', 'id' => $qa->id], 200);
    }

    public function api_update(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        $validated['id'] = $id;

        $this->qaService->save($validated);

        return response()->json(['msg' => 'success'], 200);
    }

}
