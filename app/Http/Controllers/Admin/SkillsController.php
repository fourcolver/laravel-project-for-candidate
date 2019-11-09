<?php


namespace App\Http\Controllers\Admin;


use App\Competence;
use App\CompetenceSkill;
use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class SkillsController extends Controller
{
    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        $skills = CompetenceSkill::with('competence')->get();
        $competences = Competence::get();
        return view('skills.index', compact('skills', 'competences'));
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function create()
    {
        $skill = new CompetenceSkill();
        $competences = Competence::get();
        return view('skills.create', compact('skill', 'competences'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector|void
     */
    public function store(Request $request)
    {
        $skill = CompetenceSkill::create($request->only(['competences_id', 'skill']));
        return redirect('admin/skills');
    }

    /**
     * @param $skillId
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function edit($skillId)
    {
        $skill = CompetenceSkill::findOrFail($skillId);
        $competences = Competence::get();
        return view('skills.edit', compact('skill', 'competences'));
    }

    /**
     * @param Request $request
     * @param $skillId
     * @return RedirectResponse|Redirector|void
     */
    public function update(Request $request, $skillId)
    {
        $skill = CompetenceSkill::findOrFail($skillId);
        $skill->update($request->only(['competences_id', 'skill']));

        return redirect('admin/skills');
    }

    /**
     * @param $skillId
     * @return RedirectResponse|Redirector|void
     */
    public function destroy($skillId)
    {
        $skill = CompetenceSkill::findOrFail($skillId);
        $skill->delete();

        return redirect('admin/skills');
    }
}