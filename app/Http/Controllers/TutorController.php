<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tutor;
use App\User;
use App\Timeslot;
use Image;
use auth;
use DB;
use Illuminate\Support\Facades\Validator;

class TutorController extends Controller
{

    public function index()
    {
        return view('tutor/tutor');
    }

    public function viewProfile()
    {
        $tutor = Auth::id();
        //dd($tutor);
        $time_slots = TutorController::timeslots($tutor);
        return view('tutor/profile', compact('time_slots'));
    }

    public function timeslots($id)
    {
        $user = Auth::id();
        $tutor = DB::table('tutors')->where('user_id', $user)->get()->first();
        $tutor_id = $tutor->id;
        //dd($tutor->id);
        $time = DB::table('timeslots')->where('tutor_id', $tutor_id)->select('day', 'time')->get()->toArray();
        return $time;
    }

    // public function viewProfileSlots($id)
    // {
    //     $tutor = Tutor::find($id);
    //     $time_slots = TutorController::timeslots($id);
    //     return view('tutor/profile', compact('tutor', 'time_slots'));
    // }
    public function editProfile(User $user)
    {
        return view('tutor.editprofile')->with('user',$user);
    }

    protected function validatorEdit(array $data)
    {
        return Validator::make($data, [
            'FName' => ['required', 'string', 'max:255'],
            'LName' => ['required', 'string', 'max:255'],
            'DOB' => ['required', 'date',],
            'NIC' => ['required', 'string'],
        ]);
    }
    
    public function updateProfile(Request $request, $id)
    {
        $this->validatorEdit($request->all())->validate();

        $tutor = User::find($id);
        $tutor->FName = $request->input('FName');
        $tutor->LName = $request->input('LName');
        $tutor->DOB = $request->input('DOB');
        $tutor->NIC = $request->input('NIC');

        $tutor->save();

        return redirect()->action('TutorController@viewProfile', compact('tutor'));
    }

    //method to update tutor profile picture 
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
            Image::make($avatar)->resize(300, 300)->save(public_path('/assets/img/avatar/' . $filename));

            $tutor = Auth::user();
            $tutor->avatar = $filename;
            $tutor->save();
        }
        // return view('tutor.showProfile');
        return redirect()->action('TutorController@viewProfile', compact('tutor'))->with('success', 'Profile Picture Updated');
    }
}