<?php

namespace App\Http\Controllers;

use App\Tutor;
use DB;


use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('student/student');
    }

    public function viewProfile()
    {
        return view('student/profile');
    }

    //method to view availble tutors when logged into the student account
    public function showTutorList()
    {
        $tutors = Tutor::where('approved','1')->get();
        //dd($tutors);
        return view('student.viewtutors')->with('tutors', $tutors);
    }

    //view tutor profile details of the available tutor list
    public function viewTutorProfile($id)
    {
        $tutor = Tutor::find($id);
        //dd($tutor);
        return view('student.viewtutorprofile')->with('tutor', $tutor);
    }

    //method to update student profile picture 
    public function updatePicture(Request $request)
    {
        // dd($request);
        //handle the user upload of avatar
        if ($request->hasFile('avatar')) {
            request()->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/assets/img/avatar/students/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        // return view('student.showProfile', compact('user'));
        return redirect()->action('StudentController@showProfile', compact('user'))->with('success', 'Profile Picture Updated');
    }
}
