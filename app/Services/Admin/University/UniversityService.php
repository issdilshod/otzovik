<?php

namespace App\Services\Admin\University;

use App\Models\Admin\Review\Review;
use App\Models\Admin\Setting\Qa;
use App\Models\Admin\Setting\Seo;
use App\Services\Admin\Misc\StringService;
use App\Services\Service;
use App\Models\Admin\University\University;
use App\Models\Admin\University\UniversityDirection;
use App\Models\Admin\University\UniversityEducationLevel;
use App\Models\Admin\University\UniversityEducationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UniversityService extends Service{

    private $universityDirectionService;
    private $universityEducationTypeService;
    private $universityEducationLevelService;

    public function __construct()
    {
        $this->universityDirectionService = new UniversityDirectionService();
        $this->universityEducationTypeService = new UniversityEducationTypeService();
        $this->universityEducationLevelService = new UniversityEducationLevelService();
    }

    public function findCount()
    {
        $count = University::where('status', '!=', Config::get('status.delete'))
                    ->count();
        return $count;
    }
    
    public function findAll($name = '')
    {
        $universities = University::withCount('reviews')
                            ->orderBy('name')
                            ->where('status', '!=', Config::get('status.delete'))
                            ->when($name!='', function ($q) use($name){
                                $q->where('name', 'like', $name . '%');
                            })
                            ->paginate(Config::get('pagination.per_page'));
        return $universities;
    }

    public function find($id)
    {
        $university = University::where('id', $id)
                        ->where('status', '!=', Config::get('status.delete'))
                        ->first();
        if ($university==null){
            return false;
        }

        // directions
        $university['directions'] = UniversityDirection::where('status', '!=', Config::get('status.delete'))
                                        ->where('university_id', $id)
                                        ->get();
        // educations type
        $university['education_types'] = UniversityEducationType::where('status', '!=', Config::get('status.delete'))
                                            ->where('university_id', $id)
                                            ->get();

        // education level
        $university['education_levels'] = UniversityEducationLevel::where('status', '!=', Config::get('status.delete'))
                                            ->where('university_id', $id)
                                            ->get();

        // qas
        $university['qas'] = Qa::where('status', Config::get('status.active'))
                                ->where('rel', $id)
                                ->get();

        // seo 
        $university->seo = Seo::where('url', $university->slug)
                                ->first();

        return $university;
    }

    public function findAllFront($city = '', $direction = '', $page = '', $filter = '', $level = '', $type = '', $name = '')
    {
        $universities = University::from('universities')
                            ->withCount('reviews')
                            ->where('universities.status', Config::get('status.active'))
                            ->when($city!='', function($q) use($city){ // city filter
                                $q->where('universities.city_id', $city);
                            })
                            ->when($direction!='', function($q) use($direction){ // direction filter
                                $q->join('university_directions as ud', 'ud.university_id', '=', 'universities.id')
                                    ->where('ud.direction_id', $direction);
                            })
                            ->when($level!='', function($q) use($level){ // filter by level
                                $q->join('university_education_levels as uel', 'uel.university_id', '=', 'universities.id')
                                    ->where('uel.education_level_id', $level);
                            })
                            ->when($type!='', function($q) use($type){ // filter by type
                                $q->join('university_education_types as uet', 'uet.university_id', '=', 'universities.id')
                                    ->where('uet.education_type_id', $type);
                            })
                            ->when($filter!='', function($q) use($filter){ // specific filter 
                                if ($filter=='po_kolicestvu_otzyvov'){ // filter by review
                                    $q->orderBy('reviews_count', 'desc');
                                }else if ($filter=='po_reytingu'){ // filter by rate
                                    $q->orderBy('universities.worlds_rate')
                                        ->orderBy('universities.russian_rate');
                                }else if ($filter=='po_novinkam'){ // filter by new
                                    $q->orderBy('universities.updated_at');
                                }
                            })
                            ->when($filter=='', function($q) { // default filter by review count
                                $q->orderBy('reviews_count', 'desc');
                            })
                            ->when($name!='', function($q) use($name){
                                $q->where('name', 'like', $name.'%');
                            })
                            ->paginate(Config::get('pagination.per_page'), ['universities.*'], '', $page);
        return $universities;
    }

    public function first()
    {
        $university = University::withCount('reviews')
                        ->first();

        // get directions
        $university->directions = UniversityDirection::from('university_directions as ud1')
                            ->select(['d1.name', 'd1.slug'])
                            ->join('directions as d1', 'd1.id', '=', 'ud1.direction_id')
                            ->where('ud1.status', Config::get('status.active'))
                            ->where('ud1.university_id', $university->id)
                            ->get();

        // get educations
        $university->education_types = UniversityEducationType::from('university_education_types as uet1')
                                    ->select('et1.name')
                                    ->join('education_types as et1', 'et1.id', '=', 'uet1.education_type_id')
                                    ->where('uet1.status', Config::get('status.active'))
                                    ->where('uet1.university_id', $university->id)
                                    ->get();

        // qas
        $university['qas'] = Qa::where('status', Config::get('status.active'))
                                ->where('rel', $university->id)
                                ->get();

        return $university;
    }

    public function getAll()
    {
        $universities = University::where('status', '!=', Config::get('status.delete'))
                            ->get(['id', 'name', 'logo']);
        return $universities;
    }

    public function findBySlug($slug)
    {
        $university = University::withCount('reviews')
                        ->where('status', Config::get('status.active'))
                        ->where('slug', $slug)
                        ->first();
        if ($university==null){
            return false;
        }

        // get directions
        $university->directions = UniversityDirection::from('university_directions as ud1')
                                    ->select(['d1.name', 'd1.slug'])
                                    ->join('directions as d1', 'd1.id', '=', 'ud1.direction_id')
                                    ->where('ud1.status', Config::get('status.active'))
                                    ->where('ud1.university_id', $university->id)
                                    ->get();

        // get educations
        $university->education_types = UniversityEducationType::from('university_education_types as uet1')
                                            ->select('et1.name')
                                            ->join('education_types as et1', 'et1.id', '=', 'uet1.education_type_id')
                                            ->where('uet1.status', Config::get('status.active'))
                                            ->where('uet1.university_id', $university->id)
                                            ->get();

        // qas
        $university['qas'] = Qa::where('status', Config::get('status.active'))
                                ->where('rel', $university->id)
                                ->get();
        
        return $university;
    }

    public function top($count = 10)
    {
        $universities = University::withCount('reviews')
                            ->where('status', Config::get('status.active'))
                            ->limit($count)
                            ->orderBy('reviews_count', 'desc')
                            ->get();
        return $universities;
    }

    public function popular($count = 4)
    {
        $universities = University::withCount('reviews')
                            ->where('status', Config::get('status.active'))
                            ->limit($count)
                            ->orderBy('reviews_count', 'desc')
                            ->get();
        return $universities;
    }

    public function create($university)
    {
        // user id
        $university['user_id'] = $university['current_user_id'];

        // slug
        if (!isset($university['slug']) || $university['slug']==''){
            $university['slug'] = StringService::slug($university['name']);
        }

        // accreditation
        if (isset($university['accreditation'])){
            $university['accreditation'] = 1;
        }else{
            $university['accreditation'] = 0;
        }

        // Get directions
        $tmpDirections = [];
        if (isset($university['directions'])){
            $tmpDirections = $university['directions'];
        }

        // Get education types
        $tmpEducationTypes = [];
        if (isset($university['education_types'])){
            $tmpEducationTypes = $university['education_types'];
        }

        // Get education levels
        $tmpEducationLevels = [];
        if (isset($university['education_levels'])){
            $tmpEducationLevels = $university['education_levels'];
        }

        // CREATE
        $university = University::create($university);

        // directions
        foreach($tmpDirections as $key => $value):
            $this->universityDirectionService->store($university->id, $value);
        endforeach;

        // education types
        foreach($tmpEducationTypes as $key => $value):
            $this->universityEducationTypeService->store($university->id, $value);
        endforeach;

        // education levels
        foreach($tmpEducationLevels as $key => $value):
            $this->universityEducationLevelService->store($university->id, $value);
        endforeach;

        return $university;
    }

    public function update($university, $id)
    {
        // user id
        $university['user_id'] = $university['current_user_id']; 
        unset($university['current_user_id']);

        // slug
        if ($university['slug']==''){
            $university['slug'] = StringService::slug($university['name']);
        }

        // logo
        if ($university['logo']==null){
            unset($university['logo']);
        }

        // accreditation
        if (isset($university['accreditation'])){
            $university['accreditation'] = 1;
        }else{
            $university['accreditation'] = 0;
        }

        // Get directions
        $tmpDirections = [];
        if (isset($university['directions'])){
            $tmpDirections = $university['directions'];
            unset($university['directions']);
        }

        // directions
        $this->universityDirectionService->delete_by_university($id);
        foreach($tmpDirections as $key => $value):
            $this->universityDirectionService->store($id, $value);
        endforeach;

        // Get education types
        $tmpEducationTypes = [];
        if (isset($university['education_types'])){
            $tmpEducationTypes = $university['education_types'];
            unset($university['education_types']);
        }

        // education types
        $this->universityEducationTypeService->delete_by_university($id);
        foreach($tmpEducationTypes as $key => $value):
            $this->universityEducationTypeService->store($id, $value);
        endforeach;

        // Get education levels
        $tmpEducationLevels = [];
        if (isset($university['education_levels'])){
            $tmpEducationLevels = $university['education_levels'];
            unset($university['education_levels']);
        }

        // education levels
        $this->universityEducationLevelService->delete_by_university($id);
        foreach($tmpEducationLevels as $key => $value):
            $this->universityEducationLevelService->store($id, $value);
        endforeach;

        // qa remove
        if (isset($university['qa'])){
            unset($university['qa']);
        }

        // UPDATE
        University::where('id', $id)
                        ->where('status', '!=', Config::get('status.delete'))
                        ->update($university);

        $university = University::where('id', $id)
                        ->first();
        return $university;
    }

    public function delete($id)
    {
        University::where('id', $id)
            ->update(['status' => Config::get('status.delete')]);
        return true;
    }

    public function validate(Request $request)
    {
        $validated = $request->validate([
            // basic
            'name' => 'required',
            'index' => '',
            'city_id' => '',
            'worlds_rate' => '',
            'russian_rate' => '',
            'description' => '',
            'accreditation' => '',
            // contacts
            'address' => '',
            'phones' => '',
            'email' => '',
            'website' => '',
            'facebook_link' => '',
            'twiter_link' => '',
            'telegram_link' => '',
            'viber_link' => '',
            'vk_link' => '',
            // settings
            'slug' => '',
            'traning_period' => '',
            'directions' => 'array',
            'education_types' => 'array',
            'education_levels' => 'array',
            'extra' => '',
            'status' => '',
            'qa' => 'array',
            'current_user_id' => ''
        ]);

        return $validated;
    }
}