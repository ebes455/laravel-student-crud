@extends('layouts.app')
@section('content')
<div class="card p-4 col-md-8 mx-auto"><h4 class="mb-3">Edit Student</h4>
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ route('students.update',$student) }}">@csrf @method('PUT')
<div class="mb-3"><label class="form-label">Full Name *</label><input name="name" value="{{ $student->name }}" class="form-control" required></div>
<div class="row"><div class="col-md-6 mb-3"><label class="form-label">Email *</label><input type="email" name="email" value="{{ $student->email }}" class="form-control" required></div>
<div class="col-md-6 mb-3"><label class="form-label">Phone</label><input name="phone" value="{{ $student->phone }}" class="form-control"></div></div>
<div class="row"><div class="col-md-6 mb-3"><label class="form-label">Course *</label><input name="course" value="{{ $student->course }}" class="form-control" required></div>
<div class="col-md-6 mb-3"><label class="form-label">Status</label><select name="status" class="form-select"><option {{ $student->status=='Active'?'selected':'' }}>Active</option><option {{ $student->status=='Inactive'?'selected':'' }}>Inactive</option></select></div></div>
<div class="mb-3"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="2">{{ $student->address }}</textarea></div>
<button class="btn btn-warning">Update Student</button> <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
</form></div>
@endsection
