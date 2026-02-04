<?php
// admin_dashboard.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - PDS</title>
<style>
body { font-family: Arial; background:#333; color:#fff; padding:20px; }
h1,h2,h3 { text-align:center; margin:5px 0; }
h1{font-size:24px;font-weight:bold}
h2{font-size:16px;font-weight:normal}
h3{font-size:24px;font-weight:bold}

.form-wrapper{background:#fff;color:#000;padding:15mm}
table{width:100%;border-collapse:collapse;margin-bottom:6px}
td,th{border:1px solid #000;padding:4px;vertical-align:top;font-size:11px}
.section-title{background:#555;color:#fff;font-weight:bold}
input,textarea,select{border:none;width:100%;font-size:11px;outline:none;background:transparent}
textarea{resize:none}

button{
  padding:8px 12px;
  margin:5px 0;
  cursor:pointer;
}

#pds-container{margin-top:20px;}

#applicantSelect {
  width: 300px;
  padding: 6px 8px;
  font-size: 14px;
  color: #000;
  background-color: #fff;
  border: 1px solid #555;
  border-radius: 4px;
  appearance: none;
}

#logoutBtn {
  background: #c00;
  color: #fff;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
}
</style>
</head>
<body>

<h1>ALPHATECH DEVELOPMENT CORPORATION</h1>
<h2>HUMAN RESOURCE UNIT</h2>
<h3>ADMIN DASHBOARD - PERSONAL DATA SHEETS</h3>

<div style="display:flex; justify-content: space-between; align-items: center; margin-bottom:10px;">
  <div>
    <label for="applicantSelect">Select Applicant:</label>
    <select id="applicantSelect">
      <option value="">-- Choose Applicant --</option>
    </select>
    <button onclick="downloadSelectedPDS()">Download PDF</button>
  </div>
  <div>
    <button id="logoutBtn" onclick="logout()">Logout</button>
  </div>
</div>

<div id="pds-container"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
const select = document.getElementById('applicantSelect');
const container = document.getElementById('pds-container');
let submissions = [];

// Fetch submissions from the database
fetch('get_submissions.php')
.then(res => res.json())
.then(data => {
    submissions = data;

    submissions.forEach((sub, idx) => {
        const option = document.createElement('option');
        option.value = idx;
        option.text = `${sub.last_name}, ${sub.first_name} - ${sub.submission_date}`;
        select.appendChild(option);
    });
});

select.addEventListener('change', function(){
    const idx = this.value;
    container.innerHTML = '';
    if(idx === '') return;

    const sub = submissions[idx];

    const div = document.createElement('div');
    div.id = 'pds';
    div.classList.add('form-wrapper');

    div.innerHTML = `... all your PDS HTML here ...`; // keep your full table structure

    container.appendChild(div);
});

function downloadSelectedPDS(){
    const idx = select.value;
    if(idx === '') { alert("Please select an applicant."); return; }

    const element = document.getElementById('pds');
    if(!element) return;

    const buttons = element.querySelectorAll('button, select');
    buttons.forEach(btn => btn.style.display = 'none');

    html2canvas(element, {scale:2}).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF('p', 'pt', 'a4');
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save(`PDS_${submissions[idx].last_name}_${submissions[idx].first_name}.pdf`);

        buttons.forEach(btn => btn.style.display = 'block');
    });
}

function logout() {
    window.location.href = 'admin_login.html';
}
</script>

</body>
</html>
