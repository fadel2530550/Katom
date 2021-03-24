<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroupTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Throwable;

class GroupTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grouptype = GroupTypes::with('parent')->orderBy('parent_id')->paginate(10);
        return view('admin.group_types.index',['grouptype'=>$grouptype]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grouptype = GroupTypes::whereNull('parent_id')->get();
        return view('admin.group_types.create',['grouptype'=>$grouptype]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = GroupTypes::getValidator($request->all());
        $validate->validate();
        if( $validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
        DB::beginTransaction();
        try {
            $customers = GroupTypes::create($request->input());
            DB::commit();
        }catch (Throwable $e){
            DB::rollBack();
            return Redirect::route('admin.group_types.index')->with('error',$e->getMessage());
        }
        return Redirect::route('admin.group_types.index')->with('success',"تم اضافة فئة جديد");
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
        $group_type = GroupTypes::findOrFail($id);
        if($group_type == null)
        return Redirect::route('admin.group_types.index')->with('error'," هذه الفئة غير موجودة");

        return view('admin.group_types.edit',['group_type'=>$group_type]);
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
        $validator = GroupTypes::getValidator($request->all(),$id);
        $validator->validate();
       if( $validator->fails()){
        return Redirect::route('admin.group_types.index')->with('error',$validator);
       }

        $groupetype=GroupTypes::findOrFail($id);
        $groupetype->update($request->all());
        return redirect()->route('admin.group_types.index')->with('success', "تم تعديل الفئة :$groupetype->name ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grouptype = GroupTypes::findOrFail($id);
        $grouptype->delete();

        return redirect()->route('admin.group_types.index')->with('success'," تم حذف الفئة:$grouptype->name");
    }
}
