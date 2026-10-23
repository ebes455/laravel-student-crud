@extends('layouts.app')
@section('content')
<div class="card p-4 col-md-6 mx-auto text-center"><h2>{{ $student->name }}</h2><p class="text-muted">{{ $student->email }} | {{ $student->phone }}</p>
<p><span class="badge bg-info text-dark fs-6">{{ $student->course }}</span> <span class="badge bg-success fs-6">{{ $student->status }}</span></p>
<p><strong>Address:</strong> {{ $student->address ?? 'N/A' }}</p><p class="text-muted">Joined: {{ $student->created_at->format('d M Y') }}</p>
<a href="{{ route('students.edit',$student) }}" class="btn btn-warning">Edit</a> <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a></div>
@endsection
