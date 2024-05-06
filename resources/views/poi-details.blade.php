@extends('layouts.app')
@section('content')
    <div class="main-container" style="margin-top: 0">
        <div class="back-button">
            <button><i class="fa fa-chevron-left"></i></button>
        </div>

        <div class="project-details">
            <div class="main-title">
                <b>{{ $poi->detail->title ?? '' }}</b>
                {{-- / <span>add header</span> --}}
            </div>

            <div class="flags-section">
                <div class="tablinks active" id="defaultOpen" onclick="changeTab(event, 'uk')">
                    <img src="{{ asset('images/uk.png') }}" alt="" />
                </div>
                <div class="tablinks" onclick="changeTab(event, 'germany')">
                    <img src="{{ asset('images/germany.png') }}" alt="" />
                </div>
                <div class="tablinks" onclick="changeTab(event, 'france')">
                    <img src="{{ asset('images/france.png') }}" alt="" />
                </div>
                <div>
                    <button><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div id="uk" class="tab-content">
                <div class="title-1"><b>Title 1</b> / <span class="cursor-pointer">Edit Title</span></div>
                {{-- <div class="title-2"><b>Title 2</b></div> --}}
                <div class="paragraph" lang="en">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing
                    elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore
                    magna aliquyam erat, sed diam voluptua. At vero eos et accusam et
                    justo duo dolores et ea rebum. Lorem ipsum dolor sit amet,
                    consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                    eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor
                    sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
                    At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum
                    dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                    tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                    voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. /
                    <span class="cursor-pointer">Edit Text</span>
                </div>
                <div class="mp3-buttons">
                    <div class="ai-checkbox">
                        <input type="checkbox" name="ai-checkbox" id="ai-checkbox" />
                        <label for="ai-checkbox">AI generate MP3</label>
                    </div>
                    <div class="audio-input">
                        <div class="input-box">Upload some MP3 sounds</div>
                        <div class="input-icon">
                            <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                        </div>
                    </div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/photo-icon.png') }}" alt="upload-icon" />
                    </div>
                    <div>Upload photos</div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/upload-icon-large.png') }}" alt="upload-icon" />
                    </div>
                    <div>Upload videos</div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/star-icon.png') }}" alt="star-icon" />
                    </div>
                    <div>Upload 3D Object</div>
                </div>
            </div>
            <div id="germany" class="tab-content">
                <div class="title-1"><b>Title ger</b> / <span>add title 1</span></div>
                <div class="title-2"><b>Title ger</b></div>
                <div class="paragraph">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing
                    elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore
                    magna aliquyam erat, sed diam voluptua. At vero eos et accusam et
                    justo duo dolores et ea rebum. Lorem ipsum dolor sit amet,
                    consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                    eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor
                    sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
                    At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum
                    dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                    tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                    voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. /
                    <span>Add more text</span>
                </div>
                <div class="mp3-buttons">
                    <div class="ai-checkbox">
                        <input type="checkbox" name="ai-checkbox" id="ai-checkbox" />
                        <label for="ai-checkbox">AI generate MP3</label>
                    </div>
                    <div class="audio-input">
                        <div class="input-box">Upload some MP3 sounds</div>
                        <div class="input-icon">
                            <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                        </div>
                    </div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/photo-icon.png') }}" alt="upload-icon" />
                    </div>
                    <div>Upload photos</div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/upload-icon-large.png') }}" alt="upload-icon" />
                    </div>
                    <div>Upload videos</div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/star-icon.png') }}" alt="star-icon" />
                    </div>
                    <div>Upload 3D Object</div>
                </div>
            </div>
            <div id="france" class="tab-content">
                <div class="title-1"><b>Title 1</b> / <span>add title 1</span></div>
                <div class="title-2"><b>Title 2</b></div>
                <div class="paragraph">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Lorem ipsum dolor sit amet, consetetur sadipscing
                    elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore
                    magna aliquyam erat, sed diam voluptua. At vero eos et accusam et
                    justo duo dolores et ea rebum. Lorem ipsum dolor sit amet,
                    consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                    ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                    eos et accusam et justo duo dolores et ea rebum. Lorem ipsum dolor
                    sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
                    At vero eos et accusam et justo duo dolores et ea rebum. Lorem ipsum
                    dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                    tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                    voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
                    nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
                    erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. /
                    <span>Add more text</span>
                </div>
                <div class="mp3-buttons">
                    <div class="ai-checkbox">
                        <input type="checkbox" name="ai-checkbox" id="ai-checkbox" />
                        <label for="ai-checkbox">AI generate MP3</label>
                    </div>
                    <div class="audio-input">
                        <div class="input-box">Upload some MP3 sounds</div>
                        <div class="input-icon">
                            <img src="{{ asset('images/mic-icon.png') }}" alt="mic-icon" />
                        </div>
                    </div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/photo-icon.png') }}" alt="upload-icon" />
                    </div>
                    <div>Upload photos</div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/upload-icon-large.png') }}" alt="upload-icon" />
                    </div>
                    <div>Upload videos</div>
                </div>
                <div class="input-large-box">
                    <div class="input-box-icon">
                        <img src="{{ asset('images/star-icon.png') }}" alt="star-icon" />
                    </div>
                    <div>Upload 3D Object</div>
                </div>
            </div>
            <div class="submit-details">
                <button>SAVE</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#translateButton').click(function() {
                var sourceText = $('#sourceText').val();
                var apiKey = 'YOUR_GOOGLE_TRANSLATE_API_KEY'; // Replace with your Google Translate API key
                var targetLanguage =
                    'es'; // Replace with your target language code (e.g., 'es' for Spanish)

                var apiUrl = 'https://translation.googleapis.com/language/translate/v2?key=' + apiKey;
                $.ajax({
                    url: apiUrl,
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        q: sourceText,
                        target: targetLanguage
                    }),
                    success: function(response) {
                        $('#translatedText').text(response.data.translations[0].translatedText);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
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
