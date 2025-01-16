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
                <h1 class="title">Earthquake Preparedness</h1>
                
                <div class="mb-4">
                <img src="assets/img/earthquake/earthquake.jpeg" alt="Stay Safe After Earthquake" class="img-fluid rounded mb-3">
                An earthquake is a sudden, rapid shaking of the earth caused by the shifting of underground rock. Deaths and injuries occur when people fall trying to walk
                 or run during shaking or when they are hit by falling debris. Smaller earthquakes, called aftershocks,
                  always follow the mainshock. Earthquakes can cause tsunamis, landslides, fires, and damage to utilities.
                   Earthquakes can happen anywhere, and there is no way to predict them. But we can take action to prepare. 
                   Prepare now to protect yourself, your loved ones, and your home.
                </div>
                <!-- Prepare Before Section -->
                <div id="before" class="mb-5">
                    <h2 style="font-weight:bold">Prepare Before an Earthquake</h2>
                    <!-- <img src="assets/img/prepare-before.jpg" alt="Prepare Before Earthquake" class="img-fluid rounded mb-3"> -->
                    <p>
                        Earthquakes can happen anywhere but are more common in certain areas. Find out if you live in an area prone to earthquakes.
                    </p>

                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Practice Drop, Cover, and Hold On</h2>
                    </div>
                        <p>During an earthquake, you should <strong>Drop, Cover, and Hold On</strong> to protect yourself from falling debris.
                         Practice with your entire household so everyone knows what to do. Here is how to practice:
                        </p>
                    
                    <div>
                        <p><strong>DROP </strong>
                            where you are onto your hands and knees.
                        </p>
    
                        <ul style="list-style-type: disc;">
                            <li>This position protects you from being knocked down and allows you to crawl to a protected space.</li>
                        </ul>
                        <p><strong>COVER </strong>
                             your head and neck with your arms.
                        </p>
                            <ul style="list-style-type: disc;">
                                <li>If a sturdy table or desk is nearby, crawl underneath it for protection.</li>
                                <li>If you cannot find a protected space, crawl to an interior wall (away from windows).</li>
                                <li>Stay on your knees and bend over to protect yourself from injury.</li>
                            </ul>
                        <p><strong>HOLD ON </strong>
                            until the shaking stops.
                        </p>
                            <ul style="list-style-type: disc;">
                                <li>If you are under a table or desk, hold onto it as things will be moving. Use an arm to protect your head and neck.</li>
                                <li>If you are not under a protected space: Protect your head and neck with both arms.</li>
                            </ul>
                    </div>

                    <div class="text-center mb-4">
                        <h2 class="fw-bold">To Prevent Injuries, Secure Your Space</h2>
                    </div>
                    <div>
                        <ul style="list-style-type: disc;">
                            <li>Identify things that might fall during shaking. Imagine if the room were picked up, shaken up and down, and side to side. Which items could fall and injure you? Consider things such as televisions, shelves, mirrors, pictures, water heaters, refrigerators, and bookcases.</li>
                            <li>Secure these items so they don't injure you during an earthquake. Straps, hooks, latches, and other safety devices are widely available.</li>
                            <li>If you live in an area prone to earthquakes, get your building evaluated and consider structural improvements.</li>
                            <li>Earthquakes are generally not covered by household or renters’ insurance. Earthquake insurance policies may be available. Check with insurance providers,</li>
                        </ul>
                    

                    </div>
                    </div>
                </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="width: 45%;">
                    <h2>Plan to Stay Connected</h2>
                    <ul style="list-style-type: disc; padding-left: 20px;">
                        <li>Have a backup battery or a way to charge your cell phone.</li>
                        <li>Have a battery-powered radio so that you can stay informed.</li>
                        <li>Create a personal support team of people you may assist and who can assist you.</li>
                        <li>There is no way to predict an earthquake, but earthquake early-warning systems are in development. See if they are available in your area.</li>
                    </ul>
                </div>
                <div style="width: 45%;">
                    <h2>Learn Emergency Skills</h2>
                    <ul style="list-style-type: disc; padding-left: 20px;">
                    <li>Learn First Aid and CPR to help others. People may be injured, and emergency services may not be available.</li>
                    <li>Learn how to turn off the utilities in your home.</li>
                    <li>Get a fire extinguisher and learn how to use it safely.</li>
                    <li>Be ready to live without power, gas, and water.</li>
                    </ul>
                </div>
            </div>

            <div class=" mb-4">
                    <h2 class="fw-bold text-center">Gather Emergency Supplies</h2>
                    <ul style="list-style-type: disc;">
                        <li>Gather food, water, and medicine.  Stores and pharmacies might be closed. Organize supplies into a Go-Kit, Stay-at-Home-Kit, and a Bed-Kit:</li>
                            <ul style="list-style-type:circle">
                                <li>Go-Kit: at least 3 days of supplies that you can carry with you. Include batteries and chargers for your devices (cell phone, CPAP, wheelchair, etc.)</li>
                                <li>Stay-at-Home Kit: at least 2 weeks of supplies. </li>
                                <li>Bed-Kit: a bag of supplies attached to your bed. Include items you will need if an earthquake happens while you are sleeping. Store sturdy shoes to protect your feet from glass, one of the most common earthquake injuries. Also include a flashlight, glasses, a dust mask, and a whistle.</li>
                            </ul>
                        <li>Have a 1-month supply of medication in a child-proof container, and other needed medical supplies or equipment. </li>
                        <li>Keep personal, financial, and medical records safe and easy to access (hard copies or securely backed up). Consider keeping a list of your medications and dosages on a small card to carry with you.</li>
                        <li>Stock up on earthquake preparedness kits, survival kits, and other first aid supplies.</li>
                    </ul>
            </div>

                <!-- Stay Safe During Section -->
                <div id="during" class="mb-5">
                    <h2>Stay Safe During an Earthquake</h2>
                    <!-- <img src="assets/img/stay-safe-during.jpg" alt="Stay Safe During Earthquake" class="img-fluid rounded mb-3"> -->
                    <p style="text-align: center; font-size: 1.5rem;">
                        When shaking starts, <strong style="color:red;"> <i> DROP </i></strong>, <strong style="color:red;"> <i>COVER </i></strong>, and <strong style="color:red;"> <i>HOLD ON </i></strong> to protect yourself
                    </p>

                    <ul style="list-style-type: disc;">
                        <li>Gather food, water, and medicine.  Stores and pharmacies might be closed. Organize supplies into a Go-Kit, Stay-at-Home-Kit, and a Bed-Kit:</li>
                        <li>Go-Kit: at least 3 days of supplies that you can carry with you. Include batteries and chargers for your devices (cell phone, CPAP, wheelchair, etc.)</li>
                        <li>Stay-at-Home Kit: at least 2 weeks of supplies. </li>
                        <li>Bed-Kit: a bag of supplies attached to your bed. Include items you will need if an earthquake happens while you are sleeping. Store sturdy shoes to protect your feet from glass, one of the most common earthquake injuries. Also include a flashlight, glasses, a dust mask, and a whistle.</li>
                        <li>Have a 1-month supply of medication in a child-proof container, and other needed medical supplies or equipment. </li>
                        <li>Keep personal, financial, and medical records safe and easy to access (hard copies or securely backed up). Consider keeping a list of your medications and dosages on a small card to carry with you.</li>
                        <li>Stock up on earthquake preparedness kits, survival kits, and other first aid supplies.</li>
                    </ul>
                </div>

                <!-- Stay Safe After Section -->
                <div id="after" class="mb-5">
                    <h2>After an Earthquake</h2>
                       <h2 style="text-align:center">
                            Stay Safe!
                       </h2>
                    
                    <ul style="list-style-type: disc;">
                        <li>Wait a minute before getting up. Check for any immediate dangers around you and protect yourself.</li>
                        <li>Anticipate broken glass and debris on the ground, so put on sturdy shoes as soon as possible.</li>
                        <li>If it is safe, exit the building. Go outside to a clear area. Check to make sure nothing will fall on you, such as bricks from a building, power lines, and trees.</li>
                        <li>If you do not have a safe area outside, it may be better to remain inside.</li>
                        <li>If you are near the coast, a tsunami could follow the earthquake. As soon as the shaking stops, climb to safety. Walk quickly to higher ground or inland away from the coast. Don't wait for officials to issue a warning.</li>
                        <li>Expect aftershocks. <b> Drop, Cover, and Hold On </b> whenever you feel shaking.</li>
                        <li>If you are trapped:</li>
                            <ul style="list-style-type:circle">
                                <li>Protect your mouth, nose, and eyes from airborne debris. You can use a cloth, clothing, or a dust mask to cover your mouth and nose.</li>
                                <li>Signal for help. Use a whistle or knock loudly on a solid piece of the building three times every few minutes. Rescue personnel listen for such sounds.</li>
                            </ul>
                        <li>Care for any injuries you may have and assist others.</li>
                        <li>If your home has been damaged and is no longer safe, leave and go to a safer place. If you can, take your <i>Go-Kit</i> of supplies.</li>
                        <li>Use flashlights, not candles, due to fire risk.</li>
                        <li>Do not use matches, lighters, appliances, or light switches until you are sure there are no gas leaks. Sparks from electrical switches could ignite the gas, causing an explosion.</li>
                    </ul>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div style="width: 45%;">
                        <h2>Stay Connected</h2>
                        <ul style="list-style-type: disc; padding-left: 20px;">
                            <li>Listen to local radio, TV, or other news sources for emergency information.</li>
                            <li>Let friends and family know you are safe when you can.</li>
                        </ul>
                    </div>
                    <div style="width: 45%;">
                        <h2>Take Care of Yourself</h2>
                        <ul style="list-style-type: disc; padding-left: 20px;">
                            <li>It's normal to have a lot of bad feelings, stress, or anxiety.</li>
                            <li>Eat healthy food and get enough sleep to help you deal with stress.</li>
                            <li>You can contact the Disaster Distress Helpline for free if you need to talk to someone.</li>
                        </ul>
                    </div>
                </div>

                <div>
                    <h2 style="text-align:center;">Check Your Home for Safety</h2>
                    <ul style="list-style-type: disc;">
                        <li>Follow guidance from local officials.</li>
                        <li>Inspect the outside of your home for damage before re-entering. If safe to do so, check the inside of your home.</li>
                        <li>Check for damage to gas, water, electrical, and sewage systems. If there is damage, turn the utility off.</li>
                        <li>If you suspect a gas leak, leave your home, and call 911. Once you are in a safe place, report the issue to your utility company.</li>
                        <li>If needed, have your home inspected by a professional for damage and safety issues.</li>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
