<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Control</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @forelse(\App\Category::with("user")->get() as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->user->name}}</td>
            <td>
                <a href="{{ route('category.edit',$category->id) }}">
                    <button class="btn btn-outline-primary">
                        Edit
                    </button>
                </a>
                <form action="{{ route('category.destroy',$category->id) }}" method="post" class="d-inline-block">
                    @csrf
                    @method('delete')
                    <button class="btn btn-outline-danger" onclick="return confirm('Are U sure to delete {{ $category->title }} category?')">
                        Delete
                    </button>
                </form>
            </td>
            <td>
                            <span class="small">
                                <i class="feather-calendar"></i>
                                {{ $category->created_at->format("d / m / Y") }}
                            </span>
                <br>
                <span class="small">
                                <i class="feather-clock"></i>
                                {{ $category->created_at->format("h : i A") }}
                            </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">There is no category</td>
        </tr>
    @endforelse
    </tbody>
</table>
