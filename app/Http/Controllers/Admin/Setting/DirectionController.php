<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Services\Admin\Setting\DirectionService;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    
    private $directionService;

    public function __construct()
    {
        $this->directionService = new DirectionService();
    }

    public function index(Request $request)
    {
        // permission
        $data['title'] = __('directions_title');

        $data['list'] = $this->directionService->findAll();

        return view('admin.pages.setting.direction.directions', $data);
    }

    public function store(Request $request)
    {
        // permission
        $validated = $this->directionService->validate($request);

        if ($this->directionService->create($validated)){
            return redirect('admin/settings/directions')->with('status', '200');
        }

        return redirect('admin/settings/directions')->with('status', '500');
    }

    public function get(Request $request, $id = '')
    {
        // permission
        $data['title'] = __('direction_add_title');

        if ($id!=''){
            $data['direction'] = $this->directionService->find($id);
            $data['title'] = __('direction_edit_title') . ' ' . $data['direction']->name;
        }

        return view('admin.pages.setting.direction.direction', $data);
    }

    public function update(Request $request, $id)
    {
        // permission
        $validated = $this->directionService->validate($request);

        if ($this->directionService->update($validated, $id)){
            return redirect('admin/settings/directions')->with('status', '200');
        }

        return redirect('admin/settings/directions')->with('status', '500');
    }

    public function destroy(Request $request, $id)
    {
        // permission
        $this->directionService->delete($id);

        return redirect('admin/settings/directions')->with('status', '200');
    }

}
