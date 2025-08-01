<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\RampInspection;
use App\Models\RampInspectionReply;
use App\Http\Controllers\Controller;
use App\Models\RampInspectionFinding;
use Illuminate\Support\Facades\Storage;

class RampInspectionController extends Controller
{
    public function view()
    {
        $rampInspections = RampInspection::get();
        return view('admin.rampinspection.view', ['rampInspections' => $rampInspections]);
    }


    public function form()
    {
        return view('admin.rampinspection.add');
    }


    public function create(Request $request)

    {
        $request->validate([
            'date' => 'required|date', // Date of the inspection
            'inspection_time' => 'nullable|date_format:H:i', // Time of inspection
            'aircraft_reg' => 'nullable|string|max:255', // Aircraft registration
            'aircraft_type' => 'nullable|string|max:255', // Aircraft type
            'arrival_station' => 'nullable|string|max:255', // Arrival station
            'destination' => 'nullable|string|max:255', // Destination
            'flight_no' => 'nullable|string|max:255', // Flight number
            'bay_no' => 'nullable|string|max:255', // Bay number
            'inspection_ref_no' => 'nullable|string|max:255', // Inspection reference number
            'inspection_type' => 'nullable|string|max:255', // Type of inspection
            'inspector' => 'nullable|string|max:255', // Inspector name
            'status' => 'nullable|string|max:255', // Inspection status
        ]);



        RampInspection::create([
            'date' => $request->date,
            'inspection_time' => $request->inspection_time,
            'aircraft_reg' => $request->aircraft_reg,
            'aircraft_type' => $request->aircraft_type,
            'arrival_station' => $request->arrival_station,
            'destination' => $request->destination,
            'flight_no' => $request->flight_no,
            'bay_no' => $request->bay_no,
            'inspection_ref_no' => $request->inspection_ref_no,
            'inspection_type' => $request->inspection_type,
            'inspector' => $request->inspector,
            'status' => $request->status,
            'created_at' => now(),
        ]);


        return back()->with('status', 'Aircraft Inspeciton Form has been Created.');
    }


    public function edit($id)
    {
        $rampinspection = RampInspection::find($id);
        return view('admin.rampinspection.update', ['rampinspection' => $rampinspection]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date', // Date of the inspection
            'inspection_time' => 'nullable', // Time of inspection
            'aircraft_reg' => 'nullable|string|max:255', // Aircraft registration
            'aircraft_type' => 'nullable|string|max:255', // Aircraft type
            'arrival_station' => 'nullable|string|max:255', // Arrival station
            'destination' => 'nullable|string|max:255', // Destination
            'flight_no' => 'nullable|string|max:255', // Flight number
            'bay_no' => 'nullable|string|max:255', // Bay number
            'inspection_ref_no' => 'nullable|string|max:255', // Inspection reference number
            'inspection_type' => 'nullable|string|max:255', // Type of inspection
            'inspector' => 'nullable|string|max:255', // Inspector name
            'status' => 'nullable|string|max:255', // Inspection status
        ]);


        $rampInspection = RampInspection::findOrFail($id);

