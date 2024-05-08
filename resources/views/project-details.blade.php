@extends('layouts.app')
@section('content')
    <div class="main-container" style="margin-top: 0">
        <div class="back-button">
            <a href="{{ route('projects.index', $exhibition->project_id) }}"><button><i
                        class="fa fa-chevron-left"></i></button></a>
        </div>
        <div class="main-heading">
            <h2>{{ $exhibition->title }}</h2>
            <button onclick="toggleModal()" class="add-btn">ADD <i class="fa fa-plus"></i></button>
        </div>
        <div class="places-table">
            @forelse ($exhibition->pois as $key => $pois)
                <div class="table-row">
                    <div class="place-title">
                        <div class="row-number">{{ ++$key }}</div>
                        <div class="title">
                            {{ $pois->title ?? '' }}
                        </div>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('qrcode.download', $pois->short_code) }}">
                            <img src="{{ asset('images/download-icon.png') }}" alt="download-button" />
                        </a>
                        <a href="{{ route('poi.show', $pois->short_code) }}">
                            <img src="{{ asset('images/eye-icon.png') }}" alt="view-button" />
                        </a>
                        <a href="{{ route('poi.edit', $pois->id) }}">
                            <img src="{{ asset('images/edit-icon.png') }}" alt="view-button" />
                        </a>
                        {{-- <a href="javascript:void(0)" onclick="toggleModal()" class="edit-btn" data-id="{{ $pois->id }}"
                            data-title="{{ $pois->detail->title ?? '' }}">
                            <img src="{{ asset('images/edit-icon.png') }}" alt="edit-button" />
                        </a> --}}
                        <form action="{{ route('poi.destroy', $pois->id) }}"
                            onsubmit="confirmAction(event, () => event.target.submit())" method="post">
                            @method('DELETE')
                            @csrf
                            <button>
                                <img src="{{ asset('images/remove-icon.png') }}" alt="remove-button" />
                            </button>
                        </form>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>

    <div class="add-project-modal" id="add-project-modal">
        <div class="backdrop"></div>
        <div class="modal-box">
            <i class="fa fa-close close-button" onclick="toggleModal()"></i>
            <div class="modal-inputs">
                <form action="{{ route('poi.store', $exhibition->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="poi_id" />
                    <div class="text-input">
                        <div class="input-label">ADD NEW PLACE</div>
                        <input type="text" placeholder="" name="title" />
                        <button class="submit-button" type="submit">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showFileName() {
            const fileInput = document.getElementById("fileInput");
            const selectedFile = document.getElementById("selectedFile");
            const fileName = fileInput.files[0].name;
            selectedFile.innerHTML = `${fileName}`;
        }

        function changeBoxColor(inputId, id) {
            const colorInput = document.getElementById(inputId).value;
            const selectedBox = document.getElementById(id);
            // const fileName = colorInput.files[0].name;
            // selectedFile.innerHTML = `${fileName}`;
            selectedBox.style.backgroundColor = colorInput;
        }

        function fileInputClick(id) {
            document.getElementById(id).click();
        }

        function toggleModal() {
            document.getElementById("add-project-modal").classList.toggle("show");
        }

        $('.add-btn').click(function() {
            $('.input-label').text('ADD NEW PLACE');
            $('[name="poi_id"]').val('');
            $('[name="title"]').attr('placeholder', 'ADD NEW PLACE');
            $('.submit-button').text('ADD');
        })

        $('.edit-btn').click(function() {
            $('.input-label').text('EDIT PLACE');
            $('[name="title"]').attr('placeholder', 'EDIT PLACE');
            $('[name="poi_id"]').val($(this).attr('data-id'));
            $('[name="title"]').val($(this).attr('data-title'));
            $('.submit-button').text('UPDATE');
        })

        function confirmAction(event, callback) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Are you sure you want to delete this?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-danger me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    callback();
                }
            });
        }
    </script>
@endpush
