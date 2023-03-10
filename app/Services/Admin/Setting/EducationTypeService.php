<?php

namespace App\Services\Admin\Setting;

use App\Services\Admin\Misc\StringService;
use App\Services\Service;
use App\Models\Admin\Setting\EducationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EducationTypeService extends Service{

    public function findAll($name = '')
    {
        $educationTypes = EducationType::orderBy('name')
                            ->where('status', '!=', Config::get('status.delete'))
                            ->when($name!='', function($q) use($name){
                                return $q->where('name', 'like', $name . '%');
                            })
                            ->paginate(Config::get('pagination.per_page'));
        return $educationTypes;
    }

    public function getAll()
    {
        $educationTypes = EducationType::orderBy('name', 'asc')
                            ->where('status', '!=', Config::get('status.delete'))
                            ->get();
        return $educationTypes;
    }

    public function find($id)
    {
        $educationType = EducationType::where('status', '!=', Config::get('status.delete'))
                            ->where('id', $id)
                            ->first();
        return $educationType;
    }

    public function create($educationType)
    {
        // user id
        $educationType['user_id'] = $educationType['current_user_id'];

        // slug
        $educationType['slug'] = StringService::slug($educationType['name']);

        $educationType = EducationType::create($educationType);
        return $educationType;
    }

    public function update($educationType, $id)
    {
        // user id
        $educationType['user_id'] = $educationType['current_user_id'];
        unset($educationType['current_user_id']);

        // slug
        $educationType['slug'] = StringService::slug($educationType['name']);

        $educationType = EducationType::where('id', $id)
                            ->where('status', '!=', Config::get('status.delete'))
                            ->update($educationType);
        return $educationType;
    }

    public function delete($id)
    {
        EducationType::where('id', $id)
            ->update(['status' => Config::get('status.delete')]);
        return true;
    }

    public function validate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'current_user_id' => ''
        ]);

        return $validated;
    }

}