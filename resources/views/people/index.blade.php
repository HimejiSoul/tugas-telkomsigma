@extends('layouts.app')

@section('content')
<div class="container">
    <h1>People</h1>

    <a href="{{ route('people.create') }}" class="btn btn-primary mb-3">Add Person</a>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>Category</th>
                <th>Date</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($people as $person)
            <tr>
                <td>{{ $person->id }}</td>
                <td>{{ $person->firstname }}</td>
                <td>{{ $person->lastname }}</td>
                <td>{{ $person->category }}</td>
                <td>{{ $person->date }}</td>
                <td>{{ $person->updated_at }}</td>
                <td>
                    <a href="{{ route('people.edit', $person->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('people.destroy', $person->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this person?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection