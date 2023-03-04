<?php

namespace App\Services\Admin\Setting;

use App\Models\Admin\Setting\Qa;
use App\Services\Service;
use Illuminate\Support\Facades\Config;

class QaService extends Service{

    public function findByRel($rel = null)
    {
        $qas = Qa::where('rel', $rel)
                    ->where('status', Config::get('status.active'))
                    ->get();
        return $qas;
    }

    public function save($qa)
    {
        if (isset($qa['id'])){
            $qaOrg = Qa::when(isset($qa['id']), function($q) use($qa){
                            $q->where('id', $qa['id']);
                        })
                        ->first();
        }else{
            $qaOrg = null;
        }
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