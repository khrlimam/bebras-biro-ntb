<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;
use App\Module;
use App\Util\Util;

class ModuleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $modules = Module::all();
    return view('admin.module.index', compact('modules'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $grades = Grade::all();
    return view('admin.module.create', compact('grades'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(ModuleRequest $request)
  {
    $validated = $request->validated();
    $validated['media_path'] = json_decode(file_get_contents('https://loremflickr.com/json/200/200/animal'))->file;
    $created = Module::create($validated);

    return Util::redirectIfSucceed($created, function ($message) {
      return redirect()->route('admin.module.index')->with('success', $message);
    });
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return $id;
  }

  public function showSoal($moduleid)
  {
    $module = Module::with('soals')->find($moduleid);
    return view('admin.soal.show', compact('module'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $grades = Grade::all();
    $module = Module::find($id);
    return view('admin.module.edit', compact('grades', 'module'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(ModuleRequest $request, $id)
  {
    $module = Module::find($id);
    $data = $request->validated();
    $updated = $module->update($data);
    return Util::redirectIfSucceed($updated, function ($message) {
      return redirect()->route('admin.module.index')->with('success', $message);
    }, 'Berhasil mengupdate data');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $modul = Module::find($id);
    $deleted = $modul->delete();
    return Util::redirectIfSucceed($deleted, function ($message) {
      return redirect()->route('admin.module.index')->with('success', $message);
    }, 'Berhasil menghapus modul ' . $modul->title);
  }
}
