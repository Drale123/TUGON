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
                <h1 class="title">Drought Preparedness</h1>
                
                <div class="mb-4">
                <img src="assets/img/drought/drought.jpg" alt="Stay Safe After Earthquake" class="img-fluid rounded mb-3">
                        A drought is a period of abnormally dry weather that persists long enough to produce a serious hydrologic imbalance,
                        causing, for example, crop damage and shortages in the water supply. The severity of a drought depends on the degree of moisture
                        deficiency, the duration, and the size of the affected area. Drought can be defined four ways:

                    <ul style="list-style-type: disc;">
                        <li>Meteorological Drought—when an area gets less precipitation than normal. Due to climatic differences, what is considered a drought in one location may not be a drought in another location.</li>
                        <li>Agricultural Drought—when the amount of moisture in the soil no longer meets the needs of a particular crop.</li>
                        <li>Hydrological Drought—when the surface and subsurface water supplies are below normal.</li>
                        <li>Socioeconomic drought —when water supply is unable to meet human and environmental needs can upset the balance between supply and demand.</li>
                    </ul>
                </div>
                <!-- Prepare Before Section -->
                <div id="water-restrictions" class="mb-5">
                    <h2 style="font-weight:bold">Water Restrictions</h2>
                    <p>
                        In communities where drought conditions exist, officials may recommend water conservation measures to restrict use of water. These recommendations may include such procedures as
                        watering lawns and washing cars on odd or even days of the week, at night, or on weekends. The restrictions may limit hours or prohibit use of water, or require use of hand
                        watering instead of using sprinkler systems that use much more water. You should check with your local authorities or water utility for information on water restrictions that
                        may be imposed for your area.
                    </p>

                    <p>
                    Conserving water is particularly important when drought strikes, but it’s also a good habit to be in at all times for environmental reasons. Try to do at least one thing each day to conserve water.
                    </p>
                </div>

                <div id="water-restrictions" class="mb-5">
                    <h2 style="font-weight:bold">Indoor Water Conservation Tips</h2>
                    <div>
                        <h4 style="font-weight:bold">General</h4>
                            <ul style="list-style-type: disc;">
                                <li>Never pour water down the drain when there may be another use for it. Use it to water your indoor plants or garden.</li>
                                <li>Make sure your home is leak-free. Take a reading of the water meter. Wait 30 minutes without using any water and then take a second reading. If the meter reading changes, you have a leak!</li>
                                <li>Repair dripping faucets by replacing washers. One drop per second wastes 2,700 gallons of water per year!</li>
                            </ul>
                        <h4 style="font-weight:bold">Bathroom</h4>
                            <ul style="list-style-type: disc;">
                               <li>Check for toilet leaks by adding food coloring to the tank. If you have a leak, the color will appear in the bowl within 30 minutes. Leaky toilets usually can be fixed inexpensively by replacing the flapper.</li>
                               <li>Take shorter showers. Turn the water on to get wet; turn off to lather up; then turn the water back on to rinse.</li>
                               <li>Replace your showerhead with an ultra-low-flow version.</li>
                               <li>Place a bucket in the shower to catch excess water for watering plants.</li>
                               <li>Don't let the water run while brushing your teeth, washing your face or shaving.</li>
                            </ul>
                        <h4 style="font-weight:bold">Kitchen</h4>
                            <ul style="list-style-type: disc;">
                               <li>Operate dishwashers only when they are full. Use the "light wash" feature. Most dishwashers can clean soiled dishes very well, so you don’t have to rinse before washing.</li>
                               <li>When hand washing dishes, save water by filling two containers - one with soapy water and the other with rinse water containing a small amount of chlorine bleach.</li>
                               <li>Don’t use running water to thaw meat or other frozen foods. Defrost food overnight in the refrigerator, or use the defrost setting on your microwave.</li>
                               <li>Don’t waste water waiting for it to get hot or cold. Capture it for other uses such as plant watering.</li>
                               <li>Kitchen sink disposals require lots of water. Start a compost pile as an alternate way to dispose of food waste.</li>
                            </ul>
                        <h4 style="font-weight:bold">Laundry</h4>
                            <ul style="list-style-type: disc;">
                               <li>Operate clothes washers only when they are full, or set the water level for the size of your load.</li>
                            </ul>
                        <h4 style="font-weight:bold">Longterm Indoor Water Conservation</h4>
                            <ul style="list-style-type: disc;">
                              <li>Retrofit all household faucets by installing aerators with flow restrictors.</li>
                              <li>Consider installing an instant hot water heater on your sink.</li>
                              <li>If you are considering installing a new heat pump or air-conditioning system, the new air-to-air models are just as efficient as the water-to-air type and do not waste water.</li>
                              <li>When purchasing a new appliance, choose one that is more energy and water efficient.</li>
                            </ul>
                    </div>
                </div>

                <div id="water-restrictions" class="mb-5">
                    <h2 style="font-weight:bold">Outdoor Water Conservation Tips</h2>
                    <div>
                        <h4 style="font-weight:bold">General</h4>
                            <ul style="list-style-type: disc;">
                                <li>If you have a well at home, check your pump periodically. If the pump turns on and off while water is not being used, you have a leak</li>            
                            </ul>
                        <h4 style="font-weight:bold">Car Washing</h4>
                            <ul style="list-style-type: disc;">
                               <li>Use a shut-off nozzle on your hose, so that water flows only as needed. When finished, turn it off at the faucet to avoid leaks.</li>
                               <li>Consider using a commercial car wash that recycles water. If you wash your own car, park on the grass so that you will be watering it at the same time.</li>
                            </ul>
                        <h4 style="font-weight:bold">Lawn Care</h4>
                            <ul style="list-style-type: disc;">
                               <li>Don't overwater your lawn. Lawns only need to be watered every five to seven days in the summer, and every 10 to 14 days in the winter. A heavy rain eliminates the need for watering for up to two weeks.</li>
                               <li>Water in several short sessions rather than one long one in order for your lawn to better absorb moisture.</li>
                               <li>Position sprinklers so water lands on the lawn and shrubs and not on paved areas.</li>
                               <li>Check sprinkler systems and timing devices regularly to be sure they operate properly. Set a timer to remind yourself to turn manual sprinklers off. A garden hose can pour out 600 gallons in only a few hours.</li>
                               <li>Raise the lawn mower blade to at least three inches, or to its highest level. A higher cut encourages grass roots to grow deeper, shades the root system, and holds soil moisture.</li>
                            </ul>
                        <h4 style="font-weight:bold">Longterm Outdoor Water Conservation</h4>
                            <ul style="list-style-type: disc;">
                              <li>Plant native and/or drought-tolerant grasses, ground covers, shrubs and trees. They don’t need water as frequently and usually will survive a dry period without watering.</li>
                              <li>Install water efficient irrigation devices, such as micro and drip irrigation and soaker hoses.</li>
                              <li>Use mulch to retain moisture in the soil. Mulch also helps control weeds that compete with landscape plants for water.</li>
                            </ul>
                        <h4 style="font-weight:bold">In The Community</h4>
                            <ul style="list-style-type: disc;">
                              <li>Participate in public water conservation meetings conducted by your local government, utility or water management district. Support projects that lead to an increased use of reclaimed wastewater.</li>
                              <li>Follow water conservation and water shortage rules in effect, which may limit hours or prohibit use of water for certain tasks. You’re included in the restrictions even if your water comes from a private well.</li>
                              <li>Patronize businesses that practice water conservation, such as restaurants that only serve water upon request.</li>
                            </ul>
                    </div>
                </div>

                <div id="water-restrictions" class="mb-5">
                    <h3 style="font-weight:bold">Get More Drought Preparedness and Conservation Information</h3>
                    <p>Please contact your local water authority or utility district, or your local emergency management agency for information specific to your community.</p>
                </div>




                
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
