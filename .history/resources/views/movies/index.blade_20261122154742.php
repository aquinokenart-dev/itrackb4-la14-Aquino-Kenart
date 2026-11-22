@extends('layouts.app')

@section('title', 'Movie List')

@section('content')
    <h2>All Movies</h2>

    @auth
        <div class="mb-3">
            <a href="{{ route('movies.create') }}" class="btn btn-success">Add New Movie</a>
        </div>
    @endauth

    <p>
        Active filters:
        @if (!$genre && !$year && !request('search') && request('is_available') === null)
            None (showing everything)
        @else
            @if ($genre)
                <span class="badge bg-info text-dark">
                    Genre: {{ $genres->firstWhere('id', $genre)?->name }}
                </span>
            @endif

            @if ($year)
                <span class="badge bg-info text-dark">Year: {{ $year }}</span>
            @endif

            @if (request('search'))
                <span class="badge bg-info text-dark">Search: {{ request('search') }}</span>
            @endif

            @if (request('is_available') !== null && request('is_available') !== '')
                <span class="badge bg-info text-dark">
                    {{ request('is_available') === '1' ? 'Available' : 'Not Available' }}
                </span>
            @endif
        @endif
    </p>

    <div class="mb-2">
        <strong>Genre:</strong>
        @foreach ($genres as $g)
            <a href="{{ route('movies.index', ['genre' => $g->id, 'year' => $year]) }}"
                class="btn btn-sm btn-outline-primary">{{ $g->name }}</a>
        @endforeach
    </div>

    <div class="mb-3">
        <strong>Year:</strong>
        @foreach ([2008, 2010, 2019, 2022] as $y)
            <a href="{{ route('movies.index', ['genre' => $genre, 'year' => $y]) }}"
                class="btn btn-sm btn-outline-primary">{{ $y }}</a>
        @endforeach

        <a href="{{ route('movies.index') }}" class="btn btn-sm btn-secondary ms-3">
            Clear all filters
        </a>
    </div>

    <form method="GET" action="{{ route('movies.index') }}" class="mb-3">
        <div class="row g-2">

            <div class="col-md-4">
                <input type="text" name="search" class="form-control"
                    placeholder="Search movie..." value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="genre" class="form-select">
                    <option value="">All Genres</option>
                    @foreach ($genres as $g)
                        <option value="{{ $g->id }}" @selected($genre == $g->id)>
                            {{ $g->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="is_available" class="form-select">
                    <option value="">Any Availability</option>
                    <option value="1" @selected(request('is_available') === '1')>Available</option>
                    <option value="0" @selected(request('is_available') === '0')>Not Available</option>
                </select>
            </div>

            <div class="col-md-2">
                <select name="sort" class="form-select">
                    <option value="title" @selected(request('sort', 'title') == 'title')>Title</option>
                    <option value="year" @selected(request('sort') == 'year')>Year</option>
                    <option value="rating" @selected(request('sort') == 'rating')>Rating</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Apply</button>
            </div>

        </div>

        <a href="{{ route('movies.index') }}" class="text-decoration-none">
            Clear Filters
        </a>
    </form>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Rating</th>
                <th>Year</th>
                @auth
                    <th>Action</th>
                @endauth
            </tr>
        </thead>

        <tbody>
            @forelse ($movies as $movie)
                <tr>
                    <td>{{ $movies->firstItem() + $loop->index }}</td>
                    <td>
                        <a href="{{ route('movies.show', $movie->id) }}">
                            {{ $movie->title }}
                        </a>
                    </td>
                    <td>{{ $movie->genre->name }}</td>
                    <td>{{ $movie->rating }}</td>
                    <td>{{ $movie->year }}</td>
                    @auth
                        <td>
                            <a href="{{ route('movies.edit', $movie) }}"
                                class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('movies.destroy', $movie) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    @endauth
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->check() ? 6 : 5 }}">No movies found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $movies->links() }}
    </div>

    <p>Queries: {{ count(\Illuminate\Support\Facades\DB::getQueryLog()) }}</p>
@endsection