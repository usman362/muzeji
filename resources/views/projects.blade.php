@extends('layouts.app')
@section('content')
    <div class="main-container">
        <div class="main-heading">
            <h2>Places - {{ $projectDetail->title }}</h2>
            <button onclick="toggleModal()">ADD <i class="fa fa-plus"></i></button>
        </div>
        <div class="places-table">
            @forelse ($projectDetail->exhibitions as $key => $exhibition)
                <div class="table-row">
                    <div class="place-title">
                        <div class="row-number">{{++$key}}</div>
                        <div class="title">{{$exhibition->title}}</div>
                    </div>
                    <div class="details-button">
                        <a href="{{url('statistics')}}?exhibition={{$exhibition->id}}"><button class="stats-button">Stats</button>
                            <a href="{{ route('poi.index', $exhibition->id) }}"><button class="view-button">View</button></a>
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
                <form action="{{ route('exhibition.store', $projectDetail->id) }}" method="post">
                    @csrf
                    <div class="text-input">
                        <div class="input-label">ADD NEW PLACE</div>
                        <input type="text" name="title" placeholder="Enter Place Nmae" />
                        <button type="submit" class="submit-button">ADD</button>
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
    </script>
@endpush
