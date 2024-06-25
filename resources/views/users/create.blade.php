
@extends('auth.layouts')

@section('content')
<div class="container">
    <h2>Tambah User Baru</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <table class="table">
        <!-- Form untuk menambah user baru -->
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <tr>
                <td><label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </td>
                <td><label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </td>
            </tr>
            <tr>
                <tr>
                    <td colspan="2" >
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </td>
                </tr>
            </tr>
        </form>
    </table>
</div>
@endsection