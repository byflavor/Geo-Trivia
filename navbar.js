let dropdownButton = document.getElementById("profileButton");
let dropdownMenu = document.getElementById("profileDropdown");
let triangle = document.getElementById("arrow");

// Triangle pointer variables
let targetPos
let stepSize;
let currentPos;
let direction;

dropdownButton.addEventListener("click", profileDrop);

// This function wasn't working for a while, so I spent some time debugging.
// This function closes the dropdown menu whenever the user clicks anywhere outside of it.
window.addEventListener("click", function (event) {
    // console.log("EventListener called.");
    if(!event.target.matches('#profileDropdown, #profileButton, #profileButton *, #profile') && !dropdownMenu.classList.contains("hidden")) {
        // console.log("Event target: " + event.target);
        dropdownMenu.classList.add("hidden");
        setTriangleValues();
        animateTriangle();
    }
});

function profileDrop() {
     dropdownMenu.classList.toggle("hidden");
     setTriangleValues();
     animateTriangle();
}

// animateTriangle makes a smooth animation to flip the triangle on the dropdown menu button every time the state of the
// dropdown menu changes.
function setTriangleValues() {
    stepSize = 1.5;
    // Sets the target position based on condition of the dropdown menu. Rotates counterclockwise to point down when it's
    // open, rotates clockwise to point left when it's closed.
    if(dropdownMenu.classList.contains("hidden")) {
        targetPos = 90;
    } else {
        targetPos = 0;
    }

    // currentPos will at this point be a matrix in the form of matrix(cosX, sinX, -sinX, cosX, 0, 0), where X is the
    // current angle of rotation. (source: https://css-tricks.com/get-value-of-css-rotation-through-javascript/)
    currentPos = window.getComputedStyle(triangle, null).getPropertyValue("transform");
    // Now we convert it to an angle:
    currentPos = currentPos.split("(")[1]; // gets rid of matrix( at the beginning of currentPos
    currentPos = currentPos.split(")")[0]; // gets rid of the ) at the end of currentPos
    currentPos = currentPos.split(","); // Finally, we have our raw matrix.

    let currentCos = parseFloat(currentPos[0]);
    let currentSin = parseFloat(currentPos[1]);

    currentPos = Math.atan2(currentSin, currentCos) * (180 / Math.PI); // At last, we have our angle!
    // console.log("Angle found: " + currentPos);

    if(currentPos < targetPos) {
        direction = 1;
    } else {
        direction = -1;
    }
    // console.log("Direction set: " + direction);
}

function animateTriangle() {
    if(currentPos !== targetPos) {
        // console.log("Position not same.");
        // console.log("In the function");
        if (Math.abs(currentPos - targetPos) < stepSize) {
            triangle.style.webkitTransition = "-webkit-transform 0.03s";
            triangle.style.webkitTransform = "rotate(" + targetPos + "deg)";
            currentPos = targetPos;
            // console.log("Should be done.");
        } else {
            currentPos = currentPos + direction * stepSize;
            triangle.style.webkitTransition = "-webkit-transform 0.03s";
            triangle.style.webkitTransform = "rotate(" + currentPos + "deg)";
            // console.log("Changing position to " + currentPos);
        }
        setInterval(animateTriangle, 30);
    }
}

function fitPropic() {
    let propic = document.getElementById("profileImg");
    propic.style.height = "100%";
    propic.style.objectFit = "cover";
    propic.style.width = propic.style.height;
}