@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-8">
    <div class="container">
        <div class="row justify-content-center"> 
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Student Dashboard</div>
                        <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are logged in as <strong>"{{Auth::user()->FName}}"</strong>
                    </div>
                </div>
                <a href="{{route('student.viewTutors')}}" class="btn btn-primary" type="button">TUTORS LIST</a>
            </div>
        </div>
    </div>
</div>
@endsection