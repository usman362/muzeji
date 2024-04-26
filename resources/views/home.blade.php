@extends('layouts.app')

@section('content')

<div class="main-banner main-banner-1">
    <div class="banner-image">
      <img src="{{asset('images/home-1.png')}}" alt="banner-1" />
    </div>
    <div class="banner-section">
      <div class="text-box">
        <div class="banner-number"><p>01</p></div>
        <div class="banner-text">
          Velenjski grad, Muzej usnjarstva, F-Bunker, Hiša mineralov ...
        </div>
      </div>
      <div class="heading-box">
        <div class="banner-heading">MUZEJ VELENJE</div>
        <a href="#" class="redirect-button">
          <img src="{{asset('images/arrow-right-long.png')}}" alt="right-arrow" />
        </a>
      </div>
    </div>
  </div>
  <div class="main-banner main-banner-2">
    <div class="banner-image">
      <img src="{{asset('images/home-2.png')}}" alt="banner-1" />
    </div>
    <div class="banner-section">
      <div class="text-box">
        <div class="banner-number"><p>02</p></div>
        <div class="banner-text">
          Festival Velenje, Galerija Velenje, Kino Velenje, Pikin Festival
        </div>
      </div>
      <div class="heading-box">
        <div class="banner-heading">FESTIVAL VELENJE</div>
        <a href="#" class="redirect-button">
          <img src="{{asset('images/arrow-right-long.png')}}" alt="right-arrow" />
        </a>
      </div>
    </div>
  </div>
  <div class="text-center">
    <button class="add-button" onclick="toggleModal()">
      <i class="fa fa-plus"></i>
    </button>
  </div>

  <div class="add-modal" id="add-modal">
    <div class="backdrop"></div>
    <div class="modal-box">
      <i class="fa fa-close close-button" onclick="toggleModal()"></i>
      <div class="modal-inputs">
        <div class="file-input">
          <div
            class="custom-file-input"
            id="customFileInput"
            onclick="fileInputClick('fileInput')"
          >
            <div class="upload-icon">
              <img src="{{asset('images/upload-icon.png')}}" alt="file-icon" />
            </div>
            <div class="selected-file" id="selectedFile">Upload Logo</div>
          </div>
          <input type="file" id="fileInput" onchange="showFileName()" />
          <div class=""></div>
        </div>
        <div class="text-input">
          <input type="email" placeholder="Email of user" />
        </div>
        <div class="colors-input">
          <label>Choose colors</label>
          <input
            type="color"
            id="backgroundColor"
            onchange="changeBoxColor('backgroundColor', 'backgroundColorBox')"
          />
          <div class="colorBox" onclick="fileInputClick('backgroundColor')">
            <div
              id="backgroundColorBox"
              style="
                background-color: rgba(26, 213, 152, 1);
                width: 15px;
                height: 15px;
                flex-shrink: 0;
                border-radius: 3px;
              "
            ></div>
            <div>background</div>
          </div>
          <input
            type="color"
            id="headerColor"
            onchange="changeBoxColor('headerColor', 'headerColorBox')"
          />
          <div class="colorBox" onclick="fileInputClick('headerColor')">
            <div
              id="headerColorBox"
              style="
                background-color: rgba(234, 58, 61, 1);
                width: 15px;
                height: 15px;
                flex-shrink: 0;
                border-radius: 3px;
              "
            ></div>
            <div>header</div>
          </div>
        </div>
        <div class="text-input">
          <input type="text" placeholder="COMPANY NAME" />
        </div>
      </div>
      <div class="modal-button">
        <button class="submit-button">ADD</button>
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
      document.getElementById("add-modal").classList.toggle("show");
    }
  </script>
@endpush
