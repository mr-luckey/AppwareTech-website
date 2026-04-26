@extends('admin.layouts.app')

@section('title', 'Courses Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-graduation-cap me-2"></i>Courses Management</h2>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add New Course
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        @if($courses->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="50">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Level</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>
                            <input type="checkbox" class="course-checkbox" value="{{ $course->id }}">
                        </td>
                        <td>
                            @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 5px;">
                            @else
                            <div style="width: 60px; height: 40px; background: #e9ecef; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $course->title }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-{{ $course->level == 'beginner' ? 'success' : ($course->level == 'intermediate' ? 'warning' : 'danger') }}">
                                {{ ucfirst($course->level) }}
                            </span>
                        </td>
                        <td>${{ number_format($course->price, 2) }}</td>
                        <td>{{ $course->duration }}</td>
                        <td>
                            <span class="badge bg-{{ $course->is_active ? 'success' : 'secondary' }}">
                                {{ $course->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-sm btn-info" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <form action="{{ route('admin.courses.bulk-delete') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete selected courses?');">
                @csrf
                @method('DELETE')
                <input type="hidden" name="course_ids" id="bulkCourseIds">
                <button type="submit" class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display: none;">
                    <i class="fas fa-trash me-1"></i>Delete Selected
                </button>
            </form>
            <div>
                {{ $courses->links() }}
            </div>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
            <h5>No courses found</h5>
            <p class="text-muted">Start by adding your first course.</p>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add New Course
            </a>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Select all checkboxes
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.course-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        toggleBulkDeleteBtn();
    });

    // Individual checkbox change
    document.querySelectorAll('.course-checkbox').forEach(cb => {
        cb.addEventListener('change', toggleBulkDeleteBtn);
    });

    function toggleBulkDeleteBtn() {
        const checked = document.querySelectorAll('.course-checkbox:checked').length;
        const bulkBtn = document.getElementById('bulkDeleteBtn');
        const bulkInput = document.getElementById('bulkCourseIds');
        
        if (checked > 0) {
            bulkBtn.style.display = 'inline-block';
            const ids = Array.from(document.querySelectorAll('.course-checkbox:checked')).map(cb => cb.value);
            bulkInput.value = ids.join(',');
        } else {
            bulkBtn.style.display = 'none';
        }
    }
</script>
@endpush
@endsection