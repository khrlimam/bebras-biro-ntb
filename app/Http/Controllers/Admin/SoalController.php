<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SoalRequest;
use App\Module;
use App\Pilihan;
use App\Soal;
use App\Util\Util;
use Illuminate\Support\Arr;

class SoalController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($moduleid)
  {
    $module = Module::find($moduleid);
    return view('admin.soal.create', compact('moduleid', 'module'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(SoalRequest $request)
  {
    $validated = $request->validated();
    $pilihans = $validated['pilihans'];
    $validated = Arr::except($validated, 'pilihans');
    $created = Soal::create($validated);
    $pilihans = collect($pilihans)->map(function ($pilihan) use ($created) {
      return [
        'pilihan' => $pilihan,
        'soal_id' => $created->id
      ];
    });
    $inserted = false;
    if ($validated['jenis_jawaban'] == 'pilihan')
      $inserted = Pilihan::insert($pilihans->toArray());

    return Util::redirectIfSucceed($inserted or $created, function ($message) use ($validated) {
      return redirect()->route('admin.soal.create', $validated['module_id'])->with('success', $message);
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
    $soal = Soal::find($id);
    return view('admin.soal.preview', compact('soal'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $soal = Soal::find($id);
    return view('admin.soal.edit', compact('soal'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(SoalRequest $request, $id)
  {
    $soal = Soal::find($id);
    $pilihans = $soal->pilihans;
    $validated = $request->validated();
    $editPilihans = $validated['pilihans'];
    $validated = Arr::except($validated, ['pilihans', 'module_id']);
    if ($validated['jenis_jawaban'] == 'pilihan') {
      foreach ($editPilihans as $index => $pilihan) {
        if (isset($pilihans[$index]))
          $pilihans[$index]->update(['pilihan' => $pilihan]);
        else Pilihan::create([
          'pilihan' => $pilihan,
          'soal_id' => $soal->id
        ]);
      }
    }
    $updated = $soal->update($validated);
    return Util::redirectIfSucceed($updated, function ($message) use ($soal) {
      return redirect()->route('admin.soal.show', $soal->id)->with('success', $message);
    }, 'Berhasil mengubah data');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $soal = Soal::find($id);
    $moduleId = $soal->module_id;
    $deleted = $soal->delete();
    return Util::redirectIfSucceed($deleted, function ($message) use ($moduleId) {
      return redirect()->route('admin.module.soal.show', $moduleId)->with('success', $message);
    }, 'Berhasil menghapus data!');
  }
}
