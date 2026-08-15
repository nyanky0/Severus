<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class AdminContentController extends Controller
{
    public function index()
    {
        $contents = SiteContent::all();
        return view('admin.contents.index', compact('contents'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'contents' => 'required|array',
            'contents.*.value_en' => 'required|string',
            'contents.*.value_id' => 'required|string',
        ]);

        foreach ($data['contents'] as $id => $values) {
            $content = SiteContent::find($id);
            if ($content) {
                $content->update([
                    'value_en' => $values['value_en'],
                    'value_id' => $values['value_id'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Site contents updated successfully!');
    }
}
