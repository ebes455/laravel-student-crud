<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Management System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>body{background:#f4f6f9}.navbar{background:linear-gradient(90deg,#0d6efd,#6610f2)}.card{border:none;box-shadow:0 2px 10px rgba(0,0,0,.08)}</style>
</head>
<body>
<nav class="navbar navbar-dark mb-4"><div class="container"><a class="navbar-brand fw-bold" href="{{ route('students.index') }}"><i class="bi bi-mortarboard-fill"></i> StudentMS</a><a href="{{ route('students.create') }}" class="btn btn-light btn-sm">+ Add Student</a></div></nav>
<div class="container">@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif @yield('content')</div>
<footer class="text-center text-muted mt-5 mb-3">Student Management System - Laravel CRUD | Jenkins CI/CD Lab</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body></html>
