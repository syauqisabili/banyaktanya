<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Reputasi;
use App\Vote;
use App\User;
use App\Tag;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Pertanyaan::orderBy('id', 'desc')->get();
        return view('questions.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $str_tag = $request->tag_pertanyaan;
        $arr_tag = explode(',', $str_tag);

        Pertanyaan::create([
            'judul' => $request->judul,
            'isi_pertanyaan' => $request->isi_pertanyaan,
            'user_id' => Auth::id(),
        ]);

        $question = Pertanyaan::all()->last();

        foreach( $arr_tag as $key => $item ) {
            $tag = Tag::firstOrCreate([
                'name' => $item,
            ]);

            $question->tags()->attach($tag);
        }

        return redirect()->route('pertanyaan.index')->with('pesan', 'Pertanyaan telah disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = new User;
        $item = Pertanyaan::findOrFail($id);
        $upvote = $item->votes->sum('upvote') == null ? 0 : $item->votes->sum('upvote');
        $downvote = $item->votes->sum('downvote') == null ? 0 : $item->votes->sum('downvote');
        $vote = $upvote - $downvote;

        return view('questions.show', compact('item', 'user', 'vote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = [];
        $item = Pertanyaan::findOrFail($id);

        foreach( $item->tags->toArray() as $value ) {
            $tags[] = $value['name'];
        }

        $tag = implode(',', $tags);

        return view('questions.edit', compact('item', 'tag'));
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
        $item = Pertanyaan::findOrFail($id);
        $item->update([
            'judul' => $request->judul,
            'isi_pertanyaan' => $request->isi_pertanyaan
        ]);

        return redirect()->route('pertanyaan.show', [$item->id])->with('pesan', 'Pertanyaan telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pertanyaan::findOrFail($id)->delete();
        return redirect()->route('pertanyaan.index')->with('pesan', 'Pertanyaan telah dihapus');
    }

    public function questionUpvote(Request $request)
    {
        $vote = Vote::where('user_id', Auth::id())->get();
        if (count($vote) > 0 ) {
            foreach ( $vote as $value ) {
                if ( $value->upvote == 1 && $value->pertanyaan_id == $request->pertanyaan_id ) return redirect()->back();
            }
        } 
        
        Vote::create([
            'upvote' => 1,
            'user_id' => Auth::id(),
            'pertanyaan_id' => $request->pertanyaan_id
        ]);

        $item = Vote::all()->last();
        
        Reputasi::create([
            'reputasi' => 10,
            'user_id' => $item->pertanyaan->user_id
        ]);

        return redirect()->route('pertanyaan.show', [$request->pertanyaan_id]);
    }

    public function questionDownvote(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        if ( $user->reputations->sum('reputasi') <= 15 ) { 
            return redirect()->back()->with('pesan', 'Reputasi anda kurang dari 15');
        }
        
        $vote = Vote::where('user_id', Auth::id())->get();
        if (count($vote) > 0 ) {
            foreach ( $vote as $value ) {
                if ( $value->downvote == 1 && $value->pertanyaan_id == $request->pertanyaan_id ) return redirect()->back();
            }
        } 

        Vote::create([
            'downvote' => 1,
            'user_id' => Auth::id(),
            'pertanyaan_id' => $request->pertanyaan_id
        ]);

        $item = Vote::all()->last();
        
        Reputasi::create([
            'minus' => 1,
            'user_id' => $item->pertanyaan->user_id
        ]);

        return redirect()->route('pertanyaan.show', [$request->pertanyaan_id]);
    }
}
