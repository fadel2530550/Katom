<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\GroupTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use SebastianBergmann\Environment\Console;
use Throwable;
use Validator;
class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $groups = Groups::join('group_types','group_types.id','=','Groups.category_id')
        ->select('groups.*','group_types.name as category_name')->get();

        return view('admin.groups.index', ['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupType = GroupTypes::where('parent_id', '!=', null)->get();

        return view('admin.groups.create', ['groupType' => $groupType]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Groups::getValidator($request->all());
        $validate->validate();
        if ($validate->fails()) {
            dd($validate->fails());
            return redirect()->back()->withErrors($validate)->withInput();
        }
        DB::beginTransaction();
        try {
            $customers = Groups::create($request->input());
            DB::commit();
        } catch (Throwable $e) {
            dd($e->getMessage());
            DB::rollBack();
            return Redirect::route('admin.groups.index')->with('error', $e->getMessage());

        }
        return Redirect::route('admin.groups.index')->with('success', "تم اضافة مجموعة جديد");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groups = Groups::findOrFail($id);
        $groupType = GroupTypes::where('parent_id', '!=', null)->get();
        if($groups == null)
        return Redirect::route('admin.groups.index')->with('error'," هذه المجموعة غير موجودة");
        return view('admin.groups.edit',['groups'=>$groups,'groupType'=>$groupType]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $validator = Groups::getValidator($request->all(),$id);
        $validator->validate();
       if( $validator->fails()){
        return Redirect::route('admin.groups.index')->with('error',$validator);
       }

        $groupetype=Groups::findOrFail($id);
        $groupetype->update($request->all());
        return redirect()->route('admin.groups.index')->with('success', "تم تعديل المجموعة :$groupetype->name ");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Groups::findOrFail($id);
        $group->delete();

        return redirect()->route('admin.groups.index')->with('success'," تم حذف المجموعة:$group->name");

    }

    /**
     * fetch function
     */


    public function fetch(Request $request)
    {
        $grouptype = $request->type_id;
        //  Log::info($grouptype);
        $grouptypes = GroupTypes::where('id', $grouptype)->with('children')->get();
        return response()->json([
            'grouptypes' => $grouptypes
        ]);
    }
    public function groupfetch(Request $request)
    {
        $parent= GroupTypes::findOrFail($request->type_id);
        $grouptypes = GroupTypes::where('id',$parent->parent_id)->first();
        //dd($grouptypes);
        // Log::info($grouptypes);
        return response()->json([
            'grouptypes' => $grouptypes
        ]);
    }

}