        $rampInspection->update([
            'date' => $request->date,
            'inspection_time' => $request->inspection_time,
            'aircraft_reg' => $request->aircraft_reg,
            'aircraft_type' => $request->aircraft_type,
            'arrival_station' => $request->arrival_station,
            'destination' => $request->destination,
            'flight_no' => $request->flight_no,
            'bay_no' => $request->bay_no,
            'inspection_ref_no' => $request->inspection_ref_no,
            'inspection_type' => $request->inspection_type,
            'inspector' => $request->inspector,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return back()->with('status', 'Aircraft Inspection Form updated successfully.');
    }


    public function delete($id)
    {
        $rampInspection = RampInspection::findOrFail($id);
        $rampInspection->delete();
        return back()->with('status', 'Ramp Inspection Form has been removed.');
    }









    // ================================   Findings   ======================================

    public function findingView($id)
    {
        $rampInspection = RampInspection::with('rampInspectionFinding')->find($id);

        return view('admin.rampinspection.finding.view', ['rampInspection' => $rampInspection]);
    }


    public function findingform($id)
    {
        $rampInspection = RampInspection::find($id);
        return view('admin.rampinspection.finding.add', ['rampInspection' => $rampInspection]);
    }


    public function FindingCreate(Request $request)
    {
        $request->validate([
            'code' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'finding' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate file type and size
            'status' => 'required|string|max:255',
            'closed_by' => 'nullable|string|max:255',
        ]);

        $rampInspection = RampInspection::find($request->ramp_inspection_id);

        // Initialize a variable to store the file path
        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            // Store the uploaded file in the custom directory
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/aircraft_inspection/finding/attachment', // Custom directory path
                time() . '_' . $request->file('attachment')->getClientOriginalName(), // Custom file name
                'public' // Save to the 'public' disk
            );
        }

        $rampInspection->rampInspectionFinding()->create([
            'code' => $request->code,
            'category' => $request->category,
            'finding' => $request->finding,
            'attachment' => $attachmentPath, // Save the custom file path in the database
            'status' => $request->status,
            'closed_by' => $request->closed_by,
            'created_at' => now(),
        ]);

