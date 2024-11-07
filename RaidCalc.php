<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rust CE Raid Calculator</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('imgs/gentsclub.png'); /* Use your background image */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: white;
            text-align: center;
        }
        .container {
            max-width: 600px; /* Adjust width for better appearance */
            background-color: rgba(0, 0, 0, 0.8); /* Black with 80% opacity for better readability */
            padding: 30px;
            border-radius: 10px; /* Rounded corners */
            margin: 20px; /* Add margin for spacing */
            position: relative;
            overflow: hidden;
        }
        h1, p {
            color: #b7410e; /* Rust color */
        }
        h1 {
            font-size: 48px; /* Adjusted font size */
            margin-bottom: 20px; /* Adjusted margin */
        }
        p {
            font-size: 20px; /* Adjusted font size */
            margin-bottom: 20px; /* Adjusted margin */
        }
        .result {
            background-color: rgba(255, 255, 255, 0.1); /* Light background for results */
            border-radius: 5px; /* Rounded corners */
            padding: 10px;
            color: #b7410e; /* Rust color */
            white-space: pre-wrap; /* Preserve whitespace for formatted output */
            text-align: center; /* Center align text */
        }

        /* Style for the floating Buy Me A Coffee button */
        .coffee-button {
            position: fixed;
            right: 7%;
            top: 5%;
            z-index: 1000; /* Ensures the button stays above other elements */
        }
        .coffee-button img {
            height: 60px;
            width: 217px;
        }

        /* CSS for Yellow Glow */
        .coffee-button img {
            box-shadow: 0 0 15px 3px rgba(255, 221, 0, 0.7); /* Yellow glow */
            border-radius: 10px; /* Rounded edges for the button */
            height: 49px;
            width: 219px;
        }

        /* Button hover effect */
        button {
            background-color: #b7410e; /* Base color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition */
        }
        button:hover {
            background-color: #ff8c00; /* Change to a lighter shade on hover */
        }

        /* Bigger dropdown styles */
        select {
            padding: 10px; /* Larger padding */
            font-size: 18px; /* Larger font size */
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body onload="showOptions()">
    <div class="container">
        <h1>Rust CE Raid Calculator</h1>
        <form method="post">
            <label for="type" style="color: #b7410e;">Select Type:</label>
            <select name="type" id="type" required onchange="showOptions()">
                <option value="door">Door</option>
                <option value="structure">Structure</option>
                <option value="placeable">Placeable</option>
                <option value="entity">Entity</option>
            </select>

            <div id="options-container">
                <label for="option" style="color: #b7410e;">Select Option:</label>
                <select name="option" id="option" required>
                    <!-- Default option will be filled based on type selection -->
                </select>
            </div>

            <button type="submit">Calculate</button>
        </form>

        <h2>Result:</h2>
        <div class="result">
        <?php
        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $type = $_POST['type'];
            $option = strtolower(trim($_POST['option'])); // Normalize the option

            // Call the appropriate function based on type
            switch ($type) {
                case 'door':
                    echo calculateDoors($option);
                    break;
                case 'structure':
                    echo calculateStructures($option);
                    break;
                case 'placeable':
                    echo calculatePlaceables($option);
                    break;
                case 'entity':
                    echo calculateEntities($option);
                    break;
                default:
                    echo "Invalid type!";
                    break;
            }
        }

        // Function to calculate door options
        function calculateDoors($option) {
            switch ($option) {
                case 'wood':
                    return "Wooden Door:\n1 Rocket (1 Second)\n4 HV Rockets (18 Seconds)\n1 Incendiary Rocket (8 Seconds)\n1 C4\n2 Satchels (10 Seconds)\n19 Explosive Ammo (7 Seconds)\n6 Bean Cans (25 Seconds)\n45 Handmade Shells\n23 F1 Grenades (59 Seconds)\n2 Molotov Cocktail (19 Seconds)\n";
                case 'sheet':
                case 'metal':
                    return "Sheet Metal Door:\n2 Rockets\n11 HV Rockets\n1 C4\n4 Satchels\n63 Explosive Ammo\n18 Bean Cans\n50 F1 Grenades\n";
                case 'garage':
                    return "Garage Door:\n3 Rockets\n25 HV Rockets\n2 C4s\n9 Satchels\n150 Explosive Ammo\n42 Bean Cans\n120 F1 Grenades\n";
                case 'armored':
                    return "Armored Door:\n4 Rockets\n34 HV Rockets\n2 C4s\n12 Satchels\n200 Explosive Ammo;\n56 Bean Cans\n160 F1 Grenades\n";
                default:
                    return "Invalid door option! Please enter one of the following options: \nWood, Sheet <b>OR</> Metal, Garage, Armored\n";
            }
        }

        // Function to calculate structure options
        function calculateStructures($option) {
            switch ($option) {
                case 'wood':
                    return "Wood Structure:\n2 Rockets\n9 HV Rockets\n1 Incendiary Rocket\n1 C4\n3 Satchels\n49 Explosive Ammo\n13 Bean Cans\n59 F1 Grenades\n";
                case 'stone':
                    return "Stone Structure:\n4 Rockets\n32 HV Rockets\n2 C4s\n10 Satchels\n185 Explosive Ammo\n46 Bean Cans\n182 F1 Grenades\n";
                case 'metal':
                    return "Metal Structure:\n8 Rockets\n67 HV Rockets\n4 C4s\n23 Satchels\n400 Explosive Ammo\n112 Bean Cans\n993 F1 Grenades\n";
                case 'armored':
                    return "Armored Structure:\n15 Rockets\n134 HV Rockets\n8 C4s\n46 Satchels\n799 Explosive Ammo\n223 Bean Cans\n1986 F1 Grenades\n";
                default:
                    return "Invalid structure option! Please enter one of the following options: \nWood, Stone, Metal, Armored\n";
            }
        }

        // Function to calculate placeable options
        function calculatePlaceables($option) {
            switch ($option) {
                case 'tc':
                case 'tool_cupboard':
                    return "Tool Cupboard:\n1 Rocket\n2 HV Rockets\n1 Incendiary Rocket\n1 C4\n1 Satchel\n10 Explosive Ammo\n4 Bean Cans\n20 Handmade Shells\n43 F1 Grenades\n";
                case 'vm':
                case 'vendy':
                case 'vending_machine':
                    return "Vending Machine:\n2 Timed Explosives and 60 Explosive Ammo\nOR\nNon Tier 3: 15 Satchels\n";
                default:
                    return "Invalid placeable option! Please enter one of the following options:\nTool Cupboard, Vending Machine\n";
            }
        }

        // Function to calculate entity options
        function calculateEntities($option) {
            switch ($option) {
                case 'bradley':
                case 'apc':
                    return "Bradley APC:\n7 HV Rockets\n20 Satchels\n571 Explosive Ammo\n40 F1 Grenades\n11 Rockets,\n";
                case 'heli':
                case 'attack_heli':
                case 'Patrol Helicopter':  
                    return "Patrol Heli:\nHP	10000,\nMain Rotor HP	900\nTail Rotor HP	500\n200+ Assault Rifle Bullets\n";
                case 'chinook':
                case 'ch47':
                    return "Chinook Crate:\n5 Minutes to Unlock (Hack)\nHeavy Scientists: 6 (Small Oil Rig) or 10 (Large Oil Rig)\n";
                default:
                    return "Invalid entity option!\n";
            }
        }
        ?>
        </div>
    </div>

  <!-- Floating Buy Me A Coffee Button -->
