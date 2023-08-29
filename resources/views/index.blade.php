@extends('layout')

@section('content')

<div class="container mt-5">
    <h2>Image Gallery</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
            <tr>
                <td>{{ $image->name }}</td>
                <td><img src="{{ asset($image->path) }}" alt="{{ $image->name }}" style="max-height: 100px;"></td>
                <td>
                    <a href="{{ route('form.add', $image->id) }}" class="btn btn-success btn-sm">Add</a>
                    <a href="{{ route('form.edit', $image->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('form.destroy', $image->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection