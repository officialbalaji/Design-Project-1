<?php 
    session_start();
    if(!isset($_SESSION["forms"])||($_SESSION["forms"]==="")){
        echo "<script> window.location.href='index.php'</script>";
    }
?>
<!DOCTYPE html><!--working form-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passport Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
        }
        h2 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .radio-group {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        .radio-group label {
            margin: 0;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #007bff;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .closer{
            position: absolute;
            margin-top: 7px;
            margin-left: 820px;
            font-size: 50px;
            box-sizing: 30px;
            width: 60px;
            text-align: center;
            color:black;
            border: 3px solid red;
            border-radius: 10px;

        }
        .closer:hover{
            border: 3px solid black;
            color: red;
        }

        .invalid {
        border: 2px solid red;
    }
    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: -15px;
        margin-bottom: 10px;
        display: block;
    }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .radio-group {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        .radio-group label {
            margin: 0;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
    <a onclick="closer()" class="closer">&times;</a>
        <h1>Passport Application Form</h1>
        
        <form id="passport-form" action="includes/form_submit.php" method="post">
            <!-- Section 1 -->
            <div class="form-section active" id="section-1">
                <h2>Applicant Details</h2>
                <label>Given Name *</label>
                <input type="text" name="given_name" maxlength="45" required>
                <label>Surname *</label>
                <input type="text" name="surname" maxlength="45" required>
                <label>Gender *</label>
                <div class="radio-group">
                    <label><input type="radio" name="Gender" value="male" required> Male</label>
                    <label><input type="radio" name="Gender" value="female" required> Female</label>
                    <label><input type="radio" name="Gender" value="transgender" required> Transgender</label>
                </div>
                <label>Date of Birth (DD/MM/YYYY) *</label>
                <input type="date" name="dob" required>
                <label>Place of Birth *</label>
                <input type="text" name="birth_place" required>
                <label>Marital Status *</label>
                <select name="marital_status" required>
                    <option value="">Select</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                </select>
            </div>
            

            <!-- Section 2 -->
            <div class="form-section" id="section-2">
                <h2>Present Residential Address</h2>
                <label>Is your present address out of India?</label>
                <div class="radio-group">
                    <label><input type="radio" checked="checked"  name="Address_out_of_India" value="no" onclick="toggleAddressOptions()"> With in India</label>
                    <label><input type="radio" name="Address_out_of_India" value="yes" onclick="toggleAddressOptions()"> Outside India</label>
                </div>
                <div id="state-dropdown">
                    <label for="state">State:</label>
                    <select id="state" name="state_text" onchange="populateDistricts()" required>
                        <option value="">Select State</option>
                    </select>
                </div>
                <div id="district-dropdown">
                    <label for="district">District:</label>
                    <select id="district" name="district_text" required>
                        <option value="">Select District</option>
                    </select>
                </div>
                <div id="state-text" class="hidden">
                    <label for="state_text">State/UT:</label>
                    <input type="text" id="state_text" name="state_text_tu" placeholder="Enter your state">
                </div>
                <div id="district-text" class="hidden">
                    <label for="district_text">District:</label>
                    <input type="text" id="district_text" name="district_text_tu" placeholder="Enter your district">
                </div>
                <label>House No. and Street Name *</label>
                <input type="text" name="house_street" required>
                <label>Village/Town/City *</label>
                <input type="text" name="village_town_city" required>
                <label>Police Station *</label>
                <input type="text" name="police_station" required>
                <label>PIN Code *</label>
                <input type="text" name="pin_code" required>
                <label>Mobile Number *</label>
                <input type="text" name="mobile_number" required>
                <label>Telephone Number</label>
                <input type="text" name="telephone_number" required>

                <input type="hidden" name="email_id" value='<?php echo $_SESSION["email"]; ?>' > <!--Hidden Email*ID-->
                <input type="hidden" name="userName"  value='<?php echo $_SESSION["username"]; ?>' > <!--Hidden User*Name-->

            </div>

            <!-- Section 3 -->
            <div class="form-section" id="section-3">
                <h2>Additional Details</h2>
                <label>Aadhaar Number</label>
                <input type="text" name="aadhaar" required>
                <label>Voter ID Number </label>
                <input type="text" name="voter" required>
                <label>Pan Number </label>
                <input type="text" name="pan" required>               
            </div>

            <!-- Navigation Buttons -->
            <div class="button-group">
                <button type="button" id="prevBtn" onclick="prevStep()"><< Prev</button>
                <button type="button" id="nextBtn" onclick="nextStep()">Next >></button>
            </div>
        </form>
    </div>
<script>

    function closer(){ window.location.href="closer.php"; }

    let currentStep = 0;
    const formSections = document.querySelectorAll('.form-section');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    function showStep(step) {
        formSections.forEach((section, index) => {
            section.classList.toggle('active', index === step);
        });
        prevBtn.style.display = step === 0 ? 'none' : 'inline-block';
        nextBtn.textContent = step === formSections.length - 1 ? 'Submit' : 'Next >>';
    }
    // Navigation functions
    function nextStep() {
        if (validateSection(currentStep)) {
            if (currentStep < formSections.length - 1) {
                currentStep++;
                showStep(currentStep);
            } else {
                validateForm();
            }
        }
    }

    function prevStep() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    function validateField(input) {
    const value = input.value.trim();
    const name = input.name;
    let errorMessage = "";

    // Check for required fields
    if (input.required && !value) {
        errorMessage = "This field is required.";
    } else {
        // Validate specific fields
        switch (name) {
            case "given_name":
            case "surname":
                if (!/^[A-Za-z\s]+$/.test(value)) {
                    errorMessage = "Only Alphabets and spaces are allowed.";
                }
                break;
            case "dob":
                const today = new Date();
                const dob = new Date(value);
                if (dob >= today) {
                    errorMessage = "Date of Birth must be in the past.";
                }
                break;
            case "pin_code":
                if (!/^\d{6}$/.test(value)) {
                    errorMessage = "PIN Code must be exactly 6 digits.";
                }
                break;
            case "email_id":
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    errorMessage = "Enter a valid email address.";
                }
                break;
            case "mobile_number":
                if (!/^\d{10}$/.test(value)) {
                    errorMessage = "Mobile Number must be exactly 10 digits.";
                }
                break;

            case "telephone_number":
                if (!/^[0-9]{10,11}$/.test(value)) {
                    errorMessage = "Telephone Number must be in 10-12";
                }
                break;
            case "aadhaar":
                if (!/^\d{12}$/.test(value)) {
                    errorMessage = "Aadhaar Number must be exactly 12 digits.";
                }
                break;
            case "voter":
                if (value && !/^[A-Z]{3}[0-9]{7}$/.test(value)) {
                    errorMessage = "Enter a Valid Voter ID (e.g., ABC1234567).";
                }
                break;
            case "pan":
                if (value && !/^[A-Z]{5}[0-9]{4}[A-Z]$/.test(value)) {
                    errorMessage = "Enter a Valid PAN number (e.g., ABCDE1234F).";
                }
                break;
        }
    }

    // Display error message
    const errorSpan = input.nextElementSibling;
    if (errorMessage) {
        errorSpan.textContent = errorMessage;
        input.classList.add("invalid");
        return false;
    } else { 
        errorSpan.textContent = "";
        input.classList.remove("invalid");
        return true;
    }
}
function validateRadioButton(name) {
    const radioButtons = document.getElementsByName(name);
    const isChecked = Array.from(radioButtons).some(radio => radio.checked);

    if (!isChecked) {
        alert("Please Fill the following Details!");
        return false;
    }
    return true;
}




function validateSection(step) {
    const section = formSections[step];
    const inputs = section.querySelectorAll('input, select');
    let isValid = true;

    // Track already validated radio groups
    const validatedRadioGroups = new Set();

    inputs.forEach(input => {
        if (input.type === "radio") {
            if (!validatedRadioGroups.has(input.name)) {
                if (!validateRadioButton(input.name)) {
                    isValid = false;
                }
                validatedRadioGroups.add(input.name); // Mark this radio group as validated
            }
        } else {
            if (!validateField(input)) {
                isValid = false;
            }
        }
    });

    return isValid;
}


function validateForm() {
    let isFormValid = true;
    let errorMessages = []; 
    formSections.forEach((section, index) => {
        if (!validateSection(index)) {
            isFormValid = false;
            const sectionErrors = Array.from(section.querySelectorAll(".error-message"))
                .filter(span => span.textContent)
                .map(span => span.textContent);
            errorMessages.push(...sectionErrors);
            
        }
    });

    if (isFormValid) {
        alert("Form submitted successfully!");
        document.getElementById('passport-form').submit();
    } else {
        alert("Please Fill the following Details!");
        }
}

    document.querySelectorAll('input, select').forEach(input => {
        const errorSpan = document.createElement("span");
        errorSpan.className = "error-message";
        input.parentNode.insertBefore(errorSpan, input.nextSibling);
        input.addEventListener("blur", () => validateField(input));
    });
    showStep(currentStep);


    const statesWithDistricts = {
    "Andaman and Nicobar Islands": ["Nicobar", "North and Middle Andaman", "South Andaman"],
    "Andhra Pradesh": ["Anantapur", "Chittoor", "East Godavari", "Guntur", "Kadapa", "Krishna", "Kurnool", "Nellore", "Prakasam", "Srikakulam", "Visakhapatnam", "Vizianagaram", "West Godavari"],
    "Arunachal Pradesh": ["Anjaw", "Changlang", "East Kameng", "East Siang", "Kra Daadi", "Kurung Kumey", "Lepa Rada", "Lohit", "Longding", "Lower Dibang Valley", "Lower Siang", "Lower Subansiri", "Namsai", "Pakke Kessang", "Papum Pare", "Shi Yomi", "Siang", "Tawang", "Tirap", "Upper Dibang Valley", "Upper Siang", "Upper Subansiri", "West Kameng", "West Siang"],
    "Assam": ["Baksa", "Barpeta", "Biswanath", "Bongaigaon", "Cachar", "Charaideo", "Chirang", "Darrang", "Dhemaji", "Dhubri", "Dibrugarh", "Dima Hasao", "Goalpara", "Golaghat", "Hailakandi", "Hojai", "Jorhat", "Kamrup", "Kamrup Metropolitan", "Karbi Anglong", "Karimganj", "Kokrajhar", "Lakhimpur", "Majuli", "Morigaon", "Nagaon", "Nalbari", "Sivasagar", "Sonitpur", "South Salmara-Mankachar", "Tinsukia", "Udalguri", "West Karbi Anglong"],
    "Bihar": ["Araria", "Arwal", "Aurangabad", "Banka", "Begusarai", "Bhagalpur", "Bhojpur", "Buxar", "Darbhanga", "East Champaran", "Gaya", "Gopalganj", "Jamui", "Jehanabad", "Kaimur", "Katihar", "Khagaria", "Kishanganj", "Lakhisarai", "Madhepura", "Madhubani", "Munger", "Muzaffarpur", "Nalanda", "Nawada", "Patna", "Purnia", "Rohtas", "Saharsa", "Samastipur", "Saran", "Sheikhpura", "Sheohar", "Sitamarhi", "Siwan", "Supaul", "Vaishali", "West Champaran"],
    "Chandigarh": ["Chandigarh"],
    "Chhattisgarh": ["Balod", "Baloda Bazar", "Balrampur", "Bastar", "Bemetara", "Bijapur", "Bilaspur", "Dantewada", "Dhamtari", "Durg", "Gariaband", "Gaurela-Pendra-Marwahi", "Janjgir-Champa", "Jashpur", "Kabirdham", "Kanker", "Kondagaon", "Korba", "Koriya", "Mahasamund", "Mungeli", "Narayanpur", "Raigarh", "Raipur", "Rajnandgaon", "Sukma", "Surajpur", "Surguja"],
    "Dadra and Nagar Haveli and Daman and Diu": ["Dadra and Nagar Haveli", "Daman", "Diu"],
    "Delhi": ["Central Delhi", "East Delhi", "New Delhi", "North Delhi", "North East Delhi", "North West Delhi", "Shahdara", "South Delhi", "South East Delhi", "South West Delhi", "West Delhi"],
    "Goa": ["North Goa", "South Goa"],
    "Gujarat": ["Ahmedabad", "Amreli", "Anand", "Aravalli", "Banaskantha", "Bharuch", "Bhavnagar", "Botad", "Chhota Udaipur", "Dahod", "Dang", "Devbhoomi Dwarka", "Gandhinagar", "Gir Somnath", "Jamnagar", "Junagadh", "Kheda", "Kutch", "Mahisagar", "Mehsana", "Morbi", "Narmada", "Navsari", "Panchmahal", "Patan", "Porbandar", "Rajkot", "Sabarkantha", "Surat", "Surendranagar", "Tapi", "Vadodara", "Valsad"],
    "Haryana": ["Ambala", "Bhiwani", "Charkhi Dadri", "Faridabad", "Fatehabad", "Gurugram", "Hisar", "Jhajjar", "Jind", "Kaithal", "Karnal", "Kurukshetra", "Mahendragarh", "Nuh", "Palwal", "Panchkula", "Panipat", "Rewari", "Rohtak", "Sirsa", "Sonipat", "Yamunanagar"],
    "Himachal Pradesh": ["Bilaspur", "Chamba", "Hamirpur", "Kangra", "Kinnaur", "Kullu", "Lahaul-Spiti", "Mandi", "Shimla", "Sirmaur", "Solan", "Una"],
    "Jammu and Kashmir": ["Anantnag", "Bandipora", "Baramulla", "Budgam", "Doda", "Ganderbal", "Jammu", "Kathua", "Kishtwar", "Kulgam", "Kupwara", "Poonch", "Pulwama", "Rajouri", "Ramban", "Reasi", "Samba", "Shopian", "Srinagar", "Udhampur"],
    "Jharkhand": ["Bokaro", "Chatra", "Deoghar", "Dhanbad", "Dumka", "East Singhbhum", "Garhwa", "Giridih", "Godda", "Gumla", "Hazaribagh", "Jamtara", "Khunti", "Koderma", "Latehar", "Lohardaga", "Pakur", "Palamu", "Ramgarh", "Ranchi", "Sahebganj", "Seraikela-Kharsawan", "Simdega", "West Singhbhum"],
    "Karnataka": ["Bagalkote", "Ballari", "Belagavi", "Bengaluru Rural", "Bengaluru Urban", "Bidar", "Chamarajanagar", "Chikkaballapur", "Chikkamagaluru", "Chitradurga", "Dakshina Kannada", "Davanagere", "Dharwad", "Gadag", "Hassan", "Haveri", "Kalaburagi", "Kodagu", "Kolar", "Koppal", "Mandya", "Mysuru", "Raichur", "Ramanagara", "Shivamogga", "Tumakuru", "Udupi", "Uttara Kannada", "Vijayapura", "Yadgir"],
    "Kerala": ["Alappuzha", "Ernakulam", "Idukki", "Kannur", "Kasaragod", "Kollam", "Kottayam", "Kozhikode", "Malappuram", "Palakkad", "Pathanamthitta", "Thiruvananthapuram", "Thrissur", "Wayanad"],
    "Ladakh": ["Kargil", "Leh"],
    "Lakshadweep": ["Agatti", "Amini", "Androth", "Bithra", "Chetlat", "Kadmat", "Kalpeni", "Kavaratti", "Kilthan", "Minicoy"],
    "Madhya Pradesh": ["Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar", "Balaghat", "Barwani", "Betul", "Bhind", "Bhopal", "Burhanpur", "Chhatarpur", "Chhindwara", "Damoh", "Datia", "Dewas", "Dhar", "Dindori", "Guna", "Gwalior", "Harda", "Hoshangabad", "Indore", "Jabalpur", "Jhabua", "Katni", "Khandwa", "Khargone", "Mandla", "Mandsaur", "Morena", "Narsinghpur", "Neemuch", "Panna", "Raisen", "Rajgarh", "Ratlam", "Rewa", "Sagar", "Satna", "Sehore", "Seoni", "Shahdol", "Shajapur", "Sheopur", "Shivpuri", "Sidhi", "Singrauli", "Tikamgarh", "Ujjain", "Umaria", "Vidisha"],
    "Puducherry": ["Karaikal", "Mahe", "Pondicherry", "Yanam"],
    "Punjab": ["Amritsar", "Barnala", "Bathinda", "Faridkot", "Fatehgarh Sahib", "Fazilka", "Ferozepur", "Gurdaspur", "Hoshiarpur", "Jalandhar", "Kapurthala", "Ludhiana", "Mansa", "Moga", "Mohali", "Muktsar", "Pathankot", "Patiala", "Rupnagar", "Sangrur", "Shaheed Bhagat Singh Nagar", "Tarn Taran"],
    "Rajasthan": ["Ajmer", "Alwar", "Banswara", "Baran", "Barmer", "Bharatpur", "Bhilwara", "Bikaner", "Bundi", "Chittorgarh", "Churu", "Dausa", "Dholpur", "Dungarpur", "Hanumangarh", "Jaipur", "Jaisalmer", "Jalore", "Jhalawar", "Jhunjhunu", "Jodhpur", "Karauli", "Kota", "Nagaur", "Pali", "Pratapgarh", "Rajsamand", "Sawai Madhopur", "Sikar", "Sirohi", "Sri Ganganagar", "Tonk", "Udaipur"],
    "Sikkim": ["East Sikkim", "North Sikkim", "South Sikkim", "West Sikkim"],
    "Tamil Nadu": ["Ariyalur", "Chengalpattu", "Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kallakurichi", "Kanchipuram", "Kanyakumari", "Karur", "Krishnagiri", "Madurai", "Mayiladuthurai", "Nagapattinam", "Namakkal", "Nilgiris", "Perambalur", "Pudukkottai", "Ramanathapuram", "Ranipet", "Salem", "Sivaganga", "Tenkasi", "Thanjavur", "Theni", "Thoothukudi", "Tiruchirappalli", "Tirunelveli", "Tirupathur", "Tiruppur", "Tiruvallur", "Tiruvannamalai", "Tiruvarur", "Vellore", "Viluppuram", "Virudhunagar"],
    "Telangana": ["Adilabad", "Bhadradri Kothagudem", "Hanamkonda", "Hyderabad","Jagtial", "Jangaon", "Jayashankar Bhupalpally", "Jogulamba Gadwal", "Kamareddy", "Karimnagar", "Khammam", "Komaram Bheem", "Mahabubabad", "Mahabubnagar", "Mancherial","Medak", "Medchal-Malkajgiri", "Mulugu", "Nagarkurnool", "Nalgonda", "Narayanpet", "Nirmal", "Nizamabad", "Peddapalli","Rajanna Sircilla", "Rangareddy", "Sangareddy", "Siddipet","Suryapet", "Vikarabad", "Wanaparthy", "Warangal","Yadadri Bhuvanagiri"],
    "Tripura": ["Dhalai", "Gomati", "Khowai", "North Tripura","Sepahijala", "South Tripura", "Unakoti", "West Tripura"],
    "Uttar Pradesh": ["Agra", "Aligarh", "Prayagraj", "Ambedkar Nagar", "Amethi", "Amroha", "Auraiya", "Azamgarh", "Baghpat", "Bahraich", "Ballia", "Balrampur", "Banda", "Barabanki", "Bareilly", "Basti", "Bijnor", "Budaun", "Bulandshahr", "Chandauli", "Chitrakoot", "Deoria", "Etah", "Etawah", "Ayodhya", "Farrukhabad", "Fatehpur", "Firozabad", "Gautam Buddh Nagar", "Ghaziabad", "Ghazipur", "Gonda", "Gorakhpur", "Hamirpur", "Hapur", "Hardoi", "Hathras", "Jalaun", "Jaunpur", "Jhansi", "Kannauj", "Kanpur Dehat", "Kanpur Nagar", "Kasganj", "Kaushambi", "Kushinagar", "Lakhimpur Kheri", "Lalitpur", "Lucknow", "Maharajganj", "Mahoba", "Mainpuri", "Mathura", "Mau", "Meerut", "Mirzapur", "Moradabad", "Muzaffarnagar", "Pilibhit", "Pratapgarh", "Raebareli", "Rampur", "Saharanpur", "Sambhal", "Sant Kabir Nagar", "Sant Ravidas Nagar", "Shahjahanpur", "Shamli", "Shrawasti", "Siddharthnagar","Sitapur", "Sonbhadra", "Sultanpur", "Unnao", "Varanasi"],
    "West Bengal": ["Alipurduar", "Bankura", "Birbhum", "Cooch Behar", "Dakshin Dinajpur", "Darjeeling", "Hooghly", "Howrah", "Jalpaiguri", "Jhargram", "Kalimpong", "Kolkata", "Malda", "Murshidabad", "Nadia", "North 24 Parganas", "Paschim Bardhaman", "Paschim Medinipur", "Purba Bardhaman", "Purba Medinipur", "Purulia", "South 24 Parganas", "Uttar Dinajpur"]
};
        function toggleAddressOptions() {
            const isOutOfIndia = document.querySelector('input[name="Address_out_of_India"]:checked').value === "yes";
            const stateDropdown = document.getElementById("state-dropdown");
            const districtDropdown = document.getElementById("district-dropdown");
            const stateText = document.getElementById("state-text");
            const districtText = document.getElementById("district-text");
            const stateinput = document.getElementById("state_text");
            const districtinput = document.getElementById("district_text");
            if (isOutOfIndia) {
                stateDropdown.classList.add("hidden");
                districtDropdown.classList.add("hidden");
                stateText.classList.remove("hidden");
                districtText.classList.remove("hidden");
                stateinput.setAttribute("required", true);
                districtinput.setAttribute("required", true);
            } else {
                stateDropdown.classList.remove("hidden");
                districtDropdown.classList.remove("hidden");
                stateText.classList.add("hidden");
                districtText.classList.add("hidden");
                stateinput.removeAttribute("required");
                districtinput.removeAttribute("required");
            }
        }
        function populateStates() {
            const stateSelect = document.getElementById("state");
            for (const state in statesWithDistricts) {
                const option = document.createElement("option");
                option.value = state;
                option.textContent = state;
                stateSelect.appendChild(option);
            }
        }
        function populateDistricts() {
            const stateSelect = document.getElementById("state");
            const districtSelect = document.getElementById("district");
            const selectedState = stateSelect.value;

            districtSelect.innerHTML = "<option value=''>Select District</option>";

            if (selectedState && statesWithDistricts[selectedState]) {
                statesWithDistricts[selectedState].forEach(district => {
                    const option = document.createElement("option");
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
    }
    document.addEventListener("DOMContentLoaded", populateStates);
    let formSubmitted = false;
    document.querySelector("form").addEventListener("submit", function () { formSubmitted = true; });
    window.addEventListener("beforeunload", function (event) {
    if (!formSubmitted) {
        const confirmationMessage = "Are you sure you want to reload or leave this page?";
        event.preventDefault();
        event.returnValue = confirmationMessage; // Required for most browsers
        return confirmationMessage;
        }
    });
    </script>
</body>
</html>