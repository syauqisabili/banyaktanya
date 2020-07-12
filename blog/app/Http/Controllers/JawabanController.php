<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Reputasi;
use App\Jawaban;
use App\Vote;
use App\User;

class JawabanController extends Controller
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
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Jawaban::create([
            'isi_jawaban' => $request->isi_jawaban,
            'user_id' => Auth::id(),
            'pertanyaan_id' => $request->pertanyaan_id
        ]);

        return redirect()->back()->with('pesan', 'Jawaban telah di posting');
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
        // 
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
        $answer = Jawaban::findOrFail($id);
        $answer->update([
            'status' => true
        ]);

        Reputasi::create([
            'reputasi' => 15,
            'user_id' => $answer->user_id
        ]);

        return redirect()->back()->with('pesan', 'Jawaban ini telah dipilih menjadi jawaban terbaik');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jawaban::findOrFail($id)->delete();
        return redirect()->back()->with('pesan', 'Jawaban telah dihapus');
    }

    public function answerUpvote(Request $request)
    {
        $vote = Vote::where('user_id', Auth::id())->get();
        if (count($vote) > 0 ) {
            foreach ( $vote as $value ) {
                if ( $value->upvote == 1 && $value->jawaban_id == $request->jawaban_id ) return redirect()->back();
            }
        } 
        
        Vote::create([
            'upvote' => 1,
            'user_id' => Auth::id(),
            'jawaban_id' => $request->jawaban_id
        ]);

        $item = Vote::all()->last();
        
        Reputasi::create([
            'reputasi' => 10,
            'user_id' => $item->jawaban->user_id
        ]);

        return redirect()->route('pertanyaan.show', [$request->pertanyaan_id]);
    }

    public function answerDownvote(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if ( $user->reputations->sum('reputasi') <= 15 ) { 
            return redirect()->back()->with('pesan', 'Reputasi anda kurang dari 15');
        }
        
        $vote = Vote::where('user_id', Auth::id())->get();
        if (count($vote) > 0 ) {
            foreach ( $vote as $value ) {
                if ( $value->downvote == 1 && $value->jawaban_id == $request->jawaban_id ) return redirect()->back();
            }
        } 

        Vote::create([
            'downvote' => 1,
            'user_id' => Auth::id(),
            'jawaban_id' => $request->jawaban_id
        ]);

        $item = Vote::all()->last();
        
        Reputasi::create([
            'minus' => 1,
            'user_id' => $item->jawaban->user_id
        ]);

        return redirect()->route('pertanyaan.show', [$request->pertanyaan_id]);
    }
}
