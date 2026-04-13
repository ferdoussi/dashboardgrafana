<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function viewCreateForm()
    {
        return view('panels.viewCreateForm');
    }
    public function createPanel(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'module' => 'required|string',
        'grafana_url' => 'required|url',
    ]);

    // checkbox إلا ما تـchecka ما كيجيوش
    $data['active'] = $request->has('active');

    \App\Models\Panel::create($data);

   return redirect()->route('panels.createPanel')
    ->with('success', 'Panel created successfully!');
}
}
