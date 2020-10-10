<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentsData = Student::all();
        return view('student.index', compact('studentsData'));
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
        $request->validate([
            'first_name' => 'required|min:3',
            'gender' => 'required',
            'birth_date' => 'required',
            'religion' => 'required',
            'dad_name' => 'required|min:3',
            'mom_name' => 'required|min:3',
            'address' => 'required|min:5',
        ]);
        Student::create($request->all());
        return redirect('/student')->with('success', 'Data berhasil di input.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('student.profile', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit', compact('student'));
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
        Student::where('id', $id)
                ->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'birth_date' => $request->birth_date,
                    'religion' => $request->religion,
                    'dad_name' => $request->dad_name,
                    'mom_name' => $request->mom_name,
                    'address' => $request->address,
                ]);
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/' . $request->file('avatar')->getClientOriginalName());
            $student->avatar = $request->file('avatar')->getClientOriginalName();
            $student->save();
        }

        return redirect('/student')->with('success', 'Data berhasil di edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect('/student')->with('success', 'Data berhasil di hapus.');
    }
}
