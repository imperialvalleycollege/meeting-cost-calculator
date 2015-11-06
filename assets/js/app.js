window.onload = function() {
    var startTimestamp = 0;   
    var endTimestamp = 0;   
    
    var startTimestampButton = document.getElementById('start-timestamp'); 
    var startTimestampElement = document.getElementById('start-timestamp-value'); 
    
    startTimestampButton.onclick = function() {
        startTimestamp = Date.now();
        startTimestampElement.innerHTML = startTimestamp;    
    }

    var endTimestampButton = document.getElementById('end-timestamp'); 
    var endTimestampElement = document.getElementById('end-timestamp-value'); 
    
    endTimestampButton.onclick = function() {
        endTimestamp = Date.now();
        endTimestampElement.innerHTML = endTimestamp;    
    }
    
    var selectElement = document.getElementById('selected-staff');
    for (var username in data)
    {
        var obj = data[username];
        var opt = document.createElement('option');
        opt.value = obj.SAL_SECOND;
        opt.innerHTML = obj.FIRST_NAME + " " + obj.LAST_NAME;
        selectElement.appendChild(opt);    
    }
    
    var pageHeading = document.getElementById('page-heading');
    var totalSalaryPerSecondForSelectedStaff = 0;
    selectElement.onchange = function() {
        totalSalaryPerSecondForSelectedStaff = 0;
        for(var i=0; i < selectElement.length; i++)
        {
            if (selectElement.options[i].selected)
            {
                totalSalaryPerSecondForSelectedStaff += Number(selectElement.options[i].value);
            }
        }
        
        //pageHeading.innerHTML = totalSalaryPerSecondForSelectedStaff;
    };
    
    window.setInterval(function() {
        if (totalSalaryPerSecondForSelectedStaff > 0 && startTimestamp > 0 && endTimestamp === 0)
        {
            var currentTimestamp = Date.now();
            var meetingCost = totalSalaryPerSecondForSelectedStaff * ((currentTimestamp - startTimestamp) / 1000);
            
            if (meetingCost < 10)
            {
                pageHeading.innerHTML = "&#9786; $" + totalSalaryPerSecondForSelectedStaff * ((currentTimestamp - startTimestamp) / 1000);    
            }
            else
            {
                pageHeading.innerHTML = "&#9785; $" + totalSalaryPerSecondForSelectedStaff * ((currentTimestamp - startTimestamp) / 1000);
            }
            
            console.log('Start Timestamp: ' + startTimestamp);
            console.log('Current Timestamp: ' + currentTimestamp);
            console.log('Total Salary Per Second for Selected: ' + totalSalaryPerSecondForSelectedStaff);
        }    
        
    }, 1000);
};