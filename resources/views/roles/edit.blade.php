@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content_header')
    <h1>Edit Role</h1>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edit Role
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="select-all">
                                        Select All
                                    </label>
                                </div>
                            </div>
                            @php
                                $groupedPermissions = $permissions->groupBy(function ($permission) {
                                    return explode('-', $permission->name)[1];
                                });
                            @endphp
                            @foreach ($groupedPermissions as $menuName => $permissionsGroup)
                                <div class="col-md-3">
                                    <h5>{{ $menuName }}</h5>
                                    @foreach ($permissionsGroup as $permission)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                    {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Role</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.getElementById('select-all').onclick = function() {
            var checkboxes = document.querySelectorAll('input[name="permissions[]"]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>
@endsection
