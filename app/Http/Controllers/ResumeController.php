<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Termwind\Components\Dd;
use App\Services\GPTService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resumes = Resume::all();

        return $resumes;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resume = Resume::find($id);

        return $resume;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resume $resume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resume $resume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resume $resume)
    {
        //
    }

    public function resume(Request $request)
    {
        $user = $request->user();

        $resume = $request->only([
            'full_name',
            'email',
            'current_position',
            'experience',
            'technologies',
            'image_path',
            'companies',
        ]);

        $jobDescription = 'I am writing a resume, my details are name:' . $resume['full_name']
            . ' role: ' . $resume['current_position'] . ' (' . $resume['experience']
            . 'years). I write in the technologies: ' . $resume['technologies']
            . '. Can you write a 100 words description for the top of the resume(first person writing)?';

        $jobResponsibilities = 'I am writing a resume, my details are name:' . $resume['full_name']
            . ' role: ' . $resume['current_position'] . ' (' . $resume['experience']
            . 'years). I write in the technologies: ' . $resume['technologies']
            . '. Can you write 10 points for a resume on what I am good at?';

        foreach ($resume['companies'] as $company) {
            $jobAchievements = 'I am writing a resume, my details are name:' . $resume['full_name']
                . ' role: ' . $resume['current_position'] . ' (' . $resume['experience']
                .   'years). During my years I worked at '
                . strval($company['company_name']) . ' as a ' . strval($company['position_held'])
                . '. Can you write me 50 words for each company separated in numbers of my succession in the company (in first person)?';
        }


        $jobDescriptionResult = resolve(GPTService::class)->generate($jobDescription);
        $jobResponsibilitiesResult = resolve(GPTService::class)->generate($jobResponsibilities);
        $jobAchievementsResult = resolve(GPTService::class)->generate($jobAchievements);

        $newResume  = new Resume();
        $newResume->user_id = $user->id;
        $newResume->full_name = $resume['full_name'];
        $newResume->email = $resume['email'];
        $newResume->current_position = $resume['current_position'];
        $newResume->experience = $resume['experience'];
        $newResume->technologies = $resume['technologies'];
        $newResume->image_path = $resume['image_path'];
        $newResume->companies = $resume['companies'];
        $newResume->job_description = $jobDescriptionResult;
        $newResume->job_responsibilities = $jobResponsibilitiesResult;
        $newResume->job_achievements = $jobAchievementsResult;
        $newResume->save();

        return $newResume->id;
    }

    /**
     * Method upload
     *
     * @param Request $request
     *
     * @return void
     */
    public function upload(Request $request)
    {
        $path = $request->file('image')->store('public/uploads');

        // remove public from $path
        $path = str_replace('public', '', $path);

        return $path;
    }
}
