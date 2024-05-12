@extends('layouts.app')
@section('content')
    <div class="main-container" style="margin-top: 0">
        <div class="main-heading">
            <h1>Settings</h1>
        </div>
        <div class="settings-container">
            <div class="projects-dropdown dropdown">
                <div class="dropdown-box">
                    <span
                        id="project-select">{{ !empty(\App\Models\Project::find(request()->project)) ? \App\Models\Project::find(request()->project)->title : 'Select the Project' }}</span>
                    <i class="fa fa-chevron-down"></i>
                </div>
                <div class="submenu project-submenu" id="dropdown-items">
                    @foreach ($projects as $key => $project)
                        <a href="{{ $project->id == request()->project ? 'javascript:void(0)' : url('settings') . '?project=' . $project->id }}"
                            class="submenu-item {{ $project->id == request()->project ? 'active' : '' }}"
                            onclick="onChangeDropdown(event,'project-select','{{ $project->title }}','dropdown-items' )">
                            {{ $project->title }} <i class="fa fa-check"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            @if (!empty(request('project')) && !empty(\App\Models\Project::find(request()->project)))
            <form action="{{route('settings.store',request()->project)}}" method="post" enctype="multipart/form-data">
                @csrf
                @php
                    $project = \App\Models\Project::find(request()->project);
                @endphp
                <div class="input-sections">
                    <div class="colors-radio-box radio-box">
                        <input type="radio" name="colors-radio" id="colors-radio" />
                        <label for="colors-radio">Colours</label>
                    </div>
                    <div class="colors-input-boxes">
                        {{-- Color Box Child --}}

                        <div>
                            <sub>Background Color</sub>
                            <div class="colors-input-box cursor-pointer " onclick="inputClick('color-input-1')">
                                <input type="color" id="color-input-1" name="bg_color" value="{{$project->bg_color ?? '#0090ff'}}"
                                    onchange="changeBoxColor('color-input-1', 'color-box-1', 'color-code-1')" />
                                <div id="color-box-1" class="color-box" style="background: {{$project->bg_color ?? '#0090ff'}}"></div>
                                <div id="color-code-1" class="color-code">{{$project->bg_color ?? '#0090ff'}}</div>
                            </div>
                            {{-- <i class="fa fa-close mt-2 cursor-pointer" onclick="removeColorBox(this)"></i> --}}
                        </div>

                        <div>
                            <sub>Header Color</sub>
                            <div class="colors-input-box cursor-pointer " onclick="inputClick('color-input-2')">
                                <input type="color" id="color-input-2" name="head_color" value="{{$project->head_color ?? '#0090ff'}}"
                                    onchange="changeBoxColor('color-input-2', 'color-box-2', 'color-code-2')" />
                                <div id="color-box-2" class="color-box" style="background: {{$project->head_color ?? '#0090ff'}}"></div>
                                <div id="color-code-2" class="color-code">{{$project->head_color ?? '#0090ff'}}</div>
                            </div>
                            {{-- <i class="fa fa-close mt-2 cursor-pointer" onclick="removeColorBox(this)"></i> --}}
                        </div>

                        <div>
                            <sub>Splash Color</sub>
                            <div class="colors-input-box cursor-pointer " onclick="inputClick('color-input-5')">
                                <input type="color" id="color-input-5" name="splash_color" value="{{$project->splash_color ?? '#0090ff'}}"
                                    onchange="changeBoxColor('color-input-5', 'color-box-5', 'color-code-5')" />
                                <div id="color-box-5" class="color-box" style="background: {{$project->splash_color ?? '#0090ff'}}"></div>
                                <div id="color-code-5" class="color-code">{{$project->splash_color ?? '#0090ff'}}</div>
                            </div>
                            {{-- <i class="fa fa-close mt-2 cursor-pointer" onclick="removeColorBox(this)"></i> --}}
                        </div>
                        {{-- Add Color Button --}}
                        {{-- <div class="colors-input-box" id="add-color-button" style="cursor: pointer">
                            <div class="color-box" style="background: grey"></div>
                            <div id="color-code-6" class="color-code">
                                <small>Add Color</small>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="input-sections">
                    <div class="logo-radio-box radio-box">
                        <input type="radio" name="logo-radio" id="logo-radio" />
                        <label for="logo-radio">Logo</label>
                    </div>
                    <div class="input-boxes">
                        <div class="input-box cursor-pointer" onclick="inputClick('file-input-1')">
                            <input onchange="showFileName('file-input-1','selected-file-1')" type="file" name="file" id="file-input-1" />
                            <div class="upload-icon">
                                <img src="images/upload-icon.png" alt="upload-icon" />
                            </div>
                            <div id="selected-file-1">Upload some files</div>
                        </div>
                    </div>
                    <img src="{{asset('storage/'.$project->logo)}}" alt="" width="100">
                </div>
                <div class="input-sections">
                    <div class="design-radio-box radio-box">
                        <input type="radio" name="design-radio" id="design-radio" />
                        <label for="design-radio">Design</label>
                    </div>
                    <div class="input-boxes">
                        <div class="input-box cursor-pointer" onclick="inputClick('file-input-2')">
                            <input onchange="showFileName('file-input-2','selected-file-2')" type="file" name="splash" id="file-input-2" />
                            <div class="upload-icon">
                                <img src="images/upload-icon.png" alt="upload-icon" />
                            </div>
                            <div id="selected-file-2">Splash screen</div>
                        </div>
                    </div>
                    {{-- <img src="{{asset('storage/'.$project->logo)}}" alt="" width="100"> --}}
                </div>
                <div class="submit-details">
                    <button type="submit">SAVE</button>
                </div>
            </form>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showFileName(id,value) {
            const fileInput = document.getElementById(id);
            const selectedFile = document.getElementById(value);
            const fileName = fileInput.files[0].name;
            selectedFile.innerHTML = `${fileName}`;
        }

        function changeBoxColor(inputId, id, codeId) {
            const colorInput = document.getElementById(inputId).value;
            const selectedBox = document.getElementById(id);
            const codeText = document.getElementById(codeId);
            // const fileName = colorInput.files[0].name;
            // selectedFile.innerHTML = `${fileName}`;
            selectedBox.style.backgroundColor = colorInput;
            codeText.innerText = colorInput;
        }

        function inputClick(id) {
            document.getElementById(id).click();
        }

        function toggleModal() {
            document.getElementById("add-modal").classList.toggle("show");
        }

        function onChangeDropdown(event, id, value, parentId) {
            Array.from(document.getElementById(parentId).children).forEach(
                (element) => {
                    element.classList.remove("active");
                }
            );
            const selectDropdown = document.getElementById(id);
            selectDropdown.innerText = value;
            event.target.classList.add("active");
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#add-color-button').click(function() {
                var colorCount = $('.colors-input-boxes .colors-input-box').length;
                var newColorBox = `
                    <div style="display: flex">
                        <div class="colors-input-box cursor-pointer" onclick="inputClick('color-input-${colorCount}')">
                            <input type="color" id="color-input-${colorCount}"
                                onchange="changeBoxColor('color-input-${colorCount}', 'color-box-${colorCount}', 'color-code-${colorCount}')" />
                            <div id="color-box-${colorCount}" class="color-box" style="background: #0090ff"></div>
                            <div id="color-code-${colorCount}" class="color-code">#0090FF</div>
                        </div>
                        <i class="fa fa-close mt-2 cursor-pointer" onclick="removeColorBox(this)"></i>
                    </div>`;
                $(this).before(newColorBox);
            });
        });

        function removeColorBox(element) {
            $(element).parent().remove();
        }
    </script>
@endpush
