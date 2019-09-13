<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use App\School;

class SchoolController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $schools = School::all();
    return view('admin.school.index', compact('schools'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.school.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(SchoolRequest $request)
  {
    $data = $request->validated();
    $created = School::create($data);
    if ($created)
      return redirect()->route('admin.school.index')->with('success', 'Berhasil menambah data sekolah baru');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $school = School::find($id);
    return view('admin.school.edit', compact('school'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(SchoolRequest $request, $id)
  {
    $school = School::find($id);
    $validated = $request->validated();
    $updated = $school->update($validated);
    if ($updated)
      return redirect()->route('admin.school.index')->with('success', 'Data sekolah telah diupdate');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    if (School::find($id)->delete())
      return redirect()->route('admin.school.index')->with('success', 'Data sekolah telah dihapus');

  }
}
