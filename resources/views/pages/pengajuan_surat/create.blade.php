@extends('template.layout')
@section('title', 'Pengajuan Surat | ' . config('app.name'))
@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="relative">
            <!-- Bagian gambar -->
            <div class="h-150 md:h-1auto overflow-hidden">
                <img src="{{ asset('images/bg-kop-pengajuan-surat-01.png') }}" alt=""
                    class="w-full h-full object-cover">
            </div>

            <!-- Bagian teks judul dan form -->
            <div class="absolute top-30 left-0 right-0 flex flex-col px-4 items-center justify-center pt-4 md:pt-10">
                <h1 class="text-center text-3xl md:text-4xl text-white font-medium mb-4">
                    Layanan Pengajuan {{ $suratType->nama_surat ?? 'Surat Administrasi' }} Online
                </h1>

                <!-- Garis horizontal -->
                <div class="flex justify-center w-full max-w-md px-8">
                    <div class="h-1 md:h-1.5 w-1/2 bg-white rounded"></div>
                    <div class="h-1 md:h-1.5 w-1/6 bg-white rounded mx-4"></div>
                </div>
            </div>
        </div>

        <!-- Form pengajuan surat -->
        <div class="relative container max-w-4xl mx-auto px-4 py-12 md:py-8 -mt-80 md:-mt-80">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <form action="{{ route('surat.store') }}" method="POST" id="form_pengajuan_surat"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="flex flex-col gap-4 mb-4">
                        <label for="jenis_surat" class="text-sm font-semibold">Jenis Surat</label>
                        <select id="jenis_surat" name="jenis_surat" class="border border-gray-300 rounded-md p-2" required>
                            <option value="" disabled selected>Pilih Jenis Surat</option>
                            @foreach ($suratSubTypes as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->nama_sub_surat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Data Pemohon -->
                    <div id="data_pemohon_section" class="mb-6 mt-6 hidden">
                        <h5 class="text-sky-800 mt-6 mb-4 text-sm font-semibold">
                            Data Pemohon <span id="jenis_surat_name"></span>
                        </h5>
                        <div id="data_pemohon_fields" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nama_lengkap_pemohon" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Lengkap
                                    *</label>
                                <input type="text" id="nama_lengkap_pemohon" name="nama_lengkap_pemohon"
                                    class="w-full border border-gray-300 rounded-md p-2" required>
                            </div>
                            <div>
                                <label for="nik_pemohon" class="block text-sm font-medium text-gray-700 mb-1">NIK *</label>
                                <input type="number" id="nik_pemohon" name="nik_pemohon"
                                    class="w-full border border-gray-300 rounded-md p-2" required>
                            </div>
                            <div>
                                <label for="tempat_lahir_pemohon"
                                    class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir
                                    *</label>
                                <input type="text" id="tempat_lahir_pemohon" name="tempat_lahir_pemohon"
                                    class="w-full border border-gray-300 rounded-md p-2" required>
                            </div>
                            <div>
                                <label for="tgl_lahir_pemohon" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                    Lahir *</label>
                                <input type="date" id="tgl_lahir_pemohon" name="tgl_lahir_pemohon"
                                    class="w-full border border-gray-300 rounded-md p-2" required>
                            </div>
                            <div>
                                <label for="jenis_kelamin_pemohon"
                                    class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                    Kelamin *</label>
                                <select id="jenis_kelamin_pemohon" name="jenis_kelamin_pemohon"
                                    class="w-full border border-gray-300 rounded-md p-2" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label for="alamat_pemohon" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                    *</label>
                                <textarea id="alamat_pemohon" name="alamat_pemohon" rows="2" class="w-full border border-gray-300 rounded-md p-2"
                                    required></textarea>
                            </div>
                            <div>
                                <label for="agama_pemohon" class="block text-sm font-medium text-gray-700 mb-1">Agama
                                    *</label>
                                <select id="agama_pemohon" name="agama_pemohon"
                                    class="w-full border border-gray-300 rounded-md p-2" required>
                                    <option value="" disabled selected>Pilih Agama</option>
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="katolik">Katolik</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="buddha">Buddha</option>
                                    <option value="konghucu">Konghucu</option>
                                </select>
                            </div>
                            <div>
                                <label for="pekerjaan_pemohon"
                                    class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan
                                    *</label>
                                <input type="text" id="pekerjaan_pemohon" name="pekerjaan_pemohon"
                                    class="w-full border border-gray-300 rounded-md p-2" required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="keperluan_pemohon"
                                    class="block text-sm font-medium text-gray-700 mb-1">Keperluan</label>
                                <textarea id="keperluan_pemohon" name="keperluan_pemohon" rows="2"
                                    class="w-full border border-gray-300 rounded-md p-2" required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Isi Surat - akan diisi secara dinamis -->
                    <div id="isi_surat_section" class="mb-6 mt-6 hidden">
                        <h5 class="text-sky-800 mt-6 mb-4 text-sm font-semibold">
                            Isi <span id="jenis_surat_name_2"></span>
                        </h5>
                        <div id="isi_surat_fields" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Fields will be loaded here dynamically -->
                        </div>
                    </div>

                    <!-- Tombol kirim -->
                    <div class="flex justify-end">
                        <button type="submit" id="submit_button"
                            class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors hidden">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisSuratSelect = document.getElementById('jenis_surat');
            const dataPemohonSection = document.getElementById('data_pemohon_section');
            const isiSuratSection = document.getElementById('isi_surat_section');
            const dataPemohonFields = document.getElementById('data_pemohon_fields');
            const isiSuratFields = document.getElementById('isi_surat_fields');
            const jenisSuratName = document.getElementById('jenis_surat_name');
            const jenisSuratName2 = document.getElementById('jenis_surat_name_2');
            const submitButton = document.getElementById('submit_button');
            const formPengajuanSurat = document.getElementById('form_pengajuan_surat');

            // Data statis untuk data pemohon (selalu sama)
            // Function to fetch isi surat fields based on selected jenis surat
            function loadIsiSuratFields(suratTypeId) {
                fetch(`/surat/${suratTypeId}/fields`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Update form with the received data
                        if (data.success) {
                            const formData = data.data;

                            // Set the surat name in the section headings
                            if (formData.nama_surat) {
                                jenisSuratName.textContent = formData.nama_surat;
                                jenisSuratName2.textContent = formData.nama_surat;
                            }

                            // Handle isi surat fields
                            if (formData.fields && formData.fields.length > 0) {
                                createFormFields(isiSuratFields, formData.fields);
                                isiSuratSection.classList.remove('hidden');
                            } else {
                                isiSuratSection.classList.add('hidden');
                            }

                            // Show the submit button
                            submitButton.classList.remove('hidden');
                        } else {
                            // Handle error response
                            console.error('Error loading form data:', data.message);
                            alert('Gagal memuat data formulir: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching form data:', error);
                        alert('Terjadi kesalahan saat memuat data formulir. Silakan coba lagi.');
                    });
            }

            // Function to create form fields based on field definitions
            function createFormFields(container, fields) {
                // Clear existing fields
                container.innerHTML = '';

                // Create fields based on the received data
                fields.forEach(field => {
                    const fieldDiv = document.createElement('div');
                    fieldDiv.className = 'mb-4';

                    // Create label
                    const label = document.createElement('label');
                    label.setAttribute('for', field.name);
                    label.className = 'block text-sm font-medium text-gray-700 mb-1';
                    label.textContent = field.label + (field.required ? ' *' : '');

                    // Create input element based on field type
                    let inputElement;

                    switch (field.type) {
                        case 'text':
                        case 'email':
                        case 'number':
                        case 'date':
                        case 'tel':
                            inputElement = document.createElement('input');
                            inputElement.type = field.type;
                            inputElement.className = 'w-full border border-gray-300 rounded-md p-2';
                            break;

                        case 'textarea':
                            inputElement = document.createElement('textarea');
                            inputElement.rows = 3;
                            inputElement.className = 'w-full border border-gray-300 rounded-md p-2';
                            break;

                        case 'select':
                            inputElement = document.createElement('select');
                            inputElement.className = 'w-full border border-gray-300 rounded-md p-2';

                            // Add default empty option
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.textContent = `-- Pilih ${field.label} --`;
                            defaultOption.selected = true;
                            defaultOption.disabled = field.required;
                            inputElement.appendChild(defaultOption);

                            // Add options
                            if (field.options && Array.isArray(field.options)) {
                                field.options.forEach(option => {
                                    const optionElement = document.createElement('option');
                                    optionElement.value = option.value;
                                    optionElement.textContent = option.label;
                                    inputElement.appendChild(optionElement);
                                });
                            }
                            break;

                        case 'radio':
                        case 'checkbox':
                            inputElement = document.createElement('div');
                            inputElement.className = 'mt-1 space-y-2';

                            if (field.options && Array.isArray(field.options)) {
                                field.options.forEach((option, index) => {
                                    const wrapper = document.createElement('div');
                                    wrapper.className = 'flex items-center';

                                    const input = document.createElement('input');
                                    input.type = field.type;
                                    input.id = `${field.name}_${index}`;
                                    input.name = field.type === 'radio' ? field.name :
                                        `${field.name}[]`;
                                    input.value = option.value;
                                    input.className = 'mr-2';
                                    if (field.required && index === 0 && field.type === 'radio') {
                                        input.required = true;
                                    }

                                    const optionLabel = document.createElement('label');
                                    optionLabel.setAttribute('for', `${field.name}_${index}`);
                                    optionLabel.textContent = option.label;

                                    wrapper.appendChild(input);
                                    wrapper.appendChild(optionLabel);
                                    inputElement.appendChild(wrapper);
                                });
                            }
                            break;

                        case 'file':
                            inputElement = document.createElement('input');
                            inputElement.type = 'file';
                            inputElement.className = 'w-full border border-gray-300 rounded-md p-2';
                            if (field.accept) {
                                inputElement.accept = field.accept;
                            }
                            break;

                        default:
                            inputElement = document.createElement('input');
                            inputElement.type = 'text';
                            inputElement.className = 'w-full border border-gray-300 rounded-md p-2';
                    }

                    // Set common input attributes
                    if (inputElement.tagName !== 'DIV') {
                        inputElement.id = field.name;
                        inputElement.name = field.name;

                        if (field.placeholder) {
                            inputElement.placeholder = field.placeholder;
                        }

                        if (field.required) {
                            inputElement.required = true;
                        }

                        if (field.value) {
                            inputElement.value = field.value;
                        }

                        if (field.disabled) {
                            inputElement.disabled = true;
                        }

                        if (field.min !== undefined && (field.type === 'number' || field.type === 'date')) {
                            inputElement.min = field.min;
                        }

                        if (field.max !== undefined && (field.type === 'number' || field.type === 'date')) {
                            inputElement.max = field.max;
                        }
                    }

                    // Add help text if provided
                    let helpText = null;
                    if (field.help_text) {
                        helpText = document.createElement('p');
                        helpText.className = 'text-sm text-gray-500 mt-1';
                        helpText.textContent = field.help_text;
                    }

                    // Add elements to field div
                    fieldDiv.appendChild(label);
                    fieldDiv.appendChild(inputElement);
                    if (helpText) {
                        fieldDiv.appendChild(helpText);
                    }

                    // Add field to container
                    container.appendChild(fieldDiv);
                });
            }

            // Add event listener to jenis surat select
            if (jenisSuratSelect) {
                jenisSuratSelect.addEventListener('change', function() {
                    const selectedValue = this.value;

                    // console.log('Selected Jenis Surat ID:', selectedValue);

                    if (selectedValue) {
                        // Load isi surat fields for selected surat type
                        dataPemohonSection.classList.remove('hidden');
                        loadIsiSuratFields(selectedValue);
                    } else {
                        // Hide sections if no type is selected
                        isiSuratSection.classList.add('hidden');
                        submitButton.classList.add('hidden');
                    }
                });

                // Load form data if jenis surat is already selected (e.g., on edit page)
                if (jenisSuratSelect.value) {
                    // Load isi surat fields for selected surat type
                    loadIsiSuratFields(jenisSuratSelect.value);
                }
            }

            // // Handle form submission
            // if (formPengajuanSurat) {
            //     formPengajuanSurat.addEventListener('submit', function(event) {
            //         event.preventDefault();

            //         // Ensure all dynamically added fields are part of the form
            //         const formData = new FormData(formPengajuanSurat);

            //         // Disable submit button to prevent multiple submissions
            //         submitButton.disabled = true;
            //         submitButton.textContent = 'Mengirim...';

            //         // Submit form using fetch API
            //         fetch(this.action, {
            //                 method: 'POST',
            //                 body: formData,
            //                 headers: {
            //                     'X-Requested-With': 'XMLHttpRequest' // Indicate AJAX request
            //                 }
            //             })
            //             .then(response => {
            //                 if (!response.ok) {
            //                     throw new Error('Network response was not ok');
            //                 }
            //                 return response.json();
            //             })
            //             .then(data => {
            //                 if (data.success) {
            //                     window.location.href = "{{ route('surat.success') }}";
            //                 } else {
            //                     notification('Gagal', data.message, 'error');
            //                 }
            //             })
            //             .catch(error => {
            //                 console.error('Error submitting form:', error);
            //                 notification('Gagal',
            //                     'Terjadi kesalahan saat mengirim pengajuan. Silakan coba lagi.',
            //                     'error');
            //             })
            //             .finally(() => {
            //                 // Re-enable submit button
            //                 submitButton.disabled = false;
            //                 submitButton.textContent = 'Kirim Pengajuan';
            //             });
            //     });
            // }

            // function notification(title, message, icon) {
            //     Swal.fire({
            //         title: `${title}`,
            //         text: `${message}`,
            //         icon: `${icon}`,
            //     });
            // }
        });
    </script>
@endsection
