@extends('layouts.app')

@section('title')
    Requested Tutors
@endsection

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-8">
  <div class="container">
    <label class="btn btn-dark">Number of Requested Tutors in TUTORLAND : {{count($unapprovedtutors)}}</label>
    <div class="header-body text-center mb-7">
      {{-- success messege when tutor removed --}}
      <div>
          @if (session('success'))
              <div class="alert alert-success" role="alert">
                  {{ session('success') }}
              </div>
          @endif
          @if (session('error'))
              <div class="alert alert-danger" role="alert">
                  {{ session('error') }}
              </div>
          @endif
      </div>
      <div class="row justify-content-center">
      <div class="row mt-5">
          @if(count($unapprovedtutors)>0)
          <div class="col">
            <div class="card bg-default shadow">
              <div class="card-header bg-transparent border-0">
                <h3 class="text-white mb-0">Requested Tutors</h3>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-dark table-flush">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">NIC</th>
                      <th scope="col">Subject</th>
                      <th scope="col">Qualification</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($unapprovedtutors as $unapprovedTutor)
                    <tr>
                      <th scope="row">
                        <div class="media align-items-center">
                          <a href="#" class="avatar rounded-circle mr-3">
                            <img alt="Image placeholder" src="/assets/img/avatar/{{$unapprovedTutor->user->avatar}}">
                          </a>
                          <div class="media-body">
                            <span class="mb-0 text-sm">{{$unapprovedTutor->user->FName}}</span>
                          </div>
                        </div>
                      </th>
                      <td>
                          {{$unapprovedTutor->user->LName}}
                      </td>
                      <td>
                          {{$unapprovedTutor->user->email}}
                      </td>
                      <td>
                          {{$unapprovedTutor->user->NIC}}
                      </td>
                      <td>
                          {{$unapprovedTutor->subject->subject}}
                      </td>
                      <td>
                          {{$unapprovedTutor->Qualification}}
                      </td>
                      <td>
                        <a href="{{route('viewunapprovedtutordetails',['user'=> $unapprovedTutor->id])}}" class="btn btn-info">View Tutor</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          @else
              <h1>No Requested Tutors</h1>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection