<?php

namespace App\Http\Controllers\admin;

use App\Models\Manual;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ManualController extends Controller
{

    public function view()
    {
        $manual = Manual::get();
        return view('admin.documents.manual.view', ['manuals' => $manual]);
    }


    public function form()
    {
        return view('admin.documents.manual.add');
    }


    public function create(Request $request)

    {
        $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'eff_date' => 'required|date',
            'revision_no' => 'required|string',
            'pdf_file' => 'required|file|mimes:pdf|max:5000',
        ]);

        $file = $request->file('pdf_file');
        $path = '/assets/pdf/manual/';
        $file->move(public_path($path), $request->doc_name);
        $filePath = $path . $request->doc_name;


        Manual::create([

            'doc_no' => $request->doc_no,
            'doc_name' => $request->doc_name,
            'eff_date' => $request->eff_date,
            'revision_no' => $request->revision_no,
            'pdf_file' => $filePath,

            'created_at' => now(),
        ]);

        return back()->with('status', 'New Document has been Uploaded.');
    }


    public function edit($id)
    {
        $manual = Manual::find($id);
        return view('admin.documents.manual.update', ['manual' => $manual]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'eff_date' => 'required|date',
            'revision_no' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5000',
        ]);

        $manual = Manual::findOrFail($id);

        if ($request->hasFile('pdf_file')) {
            if (File::exists(public_path($manual->pdf_file))) {
                File::delete(public_path($manual->pdf_file));
            }

            $file = $request->file('pdf_file');
            $filename = $request->doc_name;
            $path = 'assets/pdf/policy/';
            $file->move(public_path($path), $filename);
            $filePath = $path . $filename;

            $manual->pdf_file = $filePath;
        } else {
            // If no new file is uploaded, check if the document name has changed
            if ($manual->doc_name !== $request->doc_name) {
                // Determine the old and new file paths
                $oldFilePath = public_path($manual->pdf_file);
                $newFileName = $request->doc_name;
                $newFilePath = 'assets/pdf/policy/' . $newFileName;

                // Rename the existing file if it exists
                if (File::exists($oldFilePath)) {
                    File::move($oldFilePath, public_path($newFilePath));
                    // Update the file path in the database
                    $manual->pdf_file = $newFilePath;
                }
            }
        }

        $manual->update([
            'doc_no' => $request->doc_no,
            'doc_name' => $request->doc_name,
            'eff_date' => $request->eff_date,
            'revision_no' => $request->revision_no,
        ]);

        return back()->with('status', 'Policy updated successfully.');
    }


    public function delete($id)
    {
        $policy = Manual::findOrFail($id);

        // Delete the associated PDF file if it exists
        if (File::exists(public_path($policy->pdf_file))) {
            File::delete(public_path($policy->pdf_file));
        }

        $policy->delete();
        return back()->with('status', 'Policy document has been removed.');
    }
}
