@extends('layouts.app')
@section('content')

<div class="main-container" style="margin-top: 0">
    <div class="main-heading">
      <h1>Settings</h1>
    </div>
    <div class="settings-container">
      <div class="projects-dropdown dropdown">
        <div class="dropdown-box">
          Select the Project <i class="fa fa-chevron-down"></i>
        </div>
        <div class="submenu project-submenu">
          <div class="submenu-item active">
            Muzej Velenje <i class="fa fa-check"></i>
          </div>
          <div class="submenu-item">
            Festival Velenje <i class="fa fa-check"></i>
          </div>
          <div class="submenu-item">
            Third Project <i class="fa fa-check"></i>
          </div>
          <div class="submenu-item">
            Fourth Project <i class="fa fa-check"></i>
          </div>
        </div>
      </div>

      <div class="input-sections">
        <div class="colors-radio-box radio-box">
          <input type="radio" name="colors-radio" id="colors-radio" />
          <label for="colors-radio">Colours</label>
        </div>
        <div class="colors-input-boxes">
          <div class="colors-input-box" onclick="inputClick('color-input-1')">
            <input
              type="color"
              id="color-input-1"
              onchange="changeBoxColor('color-input-1', 'color-box-1', 'color-code-1')"
            />
            <div
              class="color-box"
              id="color-box-1"
              style="background: #0090ff"
            ></div>
            <div class="color-code" id="color-code-1">#0090FF</div>
          </div>
          <div class="colors-input-box" onclick="inputClick('color-input-2')">
            <input
              type="color"
              id="color-input-2"
              onchange="changeBoxColor('color-input-2', 'color-box-2', 'color-code-2')"
            />
            <div
              id="color-box-2"
              class="color-box"
              style="background: #0090ff"
            ></div>
            <div id="color-code-2" class="color-code">#0090FF</div>
          </div>
          <div class="colors-input-box" onclick="inputClick('color-input-3')">
            <input
              type="color"
              id="color-input-3"
              onchange="changeBoxColor('color-input-3', 'color-box-3', 'color-code-3')"
            />
            <div
              id="color-box-3"
              class="color-box"
              style="background: #0090ff"
            ></div>
            <div id="color-code-3" class="color-code">#0090FF</div>
          </div>
          <div class="colors-input-box" onclick="inputClick('color-input-4')">
            <input
              type="color"
              id="color-input-4"
              onchange="changeBoxColor('color-input-4', 'color-box-4' , 'color-code-4')"
            />
            <div
              id="color-box-4"
              class="color-box"
              style="background: #0090ff"
            ></div>
            <div id="color-code-4" class="color-code">#0090FF</div>
          </div>
          <div class="colors-input-box" onclick="inputClick('color-input-5')">
            <input
              type="color"
              id="color-input-5"
              onchange="changeBoxColor('color-input-5', 'color-box-5', 'color-code-5')"
            />
            <div
              id="color-box-5"
              class="color-box"
              style="background: #0090ff"
            ></div>
            <div id="color-code-5" class="color-code">#0090FF</div>
          </div>
        </div>
      </div>
      <div class="input-sections">
        <div class="logo-radio-box radio-box">
          <input type="radio" name="logo-radio" id="logo-radio" />
          <label for="logo-radio">Logo</label>
        </div>
        <div class="input-boxes">
          <div class="input-box" onclick="inputClick('file-input-1')">
            <input type="file" id="file-input-1" />
            <div class="upload-icon">
              <img src="images/upload-icon.png" alt="upload-icon" />
            </div>
            <div>Upload some files</div>
          </div>
        </div>
      </div>
      <div class="input-sections">
        <div class="design-radio-box radio-box">
          <input type="radio" name="design-radio" id="design-radio" />
          <label for="design-radio">Desgin</label>
        </div>
        <div class="input-boxes">
          <div class="input-box" onclick="inputClick('file-input-2')">
            <input type="file" id="file-input-2" />
            <div class="upload-icon">
              <img src="images/upload-icon.png" alt="upload-icon" />
            </div>
            <div>Splash screen</div>
          </div>
        </div>
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
  </script>

@endpush
