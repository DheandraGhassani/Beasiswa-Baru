@extends('auth.layouts')


@section('content')
<div class="container">
    <h2>Edit User</h2>
    <table class="table">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <tr>
                <td>
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </td>
            </tr>
        </form>
    </table>
</div>
@endsection