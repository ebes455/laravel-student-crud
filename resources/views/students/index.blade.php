@extends('layouts.app')
@section('content')
<div class="row mb-3">
  <div class="col-md-4"><div class="card p-3 text-center"><h3>{{ $total }}</h3><p class="text-muted mb-0">Total Students</p></div></div>
  <div class="col-md-4"><div class="card p-3 text-center"><h3 class="text-success">{{ $active }}</h3><p class="text-muted mb-0">Active Students</p></div></div>
  <div class="col-md-4"><div class="card p-3 text-center"><h3 class="text-danger">{{ $total-$active }}</h3><p class="text-muted mb-0">Inactive</p></div></div>
</div>
<div class="card p-4">
<div class="d-flex justify-content-between mb-3"><h4>All Students</h4>
<form class="d-flex" method="GET"><input name="search" value="{{ request('search') }}" class="form-control me-2" placeholder="Search name, email, course..."><button class="btn btn-primary">Search</button></form></div>
<table class="table table-hover"><thead class="table-dark"><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th><th>Status</th><th>Actions</th></tr></thead>
<tbody>@forelse($students as $s)<tr><td>{{ $s->id }}</td><td><strong>{{ $s->name }}</strong></td><td>{{ $s->email }}</td><td>{{ $s->phone }}</td><td><span class="badge bg-info text-dark">{{ $s->course }}</span></td><td><span class="badge bg-{{ $s->status=='Active'?'success':'secondary' }}">{{ $s->status }}</span></td>
<td><a href="{{ route('students.show',$s) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></a> <a href="{{ route('students.edit',$s) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
<form action="{{ route('students.destroy',$s) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this student?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form></td></tr>
@empty<tr><td colspan="7" class="text-center">No students found. Add your first student!</td></tr>@endforelse</tbody></table>
{{ $students->links() }}
</div>
@endsection
