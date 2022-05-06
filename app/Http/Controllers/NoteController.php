<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'note' => 'required',
        ]);

        $customer_id = $request->customer_id;
        
        $customer = Customer::find($customer_id);

        $note = $customer->notes()->create([
            'note' => $validated['note'],
            'status' => 0,
        ]);
        
        session()->flash('note-created', 'New Note Created');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        return response()->json(['note'=>$note->note]);
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
        $validated = $request->validate([
            'note' => 'required',
        ]);

        $category = Note::find($id);
        $category->update([
            'note' => $validated['note'],
        ]);

        session()->flash('note-updated', 'Note Updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $note = Note::find($id);
        
        if($note->delete()) {
            session()->flash('note-deleted', 'Note Deleted');
        }
        
        return back();
    }

    public function mark_as_read($id) {
        $note = Note::find($id);
        $note->status = 1;
        $note->save();
        session()->flash('note-mark-as-read', 'Note Marked as Read');
        return back();
    }
}
