//Show And Hide Password In Input Field
var showPass = document.querySelector('.show-pass');
var inputPass = document.querySelector('.input-pass');
if(showPass){
    showPass.addEventListener('click', () => {
        if (inputPass.type == 'password') {
            inputPass.type = 'text';
            showPass.classList.add('fa-eye-slash');
            showPass.classList.remove('fa-eye');
        } else {
            inputPass.type = 'password';
            showPass.classList.remove('fa-eye-slash');
            showPass.classList.add('fa-eye');
        }
    })
}

// Show Image chossed
var inputUpload = document.getElementById("userPhoto"),
    image = document.getElementById("photo");
if (inputUpload) {
    const imageSrc = image.getAttribute("src");
    inputUpload.onchange = () => {
        let reader = new FileReader();
        if (inputUpload.files[0]) {
            reader.readAsDataURL(inputUpload.files[0]);
        } else {
            image.setAttribute("src", imageSrc);
            image.classList.remove("show");
        }
        reader.onload = () => {
            image.setAttribute("src", reader.result);
            image.classList.add("show");
        };
    };
}
//hidden Alert After 5 seconds
var allAlert = document.querySelectorAll('.alert');
if (allAlert.length > 0) {
    allAlert.forEach((alert) => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000)
    })
}

//Data Table 
$(document).ready(function() {
    $('#example').DataTable();
});

//Confirm Delete Member
var deleteBtns = document.querySelectorAll('.confirm');
if (deleteBtns) {
    deleteBtns.forEach(function(e) {
        e.onclick = function() {
            return confirm('Are Your Sure Delete Member ?');
        }
    })
}

//Show And Hide Box_categorie
let allheader_category = document.querySelectorAll('.box-category .name-cate');
allheader_category.forEach((e) => {
    e.addEventListener('click', (ele) => {
        ele.target.nextElementSibling.classList.toggle('show');
    })
})