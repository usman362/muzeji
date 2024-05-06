@extends('layouts.app')
@section('content')
    <div class="main-container" style="margin-top: 0">
        <div class="back-button">
            <button><i class="fa fa-chevron-left"></i></button>
        </div>

        <form action="{{ route('poi.update', $poi->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="project-details">
                <div class="main-title">
                    {{-- <b>{{ $poi->detail->title ?? '' }}</b> --}}
                    <span>add header</span>
                </div>

                <div class="flags-section">
                    @foreach ($poi->details as $key => $detail)
                        <div class="tablinks active" id="defaultOpen" onclick="changeTab(event, '{{ $detail->language }}')">
                            <img src="{{ asset('images/uk.png') }}" alt="" />
                        </div>
                    @endforeach
                    <div>
                        <button><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                @foreach ($poi->details as $key => $detail)
                    <div id="{{ $detail->language }}" class="tab-content">
                        <div class="title-1"><input type="text" class="form-control" value="{{ $detail->title }}"
                                name="title[]">
                        </div>
                        <div class="paragraph">
                            <textarea name="description[]" id="" class="form-control" rows="10">{{ $detail->description }}</textarea>
                        </div>

                        <div class="">
                            <select name="" id="" class="form-control select2">
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </div>

                        <div class="mp3-buttons">
                            <div class="ai-checkbox">
                                <input type="checkbox" name="ai-checkbox[]" id="ai-checkbox" />
                                <label for="ai-checkbox">AI generate MP3</label>
                            </div>
                            <div class="audio-input cursor-pointer" onclick="fileInputClick('audioInput')">
                                <input type="file" id="audioInput" class="d-none" name="audio[]"
                                    onchange="showFileName()" accept="audio/*" />
                                <div class=""></div>
                                <div class="selected-file" id="selectedFile">Upload Logo</div>
                                <div class="input-icon">
                                    <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                                </div>
                            </div>
                        </div>
                        <div class="input-large-box cursor-pointer" onclick="fileInputClick('imageInput')">
                            <div class="input-box-icon">
                                <img src="{{ asset('images/photo-icon.png') }}" alt="file-icon" />
                            </div>
                            <div class="selected-file" id="selectedFile">Upload Logo</div>
                            <input type="file" id="imageInput" class="d-none" name="logo[]" onchange="showFileName()"
                                accept="image/*" />
                            <div class=""></div>
                        </div>
                        <div class="input-large-box cursor-pointer" onclick="fileInputClick('videoInput')">
                            <div class="input-box-icon">
                                <img src="{{ asset('images/upload-icon-large.png') }}" alt="file-icon" />
                            </div>
                            <div class="selected-file" id="selectedFile">Upload videos</div>
                            <input type="file" id="videoInput" class="d-none" name="video[]" onchange="showFileName()"
                                accept="video/*" />
                            <div class=""></div>
                        </div>
                        <div class="input-large-box cursor-pointer" onclick="fileInputClick('fileInput')">
                            <div class="input-box-icon">
                                <img src="{{ asset('images/star-icon.png') }}" alt="file-icon" />
                            </div>
                            <div class="selected-file" id="selectedFile">Upload 3D Object</div>
                            <input type="file" id="fileInput" name="object[]" onchange="showFileName()" />
                            <div class=""></div>
                        </div>
                    </div>
                @endforeach

                <div class="submit-details">
                    <button type="submit">SAVE</button>
                </div>
            </div>
        </form>
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

        document.getElementById("defaultOpen").click();

        function changeTab(evt, tabName) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        $(document).ready(function() {
            let audioChunks = [];
            let mediaRecorder;

            // Get user media constraints
            const constraints = {
                audio: true
            };

            // Event handler for starting recording
            $('#startRecording').click(function() {
                navigator.mediaDevices.getUserMedia(constraints)
                    .then(function(stream) {
                        mediaRecorder = new MediaRecorder(stream);

                        // Event handler for data available
                        mediaRecorder.ondataavailable = function(event) {
                            audioChunks.push(event.data);
                        }

                        // Start recording
                        mediaRecorder.start();
                    })
                    .catch(function(err) {
                        console.error('Error recording audio: ' + err);
                    });
            });

            // Event handler for stopping recording
            $('#stopRecording').click(function() {
                if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                    mediaRecorder.stop();
                }
            });

            // Event handler for data available
            $('#downloadLink').click(function() {
                // Convert audio chunks to blob
                const audioBlob = new Blob(audioChunks, {
                    type: 'audio/wav'
                });

                // Create download link
                const url = URL.createObjectURL(audioBlob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'recording.wav';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            });

            // Handle media recorder error
            mediaRecorder.onerror = function(e) {
                console.error('Error from Media Recorder:', e);
            };
        });
    </script>
@endpush
