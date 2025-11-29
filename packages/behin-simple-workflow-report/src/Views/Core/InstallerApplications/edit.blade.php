@extends('behin-layouts.app')

@section('title')
    ویرایش اطلاعات نصاب
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>ویرایش درخواست</span>
                        <a class="btn btn-secondary btn-sm"
                            href="{{ route('simpleWorkflowReport.installer-applications.index') }}">بازگشت</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('simpleWorkflowReport.installer-applications.update', $application) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">نام</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name', $application->first_name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">نام خانوادگی</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name', $application->last_name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">کد ملی</label>
                                    <input type="text" name="national_id" class="form-control"
                                        value="{{ old('national_id', $application->national_id) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">تلفن</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', $application->phone) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">استان</label>
                                    <input type="text" name="province" class="form-control"
                                        value="{{ old('province', $application->province) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">شهر</label>
                                    <input type="text" name="city" class="form-control"
                                        value="{{ old('city', $application->city) }}" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">توضیحات</label>
                                    <textarea name="description" class="form-control" rows="2">{{ old('description', $application->description) }}</textarea>
                                </div>
                                <div class="col-12 mb-4">
                                    <label class="form-label">خلاصه رزومه</label>
                                    <textarea name="resume_summary" class="form-control" rows="3">{{ old('resume_summary', optional($application->profile)->summary) }}</textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">پروژه‌ها</h5>
                                <button type="button" id="add-project" class="btn btn-outline-primary btn-sm">افزودن پروژه</button>
                            </div>

                            <div id="projects-wrapper">
                                @foreach ($application->projects as $index => $project)
                                    <div class="card mb-3 project-card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">پروژه {{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-outline-danger btn-sm remove-project">حذف</button>
                                            </div>
                                            <input type="hidden" name="projects[{{ $index }}][id]" value="{{ $project->id }}" class="project-id">
                                            <input type="hidden" name="projects[{{ $index }}][remove]" value="0" class="project-remove">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">عنوان پروژه</label>
                                                    <input type="text" name="projects[{{ $index }}][title]" class="form-control"
                                                        value="{{ old("projects.$index.title", $project->title) }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">تصویر</label>
                                                    <input type="file" name="projects[{{ $index }}][image]" class="form-control">
                                                    @if ($project->image_path)
                                                        <div class="mt-2">
                                                            <img src="{{ 'storage/app/public/' . $project->image_path }}" alt="project image" class="img-thumbnail" style="max-width: 200px;">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label">توضیحات پروژه</label>
                                                    <textarea name="projects[{{ $index }}][description]" class="form-control" rows="3">{{ old("projects.$index.description", $project->description) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="project-template">
        <div class="card mb-3 project-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">پروژه جدید</h6>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-project">حذف</button>
                </div>
                <input type="hidden" name="projects[__INDEX__][id]" value="" class="project-id">
                <input type="hidden" name="projects[__INDEX__][remove]" value="0" class="project-remove">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">عنوان پروژه</label>
                        <input type="text" name="projects[__INDEX__][title]" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">تصویر</label>
                        <input type="file" name="projects[__INDEX__][image]" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">توضیحات پروژه</label>
                        <textarea name="projects[__INDEX__][description]" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </template>
@endsection

@section('script')
    <script>
        (function() {
            let projectIndex = {{ $application->projects->count() }};
            const wrapper = document.getElementById('projects-wrapper');
            const template = document.getElementById('project-template');

            document.getElementById('add-project').addEventListener('click', function() {
                const content = template.innerHTML.replace(/__INDEX__/g, projectIndex);
                wrapper.insertAdjacentHTML('beforeend', content);
                projectIndex++;
            });

            wrapper.addEventListener('click', function(event) {
                if (!event.target.classList.contains('remove-project')) {
                    return;
                }

                const card = event.target.closest('.project-card');
                const idInput = card.querySelector('.project-id');
                const removeInput = card.querySelector('.project-remove');

                if (idInput.value) {
                    removeInput.value = 1;
                    card.classList.add('border-danger', 'bg-light');
                    card.querySelectorAll('input, textarea').forEach(function(input) {
                        if (!input.classList.contains('project-id') && !input.classList.contains('project-remove')) {
                            input.disabled = true;
                        }
                    });
                    event.target.disabled = true;
                    event.target.textContent = 'حذف شد';
                } else {
                    card.remove();
                }
            });
        })();
    </script>
@endsection
