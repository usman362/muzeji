@extends('layouts.app')

@section('content')
    @forelse ($projects as $key => $project)
        <div class="main-banner main-banner-1" style="background-color:{{$project->bg_color}}">
            <div class="banner-image">
                <img src="{{ asset('storage/'.$project->logo) }}" alt="banner-1" />
            </div>
            <div class="banner-section">
                <div class="text-box" style="background-color:{{$project->head_color}}">
                    <div class="banner-number">
                        <p>{{ ++$key }}</p>
                    </div>
                    <div class="banner-text">
                        {{$project->description}}
                    </div>
                </div>
                <div class="heading-box">
                    <div class="banner-heading">{{strtoupper($project->title)}}</div>
                    <a href="{{route('projects.index',$project->id)}}" class="redirect-button">
                        <img src="{{ asset('images/arrow-right-long.png') }}" alt="right-arrow" />
                    </a>
                </div>
            </div>
        </div>
    @empty
    @endforelse


    <div class="text-center">
        <button class="add-button" onclick="toggleModal()">
            <i class="fa fa-plus"></i>
        </button>
    </div>

    <div class="add-modal" id="add-modal">
        <div class="backdrop"></div>
        <div class="modal-box">
            <i class="fa fa-close close-button" onclick="toggleModal()"></i>
            <form action="{{route('projects.store')}}" method="post" enctype="multipart/form-data" id="project-form">
                @csrf
                <div class="modal-inputs">
                    <div class="file-input cursor-pointer">
                        <div class="custom-file-input" id="customFileInput" onclick="fileInputClick('fileInput')">
                            <div class="upload-icon">
                                <img src="{{ asset('images/upload-icon.png') }}" alt="file-icon" />
                            </div>
                            <div class="selected-file" id="selectedFile">Upload Logo</div>
                        </div>
                        <input type="file" id="fileInput" name="file" onchange="showFileName()" required/>
                        <div class=""></div>
                    </div>
                    <div class="text-input">
                        <input type="email" name="title" placeholder="Email of User" required/>
                    </div>
                    <div class="colors-input">
                        <label>Choose colors</label>
                        <input type="color" id="backgroundColor" name="bg_color" value="#1AD598"
                            onchange="changeBoxColor('backgroundColor', 'backgroundColorBox')" />
                        <div class="colorBox" onclick="fileInputClick('backgroundColor')">
                            <div id="backgroundColorBox"
                                style="
                background-color: #1AD598;
                width: 15px;
                height: 15px;
                flex-shrink: 0;
                border-radius: 3px;
              ">
                            </div>
                            <div>background</div>
                        </div>
                        <input type="color" id="headerColor" name="head_color" value="#ea3a3d"
                            onchange="changeBoxColor('headerColor', 'headerColorBox')" />
                        <div class="colorBox" onclick="fileInputClick('headerColor')">
                            <div id="headerColorBox"
                                style="
                background-color: #ea3a3d;
                width: 15px;
                height: 15px;
                flex-shrink: 0;
                border-radius: 3px;
              ">
                            </div>
                            <div>header</div>
                        </div>
                    </div>
                    <div class="text-input">
                        <input type="text" placeholder="Company Name" name="description" required/>
                    </div>
                </div>
                <div class="modal-button">
                    <button class="submit-button" type="submit">ADD</button>
                </div>
            </form>
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
            document.getElementById("add-modal").classList.toggle("show");
        }
    </script>
@endpush
