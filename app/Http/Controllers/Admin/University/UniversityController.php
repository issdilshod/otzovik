<?php

namespace App\Http\Controllers\Admin\University;

use App\Http\Controllers\Controller;
use App\Services\Admin\Account\UserService;
use App\Services\Admin\Misc\FileService;
use App\Services\Admin\Misc\StringService;
use App\Services\Admin\Setting\CityService;
use App\Services\Admin\Setting\DirectionService;
use App\Services\Admin\Setting\EducationLevelService;
use App\Services\Admin\Setting\EducationTypeService;
use App\Services\Admin\Setting\QaService;
use App\Services\Admin\Setting\SeoService;
use App\Services\Admin\University\UniversityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UniversityController extends Controller
{

    private $universityService;
    private $fileService;
    private $directionsService;
    private $educationTypeService;
    private $educationLevelService;
    private $citySevice;
    private $userService;
    private $qaService;
    private $seoService;

    public function __construct()
    {
        $this->universityService = new UniversityService();
        $this->fileService = new FileService();
        $this->directionsService = new DirectionService();
        $this->educationTypeService = new EducationTypeService();
        $this->educationLevelService = new EducationLevelService();
        $this->citySevice = new CityService();
        $this->userService = new UserService();
        $this->qaService = new QaService();
        $this->seoService = new SeoService();
    }
    
    public function index(Request $request)
    {
        // permission
        $data['title'] = __('universities_title');

        // search
        $data['q'] = $request->q??'';

        $data['f'] = $request->f??'name-asc';

        $data['list'] = $this->universityService->findAll($data['q'], $data['f']);

        $data['status'] = Config::get('status');

        return view('admin.pages.university.universities', $data);
    }

    public function store(Request $request)
    {
        // permission
        $validated = $this->universityService->validate($request);

        // logo upload
        $validated['logo'] = $this->fileService->upload($request, $validated['name']);

        $university = $this->universityService->create($validated);
        if ($university){
            // qa
            if (isset($validated['qa'])){
                $this->qaService->removeByRel($university->id);
                foreach($validated['qa'] as $key => $value):
                    $value['rel'] = $university->id;
                    $this->qaService->save($value);
                endforeach;
            }

            // seo
            $seo['title'] = ($request->title??'');
            $seo['description'] = ($request->description??'');
            $this->seoService->save($seo, $university->slug);

            return redirect('admin/universities')->with('status', '200');
        }

        return redirect('admin/universities')->with('status', '500');
    }

    public function get(Request $request, $id = '')
    {
        // permission
        $data['title'] = __('university_add_title');

        $data['directions'] = $this->directionsService->getAll();
        $data['education_types'] = $this->educationTypeService->getAll();
        $data['education_levels'] = $this->educationLevelService->getAll();

        if ($id!=''){
            $data['university'] = $this->universityService->find($id);
            $data['title'] = __('university_edit_title') . ' ' . $data['university']->name;
        }

        $data['cities'] = $this->citySevice->getAll();

        return view('admin.pages.university.university', $data);
    }

    public function update(Request $request, $id)
    {
        // permission
        $validated = $this->universityService->validate($request);

        // logo upload
        $validated['logo'] = $this->fileService->upload($request, $validated['name']);

        $university = $this->universityService->update($validated, $id);
        if ($university)
        {
            // qa
            if (isset($validated['qa'])){
                $this->qaService->removeByRel($id);
                foreach($validated['qa'] as $key => $value):
                    $value['rel'] = $id;
                    $this->qaService->save($value);
                endforeach;
            }

            // seo
            $seo['title'] = ($request->title??'');
            $seo['description'] = ($request->description??'');
            $this->seoService->save($seo, $university->slug);

            return redirect('admin/universities')->with('status', '200'); 
        }

        return redirect('admin/universities')->with('status', '500');
    }

    public function destroy(Request $request, $id)
    {
        // permission
        $this->universityService->delete($id);

        return redirect('admin/universities')->with('status', '200');
    }

    /**
     * Method to update status
     */
    public function status_update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required',
            'url' => ''
        ]);

        $url = $validated['url'];
        unset($validated['url']);

        if ($this->universityService->update_status($validated, $id)){
            return redirect($url)->with('status', '200');
        }

        return redirect($url)->with('status', '500');
    }

    public function api_store(Request $request)
    {
        // main validation
        $validated = $request->validate([
            'user' => 'array',
            'university' => 'array'
        ]);

        // user validation
        if (!isset($validated['user']['first_name']) || 
            !isset($validated['user']['email']) || 
            !isset($validated['user']['phone']))
        {
            return response()->json(['msg' => 'wrong content'], 422);
        }

        // university validation
        if (!isset($validated['university']['name']) || 
            !isset($validated['university']['city_id']) || 
            !isset($validated['university']['address']) ||
            !isset($validated['university']['website']) ||
            !isset($validated['university']['phones']) ||
            !isset($validated['university']['email']) ||
            !isset($validated['university']['description']))
        {
            return response()->json(['msg' => 'wrong content'], 422);
        }

        // user create
        $user = [
            'first_name' => $validated['user']['first_name'],
            'middle_name' => isset($validated['user']['middle_name'])?$validated['user']['middle_name']:'',
            'last_name' => isset($validated['user']['last_name'])?$validated['user']['last_name']:'',
            'email' => $validated['user']['email'],
            'phone' => $validated['user']['phone'].isset($validated['user']['extra_phone'])?', '.$validated['user']['extra_phone']:'',
            'role' => Config::get('roles.user'),
            'status' => Config::get('status.wait')
        ];

        // avatar
        if ($request->hasFile('avatar')){
            $user['avatar'] = $this->fileService->upload($request, $user['first_name'] . ' ' . $user['last_name'], 'avatar');
        }

        $user = $this->userService->store($user);

        // university create
        $university = [
            'current_user_id' => $user->id,
            'name' => $validated['university']['name'],
            'city_id' => $validated['university']['city_id'],
            'address' => $validated['university']['address'],
            'website' => $validated['university']['website'],
            'phones' => $validated['university']['phones'].isset($validated['university']['extra_phones'])?', '.$validated['university']['extra_phones']:'',
            'email' => $validated['university']['email'],
            'description' => $validated['university']['description'],
            'status' => Config::get('status.wait')
        ];

        $this->universityService->create($university);

        return response()->json(['msg' => 'success'], 200);
    }

}
