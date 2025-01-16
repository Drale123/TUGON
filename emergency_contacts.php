<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Hotlines</title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-4">Emergency Hotlines</h1>

    <!-- National Emergency Hotline -->
    <div class="text-center mb-4">
        <h2 class="text-danger">National Emergency Hotline</h2>
        <p style="font-size: 2rem;"><strong>911</strong></p>
    </div>
    
    <!-- Search Bar -->
    <div class="d-flex justify-content-end mb-4">
        <div class="input-group" style="max-width: 500px;">
            <span class="input-group-text bg-white border-end-0" id="search-icon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search hotlines...">
        </div>
    </div>

    <!-- Hotlines List -->
    <div id="hotlineList">
        <!-- Indicator for Letter A -->
        <div class="category" data-category="A">
            <h3 class="mt-4">A</h3>
            
            <div class="hotline-item">
                <h5>Ambulance Services</h5>
                <p>(02) 1234-5678</p>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>ARTECHE MPS</h5>
                <a  class="single" href="tel: +639 29 176 6617">+639 29 176 6617</a>
                <!-- <p>0949 603 6299 (Smart)</p> -->
                <hr>
            </div>
        </div>

        <div class="category" data-category="B">
            <h3 class="mt-4">B</h3>
            <div class="hotline-item">
                <h5>BALANGIGA MPS</h5>
                <a  class="single" href="tel: +63947 279 3966">0947 279 3966</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>BFP-BORONGAN</h5>
                <a  class="single" href="tel: +63950 275 3249">0950 275 3249 (Smart)</a> <br>
                <a  class="single" href="tel: +63977 657 0373">0977 657 0373 (Globe)</a>
                <hr>
            </div>
            

            <div class="hotline-item">
                <h5>BORONGAN CITY POLICE STATION</h5>
                <a  class="single" href="tel: +63947 562 5575">0947 562 5575 (Smart)</a> <br>
                <a  class="single" href="tel: +63935 893 1089">0935 893 1089 (Globe)</a>
                <hr>
            </div>

            
        </div>

        <div class="category" data-category="C">
            <h3 class="mt-4">C</h3>

            <div class="hotline-item">
                <h5>CAN-AVID MPS</h5>
                <a  class="single" href="tel: +63919 962 1555">0919 962 1555 (Smart)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>CDRRMO BORONGAN</h5>
                <a  class="single" href="tel: +63995 925 6105">0995 925 6105 (Smart)</a>
                <hr>
            </div>
        </div>

        <div class="category" data-category="D">
            <h3 class="mt-4">D</h3>

            <div class="hotline-item">
                <h5>DOLORES MPS</h5>
                <a  class="single" href="tel: +639918 617 5345">0918 617 5345 (Smart)</a>
                <hr>
            </div>
            
        </div>

        <div class="category" data-category="E">
            <h3 class="mt-4">E</h3>
            <div class="hotline-item">
                <h5>ESAMELCO CAO</h5>
                <a  class="single" href="tel: +63917 521 9152">0917 521 9152 (Globe)</a> <br>
                <a  class="single" href="tel: +63917 521 62132">0917 521 62132 (Globe)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>ESPH</h5>
                <a  class="single" href="tel: +63905 894 5900">0905 894 5900 (Globe)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>EASTERN SAMAR COAST GUARD</h5>
                <a  class="single" href="tel: +63950 275 3249">0950 275 3249 (Smart)</a> <br>
                <a  class="single" href="tel: +63977 657 0373">0977 657 0373 (Globe)</a>
                <hr>
            </div>
        </div>

        <div class="category" data-category="F">
            <!-- <h3 class="mt-4">F</h3> -->
            
        </div>

        <div class="category" data-category="G">
            <h3 class="mt-4">G</h3>
            
            <div class="hotline-item">
                <h5>GEN McARTHUR MPS</h5>
                <a  class="single" href="tel: +63949 308 8480">0949 308 8480 (Smart)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>GIPORLOS MPS</h5>
                <a  class="single" href="tel: +63927 948 3387">0927 948 3387 (Smart)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>GUIUAN MPS</h5>
                <a  class="single" href="tel: (055) 271 3117">(055) 271 3117</a>
                <hr>
            </div>
            
        </div>

        <div class="category" data-category="H">
            <h3 class="mt-4">H</h3>

            <div class="hotline-item">
                <h5>HERNANI MPS</h5>
                <a  class="single" href="tel: +63910 831 4477">0910 831 4477 (Smart)</a>
                <p>0910 831 4477 (Smart)</p>
                <hr>
            </div>
            
        </div>

        <div class="category" data-category="I">
            <!-- <h3 class="mt-4">I</h3> -->
            
        </div>

        <div class="category" data-category="J">
            <h3 class="mt-4">J</h3>
           
            <div class="hotline-item">
                <h5>JIPAPAD MPS</h5>
                <a  class="single" href="tel: +63929 791 3863">0929 791 3863 (Smart)</a>
                <hr>
            </div>
            
        </div>

        <div class="category" data-category="K">
            <!-- <h3 class="mt-4">K</h3> -->
            
        </div>

        <div class="category" data-category="L">
            <h3 class="mt-4">L</h3>
            
            <div class="hotline-item">
                <h5>LAWAAN MPS</h5>
                <a  class="single" href="tel: +63977 657 0373">0912 308 6510 (Smart)</a>
                <hr>
            </div>
            

            <div class="hotline-item">
                <h5>LLORENTE MPS</h5>
                <a  class="single" href="tel: +63947 207 6746">0947 207 6746 (Smart)</a>
                <hr>
            </div>
        </div>

        <div class="category" data-category="M">
            <h3 class="mt-4">M</h3>
            
            <div class="hotline-item">
                <h5>MASLOG MPS</h5>
                <a  class="single" href="tel: +63912 969 8298">0912 969 8298 (Smart)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>MAYDOLONG MPS</h5>
                <a  class="single" href="tel: +63947 562 5575">0947 562 5575(Smart)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>MERCEDES MPS</h5>
                <a  class="single" href="tel: +63912 969 6443">0912 969 6443 (Smart)</a>
                <hr>
            </div>
        </div>

        <div class="category" data-category="N">
            <!-- <h3 class="mt-4">N</h3> -->
            

        <div class="category" data-category="O">
            <!-- <h3 class="mt-4">O</h3> -->
            
        </div>

        <div class="category" data-category="P">
            <h3 class="mt-4">P</h3>
            <h5>PDRRMO EASTERN SAMAR</h5>
            <a  class="single" href="tel: (055) 560-8600">(055) 560-8600</a> <br>
            <a  class="single" href="tel: +63917 117 0807">0917 117 0807 (Globe)</a>
            <hr>
            
        </div>

        <div class="category" data-category="Q">
            <h3 class="mt-4">Q</h3>
            <div class="hotline-item">
                <h5>QUINAPONDAN MPS</h5>
                <a  class="single" href="tel: +63977 657 0373">0947 279 3821 (Globe)</a>
                <hr>
            </div>
            
            
        </div>

        <div class="category" data-category="R">
            <!-- <h3 class="mt-4">R</h3> -->
            
        </div>

        <div class="category" data-category="S">
            <h3 class="mt-4">S</h3>
            
            <div class="hotline-item">
                <h5>SAN JULIAN MPS</h5>
                <a  class="single" href="tel: +63998 421 8166">0998 421 8166 (Smart)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>SAN POLICARPO MPS</h5>
                <a  class="single" href="tel: +63921 209 9009">0921 209 9009 (Smart)</a>
                <hr>
            </div>

            <div class="hotline-item">
                <h5>SALCEDO MPS</h5>
                <a  class="single" href="tel: +63999 882 6449">0999 882 6449 (Smart)</a>
                <hr>
            </div>
        </div>

        <div class="category" data-category="T">
            <h3 class="mt-4">T</h3>

            <div class="hotline-item">
                <h5>TAFT MPS</h5>
                <a  class="single" href="tel: +63949 771 9319">0949 771 9319 (Smart)</a>
                <hr>
            </div>
            
        </div>

        <div class="category" data-category="U">
            <!-- <h3 class="mt-4">U</h3> -->
            
        </div>

        <div class="category" data-category="V">
            <!-- <h3 class="mt-4">V</h3> -->
            
        </div>

        <div class="category" data-category="W">
            <!-- <h3 class="mt-4">W</h3> -->
            
        </div>

        <div class="category" data-category="X">
            <!-- <h3 class="mt-4">X</h3> -->
            
        </div>

        <div class="category" data-category="Y">
            <!-- <h3 class="mt-4">Y</h3> -->
            
        </div>

        <div class="category" data-category="Z">
            <!-- <h3 class="mt-4">Z  </h3> -->
            
        </div>











    </div>
</div>

<script>    
    document.getElementById('searchInput').addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const hotlineItems = document.querySelectorAll('.hotline-item');
        const categories = document.querySelectorAll('.category');

        categories.forEach(category => {
            let hasVisibleItems = false;
            const items = category.querySelectorAll('.hotline-item');

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = '';
                    hasVisibleItems = true;
                } else {
                    item.style.display = 'none';
                }
            });

            // Show or hide the category header based on visible items
            category.style.display = hasVisibleItems ? '' : 'none';
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>
