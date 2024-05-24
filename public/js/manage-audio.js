// audio recorder
let recorder, audio_stream;
// const recordButton = document.getElementById("recordButton");
// recordButton.addEventListener("click", startRecording);

// stop recording
// const stopButton = document.getElementById("stopButton");
// stopButton.addEventListener("click", stopRecording);

// set preview
// const preview = document.getElementById("audio-playback");
$('.project-details').on('click','.clearButton',function(){
    let id = $(this).attr('data-id');
    $('#audio-playback'+id).addClass('d-none');
    $('#audio-playback'+id).attr('src','');
    $('.playback').find(`[name="audio_path${id}[]"]`).remove();
});

$('.project-details').on('click','.recordButton',function(){
    // button settings
    let id = $(this).attr('data-id');
    let recordButton = $('#recordButton'+id);
    let stopButton = $('#stopButton'+id);
    let preview = $("#audio-playback"+id);
    recordButton.disabled = true;
    $("#recordButton"+id).addClass("d-none");
    stopButton.disabled = false;
    $("#stopButton"+id).removeClass("d-none");
    $("#stopButton"+id).css("border","2px solid red");
    $('#clearButton'+id).addClass('d-none');

    if (!$("#audio-playback"+id).hasClass("d-none")) {
        $("#audio-playback"+id).addClass("d-none")
    };

    navigator.mediaDevices.getUserMedia({ audio: true })
        .then(function (stream) {
            audio_stream = stream;
            recorder = new MediaRecorder(stream);

            // when there is data, compile into object for preview src
            recorder.ondataavailable = function (e) {
                const url = URL.createObjectURL(e.data);
                $("#audio-playback"+id).attr('src',url);

                // Send audio to server
                sendAudioToServer(e.data,id);
            };
            recorder.start();

            timeout_status = setTimeout(function () {
                console.log("5 min timeout");
                stopRecording();
            }, 300000);
        });
})

$('.project-details').on('click','.stopButton',function(){
    let id = $(this).attr('data-id');
    let recordButton = $('#recordButton'+id);
    let stopButton = $('#stopButton'+id);

    stopButton.disabled = true;
    recorder.stop();
    audio_stream.getAudioTracks()[0].stop();

    // buttons reset
    recordButton.disabled = false;
    $("#recordButton"+id).removeClass("d-none");

    $("#stopButton"+id).addClass("d-none");
    stopButton.disabled = true;

    $("#audio-playback"+id).removeClass("d-none");
    $('#clearButton'+id).removeClass('d-none');
})

function sendAudioToServer(audioBlob,id) {
    const formData = new FormData();
    formData.append('audio', audioBlob, 'recording.wav'); // Change the file name to .wav

    fetch('/upload-audio', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(response => response.json())
      .then(data => $('#playback'+id).append(`<input type="hidden" name="audio_path${id}[]" value="${data.path}"/>`))
      .catch(error => console.error('Error:', error));
}

// function downloadRecording(){
//     var name = new Date();
//     var res = name.toISOString().slice(0,10)
//     downloadAudio.download = res + '.wav';
// }

// function previewImages(event) {
//     const input = event.target;
//     const imagePreviewContainer = document.getElementById('imagePreviewContainer');
//     imagePreviewContainer.innerHTML = ''; // Clear previous previews

//     if (input.files && input.files.length > 0) {
//         for (let i = 0; i < input.files.length; i++) {
//             const reader = new FileReader();
//             reader.onload = function(e) {
//                 const imagePreview = document.createElement('img');
//                 imagePreview.src = e.target.result;
//                 imagePreview.style.maxWidth = '200px';
//                 imagePreview.style.maxHeight = '200px';
//                 imagePreviewContainer.appendChild(imagePreview);
//             }
//             reader.readAsDataURL(input.files[i]);
//         }
//     }
// }
