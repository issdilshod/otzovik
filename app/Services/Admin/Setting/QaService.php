<?php

namespace App\Services\Admin\Setting;

use App\Models\Admin\Setting\Qa;
use App\Services\Service;
use Illuminate\Support\Facades\Config;

class QaService extends Service{

    public function save($qa)
    {
        $qaOrg = Qa::where('question', $qa['question'])
                    ->where('answer', $qa['answer'])
                    ->where('rel', $qa['rel'])
                    ->when(isset($qa['id']), function($q) use($qa){
                        $q->where('id', $qa['id']);
                    })
                    ->first();
        if ($qaOrg!=null){
            $qa['status'] = Config::get('status.active');
            $qa = $qaOrg->update($qa);
        }else{
            $qa = Qa::create($qa);
        }
        return $qa;
    }

    public function remove($id)
    {
        //
    }

    public function removeByRel($rel)
    {
        Qa::where('status', Config::get('status.active'))
            ->where('rel', $rel)
            ->update(['status' => Config::get('status.delete')]);
        return true;
    }

}