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
                <h1 class="title">Storm Surge Preparedness</h1>
                
                <div class="mb-4">
                <img src="assets/img/storm_surge/storm_surge.jpg" alt="Stay Safe After Earthquake" class="img-fluid rounded mb-3">
                A storm surge is when water is pushed towards the shore by the force of winds swirling around a cyclone such as a hurricane or strong storm.
                Storm surge can combine with normal tidal patterns and cause water levels to climb more than 18 feet in height in a matter of minutes, creating a hazard far inland by flooding vast areas of low-lying land.
                </div>
                <!-- Prepare Before Section -->
                <div id="before" class="mb-5">
                    <h2 style="font-weight:bold">Preparing for a Storm Surge</h2>
                    
                    <div class="mb-4">
                            <p>
                            It’s important to be ready for a storm surge so you’re not caught unprepared. 
                            Some of the most important things you can do are:
                            </p>
                            <ul style="list-style-type: disc;">
                                <li> <strong>Know if your property is at risk </strong> – chances are you could be affected by storm surge if your property is close to the coast and you have a “nice” bathing beach with a gently sloping shore and swimming water that is not deep or does not drop off suddenly.</li>
                                <li><strong>Consult your development planning office </strong> -  
                                    to enquire whether they have a storm surge hazard map for your area so you can gauge the vulnerability and risk of this area to storm surge and the frequency of the event. 
                                    Talk to old timers to find out how far the sea normally travels during storms or hurricanes.
                                </li>
                                <li> <strong>Take action to reduce your risk and loss </strong> - 
                                – this is known as mitigation. If your area is susceptible, consult with an
                                 engineer about what type of construction would be needed to withstand the worst-case scenario.
                                </li>
                                <li> <strong>Assess your options</strong> - 
                                        the choice is then with you: either take a risk with the event or spend additional money upfront in
                                        construction to withstand the high waves. If storm surge insurance is available, buy it.
                                </li>
                                <li>
                                    <strong>Make plans</strong> -
                                    make sure you have a well-prepared personal evacuation and participate in the local community processes for planning, 
                                    preparedness, hazard mapping, evacuation planning and search and rescue.
                                </li>
                                <li>
                                    <strong>Be aware</strong> - 
                                    listen to local radio stations and obey official instructions and advisories.
                                </li>
                            </ul>
                    </div>
                </div>

                <div id="during" class="mb-5">
                    <h2 style="font-weight:bold">During a storm surge</h2>
                    
                    <div class="mb-4">
                            <p>
                            If a storm surge is occurring, you need to know the hazards you face and how to minimize those dangers. 
                            Some of the most important things you can do are:
                            </p>
                            <ul style="list-style-type: disc;">
                                <li> 
                                    <strong>Make sure you’re in a safe place </strong>  – stay at home, if it’s safe and on high ground. If you are in an unsafe area move to a designated shelter and stay there until the storm is over. 
                                    If evacuation orders are given, evacuate early to provide better management at shelters and remain indoors.
                                </li>
                                <li>
                                    <strong>Be prepared</strong> -  
                                    If you move to an emergency shelter, make sure you take some food with you, masks and hand sanitizers or rubbing alcohol (70%)
                                </li>
                                <li> <strong>Listen closely and act </strong> - 
                                during a storm surge, local authorities will be issuing advisories and official instructions identifying danger zones and issuing evacuation orders. 
                                Listen and obey these instructions and evacuate early rather than waiting until it’s too late.
                                </li>
                                
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
