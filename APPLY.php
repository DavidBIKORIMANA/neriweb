<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Learner Application Form - GS ST PHILIPPE NERI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #007bff;
            --dark-blue: #2c3e50;
            --light-blue: #e6f0ff;
            --text-color: #34495e;
            --border-color: #ced4da;
            --input-bg: #fdfdfd;
            --card-bg: #ffffff;
            --shadow-light: 0 5px 20px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        body {
            background: var(--light-blue);
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Align to top for scrolling */
            min-height: 100vh;
        }

        .application-form-container {
            width: 100%;
            max-width: 900px; /* Increased max-width for 'medium big' */
            margin: 20px auto;
            background: var(--card-bg);
            padding: 40px 60px; /* Increased padding */
            border-radius: 20px; /* More rounded corners */
            box-shadow: var(--shadow-light);
        }

        h2.form-title {
            text-align: center;
            color: var(--dark-blue);
            margin-bottom: 30px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 2.5rem; /* Slightly larger title */
            position: relative;
            padding-bottom: 10px;
        }
        h2.form-title::after {
            content: '';
            width: 80px;
            height: 4px;
            background-color: var(--primary-blue);
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            border-radius: 2px;
        }

        h3.section-title {
            text-align: center;
            color: var(--dark-blue);
            margin-top: 35px;
            margin-bottom: 25px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 1.8rem; /* Slightly larger section title */
            position: relative;
            padding-bottom: 8px;
        }
        h3.section-title::after {
            content: '';
            width: 60px;
            height: 3px;
            background-color: var(--primary-blue);
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 0;
            border-radius: 2px;
        }

        fieldset {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 25px 30px;
            margin-bottom: 30px;
            background-color: #f8faff; /* Light background for fieldsets */
        }

        legend {
            float: none; /* Reset float */
            width: auto; /* Reset width */
            padding: 0 15px;
            font-size: 1.35rem; /* Slightly larger legend */
            font-weight: 600;
            color: var(--primary-blue);
            text-align: center;
            margin-bottom: 20px;
            border-bottom: none; /* Remove default border */
        }

        .form-label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 8px;
            display: inline-block; /* For proper spacing */
            font-size: 1.05rem; /* Slightly larger labels */
        }

        .form-control, .form-select, .form-control-file {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 18px; /* Increased padding for inputs */
            font-size: 1.05rem; /* Slightly larger input text */
            background-color: var(--input-bg);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus, .form-select:focus, .form-control-file:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px; /* Slightly taller text areas */
        }

        /* Custom style for file input */
        .custom-file-input {
            position: relative;
            overflow: hidden;
            height: calc(2.5rem + 10px); /* Adjust height to match other inputs */
            cursor: pointer;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--input-bg);
            display: flex;
            align-items: center;
            padding: 0 18px; /* Increased padding */
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .custom-file-input:hover {
             border-color: var(--primary-blue);
        }

        .custom-file-input input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .custom-file-input .file-name {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            flex-grow: 1;
            color: #6c757d;
            font-size: 1.05rem; /* Match input font size */
        }

        .custom-file-input .file-button {
            background-color: var(--primary-blue);
            color: white;
            padding: 10px 15px; /* Slightly larger button */
            border-radius: 5px;
            margin-left: 10px;
            font-size: 1rem;
        }


        .form-check-input {
            margin-top: 0.3rem; /* Align checkbox with label text */
        }
        .form-check-label {
            margin-left: 0.5rem;
            color: var(--text-color);
        }

        .btn-submit {
            display: block;
            width: 100%;
            margin-top: 40px; /* More space above button */
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 18px 25px; /* Larger button padding */
            font-size: 1.25rem; /* Larger button text */
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-submit:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        iframe {
            margin-top: 15px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .file-upload-info {
            font-size: 0.85em;
            color: #777;
            margin-top: 8px;
            display: block;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) { /* Adjust for medium screens */
            .application-form-container {
                max-width: 750px;
                padding: 35px 45px;
            }
            h2.form-title {
                font-size: 2.2rem;
            }
            h3.section-title {
                font-size: 1.6rem;
            }
            legend {
                font-size: 1.2rem;
            }
            .form-control, .form-select, .custom-file-input {
                padding: 10px 15px;
                font-size: 1rem;
            }
            textarea.form-control {
                min-height: 90px;
            }
            .btn-submit {
                padding: 15px 20px;
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            .application-form-container {
                padding: 25px 25px;
                margin: 15px auto;
            }
            h2.form-title {
                font-size: 1.8rem;
            }
            h3.section-title {
                font-size: 1.4rem;
            }
            fieldset {
                padding: 20px 20px;
            }
            .btn-submit {
                padding: 12px 15px;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .application-form-container {
                padding: 20px 20px;
            }
            h2.form-title {
                font-size: 1.6rem;
            }
            h3.section-title {
                font-size: 1.2rem;
            }
            .form-label {
                font-size: 0.95rem;
            }
            .form-control, .form-select {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
            .custom-file-input {
                height: calc(2rem + 8px);
                padding: 0 12px;
            }
            .custom-file-input .file-button {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
            legend {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>

<div class="application-form-container">
    <form action="submit_form.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <h2 class="form-title"><i class="fas fa-user-graduate me-3"></i> Learner Application Form</h2>

        <fieldset>
            <legend>Personal Information</legend>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="fullname" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter your full name" required>
                    <div class="invalid-feedback">Please provide your full name.</div>
                </div>

                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender:</label>
                    <select class="form-select" name="gender" id="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div class="invalid-feedback">Please select your gender.</div>
                </div>

                <div class="col-md-6">
                    <label for="birthday" class="form-label">Date of Birth:</label>
                    <input type="date" class="form-control" name="birthday" id="birthday" min="1990-01-01" max="<?php echo date('Y-m-d'); ?>" required>
                    <div class="invalid-feedback">Please provide a valid date of birth (after 1990 and not in the future).</div>
                </div>

                <div class="col-md-12">
                    <label for="parent_phone" class="form-label">Parent's Phone Number:</label>
                    <input type="tel" class="form-control" name="parent_phone" id="parent_phone" placeholder="e.g., +25078XXXXXXXX" pattern="^\+2507[0-9]{8}$" required>
                    <div class="form-text text-muted">Format: +25078XXXXXXXX (12 digits including +250)</div>
                    <div class="invalid-feedback">Please provide a valid Rwandan phone number (e.g., +25078XXXXXXX).</div>
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="whatsapp" id="whatsapp">
                        <label class="form-check-label" for="whatsapp">This number is on WhatsApp</label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Address Information</legend>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="province" class="form-label">Province:</label>
                    <select class="form-select" name="province" id="province" required>
                        <option value="">Select Province</option>
                        <option value="Kigali">Kigali City</option>
                        <option value="Northern">Northern Province</option>
                        <option value="Southern">Southern Province</option>
                        <option value="Western">Western Province</option>
                        <option value="Eastern">Eastern Province</option>
                    </select>
                    <div class="invalid-feedback">Please select your province.</div>
                </div>
                <div class="col-md-4">
                    <label for="district" class="form-label">District:</label>
                    <input type="text" class="form-control" name="district" id="district" placeholder="Enter your district" required>
                    <div class="invalid-feedback">Please provide your district.</div>
                </div>
                <div class="col-md-4">
                    <label for="sector" class="form-label">Sector:</label>
                    <input type="text" class="form-control" name="sector" id="sector" placeholder="Enter your sector" required>
                    <div class="invalid-feedback">Please provide your sector.</div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Academic Background & Preferences</legend>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="prev_school" class="form-label">Previous School:</label>
                    <input type="text" class="form-control" name="prev_school" id="prev_school" placeholder="Enter your previous school's name" required>
                    <div class="invalid-feedback">Please provide your previous school's name.</div>
                </div>

                <div class="col-md-12">
                    <label for="school_background" class="form-label">Tell us about your school background:</label>
                    <textarea class="form-control" name="school_background" id="school_background" rows="4" placeholder="Describe your academic history, achievements, and experiences" required></textarea>
                    <div class="invalid-feedback">Please provide details about your school background.</div>
                </div>

                <div class="col-md-12">
                    <label for="sports" class="form-label">Which sport(s) have you participated in? (Optional)</label>
                    <input type="text" class="form-control" name="sports" id="sports" placeholder="e.g., Football, Basketball, Athletics, None">
                </div>

                <div class="col-md-12">
                    <label for="target_class" class="form-label">Which class do you want to study in?</label>
                    <select class="form-select" name="target_class" id="target_class" required>
                        <option value="">Select Class</option>
                        <option value="Senior 1">Senior 1</option>
                        <option value="Senior 2">Senior 2</option>
                        <option value="Senior 3">Senior 3</option>
                        <option value="Senior 4">Senior 4</option>
                        <option value="Senior 5">Senior 5</option>
                        <option value="Senior 6">Senior 6</option>
                    </select>
                    <div class="invalid-feedback">Please select your target class.</div>
                </div>

                <div class="col-md-12" id="combination-group" style="display: none;">
                    <label for="combination" class="form-label">Choose your combination:</label>
                    <select class="form-select" name="combination" id="combination">
                        <option value="">Select Combination</option>
                        <option value="MCB">MCB - Mathematics Chemistry Biology</option>
                        <option value="PCB">PCB - Physics Chemistry Biology</option>
                        <option value="PCM">PCM - Physics Chemistry Mathematics</option>
                        <option value="MPG">MPG - Mathematics Physics Geography</option>
                        </select>
                    <div class="invalid-feedback">Please select your combination.</div>
                </div>

                <div class="col-md-12">
                    <label for="school_report" class="form-label">Upload your School Report (PDF/Word):</label>
                    <div class="custom-file-input">
                        <span id="file-name" class="file-name">No file chosen</span>
                        <span class="file-button">Browse</span>
                        <input type="file" name="school_report" id="school_report" accept=".pdf,.doc,.docx" required>
                    </div>
                    <span class="file-upload-info">Allowed file types: PDF, DOC, DOCX. Max size: 5MB (example)</span>
                    <div class="invalid-feedback">Please upload your school report.</div>
                    <iframe id="filePreview" width="100%" height="300px" style="display:none;"></iframe>
                </div>
            </div>
        </fieldset>

        <h3 class="section-title"><i class="fas fa-lightbulb me-2"></i> Critical Thinking Questions</h3>

        <fieldset>
            <legend>Community & Leadership</legend>
            <div class="mb-3">
                <label for="question1" class="form-label">1. If you are given 10,000 RWF to help your community, what would you do and why?</label>
                <textarea class="form-control" name="question1" id="question1" rows="4" required></textarea>
                <div class="invalid-feedback">Please answer this question.</div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Initiative & Problem Solving</legend>
            <div class="mb-3">
                <label for="question2" class="form-label">2. Imagine your class has no teacher for one week. How would you help your classmates learn?</label>
                <textarea class="form-control" name="question2" id="question2" rows="4" required></textarea>
                <div class="invalid-feedback">Please answer this question.</div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Integrity & Ethics</legend>
            <div class="mb-3">
                <label for="question3" class="form-label">3. You see a friend cheating during a test. What do you do and why?</label>
                <textarea class="form-control" name="question3" id="question3" rows="4" required></textarea>
                <div class="invalid-feedback">Please answer this question.</div>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-submit">Submit Application <i class="fas fa-paper-plane ms-2"></i></button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- File Preview Logic ---
        const fileInput = document.getElementById('school_report');
        const filePreview = document.getElementById('filePreview');
        const fileNameSpan = document.getElementById('file-name');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                fileNameSpan.textContent = file.name;
                if (file.type === "application/pdf") {
                    const reader = new FileReader();
                    reader.onloadend = function () {
                        filePreview.src = reader.result;
                        filePreview.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                } else {
                    // For non-PDF files, just show the name, hide iframe
                    filePreview.style.display = "none";
                    filePreview.src = ""; // Clear src
                }
            } else {
                fileNameSpan.textContent = "No file chosen";
                filePreview.style.display = "none";
                filePreview.src = "";
            }
        });

        // --- Conditional Combination Field Logic ---
        const targetClassSelect = document.getElementById('target_class');
        const combinationGroup = document.getElementById('combination-group');
        const combinationSelect = document.getElementById('combination');

        function toggleCombinationField() {
            const selectedClass = targetClassSelect.value;
            // Combinations are typically for Senior 4, 5, 6 (A-Level equivalent)
            if (['Senior 4', 'Senior 5', 'Senior 6'].includes(selectedClass)) {
                combinationGroup.style.display = 'block';
                combinationSelect.setAttribute('required', 'required');
            } else {
                combinationGroup.style.display = 'none';
                combinationSelect.removeAttribute('required');
                combinationSelect.value = ""; // Clear selection when hidden
            }
        }

        // Initial check on page load
        toggleCombinationField();
        // Listen for changes
        targetClassSelect.addEventListener('change', toggleCombinationField);

        // --- Bootstrap Client-Side Validation ---
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });
</script>

</body>
</html>