<div class="coffee-button">
    <a href="https://www.buymeacoffee.com/ACRxkGayhv">
        <img src="https://img.buymeacoffee.com/button-api/?text=Buy%20me%20a%20coffee&amp;emoji=&amp;slug=ACRxkGayhv&amp;button_colour=b7410e&amp;font_colour=000000&amp;font_family=Cookie&amp;outline_colour=000000&amp;coffee_colour=ffffff" />
    </a>
</div>

<!-- CSS for Yellow Glow -->
<style>
    /* Target the coffee button image and apply the yellow glow */
    .coffee-button img {
        box-shadow: 0 0 15px 3px rgba(255, 221, 0, 0.7); /* Yellow glow */
        border-radius: 10px; /* Rounded edges for the button */
    height: 49px;
    width: 219px;
    }
</style>

    <script>
        // JavaScript function to show options based on selected type
        function showOptions() {
            const type = document.getElementById('type').value;
            const optionsContainer = document.getElementById('options-container');
            const optionSelect = document.getElementById('option');

            // Clear previous options
            optionSelect.innerHTML = '';

            // Define options for each type
            const options = {
                door: ['Wood', 'Sheet Metal', 'Garage Door', 'Armored Door'],
                structure: ['Wood', 'Stone', 'Metal', 'Armored'],
                placeable: ['Tool Cupboard', 'Vending Machine'],
                entity: ['Bradley', 'Heli', 'Chinook'],
            };

            // Populate options based on selected type
            options[type].forEach(option => {
                const newOption = document.createElement('option');
                newOption.value = option.toLowerCase().replace(/ /g, "_"); // Use underscores for consistent naming
                newOption.textContent = option; // Display the human-readable option
                optionSelect.appendChild(newOption);
            });
        }
    </script>
</body>
</html>
