@extends('layouts.app')
@section('content')
<div class="card p-4 col-md-8 mx-auto"><h4 class="mb-3">Add New Student</h4>
@if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ route('students.store') }}">@csrf
<div class="mb-3"><label class="form-label">Full Name *</label><input name="name" value="{{ old('name') }}" class="form-control" required></div>
<div class="row"><div class="col-md-6 mb-3"><label class="form-label">Email *</label><input type="email" name="email" value="{{ old('email') }}" class="form-control" required></div>
<div class="col-md-6 mb-3"><label class="form-label">Phone</label><input name="phone" value="{{ old('phone') }}" class="form-control"></div></div>
<div class="row"><div class="col-md-6 mb-3"><label class="form-label">Course *</label><select name="course" class="form-select"><option>BS Computer Science</option><option>BS Software Engineering</option><option>BS IT</option><option>BBA</option><option>BS English</option></select></div>
<div class="col-md-6 mb-3"><label class="form-label">Status</label><select name="status" class="form-select"><option>Active</option><option>Inactive</option></select></div></div>
<div class="mb-3"><label class="form-label">Address</label><textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea></div>
<button class="btn btn-primary">Save Student</button> <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
</form></div>
@endsection
