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
                    @php
                        $logoTab = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'logo')
                            ->first();
                    @endphp
                    <div class="tablinks active" id="defaultOpen" onclick="changeTab(event, '{{ $detail->language }}')">
                        @if (isset($logoTab->media_url))
                            <img src="{{ asset('storage/' . $logoTab->media_url) }}" alt="" />
                        @else
                            <img src="{{ asset('images/error_log.png') }}" width="40" alt="" />
                        @endif
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
                        $audio = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'audio')
                            ->first();
                        $video = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'video')
                            ->first();
                        $logo = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'logo')
                            ->first();
                        $object = App\Models\POIMedia::where('detail_id', $detail->id)
                            ->where('type', 'object')
                            ->first();
                    @endphp
                    <div class="mp3-buttons">
                        @if (isset($audio->media_url))
                            <audio src="{{ asset('storage/' . $audio->media_url) }}" controls></audio>
                        @endif
                    </div>
                    <div class="input-large-box">
                        @if (isset($logo->media_url))
                            <img src="{{ asset('storage/' . $logo->media_url) }}" alt="" />
                        @else
                            <div class="input-box-icon">
                                <img src="{{ asset('images/photo-icon.png') }}" alt="upload-icon" />
                            </div>
                        @endif
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
                            <img src="{{ asset('images/star-icon.png') }}" alt="star-icon" />
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
