<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Zone List Cleaner</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        textarea {
            width: 100%;
            height: 200px;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td.zone-name {
            cursor: pointer;
            color: #007bff;
        }
        td.zone-name:hover {
            text-decoration: underline;
        }
        .copy-message {
            display: none;
            margin-top: 10px;
            color: green;
        }
        .enabled {
            color: green;
            background-color: rgba(144, 238, 144, 0.2); /* Light green background */
        }
        .disabled {
            color: red;
            background-color: rgba(255, 99, 71, 0.2); /* Light red background */
        }
        .copyable-command {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Rust Custom Zones Cleaner</h1>
    <p>To get the zone list, you must log in to your gPortal console and enter the following command:<br>
    <span class="copyable-command" onclick="copyCommand('zones.listcustomzones')">zones.listcustomzones</span></p>
    <textarea id="input" placeholder="Paste your custom zone log here..."></textarea>
    <button onclick="cleanOutput()">Clean Output</button>
    <div id="output-container">
        <table id="output-table">
            <thead>
                <tr>
                    <th>Zone Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="output"></tbody>
        </table>
    </div>
    <p class="copy-message" id="copy-message">Zone name copied!</p>

    <script>
        const excludedZones = [
            'airfield_1', 'cargoshipdynamic1', 'cargoshipdynamic2', 'gas_station_1', 'gas_station_1_2', 'harbor_1', 'harbor_2', 'launch_site_1', 'lighthouse', 'lighthouse_2', 'military_tunnel', 'mining_quarry_a', 'mining_quarry_b', 'mining_quarry_c', 'oilrig_1', 'oilrig_2', 'powerplant_1', 'radtown_small_3', 'satellite_dish', 'sphere_tank', 'supermarket_1', 'supermarket_1_2', 'trainyard_1', 'underwater_lab', 'water_treatment_plant_1', 'water_well_a', 'water_well_b', 'water_well_c', 'water_well_d', 'water_well_e', 'warehouse'
        ];

        function cleanOutput() {
            let input = document.getElementById('input').value;
            let outputTable = document.getElementById('output');
            outputTable.innerHTML = '';  // Clear previous output
            
            // Match all "Name [Zone Name] Enabled [True/False]" patterns
            let regex = /Name \[(.*?)\] Enabled \[(.*?)\]/g;
            let match;
            let zones = [];

            while ((match = regex.exec(input)) !== null) {
                let zoneName = match[1];
                let zoneStatus = match[2];

                // Skip zones in the excluded list
                if (excludedZones.includes(zoneName)) {
                    continue;
                }

                // Push valid zones into the array
                zones.push({ zoneName, zoneStatus });
            }

            // Sort the zones alphabetically by name
            zones.sort((a, b) => a.zoneName.localeCompare(b.zoneName));

            // Populate the sorted zones into the table
            zones.forEach(zone => {
                let row = document.createElement('tr');

                // Create and populate the zone name cell
                let zoneNameCell = document.createElement('td');
                zoneNameCell.classList.add('zone-name');
                zoneNameCell.textContent = zone.zoneName;
                zoneNameCell.onclick = () => copyZoneName(zone.zoneName);

                // Create and populate the status cell
                let statusCell = document.createElement('td');
                statusCell.textContent = zone.zoneStatus === 'True' ? 'Enabled' : 'Disabled';

                // Apply appropriate class based on status
                statusCell.classList.add(zone.zoneStatus === 'True' ? 'enabled' : 'disabled');

                // Append cells to the row
                row.appendChild(zoneNameCell);
                row.appendChild(statusCell);

                // Append row to the output table
                outputTable.appendChild(row);
            });
        }

        function copyZoneName(zoneName) {
            // Copy zone name to clipboard in quotes
            navigator.clipboard.writeText(`"${zoneName}"`)
                .then(() => {
                    // Show copy confirmation
                    let copyMessage = document.getElementById('copy-message');
                    copyMessage.style.display = 'block';
                    setTimeout(() => {
                        copyMessage.style.display = 'none';
                    }, 2000);
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                });
        }

        function copyCommand(command) {
            // Copy command to clipboard
            navigator.clipboard.writeText(command)
                .then(() => {
                    // Show copy confirmation
                    let copyMessage = document.getElementById('copy-message');
                    copyMessage.textContent = 'Command copied!';
                    copyMessage.style.display = 'block';
                    setTimeout(() => {
                        copyMessage.style.display = 'none';
                    }, 2000);
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                });
        }
    </script>

</body>
</html>