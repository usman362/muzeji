@extends('layouts.app')
@section('content')
    <div class="main-container" style="margin-top: 0">
        <div class="back-button">
            <a href="{{ route('poi.index', $poi->exhibition->id) }}"><button><i class="fa fa-chevron-left"></i></button></a>
        </div>

        <div class="project-details">
            <div class="main-title">
                <b>{{ $poi->detail->title ?? '' }}</b>
            </div>

            <div class="flags-section">
                @foreach ($poi->details as $key => $detail)
                    <div class="tablinks active" id="defaultOpen" onclick="changeTab(event, '{{ $detail->language }}')">
                        <img src="https://hatscripts.github.io/circle-flags/flags/{{ $detail->flag }}.svg" alt=""
                            width="36" />
                    </div>
                @endforeach
            </div>

            @foreach ($poi->details as $key => $detail)
                <div id="{{ $detail->language }}" class="tab-content">
                    <div class="title-1"><b>{{ $detail->title }}</b></div>
                    <div class="paragraph" lang="{{ $detail->language }}">
                        {{ $detail->description }}
                    </div>
                    @php
                        $audios = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'audio')
                            ->get();
                        $video = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'video')
                            ->first();
                        $logos = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'logo')
                            ->get();
                        $object = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'object')
                            ->first();
                    @endphp
                    <div class="mp3-buttons">
                        <div class="row">
                            @foreach ($audios as $audio)
                                <div class="col-md-4">
                                    <audio src="{{ asset('storage/' . $audio->media_url) }}" controls></audio>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="input-large-box">
                        <div style="display:flex">
                            @forelse ($logos as $logo)
                                <img src="{{ asset('storage/' . $logo->media_url) }}" alt="" width="100" />
                            @empty
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/photo-icon.png') }}" alt="upload-icon" />
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="input-large-box">
                        @if (isset($video->media_url))
                            <video src="{{ asset('storage/' . $video->media_url) }}" controls></video>
                        @else
                            <div class="input-box-icon">
                                <img src="{{ asset('images/upload-icon-large.png') }}" alt="upload-icon" />
                            </div>
                        @endif
                    </div>
                    <div class="input-large-box">
                        <div class="input-box-icon">
                            @if (isset($object->media_url))
                                <img src="{{ asset('storage/' . $object->media_url) }}" alt="star-icon" />
                            @else
                                <div class="input-box-icon">
                                    <img src="{{ asset('images/star-icon.png') }}" alt="star-icon" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
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