        return back()->with('status', 'Aircraft Inspection Finding has been Created.');
    }




    public function findingEdit($id)
    {
        $rampinspectionfinding = RampInspectionFinding::find($id);
        $rampInspection = RampInspection::where('id', $rampinspectionfinding->ramp_inspection_id)->first();
        return view('admin.rampinspection.finding.update', ['rampinspectionfinding' => $rampinspectionfinding, 'rampInspection' => $rampInspection]);
    }



    public function findingUpdate(Request $request, $id)
    {
        $request->validate([
            'code' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'finding' => 'nullable|string|max:255',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate new file
            'status' => 'nullable|string|max:255',
            'closed_by' => 'nullable|string|max:255',
        ]);

        $rampInspectionFinding = RampInspectionFinding::find($id);

        // Initialize a variable to store the file path
        $attachmentPath = $rampInspectionFinding->attachment; // Retain existing path by default

        if ($request->hasFile('attachment')) {
            // Delete the old attachment if it exists
            if ($rampInspectionFinding->attachment && Storage::disk('public')->exists($rampInspectionFinding->attachment)) {
                Storage::disk('public')->delete($rampInspectionFinding->attachment);
            }

            // Store the new attachment
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/aircraft_inspection/finding/attachment', // Custom directory path
                time() . '_' . $request->file('attachment')->getClientOriginalName(), // Custom file name
                'public' // Save to the 'public' disk
            );
        }

        // Update the record with validated data and new file path
        $rampInspectionFinding->update([
            'code' => $request->code,
            'category' => $request->category,
            'finding' => $request->finding,
            'attachment' => $attachmentPath, // Save the updated file path
            'status' => $request->status,
            'closed_by' => $request->closed_by,
        ]);

        return back()->with('status', 'Aircraft Inspection Finding updated successfully.');
    }




    public function findingDelete($id)
    {
        $rampInspectionFinding = RampInspectionFinding::find($id);
        $rampInspectionFinding->delete();
        return back()->with('status', 'Ramp Inspection Finding has been removed.');
    }








    //=============================== Reply ===============================

    public function replyView($id)
    {
        // Retrieve the specific RampInpectionFinding that has one reply and that finding belongs to one specific Ramp Inspection
        $rampInspectionFinding = RampInspectionFinding::with('rampInspectionReply')->with('rampInspection')
            ->where('id', $id)
            ->first();

        return view('admin.rampinspection.finding.reply.view', [
            'rampInspectionFindings' => $rampInspectionFinding,
        ]);
    }



    public function replyform($id)
    {
        $rampInspectionFinding = RampInspectionFinding::find($id);

        return view('admin.rampinspection.finding.reply.add', [
            'rampInspectionFinding' => $rampInspectionFinding,
        ]);
    }



    public function replyCreate(Request $request)
    {
        $request->validate([
            'reply' => 'nullable|string|max:255', // Reply content
            'reply_by' => 'nullable|string|max:255', // Person who gave the reply
            'remarks' => 'nullable|string|max:255', // Additional remarks
            'remarks_by' => 'nullable|string|max:255', // Person who provided the remarks
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate file type and size
            'status' => 'nullable|string|max:255', // Current status of the reply
        ]);

        $rampInspectionFinding = RampInspectionFinding::find($request->finding_id);

        // Check if a reply already exists
        if ($rampInspectionFinding->rampInspectionReply) {
            return back()->with('status', 'A Reply for this finding already exists.');
        }

        // Initialize a variable to store the file path
        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            // Store the uploaded file in the custom directory
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/aircraft_inspection/reply/attachment', // Custom directory path
                time() . '_' . $request->file('attachment')->getClientOriginalName(), // Custom file name
                'public' // Save to the 'public' disk
            );
        }

        $rampInspectionFinding->rampInspectionReply()->create([
            'reply' => $request->reply, // Reply content
            'reply_by' => $request->reply_by, // Person who gave the reply
            'remarks' => $request->remarks, // Additional remarks
            'remarks_by' => $request->remarks_by, // Person who provided the remarks
            'attachment' => $attachmentPath, // Save the custom file path in the database
            'status' => $request->status, // Current status of the reply
            'created_at' => now(),
        ]);

        return back()->with('status', 'Finding Reply has been Created.');
    }



    public function replyEdit($id)
    {
        $rampInspectionReply = RampInspectionReply::with('rampInspectionFinding')
            ->where('id', $id)
            ->first();


        return view('admin.rampinspection.finding.reply.update', ['rampInspectionReply' => $rampInspectionReply]);
    }



    public function replyUpdate(Request $request, $id)
    {
        // Validate the incoming data
        $request->validate([
            'reply' => 'nullable|string|max:255', // Reply content
            'reply_by' => 'nullable|string|max:255', // Person who gave the reply
            'remarks' => 'nullable|string|max:255', // Additional remarks
            'remarks_by' => 'nullable|string|max:255', // Person who provided the remarks
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate file type and size
            'status' => 'nullable|string|max:255', // Current status of the reply
        ]);

        // Find the associated RampInspectionReply
        $reply = RampInspectionReply::find($id);

        // Initialize a variable to store the file path
        $attachmentPath = $reply->attachment; // Retain existing path by default

        if ($request->hasFile('attachment')) {
            // Delete the old attachment if it exists
            if ($reply->attachment && Storage::disk('public')->exists($reply->attachment)) {
                Storage::disk('public')->delete($reply->attachment);
            }

            // Store the new attachment
            $attachmentPath = $request->file('attachment')->storeAs(
                'assets/aircraft_inspection/reply/attachment', // Custom directory path
                time() . '_' . $request->file('attachment')->getClientOriginalName(), // Custom file name
                'public' // Save to the 'public' disk
            );
        }

        // Update the record with validated data and new file path
        $reply->update([
            'reply' => $request->reply, // Reply content
            'reply_by' => $request->reply_by, // Person who gave the reply
            'remarks' => $request->remarks, // Additional remarks
            'remarks_by' => $request->remarks_by, // Person who provided the remarks
            'attachment' => $attachmentPath, // Save the updated file path
            'status' => $request->status, // Current status of the reply
        ]);

        return back()->with('status', 'Finding Reply has been updated successfully.');
    }


    public function replyDelete($id)
    {
        $rampInspectionReply = RampInspectionReply::find($id);
        $rampInspectionReply->delete();
        return back()->with('status', 'Reply has been removed.');
    }
}
