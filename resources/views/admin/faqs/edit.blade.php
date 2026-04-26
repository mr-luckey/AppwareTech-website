@extends('admin.layouts.app')

@section('title', 'Edit FAQ')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-question-circle me-2"></i>Edit FAQ</h2>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to FAQs
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="question" class="form-label">Question <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question', $faq->question) }}" required>
                @error('question')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="answer" class="form-label">Answer <span class="text-danger">*</span></label>
                <textarea class="form-control summernote @error('answer') is-invalid @enderror" id="answer" name="answer" rows="5">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="order" class="form-label">Display Order</label>
                        <input type="number" min="0" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $faq->order) }}">
                        <small class="text-muted">Lower numbers appear first.</small>
                        @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Update FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection