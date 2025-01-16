<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Earthquake Preparedness</title>
    <style>
        /* Title with blue underline */
        .title {
            position: relative;
            font-weight: bold;
            font-size: 2.5rem;
            padding-bottom: 10px;
        }

        .title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #187FC1;
        }

        /* Sidebar navigation */
        .sidebar {
            position: fixed;
            top: 100px;
            left: 20px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            color: #007bff;
            text-decoration: none;
            padding: 8px;
            border-radius: 3px;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <!-- <div class="sidebar">
        <a href="#before">Before</a>
        <a href="#during">During</a>
        <a href="#after">After</a>
    </div> -->

    <!-- Full-width Image Banner -->
    <div class="banner"></div>

    <div class="row mt-4">
        <!-- Main Content -->
        <div class="col-md-9 mx-auto">
            <div class="container my-4">
                <h1 class="title">Volcanic Eruption Preparedness</h1>
                
                <div class="mb-4">
                <img src="assets/img/volcanic_eruption/volcanic_eruption.jpg" alt="Stay Safe After Earthquake" class="img-fluid rounded mb-3">
                    An extreme heat event is a series of hot days, much hotter than average for a particular time and place. Extreme heat is deadly and kills more people than any other weather event. Climate change is making extreme heat events more frequent, more severe, and last longer. But we can take action to prepare.
                    Prepare now to protect yourself and your loved ones.
                </div>
                <!-- Prepare Before Section -->
                <div id="before" class="mb-5">
                    <h2 style="font-weight:bold">Prepare Before Extreme Heat Occurs</h2>
                    
                    <div class="mb-4">
                        <h3 class="fw-bold text-center">Learn How to Stay Hydrated</h3>
                            <p>
                                You need to drink enough water to prevent heat illness. An average person needs to drink about 3/4 of a gallon of water daily.
                                Everyone’s needs may vary.
                            </p>
                            <ul style="list-style-type: disc;">
                                <li>You can check that you are getting enough water by noting your urine color. Dark yellow may indicate you are not drinking enough.</li>
                                <li>Avoid sugary, caffeinated and alcoholic drinks.</li>
                                <li>If you are sweating a lot, combine water with snacks or a sports drink to replace the salt and minerals you lose in sweat.</li>
                                <li>Talk to your doctor about how to prepare if you have a medical condition or are taking medicines.</li>
                            </ul>
                    </div>
                </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="width: 45%;">
                    <h2>Gather Emergency Supplies</h2>
                    <p>
                        Gather food, water and medicine. Stores might be closed. 
                        Organize supplies into a Go-Kit and a Stay-at-Home Kit. 
                        In the event of a power outage, you may lose access to clean drinking water. Set aside at least one gallon of drinking water per person per day. Consider adding drinks with electrolytes. 
                        Include sunscreen and wide-brimmed hats.
                    </p>
                        <ul style="list-style-type: disc; padding-left: 20px;">
                            <li> <b>Go-Kit:</b> at least three days of supplies that you can carry with you. Include backup batteries and chargers for your devices (cell phone, CPAP, wheelchair, etc.).</li>
                            <li><b>Stay-at-Home Kit:</b>  at least two weeks of supplies.</li>
                            <li>Have a 1-month supply of medication in a child-proof container and medical supplies or equipment</li>
                            <li>Keep personal, financial, and medical records safe and easy to access (hard copies or securely backed up).</li>
                        </ul>
                    <p>
                    Consider keeping a list of your medications and dosages on a small card to carry with you.
                    </p>
                </div>
                <div style="width: 45%;">
                    <h2>Make a Plan to Stay Cool</h2>
                    <p>
                        Do not rely only on electric fans during extreme heat. 
                        When temperatures are in the high 90s, fans may not prevent heat-related illness. 
                        Taking a cool shower or bath or moving to an air-conditioned place is a much better way to cool off.
                    </p>
                        <ul style="list-style-type: disc; padding-left: 20px;">
                            <li>Spending a few hours each day in air conditioning can help prevent heat illness.</li>
                                <ul style= "list-style-type: circle;">
                                    <li>If you have air conditioning, be sure that it is in working order.</li>
                                    <li>If you do not have air conditioning or if there is a power outage, find locations where you can stay cool. For example, a public library, shopping mall, or a public cooling center. Plan how you will get there.</li>
                                    <li>Additional resources may be available from local government or community groups.</li>
                                </ul>
                            <li>Make sure you have plenty of lightweight, loose clothing to wear.</li>
                            <li>Create a support team of people you may assist and who can assist you. Check in with them often to make sure that everyone is safe.</li>
                        </ul>
                </div>
            </div>

        

                
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
